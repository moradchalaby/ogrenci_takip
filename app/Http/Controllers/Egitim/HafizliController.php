<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Ogrenci;
use DateInterval;
use DatePeriod;
use DateTime;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class HafizliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        /*   $data = Ogrenci::join('ogrencibirim',  'ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
            ->join('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')
            ->join('hafizlikdurum',  'ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')
            ->crossJoin('hfzlkders')




            ->where(['ogrenci.ogrenci_kytdurum' => '1'], ['ogrenci.id', '=', 'hfzlkders.ogrenci_id'])
            ->orderBy('hfzlkders.hafizlik_tarih')

            ->select(
                'ogrenci.id as id',
                'ogrenci.ogrenci_resim',
                'ogrenci.ogrenci_adsoyad as adsoyad',


                'birim.birim_ad as birim',
                'hafizlikdurum.hafizlik_durum as durum',
                'hafizlikdurum.bast as bast',
                'hafizlikdurum.sont as sont',
                'hafizlikdurum.hafizlik_son as sonders',
                DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_ders ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersler '),
                DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS say'),
                DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_tarih ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS gunler'),
                DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.id ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersId')

            )->whereBetween('hfzlkders.hafizlik_tarih', ['2020-06-14', '2020-06-20'])
            ->groupBy('ogrenci.id')->get();
        print_r($data);
        exit;
                     foreach ($data as $key => $value) {
            echo $key;
            echo '<br>';
            echo $value->gunler;
            echo '<br><br><br>';
        }
        exit; */
        //tarihli dersleri ekle ye ayrı bir dizi olarak ekleyecez

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



            $data = Ogrenci::join('ogrencibirim',  'ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                ->join('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')
                ->join('hafizlikdurum',  'ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')
                ->crossJoin('hfzlkders')




                ->where(['ogrenci.ogrenci_kytdurum' => '1'], ['ogrenci.id', '=', 'hfzlkders.ogrenci_id'])
                ->orderBy('hfzlkders.hafizlik_tarih')

                ->select(
                    'ogrenci.id as id',
                    'ogrenci.ogrenci_resim',
                    'ogrenci.ogrenci_adsoyad as adsoyad',


                    'birim.birim_ad as birim',
                    'hafizlikdurum.hafizlik_durum as durum',
                    'hafizlikdurum.bast as bast',
                    'hafizlikdurum.sont as sont',
                    'hafizlikdurum.hafizlik_son as sonders',
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_ders ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersler '),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS say'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_tarih ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS gunler'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.id ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersId')

                )->whereBetween('hfzlkders.hafizlik_tarih', [$bast, $sont])
                ->groupBy('ogrenci.id')->get();

            $dt = DataTables::of($data)
                ->addIndexColumn()

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
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Name'],

        ];





        foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }
        $html = $builder->ajax([
            'url' => route('hafizlik.index'),
            'type' => 'GET',
            'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
        }",
        ])->columns($ekle)->lengthMenu([
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