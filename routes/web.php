<?php

use Illuminate\Support\Facades\Route;

Route::resource('/institutions', 'InstitutionController');

Route::get('/', function () {
    return view('welcome');
});
