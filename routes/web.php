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
use App\Http\Controllers\Root\RoleController;
//use App\Http\Controllers\Personel\BirimhocaController;
//use App\Http\Controllers\Personel\BirimsorumluController;
//use App\Http\Controllers\Personel\BekarhocaController;
//use App\Http\Controllers\Personel\MuhtelifhocaController;
//use App\Http\Controllers\Personel\IhtisashocaController;
//use App\Http\Controllers\Personel\HafizlikhocaController;
//use App\Http\Controllers\Personel\TeknikhocaController;
//use App\Http\Controllers\Personel\IdarihocaController;
use App\Http\Controllers\Egitim\OgrenciController;
use App\Http\Controllers\Egitim\BirimOgrenciController;
use App\Http\Controllers\Egitim\ProjeOgrenciController;
use App\Http\Controllers\Egitim\HafizlikController;
use App\Http\Controllers\Egitim\BirimHafizlikController;
use App\Http\Controllers\Personel\HocaBirimHafizlikController;

use App\Http\Controllers\Personel\HocaHafizlikController;
use App\Http\Controllers\Egitim\ProjeHafizlikController;
use App\Http\Controllers\Yapi\BirimController;
use App\Http\Controllers\YetkilerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RoutesController;



/* Auth::routes(); */

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
        Route::post('/', [PersonelController::class, 'index'])->name('personel.indexpost');
        Route::post('/rolegetir', [PersonelController::class, 'rolegetir'])->name('personel.rolegetir');
        Route::post('/birimgetir', [PersonelController::class, 'birimgetir'])->name('personel.birimgetir');
        Route::post('/edit', [PersonelController::class, 'edit'])->name('personel.edit');
        Route::get('/getEmployees', [PersonelController::class, 'getEmployees'])->name('personel.getEmployees');
        Route::post('/update', [PersonelController::class, 'update'])->name('personel.update');
    });

    Route::prefix('birim')->group(function () {

        Route::get('/', [BirimController::class, 'index'])->name('birim.index');

        Route::post('/birimadd', [BirimController::class, 'store'])->name('birim.store');
        Route::post('/birimdelete', [BirimController::class, 'destroy'])->name('birim.destroy');
        Route::post('/birimupdate', [BirimController::class, 'update'])->name('birim.update');
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
        Route::post('/birimgetir', [OgrenciController::class, 'birimgetir'])->name('ogrenci.birimgetir');
    });
    Route::prefix('hocahafizlik')->group(function () {
        //?hafizlik



        Route::post('/', [HocaHafizlikController::class, 'index'])->name('hocahafizlik.indexpost');
        Route::get('/', [HocaHafizlikController::class, 'index'])->name('hocahafizlik.index');
        Route::post('/hocagetir', [HocaHafizlikController::class, 'hocagetir'])->name('hocahafizlik.hocagetir');
        Route::post('/birimhocagetir', [HocaHafizlikController::class, 'birimhocagetir'])->name('hocahafizlik.birimhoca');
        Route::post('/birimgetir', [HocaHafizlikController::class, 'birimgetir'])->name('hocahafizlik.birimgetir');
    });
    Route::prefix('hafizlik')->group(function () {
        //?hafizlik

        Route::post('/durum', [HafizlikController::class, 'durum'])->name('hafizlik.durum');
        Route::post('/ders', [HafizlikController::class, 'ders'])->name('hafizlik.ders');
        Route::post('/dersekle', [HafizlikController::class, 'dersekle'])->name('hafizlik.dersekle');
        Route::post('/dersguncelle', [HafizlikController::class, 'dersguncelle'])->name('hafizlik.dersguncelle');

        Route::post('/durumguncel', [HafizlikController::class, 'durumguncel'])->name('hafizlik.durumguncel');
        Route::post('/hocaguncel', [HafizlikController::class, 'hocaguncel'])->name('hafizlik.hocaguncel');
        Route::post('/', [HafizlikController::class, 'index'])->name('hafizlik.indexpost');
        Route::get('/', [HafizlikController::class, 'index'])->name('hafizlik.index');
        Route::post('/hocagetir', [HafizlikController::class, 'hocagetir'])->name('hafizlik.hocagetir');
        Route::post('/birimhocagetir', [HafizlikController::class, 'birimhocagetir'])->name('hafizlik.birimhoca');
        Route::post('/birimgetir', [HafizlikController::class, 'birimgetir'])->name('hafizlik.birimgetir');
    });

    Route::prefix('birimhocahafizlik')->group(function () {
        //?hafizlik



        Route::post('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('birimhocahafizlik.indexpost');
        Route::get('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('birimhocahafizlik.index');
        Route::post('/hocagetir', [HocaBirimHafizlikController::class, 'hocagetir'])->name('birimhocahafizlik.hocagetir');
        Route::post('/birimhocagetir', [HocaBirimHafizlikController::class, 'birimhocagetir'])->name('birimhocahafizlik.birimhoca');
        Route::post('/birimgetir', [HocaBirimHafizlikController::class, 'birimgetir'])->name('birimhocahafizlik.birimgetir');
    });
    Route::prefix('birimogrenci')->group(function () {
        //?Öğrenci

        Route::post('/store', [BirimOgrenciController::class, 'store'])->name('birimogrenci.store');
        Route::post('/edit', [BirimOgrenciController::class, 'edit'])->name('birimogrenci.edit');
        Route::post('/update', [BirimOgrenciController::class, 'update'])->name('birimogrenci.update');
        Route::post('/birimgetir', [BirimOgrenciController::class, 'birimgetir'])->name('birimogrenci.birimgetir');
        Route::get('/{id}', [BirimOgrenciController::class, 'index'])->name('birimogrenci.index');
    });
    Route::prefix('birimhafizlik')->group(function () {
        //?hafizlik
        Route::get('/', [BirimHafizlikController::class, 'index'])->name('birimhafizlik.index');

        Route::post('/durum', [BirimHafizlikController::class, 'durum'])->name('birimhafizlik.durum');
        Route::post('/ders', [BirimHafizlikController::class, 'ders'])->name('birimhafizlik.ders');
        Route::post('/dersekle', [BirimHafizlikController::class, 'dersekle'])->name('birimhafizlik.dersekle');
        Route::post('/dersguncelle', [BirimHafizlikController::class, 'dersguncelle'])->name('birimhafizlik.dersguncelle');

        Route::post('/durumguncel', [BirimHafizlikController::class, 'durumguncel'])->name('birimhafizlik.durumguncel');
        Route::post('/hocaguncel', [BirimHafizlikController::class, 'hocaguncel'])->name('birimhafizlik.hocaguncel');
        Route::post('/{id}', [BirimHafizlikController::class, 'index'])->name('birimhafizlik.indexpost');
        Route::get('/{id}', [BirimHafizlikController::class, 'index'])->name('birimhafizlik.index');
        Route::post('/hocagetir', [BirimHafizlikController::class, 'hocagetir'])->name('birimhafizlik.hocagetir');
        Route::post('/birimhocagetir', [BirimHafizlikController::class, 'birimhocagetir'])->name('birimhafizlik.birimhoca');
        Route::post('/birimgetir', [BirimHafizlikController::class, 'birimgetir'])->name('birimhafizlik.birimgetir');
    });
    Route::prefix('projeogrenci')->group(function () {
        //?Öğrenci

        Route::post('/store', [BirimOgrenciController::class, 'store'])->name('projeogrenci.store');
        Route::post('/edit', [BirimOgrenciController::class, 'edit'])->name('projeogrenci.edit');
        Route::post('/update', [BirimOgrenciController::class, 'update'])->name('projeogrenci.update');
        Route::post('/birimgetir', [BirimOgrenciController::class, 'birimgetir'])->name('projeogrenci.birimgetir');
        Route::get('/{id}', [BirimOgrenciController::class, 'index'])->name('projeogrenci.index');
    });
    Route::prefix('projehafizlik')->group(function () {
        //?hafizlik
        Route::get('/', [BirimHafizlikController::class, 'index'])->name('projehafizlik.index');

        Route::post('/durum', [BirimHafizlikController::class, 'durum'])->name('projehafizlik.durum');
        Route::post('/ders', [BirimHafizlikController::class, 'ders'])->name('projehafizlik.ders');
        Route::post('/dersekle', [BirimHafizlikController::class, 'dersekle'])->name('projehafizlik.dersekle');
        Route::post('/dersguncelle', [BirimHafizlikController::class, 'dersguncelle'])->name('projehafizlik.dersguncelle');

        Route::post('/durumguncel', [BirimHafizlikController::class, 'durumguncel'])->name('projehafizlik.durumguncel');
        Route::post('/hocaguncel', [BirimHafizlikController::class, 'hocaguncel'])->name('projehafizlik.hocaguncel');
        Route::post('/{id}', [BirimHafizlikController::class, 'index'])->name('projehafizlik.indexpost');
        Route::get('/{id}', [BirimHafizlikController::class, 'index'])->name('projehafizlik.index');
        Route::post('/hocagetir', [BirimHafizlikController::class, 'hocagetir'])->name('projehafizlik.hocagetir');
        Route::post('/birimhocagetir', [BirimHafizlikController::class, 'birimhocagetir'])->name('projehafizlik.birimhoca');
        Route::post('/birimgetir', [BirimHafizlikController::class, 'birimgetir'])->name('projehafizlik.birimgetir');
    });

    Route::prefix('projehocahafizlik')->group(function () {
        //?hafizlik



        Route::post('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('projehocahafizlik.indexpost');
        Route::get('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('projehocahafizlik.index');
        Route::post('/hocagetir', [HocaBirimHafizlikController::class, 'hocagetir'])->name('projehocahafizlik.hocagetir');
        Route::post('/birimhocagetir', [HocaBirimHafizlikController::class, 'birimhocagetir'])->name('projehocahafizlik.birimhoca');
        Route::post('/birimgetir', [HocaBirimHafizlikController::class, 'birimgetir'])->name('projehocahafizlik.birimgetir');
    });
    //İHTİSAS
    Route::prefix('ihtisasogrenci')->group(function () {
        //?Öğrenci

        Route::post('/store', [BirimOgrenciController::class, 'store'])->name('ihtisasogrenci.store');
        Route::post('/edit', [BirimOgrenciController::class, 'edit'])->name('ihtisasogrenci.edit');
        Route::post('/update', [BirimOgrenciController::class, 'update'])->name('ihtisasogrenci.update');
        Route::post('/birimgetir', [BirimOgrenciController::class, 'birimgetir'])->name('ihtisasogrenci.birimgetir');
        Route::get('/{id}', [BirimOgrenciController::class, 'index'])->name('ihtisasogrenci.index');
    });
    Route::prefix('ihtisashafizlik')->group(function () {
        //?hafizlik
        Route::get('/', [BirimHafizlikController::class, 'index'])->name('ihtisashafizlik.index');

        Route::post('/durum', [BirimHafizlikController::class, 'durum'])->name('ihtisashafizlik.durum');
        Route::post('/ders', [BirimHafizlikController::class, 'ders'])->name('ihtisashafizlik.ders');
        Route::post('/dersekle', [BirimHafizlikController::class, 'dersekle'])->name('ihtisashafizlik.dersekle');
        Route::post('/dersguncelle', [BirimHafizlikController::class, 'dersguncelle'])->name('ihtisashafizlik.dersguncelle');

        Route::post('/durumguncel', [BirimHafizlikController::class, 'durumguncel'])->name('ihtisashafizlik.durumguncel');
        Route::post('/hocaguncel', [BirimHafizlikController::class, 'hocaguncel'])->name('ihtisashafizlik.hocaguncel');
        Route::post('/{id}', [BirimHafizlikController::class, 'index'])->name('ihtisashafizlik.indexpost');
        Route::get('/{id}', [BirimHafizlikController::class, 'index'])->name('ihtisashafizlik.index');
        Route::post('/hocagetir', [BirimHafizlikController::class, 'hocagetir'])->name('ihtisashafizlik.hocagetir');
        Route::post('/birimhocagetir', [BirimHafizlikController::class, 'birimhocagetir'])->name('ihtisashafizlik.birimhoca');
        Route::post('/birimgetir', [BirimHafizlikController::class, 'birimgetir'])->name('ihtisashafizlik.birimgetir');
    });
    Route::prefix('ihtisashocahafizlik')->group(function () {
        //?hafizlik



        Route::post('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('ihtisashocahafizlik.indexpost');
        Route::get('/{id}', [HocaBirimHafizlikController::class, 'index'])->name('ihtisashocahafizlik.index');
        Route::post('/hocagetir', [HocaBirimHafizlikController::class, 'hocagetir'])->name('ihtisashocahafizlik.hocagetir');
        Route::post('/birimhocagetir', [HocaBirimHafizlikController::class, 'birimhocagetir'])->name('ihtisashocahafizlik.birimhoca');
        Route::post('/birimgetir', [HocaBirimHafizlikController::class, 'birimgetir'])->name('ihtisashocahafizlik.birimgetir');
    });


    Route::prefix('root')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('root.index');
        Route::post('/', [RoleController::class, 'index'])->name('root.indexpost');

        Route::post('/edit', [RoleController::class, 'edit'])->name('root.edit');
        Route::post('/destroy', [RoleController::class, 'destroy'])->name('root.delete');

        Route::post('/store', [RoleController::class, 'store'])->name('root.store');
        Route::post('/update', [RoleController::class, 'update'])->name('root.update');
    });
    Route::get('/routes', [RoutesController::class, 'showApplicationRoutes'])->name('routes.index');
});


/* Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('login');
Route::get('/login/redirect', function () {
    return redirect(route('auth.login'));
})->name('/'); */

/*
    Route::prefix('birimhoca')->group(function () {
        //?BirimHoca
        Route::get('/getBirim', [BirimhocaController::class, 'getBirim'])->name('birimhoca.getBirim');
        Route::get('/store', [BirimhocaController::class, 'store'])->name('birimhoca.store');
        Route::post('/create', [BirimhocaController::class, 'create'])->name('birimhoca.create');
        Route::get('/', [BirimhocaController::class, 'index'])->name('birimhoca.index');
        Route::post('/hocagetir', [BirimhocaController::class, 'hocagetir'])->name('birimhoca.hocagetir');
        Route::post('/birimgetir', [BirimhocaController::class, 'birimgetir'])->name('birimhoca.birimgetir');
    });
    Route::prefix('birimsorumlu')->group(function () {
        //?IhtisasHoca
        Route::get('/getBirim', [BirimsorumluController::class, 'getBirim'])->name('birimsorumlu.getBirim');
        Route::post('/birimehocaekle', [BirimsorumluController::class, 'create'])->name('birimsorumlu.create');
        Route::get('/', [BirimsorumluController::class, 'index'])->name('birimsorumlu.index');
        Route::post('/hocagetir', [BirimsorumluController::class, 'hocagetir'])->name('birimsorumlu.hocagetir');
        Route::post('/birimgetir', [BirimsorumluController::class, 'birimgetir'])->name('birimsorumlu.birimgetir');
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
*/
require __DIR__ . '/auth.php';
