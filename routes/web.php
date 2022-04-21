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
use App\Http\Controllers\Personel\IhtisashocaController;
use App\Http\Controllers\Personel\HafizlikhocaController;
use App\Http\Controllers\Personel\TeknikhocaController;
use App\Http\Controllers\Personel\IdarihocaController;
use App\Http\Controllers\Yapi\BirimController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoutesController;




Route::group(['middleware' => 'auth', 'namespace' => 'User'], function () {
    Auth::routes();
    Route::get('/', [CalenderController::class, 'index']);
    Route::prefix('takvim')->group(function () {

        Route::get('/', [CalenderController::class, 'index']);
        Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
        Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
        Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
    });
    Route::namespace('Personel')->group(function () {

        Route::get('/personel', [PersonelController::class, 'index'])->name('personel.index');

        Route::get('/personel/getEmployees/', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
        Route::prefix('birimhoca')->group(function () {
            //?BirimHoca
            Route::get('/getBirim', [BirimhocaController::class, 'getBirim'])->name('birimhoca.getBirim');
            Route::get('/store', [BirimhocaController::class, 'store'])->name('birimhoca.store');
            Route::post('/birimhocaekle', [BirimhocaController::class, 'create'])->name('birimhoca.create');
            Route::get('/', [BirimhocaController::class, 'index'])->name('birimhoca.index');
            Route::get('/hocagetir', [BirimhocaController::class, 'hocagetir'])->name('birimhoca.hocagetir');
            Route::post('/birimgetir', [BirimhocaController::class, 'birimgetir'])->name('birimhoca.birimgetir');
        });
        //?BekarHoca
        Route::get('/bekarhoca/getBirim/', [BekarhocaController::class, 'getBirim'])->name('bekarhoca.getBirim');
        Route::post('/bekarhoca/bekarhocaekle/', [BekarhocaController::class, 'create'])->name('bekarhoca.create');
        Route::get('/bekarhoca', [BekarhocaController::class, 'index'])->name('bekarhoca.index');
        Route::post('/bekarhoca/hocagetir', [BekarhocaController::class, 'hocagetir']);
        Route::post('/bekarhoca/birimgetir', [BekarhocaController::class, 'birimgetir']);
        //?MuhtelifHoca
        Route::get('/muhtelifhoca/getBirim/', [MuhtelifhocaController::class, 'getBirim'])->name('muhtelifhoca.getBirim');
        Route::post('/muhtelifhoca/muhtelifhocaekle/', [MuhtelifhocaController::class, 'create'])->name('muhtelifhoca.create');
        Route::get('/muhtelifhoca', [MuhtelifhocaController::class, 'index'])->name('muhtelifhoca.index');
        Route::post('/muhtelifhoca/hocagetir', [MuhtelifhocaController::class, 'hocagetir']);
        Route::post('/muhtelifhoca/birimgetir', [MuhtelifhocaController::class, 'birimgetir']);
        //?HafizlikHoca
        Route::get('/hafizlikhoca/getBirim/', [HafizlikhocaController::class, 'getBirim'])->name('hafizlikhoca.getBirim');
        Route::post('/hafizlikhoca/hafizlikhocaekle/', [HafizlikhocaController::class, 'create'])->name('hafizlikhoca.create');
        Route::get('/hafizlikhoca', [HafizlikhocaController::class, 'index'])->name('hafizlikhoca.index');
        Route::post('/hafizlikhoca/hocagetir', [HafizlikhocaController::class, 'hocagetir']);
        Route::post('/hafizlikhoca/birimgetir', [HafizlikhocaController::class, 'birimgetir']);
        //?IhtisasHoca
        Route::get('/ihtisashoca/getBirim/', [IhtisashocaController::class, 'getBirim'])->name('ihtisashoca.getBirim');
        Route::post('/ihtisashoca/ihtisashocaekle/', [IhtisashocaController::class, 'create'])->name('ihtisashoca.create');
        Route::get('/ihtisashoca', [IhtisashocaController::class, 'index'])->name('ihtisashoca.index');
        Route::post('/ihtisashoca/hocagetir', [IhtisashocaController::class, 'hocagetir']);
        Route::post('/ihtisashoca/birimgetir', [IhtisashocaController::class, 'birimgetir']);
        //?TeknikHoca
        Route::get('/teknikhoca/getBirim/', [TeknikhocaController::class, 'getBirim'])->name('teknikhoca.getBirim');
        Route::post('/teknikhoca/teknikhocaekle/', [TeknikhocaController::class, 'create'])->name('teknikhoca.create');
        Route::get('/teknikhoca', [TeknikhocaController::class, 'index'])->name('teknikhoca.index');
        Route::post('/teknikhoca/hocagetir', [TeknikhocaController::class, 'hocagetir']);
        Route::post('/teknikhoca/birimgetir', [TeknikhocaController::class, 'birimgetir']);
        //?İdariHoca
        Route::get('/idarihoca/getBirim/', [IdarihocaController::class, 'getBirim'])->name('idarihoca.getBirim');
        Route::post('/idarihoca/idarihocaekle/', [IdarihocaController::class, 'create'])->name('idarihoca.create');
        Route::get('/idarihoca', [IdarihocaController::class, 'index'])->name('idarihoca.index');
        Route::post('/idarihoca/hocagetir', [IdarihocaController::class, 'hocagetir']);
        Route::post('/idarihoca/birimgetir', [IdarihocaController::class, 'birimgetir']);
    });
    Route::namespace('Yapi')->group(function () {

        Route::get('/birim', [BirimController::class, 'index'])->name('birim.index');
        Route::get('/birim/getBirim/', [BirimController::class, 'getBirim'])->name('birim.getBirim');
        Route::post('/birim/birimadd/', [BirimController::class, 'birimadd'])->name('birim.birimadd');
    });
    Route::get('/routes', [RoutesController::class, 'showApplicationRoutes'])->name('routes.index');
});
Auth::routes();
Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('login');
Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('/');