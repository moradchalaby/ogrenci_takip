<?php

use App\Http\Controllers\Muhasebe\KasaController;
use App\Http\Controllers\Muhasebe\MakbuzSetController;
use App\Http\Controllers\Muhasebe\MuhasebeController;
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

        Route::get('/', [CalenderController::class, 'index'])->middleware('can:yet','takvim');
        Route::post('/editEvents', [CalenderController::class, 'editEvents'])->middleware('can:yet','idari')->name('update');
        Route::post('/editFormEvents', [CalenderController::class, 'editFormEvents'])->middleware('can:yet','idari')->name('formupdate');
        Route::post('/addEvents', [CalenderController::class, 'addEvents'])->middleware('can:yet','idari')->name('insert');
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
    Route::prefix('muhasebe')->group(function () {
        Route::get('/{id}', [MuhasebeController::class, 'index'])->can('yet','muhasebe')->name('muhasebe.index');
        //Route::post('/{id}', [MuhasebeController::class, 'index'])->name('muhasebe.indexpost');

        Route::post('/edit', [MuhasebeController::class, 'edit'])->can('islem','muhasebe')->name('muhasebe.edit');
        Route::post('/destroy', [MuhasebeController::class, 'destroy'])->can('islem','muhasebe')->name('muhasebe.delete');

        Route::post('/store', [MuhasebeController::class, 'store'])->can('islem','muhasebe')->name('muhasebe.store');
        Route::post('/show/{id}', [MuhasebeController::class, 'show'])->can('yet','muhasebe')->name('muhasebe.show');
        Route::post('/update/{id}', [MuhasebeController::class, 'update'])->can('islem','muhasebe')->name('muhasebe.update');

        Route::post('/{id}/odemeturgetir', [MuhasebeController::class, 'odemeturgetir'])->can('yet','muhasebe')->name('muhasebe.odemeturgetir');
        Route::post('/{id}/odemesekligetir', [MuhasebeController::class, 'odemesekligetir'])->can('yet','muhasebe')->name('muhasebe.odemesekligetir');
        Route::post('/{id}/kurgetir', [MuhasebeController::class, 'kurgetir'])->can('yet','muhasebe')->name('muhasebe.kurgetir');

    });

    Route::prefix('ogrenciodeme')->group(function (){
        Route::get('/', [MuhasebeController::class, 'ogrenciodeme'])->can('yet','ogrenciodeme')->name('muhasebe.ogrenci');
        Route::post('/edit', [MuhasebeController::class, 'editOgrenci'])->can('islem','ogrenciodeme')->name('muhasebe.ogrenci.edit');
        Route::post('/destroy', [MuhasebeController::class, 'destroyOgrenci'])->can('islem','ogrenciodeme')->name('muhasebe.ogrenci.delete');

        Route::post('/store', [MuhasebeController::class, 'storeOgrenci'])->can('islem','ogrenciodeme')->name('muhasebe.ogrenci.store');
        Route::post('/show/{id}', [MuhasebeController::class, 'showOgrenci'])->can('islem','ogrenciodeme')->name('muhasebe.ogrenci.show');
        Route::post('/update/{id}', [MuhasebeController::class, 'updateOgrenci'])->can('islem','ogrenciodeme')->name('muhasebe.ogrenci.update');

    });
    Route::prefix('hocaodeme')->group(function (){
        Route::get('/', [MuhasebeController::class, 'hocaodeme'])->can('yet','muhasebe')->name('muhasebe.hoca');
        Route::post('/edit', [MuhasebeController::class, 'editHoca'])->can('islem','hocaodeme')->name('muhasebe.hoca.edit');
        Route::post('/destroy', [MuhasebeController::class, 'destroyHoca'])->can('islem','hocaodeme')->name('muhasebe.hoca.delete');

        Route::post('/store', [MuhasebeController::class, 'storeHoca'])->can('islem','hocaodeme')->name('muhasebe.hoca.store');
        Route::post('/show/{id}', [MuhasebeController::class, 'showHoca'])->can('islem','hocaodeme')->name('muhasebe.hoca.show');
        Route::post('/update/{id}', [MuhasebeController::class, 'updateHoca'])->can('islem','hocaodeme')->name('muhasebe.hoca.update');

    });
    Route::prefix('kasa')->group(function (){
        Route::get('/{id}', [KasaController::class, 'index'])->can('yet','kasa')->name('kasa.index');
        Route::post('/edit', [KasaController::class, 'edit'])->can('islem','kasa')->name('kasa.edit');
        Route::post('/destroy', [KasaController::class, 'destroy'])->can('islem','kasa')->name('kasa.delete');

        Route::post('/store', [KasaController::class, 'store'])->can('islem','kasa')->name('kasa.store');
        Route::post('/show/{id}', [KasaController::class, 'show'])->can('islem','kasa')->name('kasa.show');
        Route::post('/update/{id}', [KasaController::class, 'update'])->can('islem','kasa')->name('kasa.update');

    });
    Route::prefix('makbuzset')->group(function () {

        Route::get('/', [MakbuzSetController::class, 'index'])->can('root','root')->name('makbuzset.index');

        Route::post('/store', [MakbuzSetController::class, 'store'])->can('root','root')->name('makbuzset.store');
        Route::post('/destroy', [MakbuzSetController::class, 'destroy'])->can('root','root')->name('makbuzset.destroy');
        Route::post('/update', [MakbuzSetController::class, 'update'])->can('root','root')->name('makbuzset.update');
    });
    Route::prefix('root')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->can('root','root')->name('root.index');
        Route::post('/', [RoleController::class, 'index'])->can('root','root')->name('root.indexpost');

        Route::post('/edit', [RoleController::class, 'edit'])->can('root','root')->name('root.edit');
        Route::post('/destroy', [RoleController::class, 'destroy'])->can('root','root')->name('root.delete');

        Route::post('/store', [RoleController::class, 'store'])->can('root','root')->name('root.store');
        Route::post('/update', [RoleController::class, 'update'])->can('root','root')->name('root.update');
    });
    Route::get('/routes', [RoutesController::class, 'showApplicationRoutes'])->can('root','root')->name('routes.index');

    //selectbox getir


    Route::post('/birimgetir', [HafizlikController::class, 'birimgetir'])->name('muhasebe.birimgetir');
});


require __DIR__ . '/auth.php';
