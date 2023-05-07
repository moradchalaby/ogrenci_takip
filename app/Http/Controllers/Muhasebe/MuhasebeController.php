<?php

namespace App\Http\Controllers\Muhasebe;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Kasa;
use App\Models\Makbuz;
use App\Models\MakbuzSet;
use App\Models\Ogrenci;
use App\Models\OgrenciOdeme;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class MuhasebeController extends Controller
{
  public function __construct()
    {

        $this->middleware('can:yetkili');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request, Builder $builder, $id)
    {



        $user_id= $id;

//dd(MakbuzSet::whereSetParent('1'));


        if ($request->tarihar != null) {

            $tarihar = explode(' - ', $request->tarihar);
        } else {
            $tarihar = [date("Y-m-d"), date("Y-m-d")];
        };
        $bast = date("Y-m-d", strtotime($tarihar[0]));
        $sont =
            date("Y-m-d", strtotime($tarihar[1]));
        $beign = new DateTime($bast);
        $end = new DateTime($sont);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod(
            $beign,
            $interval,
            $end
        );


        if ($request->ajax()) {


            $data =
                Makbuz::where('user_id','=',$id)
                   // ->WhereBetween('tarih', [$bast, $sont])
                    ->orderBy('tarih', 'desc')
                    ->when($request->fiyat != null, function ($q) use ($request) {
                        return $q->havingRaw("tutar >= {$request->fiyat}");
                    }, function ($q) {
                        return $q;
                    })->when($request->tur != null, function ($q) use ($request) {
                        return $q->where("tur", "=", $request->tur);
                    }, function ($q) {
                        return $q;
                    })->when($request->kur != null, function ($q) use ($request) {
                        return $q->where("kur", "=", $request->kur);
                    })->when($request->odeme_sekli != null, function ($q) use ($request) {
                        return $q->where("odeme_sekli", "=", $request->odeme_sekli);
                    }, function ($q) {
                        return $q;
                    })
                    ->select(
                        '*',
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "₺") AS tltop'),
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "₺") AS tltop'),
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "$") AS ustop'), )
                    ->get();

           $data= $data->push(['id'=>'0','adsoyad'=>'TOPLAM','kullanici'=>'TL','tutar'=>intval($data[0]->tltop).' ₺','odeme_sekli'=>'EURO','tarih'=>intval($data[0]->eutop).' €','tur'=>'DOLAR','aciklama'=>intval($data[0]->ustop).' $','kur'=>'']);


            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('adsoyad', function ($row) {


                    $name=$row['adsoyad'];
                    return $name;
                })
                ->addColumn('kullanici', function ($row) {



                    return $row['kullanici'];
                })
                ->addColumn('fiyat', function ($row) {



                    return $row['tutar'].' '.$row['kur'];
                })


                ->addColumn('odemeSekli', function ($row) {
                    return $row['odeme_sekli'];
                })
                ->addColumn('tarih', function ($row) use ($request) {


                    $toplam = $row['tarih'];



                    return $toplam;
                })

                ->addColumn('tur', function ($row) {


                    return $row['tur'];
                })
            ->addColumn('aciklama', function ($row) {


                return $row['aciklama'];
            })->addColumn('action', function ($row) {

                    $btn= '<a type="button" class="btn btn-success btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-target="#modalEdit">

                                          Düzenle
                                      </a>
                                      <a type="button" class="btn btn-primary btn-xs showmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-target="#modalShow">

                                          Görüntüle
                                      </a>
                                      ';

                                    /*  <a href="/yetki/' . $row['id'] . '" type="button" class="btn btn-success btn-xs">

                                        Yetkiler
                                      </a>*/
                    return $btn;
                });

            $raw = [
                'adsoyad',
                'tur', 'action', 'tarih', 'fiyat', 'aciklama', 'kullanici','odemeSekli',
            ];
          /*  foreach ($daterange as $date) {

                $gun = $date->format('Y-m-d');

                $dt->addColumn($gun, function ($row) use ($gun) {
                    $dersid = explode(',', $row['dersId']);
                    $gunler = explode(',', $row['gunler']);
                    $dersler = explode('*', $row['dersler']);
                    $array_new = array_count_values($dersler);
                    $array2 = array();
                    foreach ($array_new as $key => $val) {
                        if ($val > 1) { //or do $val >2 based on your desire
                            $array2[] = $key;
                        }
                    }


                    if (in_array($gun, $gunler)) {


                        $tekrar =   array_count_values($gunler);
                        $say = $tekrar[$gun];
                        $class = 'bg-info';
                        if (in_array($dersler[array_search($gun, $gunler)], $array2)) {
                            $class = 'bg-danger';
                        }
                        $thisders = str_contains($row['durum'], 'Hafız') ?  str_Replace('20/', '', $dersler[array_search($gun, $gunler)]) : $dersler[array_search($gun, $gunler)];
                        $ders =
                            '<a  class="duzenleDers btn-xs ' . $class . '  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler)] . '"data-target="#modalDersduzenle">' . $thisders . '</a> ';
                        for ($i = 1; $i < $say; $i++) {
                            $thisders = str_contains($row['durum'], 'Hafız') ?  str_Replace('20/', '', $dersler[array_search($gun, $gunler) + $i]) : $dersler[array_search($gun, $gunler) + $i];
                            $class = 'bg-info';
                            if (in_array($dersler[array_search($gun, $gunler) + $i], $array2)) {
                                $class = 'bg-danger';
                            }
                            $ders = $ders
                                . ' <a  class="duzenleDers btn-xs ' . $class . '  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler) + $i] . '"data-target="#modalDersduzenle">' . $thisders
                                . '</a> ';
                        }
                    } else {
                        $ders = '';
                    }

                    return $ders;
                });
                $raw[] = $gun;
            }*/
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }

        $ekle = [

            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Ad Soyad'],
            ['data' => 'kullanici', 'name' => 'kullanici', 'title' => 'Ödeme Alan'],
            ['data' => 'fiyat', 'name' => 'fiyat', 'title' => 'Tutar'],
            ['data' => 'odemeSekli', 'name' => 'odemeSekli', 'title' => 'Ödeme Şekli'],
            ['data' => 'tarih', 'name' => 'tarih', 'title' => 'Tarih'],
            ['data' => 'tur', 'name' => 'tur', 'title' => 'Ödeme Türü'],

            ['data' => 'aciklama', 'name' => 'aciklama', 'title' => 'Açıklama'],
            ['data' => 'action', 'name' => 'tactionur', 'title' => 'İşlem'],

        ];





     /*   foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }*/
      $html = $builder
        /* ->ajax([

            'url' => route('muhasebe.indexpost',Auth::id()),
            'type' => 'POST',
            'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
            d.user_id = '{$id}';
            d.hoca_id = '{$request->hoca_id}';
            d.kota = '{$request->kota}';
            d.sayfa = '{$request->sayfa}';
            d.durum = '{$request->durum}';
        }",
        ])*/->columns($ekle)->initComplete("function() {


        window.LaravelDataTables['example1'].buttons().container().appendTo($('.col-md-6:eq(0)', window.LaravelDataTables['example1'].table().container()));


        }");
        if ($request->responsive) {
            $html->responsive(true);
        } else {
            $html->scrollX(true);
        };



        $html->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->serverSide(true)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3, 4], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ]);



        $veri['title'] = 'Muhasebe';
        $veri['name'] = 'Muhasebe';
        $veri['bast'] = $bast;
        $veri['sont'] = $sont;
        $veri['kota'] = $request->kota;
        $veri['sayfa'] = $request->sayfa;
        $veri['hoca'] = $request->hoca_id;
        $veri['birim'] = $id;
        $veri['durum'] = $request->durum;
        /* dd($html);
        exit; */

        return view('muhasebe.makbuzlar.index', compact('html', 'veri'));
    }

    public function hocaodeme(Request $request, Builder $builder, $id)
    {



        $user_id= $id;

//dd(MakbuzSet::whereSetParent('1'));


        if ($request->tarihar != null) {

            $tarihar = explode(' - ', $request->tarihar);
        } else {
            $tarihar = [date("Y-m-d"), date("Y-m-d")];
        };
        $bast = date("Y-m-d", strtotime($tarihar[0]));
        $sont =
            date("Y-m-d", strtotime($tarihar[1]));
        $beign = new DateTime($bast);
        $end = new DateTime($sont);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod(
            $beign,
            $interval,
            $end
        );


        if ($request->ajax()) {


            $data =
                Makbuz::where('user_id','=',$id)
                    // ->WhereBetween('tarih', [$bast, $sont])
                    ->orderBy('tarih', 'desc')
                    ->when($request->fiyat != null, function ($q) use ($request) {
                        return $q->havingRaw("tutar >= {$request->fiyat}");
                    }, function ($q) {
                        return $q;
                    })->when($request->tur != null, function ($q) use ($request) {
                        return $q->where("tur", "=", $request->tur);
                    }, function ($q) {
                        return $q;
                    })->when($request->kur != null, function ($q) use ($request) {
                        return $q->where("kur", "=", $request->kur);
                    })->when($request->odeme_sekli != null, function ($q) use ($request) {
                        return $q->where("odeme_sekli", "=", $request->odeme_sekli);
                    }, function ($q) {
                        return $q;
                    })
                    ->select(
                        '*',
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "₺") AS tltop'),
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "₺") AS tltop'),
                        DB::raw('(SELECT SUM(makbuzs.tutar)
                  FROM makbuzs
                 WHERE makbuzs.kur = "$") AS ustop'), )
                    ->get();

            $data= $data->push(['id'=>'0','adsoyad'=>'TOPLAM','kullanici'=>'TL','tutar'=>intval($data[0]->tltop).' ₺','odeme_sekli'=>'EURO','tarih'=>intval($data[0]->eutop).' €','tur'=>'DOLAR','aciklama'=>intval($data[0]->ustop).' $','kur'=>'']);


            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('adsoyad', function ($row) {


                    $name=$row['adsoyad'];
                    return $name;
                })
                ->addColumn('kullanici', function ($row) {



                    return $row['kullanici'];
                })
                ->addColumn('fiyat', function ($row) {



                    return $row['tutar'].' '.$row['kur'];
                })


                ->addColumn('odemeSekli', function ($row) {
                    return $row['odeme_sekli'];
                })
                ->addColumn('tarih', function ($row) use ($request) {


                    $toplam = $row['tarih'];



                    return $toplam;
                })

                ->addColumn('tur', function ($row) {


                    return $row['tur'];
                })
                ->addColumn('aciklama', function ($row) {


                    return $row['aciklama'];
                })->addColumn('action', function ($row) {

                    $btn= '<a type="button" class="btn btn-success btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-target="#modalEdit">

                                          Düzenle
                                      </a>
                                      <a type="button" class="btn btn-primary btn-xs showmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-target="#modalShow">

                                          Görüntüle
                                      </a>
                                      ';

                    /*  <a href="/yetki/' . $row['id'] . '" type="button" class="btn btn-success btn-xs">

                        Yetkiler
                      </a>*/
                    return $btn;
                });

            $raw = [
                'adsoyad',
                'tur', 'action', 'tarih', 'fiyat', 'aciklama', 'kullanici','odemeSekli',
            ];
            /*  foreach ($daterange as $date) {

                  $gun = $date->format('Y-m-d');

                  $dt->addColumn($gun, function ($row) use ($gun) {
                      $dersid = explode(',', $row['dersId']);
                      $gunler = explode(',', $row['gunler']);
                      $dersler = explode('*', $row['dersler']);
                      $array_new = array_count_values($dersler);
                      $array2 = array();
                      foreach ($array_new as $key => $val) {
                          if ($val > 1) { //or do $val >2 based on your desire
                              $array2[] = $key;
                          }
                      }


                      if (in_array($gun, $gunler)) {


                          $tekrar =   array_count_values($gunler);
                          $say = $tekrar[$gun];
                          $class = 'bg-info';
                          if (in_array($dersler[array_search($gun, $gunler)], $array2)) {
                              $class = 'bg-danger';
                          }
                          $thisders = str_contains($row['durum'], 'Hafız') ?  str_Replace('20/', '', $dersler[array_search($gun, $gunler)]) : $dersler[array_search($gun, $gunler)];
                          $ders =
                              '<a  class="duzenleDers btn-xs ' . $class . '  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler)] . '"data-target="#modalDersduzenle">' . $thisders . '</a> ';
                          for ($i = 1; $i < $say; $i++) {
                              $thisders = str_contains($row['durum'], 'Hafız') ?  str_Replace('20/', '', $dersler[array_search($gun, $gunler) + $i]) : $dersler[array_search($gun, $gunler) + $i];
                              $class = 'bg-info';
                              if (in_array($dersler[array_search($gun, $gunler) + $i], $array2)) {
                                  $class = 'bg-danger';
                              }
                              $ders = $ders
                                  . ' <a  class="duzenleDers btn-xs ' . $class . '  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler) + $i] . '"data-target="#modalDersduzenle">' . $thisders
                                  . '</a> ';
                          }
                      } else {
                          $ders = '';
                      }

                      return $ders;
                  });
                  $raw[] = $gun;
              }*/
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }

        $ekle = [

            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Ad Soyad'],
            ['data' => 'kullanici', 'name' => 'kullanici', 'title' => 'Ödeme Alan'],
            ['data' => 'fiyat', 'name' => 'fiyat', 'title' => 'Tutar'],
            ['data' => 'odemeSekli', 'name' => 'odemeSekli', 'title' => 'Ödeme Şekli'],
            ['data' => 'tarih', 'name' => 'tarih', 'title' => 'Tarih'],
            ['data' => 'tur', 'name' => 'tur', 'title' => 'Ödeme Türü'],

            ['data' => 'aciklama', 'name' => 'aciklama', 'title' => 'Açıklama'],
            ['data' => 'action', 'name' => 'tactionur', 'title' => 'İşlem'],

        ];





        /*   foreach ($daterange as $date) {

               $gun = $date->format('Y-m-d');
               array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
           }*/
        $html = $builder
            /* ->ajax([

                'url' => route('muhasebe.indexpost',Auth::id()),
                'type' => 'POST',
                'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
                d.user_id = '{$id}';
                d.hoca_id = '{$request->hoca_id}';
                d.kota = '{$request->kota}';
                d.sayfa = '{$request->sayfa}';
                d.durum = '{$request->durum}';
            }",
            ])*/->columns($ekle)->initComplete("function() {


        window.LaravelDataTables['example1'].buttons().container().appendTo($('.col-md-6:eq(0)', window.LaravelDataTables['example1'].table().container()));


        }");
        if ($request->responsive) {
            $html->responsive(true);
        } else {
            $html->scrollX(true);
        };



        $html->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->serverSide(true)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3, 4], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ]);



        $veri['title'] = 'Muhasebe';
        $veri['name'] = 'Muhasebe';
        $veri['bast'] = $bast;
        $veri['sont'] = $sont;
        $veri['kota'] = $request->kota;
        $veri['sayfa'] = $request->sayfa;
        $veri['hoca'] = $request->hoca_id;
        $veri['birim'] = $id;
        $veri['durum'] = $request->durum;
        /* dd($html);
        exit; */

        return view('muhasebe.makbuzlar.index', compact('html', 'veri'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function odemeturgetir(Request $request)
    {

        //
     if ($request->ajax()) {
           // $gonder[] = "<option value='0'> Seçiniz </option>";
            $data = MakbuzSet::where('set_parent','=','odemeturu')->get();
            foreach ($data as $veri) {
                if($veri['set_data']=='SADAKA'){
                    $gonder[] = '<option selected value="' . $veri['set_data'] . '" >' . $veri['set_data'] . '</option>';

                }else{
                    $gonder[] = '<option value="' . $veri['set_data'] . '">' . $veri['set_data'] . '</option>';

                }
            }

            return response()->json($gonder);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function odemesekligetir(Request $request)
    {

        //
        $gonder[] = "<option value=\"\">SEÇİNİZ</option>";
        if ($request->ajax()) {

            $data = MakbuzSet::whereSetParent('odemesekli')->get();

            foreach ($data as $veri) {
                if($veri['set_data']=='NAKİT'){
                    $gonder[] = "<option selected value=\"" . $veri['set_data'] . "\" >" . $veri['set_data'] . "</option>";

                }else{
                    $gonder[] = "<option value=\"" . $veri['set_data'] . "\">" . $veri['set_data'] . "</option>";

                }

            }

            return response()->json($gonder);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function kurgetir(Request $request)
    {

        //

        if ($request->ajax()) {

            $data = MakbuzSet::whereSetParent('kur')->get();

            foreach ($data as $veri) {
                if($veri['set_data']=='₺'){
                    $gonder[] = "<option value=\"" . $veri['set_data'] . "\" selected>" . $veri['set_data'] . "</option>";

                }
                $gonder[] = "<option value=\"" . $veri['set_data'] . "\">" . $veri['set_data'] . "</option>";

            }

            return response()->json($gonder);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->ajax()) {

          $makbuz= Makbuz::create([
              'kullanici'=>Auth::user()->name,
             'user_id' =>Auth::user()->id,
              'kur'=>$request->kur,
              'aciklama'=>$request->makbuz_aciklama,
              'adsoyad'=>$request->makbuz_adsoyad,
              'odeme_sekli'=>$request->odemeSekli,
              'tur'=>$request->odenen,
              'tarih'=>$request->tarih,
              'tutar'=>$request->tutar,

          ]);
            $data= Kasa::create([
                'kullanici'=>$request->kullanici_adsoyad,
                'user_id' =>$request->kullanici_id,
                'kur'=>$request->kur,
                'makbuz_id'=>$makbuz->id,
                'aciklama'=>$request->makbuz_aciklama,
                'adsoyad'=>$request->makbuz_adsoyad,
                'odeme_sekli'=>$request->odemeSekli,
                'tur'=>$request->odenen,
                'ay'=>date('Y-m', strtotime($request->tarih)),
                'tarih'=>$request->tarih,
                'tutar'=>$request->tutar,
                'durum'=>'1',

            ]);
//$data=$request->all();
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        //
        if ($id>0) {

            $data= Makbuz::find($id);
//$data=$request->all();
            $data['yaziyla']=$this->sayiyiYaziyaCevir($data->tutar,$data->kur,null,"",null,null,null,0);
            return response()->json($data);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->ajax()) {

            $data = Makbuz::updateorCreate( ['id' => $id], [
                'kullanici' => $request->kullanici,
                'user_id' => $request->user_id,
                'kur' => $request->kur,
                'aciklama' => $request->aciklama,
                'adsoyad' => $request->adsoyad,
                'odeme_sekli' => $request->odeme_sekli,
                'tur' => $request->tur,
                'tarih' => $request->tarih,
                'tutar' => $request->tutar,

            ]);
//$data=$request->all();
            return response()->json($data);
        }
    }



    function sayiyiYaziyaCevir($sayi,  $parabirimi, $parakurus, $diyez, $bb1, $bb2, $bb3, $kurusbasamak = 2)
    {
        // kurusbasamak virgülden sonra gösterilecek basamak sayısı
        // parabirimi = TL gibi , parakurus = Kuruş gibi
        // diyez başa ve sona kapatma işareti atar # gibi
        if ($parabirimi == '₺') {
            $parabirimi = 'TÜRK LİRASI';
            $parakurus = 'KURUŞ';
        } elseif ($parabirimi == '$') {
            $parabirimi = 'DOLAR';
            $parakurus = 'CENT';
        } elseif ($parabirimi == '€') {
            $parabirimi = 'EURO';
            $parakurus = 'CENT';
        }
        $b1 = array("", "Bir ", "İki ", "Üç ", "Dört ", "Beş ", "Altı ", "Yedi ", "Sekiz ", "Dokuz ");
        $b2 = array("", "On ", "Yirmi ", "Otuz ", "Kırk ", "Elli ", "Altmış ", "Yetmiş ", "Seksen ", "Doksan ");
        $b3 = array("", "Yüz ", "Bin ", "Milyon ", "Milyar ", "Trilyon ", "Katrilyon ");

        if ($bb1 != null) { // farklı dil kullanımı yada farklı yazım biçimi için
            $b1 = $bb1;
        }
        if ($bb2 != null) { // farklı dil kullanımı
            $b2 = $bb2;
        }
        if ($bb3 != null) { // farklı dil kullanımı
            $b3 = $bb3;
        }

        $say1 = "";
        $say2 = ""; // say1 virgül öncesi, say2 kuruş bölümü
        $sonuc = "";

        $sayi = str_replace(",", ".", $sayi); //virgül noktaya çevrilir

        $nokta = strpos($sayi, "."); // nokta indeksi

        if ($nokta > 0) { // nokta varsa (kuruş)

            $say1 = substr($sayi, 0, $nokta); // virgül öncesi
            $say2 = substr($sayi, $nokta, strlen($sayi)); // virgül sonrası, kuruş

        } else {
            $say1 = $sayi; // kuruş yoksa
        }

        $son = '';
        $w = 1; // işlenen basamak
        $sonaekle = 0; // binler on binler yüzbinler vs. için sona bin (milyon,trilyon...) eklenecek mi?
        $kac = strlen($say1); // kaç rakam var?
        $sonint = ''; // işlenen basamağın rakamsal değeri
        $uclubasamak = 0; // hangi basamakta (birler onlar yüzler gibi)
        $artan = 0; // binler milyonlar milyarlar gibi artışları yapar
        $gecici = '';

        if ($kac > 0) { // virgül öncesinde rakam var mı?
            for ($i = 0; $i < $kac; $i++) {

                $son = $say1[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
                $sonint = $son; // işlenen rakam Integer.parseInt(

                if ($w == 1) { // birinci basamak bulunuyor

                    $sonuc = $b1[$sonint] . $sonuc;
                } else if ($w == 2) { // ikinci basamak

                    $sonuc = $b2[$sonint] . $sonuc;
                } else if ($w == 3) { // 3. basamak

                    if ($sonint == 1) {
                        $sonuc = $b3[1] . $sonuc;
                    } else if ($sonint > 1) {
                        $sonuc = $b1[$sonint] . $b3[1] . $sonuc;
                    }
                    $uclubasamak++;
                }

                if ($w > 3) { // 3. basamaktan sonraki işlemler

                    if ($uclubasamak == 1) {

                        if ($sonint > 0) {
                            $sonuc = $b1[$sonint] . $b3[2 + $artan] . $sonuc;
                            if ($artan == 0) { // birbin yazmasını engelle
                                $sonuc = str_replace($b1[1] . $b3[2], $b3[2], $sonuc);
                            }
                            $sonaekle = 1; // sona bin eklendi
                        } else {
                            $sonaekle = 0;
                        }
                        $uclubasamak++;
                    } else if ($uclubasamak == 2) {

                        if ($sonint > 0) {
                            if ($sonaekle > 0) {
                                $sonuc = $b2[$sonint] . $sonuc;
                                $sonaekle++;
                            } else {
                                $sonuc = $b2[$sonint] . $b3[2 + $artan] . $sonuc;
                                $sonaekle++;
                            }
                        }
                        $uclubasamak++;
                    } else if ($uclubasamak == 3) {

                        if ($sonint > 0) {
                            if ($sonint == 1) {
                                $gecici = $b3[1];
                            } else {
                                $gecici = $b1[$sonint] . $b3[1];
                            }
                            if ($sonaekle == 0) {
                                $gecici = $gecici . $b3[2 + $artan];
                            }
                            $sonuc = $gecici . $sonuc;
                        }
                        $uclubasamak = 1;
                        $artan++;
                    }
                }

                $w++; // işlenen basamak

            }
        } // if(kac>0)

        if ($sonuc == "") { // virgül öncesi sayı yoksa para birimi yazma
            $parabirimi = "";
        }

        $say2 = str_replace(".", "", $say2);
        $kurus = "";

        if ($say2 != "") { // kuruş hanesi varsa

            if ($kurusbasamak > 3) { // 3 basamakla sınırlı
                $kurusbasamak = 3;
            }
            $kacc = strlen($say2);
            if ($kacc == 1) { // 2 en az
                $say2 = $say2 . "0"; // kuruşta tek basamak varsa sona sıfır ekler.
                $kurusbasamak = 2;
            }
            if (strlen($say2) > $kurusbasamak) { // belirlenen basamak kadar rakam yazılır
                $say2 = substr($say2, 0, $kurusbasamak);
            }

            $kac = strlen($say2); // kaç rakam var?
            $w = 1;

            for ($i = 0; $i < $kac; $i++) { // kuruş hesabı

                $son = $say2[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
                $sonint = $son; // işlenen rakam Integer.parseInt(

                if ($w == 1) { // birinci basamak

                    if ($kurusbasamak > 0) {
                        $kurus = $b1[$sonint] . $kurus;
                    }
                } else if ($w == 2) { // ikinci basamak
                    if ($kurusbasamak > 1) {
                        $kurus = $b2[$sonint] . $kurus;
                    }
                } else if ($w == 3) { // 3. basamak
                    if ($kurusbasamak > 2) {
                        if ($sonint == 1) { // 'biryüz' ü engeller
                            $kurus = $b3[1] . $kurus;
                        } else if ($sonint > 1) {
                            $kurus = $b1[$sonint] . $b3[1] . $kurus;
                        }
                    }
                }
                $w++;
            }
            if ($kurus == "") { // virgül öncesi sayı yoksa para birimi yazma
                $parakurus = "";
            } else {
                $kurus = $kurus . " ";
            }
            $kurus = $kurus . $parakurus; // kuruş hanesine 'kuruş' kelimesi ekler
        }

        $sonuc = $diyez . $sonuc . " " . $parabirimi . " " . $kurus . $diyez;
        return $sonuc;
    }
}
