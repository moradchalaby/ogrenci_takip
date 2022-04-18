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
use App\Http\Controllers\Personel\BekarhocaController;
use App\Http\Controllers\Personel\MuhtelifhocaController;
use App\Http\Controllers\Personel\HafizlikhocaController;
use App\Http\Controllers\Yapi\BirimController;

Auth::routes();



Route::prefix('takvim')->group(function () {

    Route::get('/', [CalenderController::class, 'index']);
    Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
    Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
    Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
});
Route::namespace('Personel')->group(function () {

    Route::get('/personel', [PersonelController::class, 'index']);

    Route::get('/personel/getEmployees/', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
    Route::get('/birim/getBirim/', [BirimhocaController::class, 'getBirim'])->name('birimhoca.getBirim');
    Route::post('/bekar/birimhocaekle/', [BirimhocaController::class, 'create'])->name('birimhoca.create');
    Route::get('/birimhoca', [BirimhocaController::class, 'index'])->name('birimhoca.index');
    Route::post('/birimhoca/hocagetir', [BirimhocaController::class, 'hocagetir']);
    Route::post('/birimhoca/birimgetir', [BirimhocaController::class, 'birimgetir']);
    //?BekarHoca
    Route::get('/bekar/getBirim/', [BekarhocaController::class, 'getBirim'])->name('bekarhoca.getBirim');
    Route::post('/bekar/bekarhocaekle/', [BekarhocaController::class, 'create'])->name('bekarhoca.create');
    Route::get('/bekarhoca', [BekarhocaController::class, 'index'])->name('bekarhoca.index');
    Route::post('/bekarhoca/hocagetir', [BekarhocaController::class, 'hocagetir']);
    Route::post('/bekarhoca/birimgetir', [BekarhocaController::class, 'birimgetir']);
    //?MuhtelifHoca
    Route::get('/muhtelif/getBirim/', [MuhtelifhocaController::class, 'getBirim'])->name('muhtelifhoca.getBirim');
    Route::post('/muhtelif/muhtelifhocaekle/', [MuhtelifhocaController::class, 'create'])->name('muhtelifhoca.create');
    Route::get('/muhtelifhoca', [MuhtelifhocaController::class, 'index'])->name('muhtelifhoca.index');
    Route::post('/muhtelifhoca/hocagetir', [MuhtelifhocaController::class, 'hocagetir']);
    Route::post('/muhtelifhoca/birimgetir', [MuhtelifhocaController::class, 'birimgetir']);
    //?HafizlikHoca
    Route::get('/hafizlik/getBirim/', [HafizlikhocaController::class, 'getBirim'])->name('hafizlikhoca.getBirim');
    Route::post('/hafizlik/hafizlikhocaekle/', [HafizlikhocaController::class, 'create'])->name('hafizlikhoca.create');
    Route::get('/hafizlikhoca', [HafizlikhocaController::class, 'index'])->name('hafizlikhoca.index');
    Route::post('/hafizlikhoca/hocagetir', [HafizlikhocaController::class, 'hocagetir']);
    Route::post('/hafizlikhoca/birimgetir', [HafizlikhocaController::class, 'birimgetir']);
    //?IhtisasHoca
    Route::get('/ihtisas/getBirim/', [IhtisashocaController::class, 'getBirim'])->name('ihtisashoca.getBirim');
    Route::post('/ihtisas/ihtisashocaekle/', [IhtisashocaController::class, 'create'])->name('ihtisashoca.create');
    Route::get('/ihtisashoca', [IhtisashocaController::class, 'index'])->name('ihtisashoca.index');
    Route::post('/ihtisashoca/hocagetir', [IhtisashocaController::class, 'hocagetir']);
    Route::post('/ihtisashoca/birimgetir', [IhtisashocaController::class, 'birimgetir']);
    //?TeknikHoca
    Route::get('/teknik/getBirim/', [TeknikhocaController::class, 'getBirim'])->name('teknikhoca.getBirim');
    Route::post('/teknik/teknikhocaekle/', [TeknikhocaController::class, 'create'])->name('teknikhoca.create');
    Route::get('/teknikhoca', [TeknikhocaController::class, 'index'])->name('teknikhoca.index');
    Route::post('/teknikhoca/hocagetir', [TeknikhocaController::class, 'hocagetir']);
    Route::post('/teknikhoca/birimgetir', [TeknikhocaController::class, 'birimgetir']);
});
Route::namespace('Yapi')->group(function () {

    Route::get('/birim', [BirimController::class, 'index']);
    Route::get('/birim/getBirim/', [BirimController::class, 'getBirim'])->name('birim.getBirim');
    Route::post('/birim/birimadd/', [BirimController::class, 'birimadd'])->name('birim.birimadd');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');