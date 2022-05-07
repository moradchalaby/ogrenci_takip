<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Hafizlikhoca;
use App\Models\Ogrenci;
use App\Models\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class HafizlikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        $birim_id = $request->birim_id;
        $hoca_id = $request->hoca_id;
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

        /*  $gunveri = DB::table('hfzlkders')->where('ogrenci_id', 255)
            ->orderBy('hafizlik_tarih')
            ->select(
                '*'
                /* DB::raw('GROUP_CONCAT(CASE WHEN ogrenci_id = 4 THEN hafizlik_ders ELSE NULL END
                     ORDER BY id ASC SEPARATOR ",") AS dersler '),
                DB::raw('GROUP_CONCAT(CASE WHEN ogrenci_id = 4 THEN hafizlik_topl ELSE NULL END
                     ORDER BY id ASC SEPARATOR ",") AS say'),
                DB::raw('GROUP_CONCAT(CASE WHEN ogrenci_id = 4 THEN hafizlik_tarih ELSE NULL END
                     ORDER BY id ASC SEPARATOR ",") AS gunler'),
                DB::raw('GROUP_CONCAT(CASE WHEN ogrenci_id = 4 THEN id ELSE NULL END
                     ORDER BY id ASC SEPARATOR ",") AS dersId'), */

        /*
                DB::raw("GROUP_CONCAT(if(hafizlik_ders is not null, '!!!', NULL)
                     ORDER BY hfzlkders.id ASC SEPARATOR ',') AS dersler "),
                DB::raw("GROUP_CONCAT(if(hafizlik_topl is not null, '!!!', NULL)
                     ORDER BY hfzlkders.id ASC SEPARATOR ',') AS say"),
                DB::raw("GROUP_CONCAT(if(hafizlik_tarih is not null, '!!!', NULL)
                     ORDER BY hfzlkders.id ASC SEPARATOR ',') AS gunler"),
                DB::raw("GROUP_CONCAT(if(id is not null, '!!!', NULL)
                     ORDER BY hfzlkders.id ASC SEPARATOR ',') AS dersId")
            ) ->groupBy('ogrenci_id') ->whereBetween('hafizlik_tarih', ['2020.06.15', '2020.06.15'])->orWhere('ogrenci_id', 255)->get();

        dd($request->has('birim_id'));
        exit;*/
        if ($request->ajax()) {



            $data =
                Ogrenci::where(['ogrenci.ogrenci_kytdurum' => '1'])

                ->rightJoin('ogrencibirim', function ($join) use ($birim_id) {
                    $join->on('ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                        ->when($birim_id > 0, function ($q) use ($birim_id) {
                            return $q->where('ogrencibirim.birim_id', $birim_id);
                        }, function ($q) use ($birim_id) {
                            return $q;
                        });
                })


                ->leftJoin('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')
                ->rightJoin('hafizlikdurum', function ($join) use ($hoca_id) {
                    $join->on('ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')
                        ->when($hoca_id > 0, function ($q) use ($hoca_id) {
                            return $q->where('hafizlikdurum.hoca', $hoca_id);
                        }, function ($q) use ($hoca_id) {
                            return $q;
                        });
                })
                ->leftJoin('hfzlkders', function ($join) use ($bast, $sont) {
                    $join->on('hfzlkders.ogrenci_id', '=', 'ogrenci.id')
                        ->WhereBetween('hfzlkders.hafizlik_tarih', [$bast, $sont]);
                }, null, null, 'FULL')
                /*   ->crossJoin('hfzlkders') */







                ->orderBy('hfzlkders.hafizlik_tarih')

                ->select(
                    'ogrenci.id as id',
                    'ogrenci.ogrenci_resim',
                    'ogrenci.ogrenci_adsoyad as adsoyad',


                    'birim.birim_ad as birim',
                    'hafizlikdurum.hafizlik_durum as durum',
                    'hafizlikdurum.hoca as hoca',
                    'hafizlikdurum.bast as bast',
                    'hafizlikdurum.sont as sont',
                    'hafizlikdurum.hafizlik_son as sonders',
                    DB::raw('SUM(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE 0 END )  say '),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_ders ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersler '),
                    /* DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE NULL END
                     WITH ROLLUP) AS say'), */
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_tarih ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS gunler'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.id ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersId')

                )
                ->groupBy('ogrenci.id')->when($request->kota != null, function ($q) use ($request) {
                    return $q->having('say', '>', $request->kota);
                }, function ($q) {
                    return $q;
                })->get();


            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('hoca', function ($row) {
                    $hoca = '-';
                    if ($row['hoca'] != null) {
                        $hocam = User::find($row['hoca']);
                        $hoca = $hocam->name;
                    }

                    return $hoca;
                })
                ->addColumn('hfzlkdurum', function ($row) {



                    return $row['durum'];
                })

                ->addColumn('sayfa', function ($row) {
                    $sayfalar = explode('/', $row['sonders']);
                    $sayfa = $sayfalar[0];


                    return intval($sayfa);
                })

                ->addColumn('toplam', function ($row) use ($request) {
                    /* $say = explode(',', ); */


                    $toplam = $row['say'];
                    /* foreach ($say as  $value) {
                        $toplam += floatval($value);
                    } */



                    return $toplam;
                })
                /*  ->filterColumn(function ($instance) use ($request) {
                    if ($request->kota != '0' || $request->kota != null) {
                        $instance->where('toplam', $request->kota);
                    }
                }) */
                ->addColumn('resim', function ($row) {

                    $resim = "<img alt=\"Avatar\" class=\"avatar\" src=\"{$row['ogrenci_resim']}\">";

                    return $resim;
                });

            $raw = [
                'resim', 'action'
            ];
            foreach ($daterange as $date) {

                $gun = $date->format('Y-m-d');

                $dt->addColumn($gun, function ($row) use ($gun) {
                    $dersid = explode(',', $row['dersId']);
                    $gunler = explode(',', $row['gunler']);
                    $dersler = explode(',', $row['dersler']);
                    if (in_array($gun, $gunler)) {


                        $tekrar =   array_count_values($gunler);
                        $say = $tekrar[$gun];
                        $ders =  ' <a type="button" class=" badge bg-info  col-6" data-toggle="modal" data-id="' .
                            $dersid[array_search($gun, $gunler)] .
                            '"data-target="#modalEdit">' .
                            $dersler[array_search($gun, $gunler)] .
                            '</a>';
                        for ($i = 1; $i < $say; $i++) {
                            $ders = $ders  .
                                ' <a type="button" class=" badge  bg-info   col-6" data-toggle="modal" data-id="' .
                                $dersid[array_search($gun, $gunler) + $i] .
                                '"data-target="#modalEdit">' .
                                $dersler[array_search($gun, $gunler) + $i] .
                                '</a>';
                        }
                    } else {
                        $ders = '';
                    }
                    return $ders;
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
            ['data' => 'hoca', 'name' => 'hoca', 'title' => 'Hocası'],
            ['data' => 'hfzlkdurum', 'name' => 'hfzlkdurum', 'title' => 'Durum'],
            ['data' => 'sayfa', 'name' => 'sayfa', 'title' => 'Sayfa'],
            ['data' => 'toplam', 'name' => 'toplam', 'title' => 'Toplam'],

        ];





        foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }
        $html = $builder->ajax([
            'url' => route('hafizlik.index'),
            'type' => 'GET',
            'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
            d.birim_id = '{$request->birim_id}';
            d.hoca_id = '{$request->hoca_id}';
            d.kota = '{$request->kota}';
            d.sayfa = '{$request->sayfa}';
        }",
        ])->columns($ekle);
        if ($request->responsive) {
            $html->responsive(true);
        } else {
            $html->scrollX(true);
        };
        $html->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');




        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';
        $veri['bast'] = $bast;
        /* dd($html);
        exit; */

        return view('hafizlik.index', compact('html', 'veri'));
    }
    public function hocagetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = User::rightJoin('hafizlikhoca', 'hafizlikhoca.kullanici_id', '=', 'users.id')->get();
            $gonder[] =
                "<option selected value='0'> Tüm Hocalar</option>";
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['kullanici_id'] . "\">" . $veri['name'] . "</option>";
            }

            return response()->json($gonder);
        }
    }
    public function birimgetir(Request $request)
    {

        //
        if ($request->ajax()) {
            $gonder[] = "<option selected value='0'> Tüm Birimler</option>";
            $data = Birim::get(['birim_id', 'birim_ad']);
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['birim_id'] . "\">" . $veri['birim_ad'] . "</option>";
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