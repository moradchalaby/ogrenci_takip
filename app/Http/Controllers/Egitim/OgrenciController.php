<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Hafizlikdurum;
use App\Models\Hafizlikders;

use App\Models\Ogrenci;
use App\Models\Ogrencibirim;
use App\Models\Ogrenciokul;
use App\Models\Okul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Image;

class OgrenciController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:yetkili');
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        if (request()->ajax()) {
            $data = Ogrenci::select('*')

                ->where(['ogrenci.ogrenci_kytdurum' => '1']);



            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['ogrenci_resim'] . '">';

                    return $resim;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::denies('islem', 'ogrenci')) {
                        $btn = '


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    } else {
                        $btn = ' <a type="button" class="btn btn-success reset btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '"
                                          data-target="#modalEdit">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                      </a>


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    }

                    return $btn;
                })
                ->rawColumns(['resim', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => '',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ],

            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'ogrenci_adsoyad', 'name' => 'ogrenci_adsoyad', 'title' => 'Name'],
            ['data' => 'babaad', 'name' => 'babaad', 'title' => 'Baba Adı'],
            ['data' => 'babatel', 'name' => 'babatel', 'title' => 'Baba Tel'],
            ['data' => 'annead', 'name' => 'annead', 'title' => 'Anne Adı'],
            ['data' => 'annetel', 'name' => 'annetel', 'title' => 'Anne Tel'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';
        $veri['birimler'] = Birim::select('*')

            ->where(['birim.birim_durum' => '1'])->get();



        return view('idari.egitim.index', compact('html', 'veri'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('egitim.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {


            $dataf = Ogrenci::create(

                [
                    "annead" => $request->annead,
                    "annemes" => $request->annemes,
                    "annetel" => $request->annetel,
                    "babaad" => $request->babaad,
                    "babames" => $request->babames,
                    "babatel" => $request->babatel,
                    "ogrenci_bosanma" => $request->bosanma,
                    "ogrenci_aciklama" => $request->ogrenci_aciklama,
                    "ogrenci_adres" => $request->ogrenci_adres,
                    "ogrenci_adsoyad" => $request->ogrenci_adsoyad,
                    "ogrenci_dt" => $request->ogrenci_dt,
                    "ogrenci_sehir" => $request->ogrenci_sehir,
                    "ogrenci_tc" => $request->ogrenci_tc,
                    "ogrenci_tel" => $request->ogrenci_tel,
                    "ogrenci_yetim" => $request->yetimdurum,
                    'kullanici_id' => Auth::id(),


                ]
            );
            $son = Ogrenci::latest('id')->first();
            Ogrenciokul::create(
                [
                    'okul_id' => $request->okuldurum,
                    'ogrenci_id' => $son->id,
                    'basari' => $request->basaripuan
                ]
            );
            Ogrencibirim::create(
                [
                    "birim_id" => $request->birim_id,
                    'ogrenci_id' => $son->id,
                ]
            );
            Hafizlikders::create(
                [
                    'ogrenci_id' => $son->id,
                    'kullanici_id' => Auth::id()
                ]
            );
            Hafizlikdurum::create(
                [
                    'ogrenci_id' => $son->id,
                    'hafizlik_durum' => 'Yeni Kayıt'
                ]
            );
            $name = $son->id . 'resim';

            /*  $request->validate([
                'ogrenci_resim' => 'required|file|mimes:jpeg,jpg,png,svg|max:4096' // uzantı ve maks dosya boyutu için validation
            ]); */
            /* if ($_FILES["file"]["name"] != '') {
                $test = explode('.', $_FILES["file"]["name"]);
                $ext = end($test);
                $name = $name . '.' . $ext;
                if (!file_exists('dimg')) {
                    mkdir('dimg', 0777, true);
                }
                $location = 'dimg/' . $name;

                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
                }
            } */
            if ($request->file('file') != null) {


                // üye id veya name gibi değerlere göre bir resim adı (bu değer sabit olursa yeni gelen dosyayı eskisinin üzerine kaydeder)

                // resim adı farklı yaparak eskisini silmek istiyorsanız
                // use Illuminate\Support\Facades\Storage;
                // Storage::delete(storage_path('app/public/avatar/' . $name . '.jpg')); // eski resmi sil

                $img = Image::make($request->file('file'));

                $img->fit(256, 256);
                //  $img->path = '/dimg' . $name . '.jpg'; // isterseniz resmi orantılı bir şekilde boyutlandır
                // isterseniz resmi orantılı bir şekilde boyutlandır
                $img->save(storage_path('app\public\dimg' . "\\" . $name . '.jpg'), 80);
                // storage dosyasına resmi %60 kalitede kaydet
                Ogrenci::updateorCreate(
                    ['id' => $son->id],
                    ['ogrenci_resim' => '/storage/dimg' . '/' . $name . '.jpg']
                );
            }


            return response()->json($dataf);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //


        if ($request->ajax()) {
            //dd($request);
            $ogrenciedit
                = DB::table('ogrenci')->select('*')->where('ogrenci.id', $request->ogrenci_id)
                ->leftJoin('ogrenciokul',  'ogrenci.id', '=', 'ogrenciokul.ogrenci_id')
                ->leftJoin('okul', 'okul.id', '=', 'ogrenciokul.okul_id')
                ->leftJoin('ogrencibirim',  'ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                ->leftJoin('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')


                ->first();

            return response()->json($ogrenciedit);
        }
    }

    public function birimgetir(Request $request)
    {

        //
        if ($request->ajax()) {
            $gonder[] = "<option selected value=''> Birim Seçiniz</option>";
            $data = Birim::get(['birim_id', 'birim_ad']);
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['birim_id'] . "\">" . $veri['birim_ad'] . "</option>";
            }

            return response()->json($gonder);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if ($request->ajax()) {


            $dataf = Ogrenci::updateorCreate(
                ['id' => $request->id],
                [
                    "annead" => $request->annead,
                    "annemes" => $request->annemes,
                    "annetel" => $request->annetel,
                    "babaad" => $request->babaad,
                    "babames" => $request->babames,
                    "babatel" => $request->babatel,
                    "ogrenci_bosanma" => $request->bosanma,
                    "ogrenci_aciklama" => $request->ogrenci_aciklama,
                    "ogrenci_adres" => $request->ogrenci_adres,
                    "ogrenci_adsoyad" => $request->ogrenci_adsoyad,
                    "ogrenci_dt" => $request->ogrenci_dt,
                    "ogrenci_sehir" => $request->ogrenci_sehir,
                    "ogrenci_tc" => $request->ogrenci_tc,
                    "ogrenci_tel" => $request->ogrenci_tel,
                    "ogrenci_yetim" => $request->yetimdurum,
                    'kullanici_id' => Auth::id(),


                ]
            );

            Ogrenciokul::updateorCreate(
                ['ogrenci_id' => $request->id],
                [
                    'okul_id' => $request->okuldurum,
                    'ogrenci_id' => $request->id,
                    'basari' => $request->basaripuan
                ]
            );
            Ogrencibirim::updateorCreate(
                ['ogrenci_id' => $request->id],
                [
                    "birim_id" => $request->birim_id,
                    'ogrenci_id' => $request->id,
                ]
            );
            $name = $request->id . 'resim';

            /*  $request->validate([
                'ogrenci_resim' => 'required|file|mimes:jpeg,jpg,png,svg|max:4096' // uzantı ve maks dosya boyutu için validation
            ]); */
            /* if ($_FILES["file"]["name"] != '') {
                $test = explode('.', $_FILES["file"]["name"]);
                $ext = end($test);
                $name = $name . '.' . $ext;
                if (!file_exists('dimg')) {
                    mkdir('dimg', 0777, true);
                }
                $location = 'dimg/' . $name;

                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
                }
            } */
            if ($request->file('file') != null) {


                // üye id veya name gibi değerlere göre bir resim adı (bu değer sabit olursa yeni gelen dosyayı eskisinin üzerine kaydeder)

                // resim adı farklı yaparak eskisini silmek istiyorsanız
                // use Illuminate\Support\Facades\Storage;
                Storage::delete(storage_path('app/public/avatar/' . $name . '.jpg')); // eski resmi sil

                $img = Image::make($request->file('file'));

                $img->fit(256, 256);
                //  $img->path = '/dimg' . $name . '.jpg'; // isterseniz resmi orantılı bir şekilde boyutlandır
                // isterseniz resmi orantılı bir şekilde boyutlandır
                $img->save(storage_path('app\public\dimg' . "\\" . $name . '.jpg'), 80);
                // storage dosyasına resmi %60 kalitede kaydet
                Ogrenci::updateorCreate(
                    ['id' => $request->id],
                    ['ogrenci_resim' => '/storage/dimg' . '/' . $name . '.jpg']
                );
            }
            return response()->json($dataf);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}