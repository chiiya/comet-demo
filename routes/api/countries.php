<?php

Route::get('/countries', 'CountryController@index')->name('countries.index');
Route::get('/countries/{code}', 'CountryController@show')->name('countries.show');
Route::post('/countries', 'CountryController@store')->name('countries.store');
Route::patch('/countries/{code}', 'CountryController@update')->name('countries.update');
Route::delete('/countries/{code}', 'CountryController@delete')->name('countries.delete');
