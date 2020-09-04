<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'LinkController@index')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('links', 'LinkController')->except(['index']);
Route::get('/admin', 'LinkController@index')->name('links.index');

Route::post('/changeorder', function (\Illuminate\Http\Request $request) {
  $ordering = $request->ordering;

  for ($i = 0; $i < count($ordering); $i++) {
    Auth::user()->links()->where('id', $ordering[$i])->update([
      'ordering' => $i
    ]);
  }




  return response()->json([
    'newOrdering' => Auth::user()->links()->get()
    ], 200);
});
