<?php

use Illuminate\Support\Facades\Route;

Route::any('/institutions/search', 'InstitutionController@search')
    ->name('institutions.search');
Route::resource('/institutions', 'InstitutionController');

Route::get('/', function () {
    return view('welcome');
});
