<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
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
    Route::post('/{id}/password',[UserController::class,'store'])
        ->name('castle.user.password');
});

require __DIR__.'/auth.php';
