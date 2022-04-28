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
        /*  $data = Ogrenci::join('ogrencibirim',  'ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
            ->join('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')
            ->join('hafizlikdurum',  'ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')
            ->join('hfzlkders', 'ogrenci.id', '=', 'hfzlkders.ogrenci_id')




            ->where(['ogrenci.ogrenci_kytdurum' => '1'])
            ->orderBy('hfzlkders.hafizlik_tarih')
            ->select(
                'ogrenci.id as id',
                'ogrenci.ogrenci_adsoyad as adsoyad',


                'birim.birim_ad as birim',
                'hafizlikdurum.hafizlik_durum as durum',
                'hafizlikdurum.bast as bast',
                'hafizlikdurum.sont as sont',
                'hafizlikdurum.hafizlik_son as sonders',
                DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_ders) AS dersler'),
                DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_topl) AS say'),
                DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_tarih) AS gunler')
            )->whereBetween('hfzlkders.hafizlik_tarih', ['2020-06-16', '2020-06-19'])
            ->groupBy('ogrenci.id')->get();
        foreach ($data as $key => $value) {
            echo $key;
            echo '<br>';
            echo $value->gunler;
            echo '<br><br><br>';
        }
        exit; */
        //tarihli dersleri ekle ye ayrı bir dizi olarak ekleyecez
        $ekle = [
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Name'],

        ];
        $variable =  ['2022-04-01' => '20', '2022-04-02' => '21', '2022-04-03' => '22', '2022-04-04' => '23'];
        $raw = ['resim', 'action'];

        $bast = '2020-06-16';
        $sont = '2020-06-19';
        $beign = new DateTime($bast);
        $end = new DateTime($sont);
        $end = $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod(
            $beign,
            $interval,
            $end
        );
        foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }
        $html = $builder->columns($ekle)->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        if ($request->ajax()) {
            $bast = $request->bast ? null : '2020-06-16';
            $sont = $request->sont ? null : '2020-06-19';


            $beign = new DateTime($bast);
            $end = new DateTime($sont);
            $end = $end->modify('+1 day');
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($beign, $interval, $end);
            foreach ($daterange as $date) {

                $gun = $date->format('Y-m-d');
                array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
            }
            $html = $builder->columns($ekle)->lengthMenu([
                [-1, 10, 25, 50],
                ["Tümü", 10, 25, 50]
            ],)->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');


            $data = Ogrenci::join('ogrencibirim',  'ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                ->join('birim', 'birim.birim_id', '=', 'ogrencibirim.birim_id')
                ->join('hafizlikdurum',  'ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')
                ->join('hfzlkders', 'ogrenci.id', '=', 'hfzlkders.ogrenci_id')




                ->where(['ogrenci.ogrenci_kytdurum' => '1'])
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
                    DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_ders) AS dersler'),
                    DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_topl) AS say'),
                    DB::raw('GROUP_CONCAT(hfzlkders.hafizlik_tarih) AS gunler')
                )->whereBetween('hfzlkders.hafizlik_tarih', [$bast, $sont])
                ->groupBy('ogrenci.id')->get();


            $dt = DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['ogrenci_resim'] . '">';

                    return $resim;
                });


            foreach ($daterange as $date) {

                $gun = $date->format('Y-m-d');

                $dt->addColumn($gun, function ($row) use ($gun) {

                    $gunler = explode(',', $row['gunler']);
                    $dersler = explode(',', $row['dersler']);
                    if (in_array($gun, $gunler)) {


                        $tekrar =   array_count_values($gunler);
                        $say = $tekrar[$gun];
                        $ders =  $dersler[array_search($gun, $gunler)];
                        for ($i = 1; $i < $say; $i++) {
                            $ders = $ders  . ',' .   $dersler[array_search($gun, $gunler) + $i];
                        }
                    } else {
                        $ders = 'yok';
                    }
                    return $ders;
                });
                $raw[] = $gun;
            }
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }

        $dizi = ['data' => 'buzz', 'name' => 'buzz', 'title' => 'Foo'];
        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';

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