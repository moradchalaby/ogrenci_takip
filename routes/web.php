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
use App\Http\Controllers\Egitim\OgrenciController;
use App\Http\Controllers\Egitim\HafizlikController;
use App\Http\Controllers\Yapi\BirimController;
use App\Http\Controllers\YetkilerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoutesController;



Auth::routes();
Route::group(['middleware' => ['auth'], 'namespace' => 'User'], function () {

    Route::get('/', [CalenderController::class, 'index']);

    Route::prefix('takvim')->group(function () {

        Route::get('/', [CalenderController::class, 'index']);
        Route::post('/editEvents', [CalenderController::class, 'editEvents'])->name('update');
        Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->name('formupdate');
        Route::post('/addEvents', [CalenderController::class, 'addEvents'])->name('insert');
    });
    Route::prefix('yetki')->group(function () {
        Route::get('/{id}', [YetkilerController::class, 'index'])->name('personel.yetki');
        Route::post('/yetkiver}', [YetkilerController::class, 'create'])->name('yetki.create');
        Route::post('/yetkial}', [YetkilerController::class, 'destroy'])->name('yetki.destroy');
    });


    Route::prefix('personel')->group(function () {
        Route::get('/', [PersonelController::class, 'index'])->name('personel.index');
        Route::get('/getEmployees', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
    });

    Route::prefix('birimhoca')->group(function () {
        //?BirimHoca
        Route::get('/getBirim', [BirimhocaController::class, 'getBirim'])->name('birimhoca.getBirim');
        Route::get('/store', [BirimhocaController::class, 'store'])->name('birimhoca.store');
        Route::post('/create', [BirimhocaController::class, 'create'])->name('birimhoca.create');
        Route::get('/', [BirimhocaController::class, 'index'])->name('birimhoca.index');
        Route::post('/hocagetir', [BirimhocaController::class, 'hocagetir'])->name('birimhoca.hocagetir');
        Route::post('/birimgetir', [BirimhocaController::class, 'birimgetir'])->name('birimhoca.birimgetir');
    });


    Route::prefix('bekarhoca')->group(function () {
        //?BekarHoca
        Route::get('/getBirim', [BekarhocaController::class, 'getBirim'])->name('bekarhoca.getBirim');
        Route::post('/create', [BekarhocaController::class, 'create'])->name('bekarhoca.create');
        Route::get('/', [BekarhocaController::class, 'index'])->name('bekarhoca.index');
        Route::post('/hocagetir', [BekarhocaController::class, 'hocagetir'])->name('bekarhoca.hocagetir');
        Route::post('/birimgetir', [BekarhocaController::class, 'birimgetir'])->name('bekarhoca.birimgetir');
    });


    Route::prefix('muhtelifhoca')->group(function () {
        //?MuhtelifHoca
        Route::get('/getBirim', [MuhtelifhocaController::class, 'getBirim'])->name('muhtelifhoca.getBirim');
        Route::post('/muhtelifhocaekle', [MuhtelifhocaController::class, 'create'])->name('muhtelifhoca.create');
        Route::get('/', [MuhtelifhocaController::class, 'index'])->name('muhtelifhoca.index');
        Route::post('/hocagetir', [MuhtelifhocaController::class, 'hocagetir'])->name('muhtelifhoca.hocagetir');
        Route::post('/birimgetir', [MuhtelifhocaController::class, 'birimgetir'])->name('muhtelifhoca.birimgetir');
    });


    Route::prefix('hafizlikhoca')->group(function () {
        //?HafizlikHoca
        Route::get('/getBirim', [HafizlikhocaController::class, 'getBirim'])->name('hafizlikhoca.getBirim');
        Route::post('/hafizlikhocaekle', [HafizlikhocaController::class, 'create'])->name('hafizlikhoca.create');
        Route::get('/', [HafizlikhocaController::class, 'index'])->name('hafizlikhoca.index');
        Route::post('/hocagetir', [HafizlikhocaController::class, 'hocagetir'])->name('hafizlikhoca.hocagetir');
        Route::post('/birimgetir', [HafizlikhocaController::class, 'birimgetir'])->name('hafizlikhoca.birimgetir');
    });


    Route::prefix('ihtisashoca')->group(function () {
        //?IhtisasHoca
        Route::get('/getBirim', [IhtisashocaController::class, 'getBirim'])->name('ihtisashoca.getBirim');
        Route::post('/ihtisashocaekle', [IhtisashocaController::class, 'create'])->name('ihtisashoca.create');
        Route::get('/', [IhtisashocaController::class, 'index'])->name('ihtisashoca.index');
        Route::post('/hocagetir', [IhtisashocaController::class, 'hocagetir'])->name('ihtisashoca.hocagetir');
        Route::post('/birimgetir', [IhtisashocaController::class, 'birimgetir'])->name('ihtisashoca.birimgetir');
    });


    Route::prefix('teknikhoca')->group(function () {
        //?TeknikHoca
        Route::get('/getBirim', [TeknikhocaController::class, 'getBirim'])->name('teknikhoca.getBirim');
        Route::post('/teknikhocaekle', [TeknikhocaController::class, 'create'])->name('teknikhoca.create');
        Route::get('/', [TeknikhocaController::class, 'index'])->name('teknikhoca.index');
        Route::post('/hocagetir', [TeknikhocaController::class, 'hocagetir'])->name('teknikhoca.hocagetir');
        Route::post('/birimgetir', [TeknikhocaController::class, 'birimgetir'])->name('teknikhoca.birimgetir');
    });


    Route::prefix('idarihoca')->group(function () {
        //?İdariHoca
        Route::get('/getBirim', [IdarihocaController::class, 'getBirim'])->name('idarihoca.getBirim');
        Route::post('/idarihocaekle', [IdarihocaController::class, 'create'])->name('idarihoca.create');
        Route::get('/', [IdarihocaController::class, 'index'])->name('idarihoca.index');
        Route::post('/hocagetir', [IdarihocaController::class, 'hocagetir'])->name('idarihoca.hocagetir');
        Route::post('/birimgetir', [IdarihocaController::class, 'birimgetir'])->name('idarihoca.birimgetir');
    });

    Route::prefix('birim')->group(function () {

        Route::get('/', [BirimController::class, 'index'])->name('birim.index');
        Route::get('/getBirim', [BirimController::class, 'getBirim'])->name('birim.getBirim');
        Route::post('/birimadd', [BirimController::class, 'birimadd'])->name('birim.birimadd');
    });

    Route::prefix('ogrenci')->group(function () {
        //?Öğrenci
        // Route::get('/getBirim', [OgrenciController::class, 'getBirim'])->name('ogrenci.getBirim');
        Route::post('/store', [OgrenciController::class, 'store'])->name('ogrenci.store');
        Route::post('/edit', [OgrenciController::class, 'edit'])->name('ogrenci.edit');
        Route::post('/update', [OgrenciController::class, 'update'])->name('ogrenci.update');
        // Route::post('/create', [OgrenciController::class, 'create'])->name('ogrenci.create');
        Route::get('/', [OgrenciController::class, 'index'])->name('ogrenci.index');
        // Route::get('/hocagetir', [OgrenciController::class, 'hocagetir'])->name('ogrenci.hocagetir');
        // Route::post('/birimgetir', [OgrenciController::class, 'birimgetir'])->name('ogrenci.birimgetir');
    });
    Route::prefix('hafizlik')->group(function () {
        //?Öğrenci
        // Route::get('/getBirim', [OgrenciController::class, 'getBirim'])->name('ogrenci.getBirim');
        // Route::post('/store', [OgrenciController::class, 'store'])->name('hafizlik.store');
        Route::post('/durum', [HafizlikController::class, 'durum'])->name('hafizlik.durum');
        // Route::post('/update', [OgrenciController::class, 'update'])->name('hafizlik.update');
        // Route::post('/create', [OgrenciController::class, 'create'])->name('ogrenci.create');
        Route::post('/', [HafizlikController::class, 'index'])->name('hafizlik.indexpost');
        Route::get('/', [HafizlikController::class, 'index'])->name('hafizlik.index');
        Route::post('/hocagetir', [HafizlikController::class, 'hocagetir'])->name('hafizlik.hocagetir');
        Route::post('/birimgetir', [HafizlikController::class, 'birimgetir'])->name('hafizlik.birimgetir');
    });
    Route::get('/routes', [RoutesController::class, 'showApplicationRoutes'])->name('routes.index');
});

/* Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('login');
Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('/'); */


require __DIR__ . '/auth.php';