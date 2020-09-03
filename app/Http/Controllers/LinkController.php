<?php

namespace App\Http\Controllers;

use App\Link;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $links = Auth::user()->links;
    return view('links.index', compact('links'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:255',
      'url' => 'required|url',
    ]);

    Auth::user()->links()->create($request->only(['title', 'url']));

    return redirect()->to(route('links.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Link $link
   * @return \Illuminate\Http\Response
   */
  public function show(Link $link)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Link $link
   * @return \Illuminate\Http\Response
   */
  public function edit(Link $link)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Link $link
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Link $link)
  {
    $this->authorize('update', $link);
    $request->validate([
      'title' => 'required|max:255',
      'url' => 'required|url'
    ]);
    Auth::user()->links()->update($request->only(['title', 'url']));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Link $link
   * @return \Illuminate\Http\Response
   */
  public function destroy(Link $link)
  {
    $this->authorize('delete', $link);
    $link->delete();
    return redirect(route(links.index));
  }
}
