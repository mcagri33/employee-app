<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\CityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/castle', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'castle/users','middleware'=>'auth'], function (){
    Route::get('/',[UserController::class,'index'])
        ->name('castle.user.index');
    Route::get('/add',[UserController::class,'create'])
        ->name('castle.user.add');
    Route::post('/add',[UserController::class,'store'])
        ->name('castle.user.store');
    Route::get('/{id}',[UserController::class,'edit'])
        ->name('castle.user.edit');
    Route::post('/update',[UserController::class,'update'])
        ->name('castle.user.update');
    Route::get('/delete/{id}',[UserController::class,'destroy'])
        ->name('castle.user.delete');
    Route::get('/{id}/password',[UserController::class,'password'])
        ->name('castle.user.password');
    Route::post('/passwordChange',[UserController::class,'passwordChange'])
        ->name('castle.user.passwordChange');
});

Route::group(['prefix' => 'castle/country','middleware'=>'auth'], function (){
    Route::get('/',[CountryController::class,'index'])
        ->name('castle.country.index');
    Route::get('/add',[CountryController::class,'create'])
        ->name('castle.country.add');
    Route::post('/add',[CountryController::class,'store'])
        ->name('castle.country.store');
    Route::get('/{id}',[CountryController::class,'edit'])
        ->name('castle.country.edit');
    Route::post('/update',[CountryController::class,'update'])
        ->name('castle.country.update');
    Route::get('/delete/{id}',[CountryController::class,'destroy'])
        ->name('castle.country.delete');
});

Route::group(['prefix' => 'castle/state','middleware'=>'auth'], function (){
    Route::get('/',[StateController::class,'index'])
        ->name('castle.state.index');
    Route::get('/add',[StateController::class,'create'])
        ->name('castle.state.add');
    Route::post('/add',[StateController::class,'store'])
        ->name('castle.state.store');
    Route::get('/{id}',[StateController::class,'edit'])
        ->name('castle.state.edit');
    Route::post('/update',[StateController::class,'update'])
        ->name('castle.state.update');
    Route::get('/delete/{id}',[StateController::class,'destroy'])
        ->name('castle.state.delete');
});

Route::group(['prefix' => 'castle/city','middleware'=>'auth'], function (){
    Route::get('/',[CityController::class,'index'])
        ->name('castle.city.index');
    Route::get('/add',[CityController::class,'create'])
        ->name('castle.city.add');
    Route::post('/add',[CityController::class,'store'])
        ->name('castle.city.store');
    Route::get('/{id}',[CityController::class,'edit'])
        ->name('castle.city.edit');
    Route::post('/update',[CityController::class,'update'])
        ->name('castle.city.update');
    Route::get('/delete/{id}',[CityController::class,'destroy'])
        ->name('castle.city.delete');
});
require __DIR__.'/auth.php';
