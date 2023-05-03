<?php

namespace App\Http\Controllers\Muhasebe;

use App\Http\Controllers\Controller;
use App\Models\Kasa;
use App\Models\Makbuz;
use App\Models\Ogrenci;
use App\Models\OgrenciOdeme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateInterval;
use DatePeriod;
use DateTime;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class OgrenciOdemeController extends Controller
{
    //
    /**
     * @throws \Exception
     */
    public function index(Request $request, Builder $builder)
    {



        $user_id= Auth::user()->id;



        if ($request->tarihar != null) {

            $tarihar = explode(' - ', $request->tarihar);
        } else {
            $tarihar = [date("Y-m"), date("Y-m")];
        };
        $bast = date("Y-m", strtotime($tarihar[0]));
        $sont =
            date("Y-m", strtotime($tarihar[1]));
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
                Ogrenci::where(['ogrenci.ogrenci_kytdurum' => '1'])
                    ->leftJoin('ogrenci_odemes', function ($join) use ($bast, $sont) {
                        $join->on('ogrenci_odemes.ogrenci_id', '=', 'ogrenci.id')
                            ->WhereBetween('ogrenci_odemes.ay', [$bast, $sont]);
                    }, null, null, 'FULL')
                    ->rightJoin('ogrencibirim', function ($join) use ($request) {
                        $join->on('ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                            ->when($request->birim_id > 0, function ($q) use ($request) {
                                return $q->where('ogrencibirim.birim_id', $request->birim_id);
                            }, function ($q) {
                                return $q;
                            });
                    })


                    ->leftJoin('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')

                    ->when($request->fiyat != null, function ($q) use ($request) {
                        return $q->havingRaw("ogrenci_odemes.tutar >= {$request->fiyat}");
                    }, function ($q) {
                        return $q;
                    })
                    ->when($request->tarih != null, function ($q) use ($sont, $bast) {
                        return $q->WhereBetween('ogrenci_odemes.tarih', [$bast, $sont]);
                    }, function ($q) {
                        return $q;
                    })->when($request->kur != null, function ($q) use ($request) {
                        return $q->where("ogrenci_odemes.kur", "=", $request->kur);
                    })->when($request->odeme_sekli != null, function ($q) use ($request) {
                        return $q->where("ogrenci_odemes.odeme_sekli", "=", $request->odeme_sekli);
                    }, function ($q) {
                        return $q;
                    })
                    ->select('ogrenci.id as ogr_id',
                        'ogrenci.ogrenci_adsoyad as ogr_adsoyad',
                        'ogrenci.babatel as babatel',
                        'ogrenci.annetel as annetel',
                        'ogrenci.annead as annead',
                        'ogrenci.babaad as babaad',
                        'ogrenci.annemes as annemes',
                        'ogrenci.babames as babames',
                        'ogrenci.ogrenci_resim as resim',
                        'ogrenci_odemes.*',
                        'birim.birim_ad')
                    ->get();


            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('adsoyad', function ($row) {



                    $name = ' <a  class="addmodal text-navy" data-toggle="modal" data-id="' . $row['ogr_id'] . '"data-target="#modalAdd">' . $row['ogr_adsoyad']
                        . '</a> ';
                    return $name;
                })
                ->addColumn('birim', function ($row) {



                    return $row['birim_ad'];
                })
                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['resim'] . '">';

                    return $resim;
                })

                ->addColumn('baba', function ($row) {
                    $gsm = $row['babaad'].'  -  '.$row['babames'].'<br>'.$row['babatel'].'<a href="tel:+90' . $row['babatel'] . '"><i class="fa-solid fa-phone"></i></a>
                    <a href="https://wa.me/+90' . str_replace([' ', '-', '(', ')'], '', $row['babatel']) . '" target="_blank" class="text-success"><i class="fa-brands fa-whatsapp-square"></i></a> <br>';
                    return $gsm;
                })
                ->addColumn('anne', function ($row) {
                    $gsm = $row['annead'].'  -  '.$row['annemes'].'<br>'.$row['annetel'].'<a href="tel:+90' . $row['annetel'] . '"><i class="fa-solid fa-phone"></i></a>
                    <a href="https://wa.me/+90' . str_replace([' ', '-', '(', ')'], '', $row['annetel']) . '" target="_blank" class="text-success"><i class="fa-brands fa-whatsapp-square"></i></a> <br>';
                    return $gsm;
                });


            $raw = [
                'resim',

                'adsoyad',
                'birim',
                'baba',
                'anne',
            ];
            foreach ($daterange as $date) {

                $gun = $date->format('Y-m');

                $dt->addColumn($gun, function ($row) use ($gun) {

                    if($gun==$row['ay']){
                        $makbuz='<a  class="duzenleDers btn-xs bg-success col-6 user-select-none" data-toggle="modal" data-dersid="' . $row['id']. '"data-target="#modalDersduzenle">' . $row['tutar']. '</a> ';
                    }else{
                        $makbuz='';

                    }
                    return $makbuz;
                });
                $raw[] = $gun;
            }
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }

        $ekle = [

            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Ad Soyad'],
            ['data' => 'birim', 'name' => 'birim', 'title' => 'Birim'],
            ['data' => 'baba', 'name' => 'baba', 'title' => 'Baba'],
            ['data' => 'anne', 'name' => 'anne', 'title' => 'Anne'],

            // ['data' => 'action', 'name' => 'taction', 'title' => 'İşlem'],

        ];





        foreach ($daterange as $date) {

            $gun = $date->format('Y-m');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }
        $html = $builder
            ->columns($ekle)->initComplete("function() {


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
                ['targets' => [2, 3], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ]);



        $veri['title'] = 'Öğrenci Ödemeleri';
        $veri['name'] = 'Öğrenci ödemeleri';
        $veri['bast'] = $bast;
        $veri['sont'] = $sont;
        $veri['kota'] = $request->kota;
        $veri['sayfa'] = $request->sayfa;
        $veri['hoca'] = $request->hoca_id;
        $veri['durum'] = $request->durum;


        return view('muhasebe.ogrenciodeme.index', compact('html', 'veri'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function storeOgrenci(Request $request)
    {
        //

        if ($request->ajax()) {
            if ($request->donem == 1) {
                $aciklama = date('Y-m', strtotime($request->aidat_ay)) . ' ÖĞRENCİ ÖDEMESİ';
            } elseif ($request->donem < 3) {

                $aciklama = date('Y-m', strtotime($request->aidat_ay)) . ' VE ' . date('Y-m', strtotime($request->aidat_ay . ' +1'  . 'month')) . 'ÖĞRENCİ ÖDEMESİ';
            } else {
                $aciklama = date('Y-m', strtotime($request->aidat_ay)) . ' VE ' . date('Y-m', strtotime($request->aidat_ay . ' +' . ($request->donem - 1)  . 'month')) . ' ARASI ÖĞRENCİ ÖDEMESİ';
            }

            $makbuz= Makbuz::create([
                'kullanici'=>$request->kullanici_adsoyad,
                'user_id' =>$request->kullanici_id,
                'kur'=>$request->kur,
                'ogrenci_id' => intval($request->ogrenci_id),
                'aciklama'=>$aciklama,
                'adsoyad'=>$request->ogrenci_adsoyad,
                'odeme_sekli'=>$request->odemeSekli,
                'tur'=>$request->odenen,
                'tarih'=>$request->tarih,
                'tutar'=>$request->tutar,

            ]);
            $kasa= Kasa::create([
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
            $tutar=$request->tutar/$request->donem;
            for ($i = 0; $i < $request->donem; $i++) {


                $data=OgrenciOdeme::create([
                    'ogrenci_id' => $request->ogrenci_id,
                    'user_id' => $request->kullanici_id,
                    'tutar' => $tutar,
                    'kur' => $request->kur,
                    'odeme_sekli' => $request->odemeSekli,
                    'ay' => date('Y-m', strtotime($request->aidat_ay . ' +' . $i . 'month')),
                    'makbuz_id' => $makbuz->id,
                    'tarih' => $request->tarih
                ]);
            }
            return response()->json($request);



        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function showOgrenci($id)
    {
        //
        if ($id>0) {

            $data= Ogrenci::find($id);


            return response()->json($data);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOgrenci(Request $request, $id)
    {
        //
        if ($request->ajax()) {

            $aidat = OgrenciOdeme::find( $id);

            $fark = request('tutar') - $aidat->tutar;

            $makbuz = Makbuz::find($aidat->makbuz_id);

            $aidat->tarih = request('tarih');
            $aidat->ay = request('ay');
            $aidat->tutar = request('tutar');
            $aidat->kur = request('kur');
            $aidat->odeme_sekli = request('odemeSekli');
            $aidat->save();

            $sonaciklama = $makbuz->aciklama . "\r" . $aidat->ay . " Tarihli ödeme değişikliğe uğramıştır. ";

            if ($fark != 0) {
                $sontutar = $makbuz->tutar + $fark;

                $makbuz->tutar = $sontutar;
                $makbuz->kur = request('kur');
                $makbuz->odeme_sekli = request('odemeSekli');
                $makbuz->tarih = request('tarih');
                $makbuz->aciklama = $sonaciklama;
                $makbuz->save();
            } else {
                $makbuz->kur = request('kur');
                $makbuz->odeme_sekli = request('odemeSekli');
                $makbuz->tarih = request('tarih');
                $makbuz->aciklama = $sonaciklama;
                $makbuz->save();
            }
            return response()->json($aidat);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyOgrenci($id)
    {
        //
        $aidat = OgrenciOdeme::find($id);
        $makbuzcek = Makbuz::find($aidat->makbuz_id);

        $fark = $aidat->tutar - $makbuzcek->tutar;

        $aidat_sil = OgrenciOdeme::find($id)->delete();

        if ($fark == 0) {
            $makbuz_sil = Makbuz::find($aidat->makbuz_id)->delete();
        } else {
            if ($fark < 0) {
                $fark = $fark * (-1);
            }
            $sonaciklama = $makbuzcek->aciklama . "\n" . $aidat->ay . ' Tarihli aidat silinmiştir. ';
            $makbuzuzenle = Makbuz::where('id', $aidat->makbuz_id)->update([
                'tutar' => $fark,
                'aciklama' => $sonaciklama
            ]);
        }
        return response()->json($aidat_sil);
    }
}
