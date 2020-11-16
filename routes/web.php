<?php

use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

Route::any('/people/search', [PeopleController::class,'search'])
    ->name('people.search');
Route::resource('/people', PeopleController::class);

Route::any('/institutions/search', [InstitutionController::class,'search'])
    ->name('institutions.search');
Route::resource('/institutions', InstitutionController::class);

Route::any('/departaments/search', [DepartamentController::class,'search'])
    ->name('departaments.search');
Route::resource('/departaments', DepartamentController::class);

Route::any('/designations/search', [DesignationController::class,'search'])
    ->name('designations.search');
Route::resource('/designations', DesignationController::class);

Route::any('/roles/search', [RoleController::class,'search'])
    ->name('roles.search');
Route::resource('/roles', RoleController::class);

Route::any('/contact_types/search', [ContactTypeController::class,'search'])
    ->name('contact_types.search');
Route::resource('/contact_types', ContactTypeController::class);

Route::any('/areas/search', [AreaController::class,'search'])
    ->name('areas.search');
Route::resource('/areas', AreaController::class);

Route::get('/', function () {
    return view('app');
});
