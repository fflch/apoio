<?php

use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleController;
//use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\SurrogateController;
use App\Http\Controllers\ContestController;
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

Route::any('/contact/search', [ContactController::class,'search'])
    ->name('contact.search');
Route::resource('/contact', ContactController::class);

Route::any('/areas/search', [AreaController::class,'search'])
    ->name('areas.search');
Route::resource('/areas', AreaController::class);

Route::post('/holders/getPeople',[HolderController::class,'getPeople'])
    ->name('holders.getpeople');
Route::resource('/holders', HolderController::class);

Route::post('/surrogates/getPeople',[SurrogateController::class,'getPeople'])
    ->name('surrogates.getpeople');
Route::post('/surrogates/getHolder',[SurrogateController::class,'getHolder'])
    ->name('surrogates.getholder');
Route::resource('/surrogates', SurrogateController::class);

Route::resource('/contests', ContestController::class);
Route::post('/contests/getArea',[ContestController::class,'getArea'])
    ->name('contests.getarea');

Route::get('/', function () {
    return view('app');
});
