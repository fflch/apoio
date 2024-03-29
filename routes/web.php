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
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriptionController;
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

Route::resource('/holders', HolderController::class);

Route::resource('/surrogates', SurrogateController::class);

Route::resource('/contests', ContestController::class);
Route::post('/contests/getArea',[ContestController::class,'getArea'])
    ->name('contests.getarea');

Route::get('/commissions/contest/{contest}', [CommissionController::class, 'index'])
    ->name('commissions.index');
Route::post('/commissions', [CommissionController::class, 'store'])
    ->name('commissions.store');
Route::post('/commissions/reorder', [CommissionController::class, 'reorder'])
    ->name('commissions.reorder');
Route::delete('/contest/{contest}/people/{people}',
    [CommissionController::class, 'destroy'])->name('commissions.destroy');

Route::get('/subscriptions/contest/{contest}', [SubscriptionController::class, 'index'])
    ->name('subscriptions.index');
Route::post('/subscriptions', [SubscriptionController::class, 'store'])
    ->name('subscriptions.store');
Route::delete('/subscriptions/{subscription}',
    [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');

// AutoComplete
Route::get('/search/searchPeople', [SearchController::class,'searchPeople'])
    ->name('search.searchpeople');
Route::get('/search/searchHolder', [SearchController::class,'searchHolder'])
    ->name('search.searchholder');

Route::get('/', function () {
    return view('app');
});
