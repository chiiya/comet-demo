<?php

Route::get('/languages', 'LanguageController@index')->name('languages.index');
Route::get('/languages/{id}', 'LanguageController@show')->name('languages.show');
Route::post('/languages', 'LanguageController@store')->name('languages.store');
Route::patch('/languages/{id}', 'LanguageController@update')->name('languages.update');
Route::delete('/languages/{id}', 'LanguageController@delete')->name('languages.delete');
