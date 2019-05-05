<?php

Route::get('/authors', 'AuthorController@index')->name('authors.index');
Route::get('/authors/{id}', 'AuthorController@show')->name('authors.show');
Route::middleware(['auth.apikey'])->group(function() {
    Route::post('/authors', 'AuthorController@store')->name('authors.store');
    Route::patch('/authors/{id}', 'AuthorController@update')->name('authors.update');
    Route::delete('/authors/{id}', 'AuthorController@delete')->name('authors.delete');
});
