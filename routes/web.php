<?php

use Illuminate\Support\Facades\Route;

Route::any('/institutions/search', 'InstitutionController@search')
    ->name('institutions.search');
Route::resource('/institutions', 'InstitutionController');

Route::any('/departaments/search', 'DepartamentController@search')
    ->name('departaments.search');
Route::resource('/departaments', 'DepartamentController');

Route::any('/designations/search', 'DesignationController@search')
    ->name('designations.search');
Route::resource('/designations', 'DesignationController');

Route::any('/roles/search', 'RoleController@search')
    ->name('roles.search');
Route::resource('/roles', 'RoleController');

Route::get('/', function () {
    return view('welcome');
});
