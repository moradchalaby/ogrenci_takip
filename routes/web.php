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
use App\Http\Controllers\Personel\BirimhocaController;

Auth::routes();



Route::prefix('takvim')->group(function () {

    Route::get('/', [CalenderController::class, 'index']);
    Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
    Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
    Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
});
Route::namespace('Personel')->group(function () {

    Route::get('/personel', [PersonelController::class, 'index']);
    Route::get('/birimhoca', [BirimhocaController::class, 'index']);
    Route::post('/hocagetir', [BirimhocaController::class, 'hocagetir']);
    Route::post('/birimgetir', [BirimhocaController::class, 'birimgetir']);
    Route::get('/personel/getEmployees/', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
    Route::get('/personel/getBirim/', [BirimhocaController::class, 'getBirim'])->name('birimhoca.getBirim');
    Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
    Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
    Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
