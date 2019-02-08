<?php

Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/{id}', 'BookController@show')->name('books.show');
Route::post('/books', 'BookController@store')->name('books.store');
Route::patch('/books/{id}', 'BookController@update')->name('books.update');
Route::delete('/books/{id}', 'BookController@delete')->name('books.delete');
