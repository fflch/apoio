<?php

use Illuminate\Support\Facades\Route;

Route::any('/institutions/search', 'InstitutionController@search')
    ->name('institutions.search');
Route::resource('/institutions', 'InstitutionController');

Route::any('/departaments/search', 'DepartamentController@search')
    ->name('departaments.search');
Route::resource('/departaments', 'DepartamentController');

Route::resource('/designations', 'DesignationController');

Route::get('/', function () {
    return view('welcome');
});
