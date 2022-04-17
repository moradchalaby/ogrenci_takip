<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\Personel\PersonelController;

Auth::routes();



Route::prefix('takvim')->group(function () {

    Route::get('/', [CalenderController::class, 'index']);
    Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
    Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
    Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
});
Route::namespace('personel')->group(function () {

    Route::get('/personel', [PersonelController::class, 'index']);
    Route::get('/personel/getEmployees/', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
    Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
    Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
    Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');