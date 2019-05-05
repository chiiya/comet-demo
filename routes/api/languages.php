<?php

Route::get('/languages', 'LanguageController@index')->name('languages.index');
Route::get('/languages/{code}', 'LanguageController@show')->name('languages.show');
Route::middleware(['auth.apikey'])->group(function() {
    Route::post('/languages', 'LanguageController@store')->name('languages.store');
    Route::patch('/languages/{code}', 'LanguageController@update')->name('languages.update');
    Route::delete('/languages/{code}', 'LanguageController@delete')->name('languages.delete');
});
