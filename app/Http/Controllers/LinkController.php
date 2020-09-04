<?php

namespace App\Http\Controllers;

use App\Link;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    $links = Auth::user()->links()->orderBy('ordering', 'asc')->get();
    return view('links.index', compact('links'));
  }

  /**
   * Display the Linker page for the current user
   *
   * @param User $user
   *
   * @return View
   */
  public function linker(User $user)
  {
    $links = $user->links()->orderBy('ordering', 'asc')->get();
    return view('linker', [
      'user' => $user,
      'links' => $links
    ]);
  }

  /**
   * Change ordering of the links for the authenticated user
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function changeOrder(Request $request)
  {
    $ordering = $request->ordering;

    $linkIds = Auth::user()->links()->pluck('id');


    if (!consistsOfTheSameValues($ordering, $linkIds->toArray())) {
      return response()->json([], 400);
    }

    for ($i = 0; $i < count($ordering); $i++) {
      Auth::user()->links()->where('id', $ordering[$i])->update([
        'ordering' => $i
      ]);
    }

    return response()->json([
      'newOrdering' => Auth::user()->links()->get()
    ], 200);

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('links.create');
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

    $link = Auth::user()->links()->orderBy('ordering', 'asc')->first();
    if ($link != null) {
      $order = $link->ordering - 1;
    } else {
      $order = -1;
    }

    Auth::user()->links()->create([
      'title' => $request->input('title'),
      'url' => $request->input('url'),
      'ordering' => $order
    ]);

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
    return view('links.edit', compact('link'));
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
    $link->update($request->only(['title', 'url']));
    flash('Your link has been updated.')->success();
    return redirect()->to(route('links.index'));
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
    flash('Your link has been deleted.')->success();
    return redirect(route('links.index'));
  }
}
