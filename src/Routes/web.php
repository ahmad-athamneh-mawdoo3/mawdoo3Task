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
Route::prefix('search')->namespace('mawdoo3\laravelTask\Controllers')->group(function () {
    Route::get('/all', 'SearchController@index')->name('searchResult');
    Route::get('/search/{searchWord?}', 'SearchController@getSearchView')->name('searchIndex');
    Route::post('/', 'SearchController@setSearch')->name('searchPost');
    Route::post('/{result}', 'SearchController@ActionResult')->name('ActionResult');
});

