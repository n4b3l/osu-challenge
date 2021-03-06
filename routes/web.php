<?php

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
    return view('pages.osu-challenge');
});
Route::get('/challenges', function () {
    return view('pages.view_challenges');
});

Route::get('/challenges/{id}', function ($id) {
    return view('pages.view_challenge',['id' => $id]);
});

Route::get('/test', function () {
    return view('pages.test');
});