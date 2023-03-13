<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Hafizlikders;
use App\Models\Hafizlikdurum;
use App\Models\Hafizlikhoca;
use App\Models\Hocarapor;
use App\Models\Ogrenci;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class HocaHafizlikController extends Controller
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




        if ($request->ajax()) {



            $data =
                User::whereNotIn('users.id', [1])->where(['users.kullanici_durum' => '1'])
                ->when($hoca_id > 0, function ($q) use ($hoca_id) {
                    return $q->where('users.id', $hoca_id);
                })
                ->rightJoin('role_user', function ($join) {
                    $join->on('role_user.user_id', '=', 'users.id')
                        ->Where('role_user.role_id', '=', 37);
                }, null, null, 'FULL')
                ->leftJoin('birimhoca', function ($join) use ($birim_id) {
                    $join->on('users.id', '=', 'birimhoca.kullanici_id')
                        ->when($birim_id > 0, function ($q) use ($birim_id) {
                            return $q->where('birimhoca.birim_id', $birim_id);
                        }, function ($q) use ($birim_id) {
                            return $q;
                        });
                })


                ->leftJoin('birim', 'birim.birim_id', '=', 'birimhoca.birim_id')
                ->when($birim_id > 0, function ($q) use ($birim_id) {
                    return $q->where('birimhoca.birim_id', $birim_id);
                })

                ->leftJoin('hrapor', function ($join) use ($bast, $sont) {
                    $join->on('hrapor.kullanici_id', '=', 'users.id')
                        ->WhereBetween('hrapor.hrapor_tarih', [$bast, $sont]);
                }, null, null, 'FULL')
                ->orderBy('users.name', 'asc')
                ->select(
                    'users.id as id',
                    'users.kullanici_resim as resim',
                    'users.name as adsoyad',
                    'birim.birim_ad as birim_ad',

                    DB::raw('SUM(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.hrapor_ders ELSE 0 END ) topders '),
                    DB::raw('SUM(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.hrapor_sayfa ELSE 0 END ) topsayfa '),

                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id  THEN hrapor.hrapor_sayfa ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR "*") AS sayfa '),
                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.hrapor_tarih ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR ",") AS gunler'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.hrapor_ders ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR "*") AS ders'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.ogrenci_id ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR ",") AS ogrenci_id'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.ders_id ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR ",") AS ders_id'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hrapor.kullanici_id = users.id THEN hrapor.id ELSE NULL END
                     ORDER BY hrapor.id ASC SEPARATOR ",") AS hraporid')

                )->groupBy('users.id')
                ->get();

            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('adsoyad', function ($row) {
                    $name =  $row['adsoyad'];

                    return $name;
                })
                /*   ->addColumn('birim', function ($row) {

                    $birimler = explode(',', $row['birim_idler']);
                    $birim = '';
                    $s = 0;
                    foreach ($birimler as $key => $value) {
                        $b = Birim::find($value);

                        if ($s > 0) {
                            $birim = $birim . ', ' . $b->birim_ad;
                        } else {
                            $birim = $b->birim_ad;
                        }

                        $s++;
                    }

                    return $birim;
                }) */

                ->addColumn('tsayfa', function ($row) {
                    //$sayfa = explode('*', $row['sayfa']);
                    //$sayfa = array_sum($sayfa);
                    return $row['topsayfa'];
                })

                ->addColumn('tders', function ($row) {
                    // $sayfa = explode('*', $row['ders']);
                    // $sayfa = array_sum($sayfa);
                    return $row['topders'];
                })



                ->addColumn('resim', function ($row) {

                    if ($row['resim'] == '') {
                        $resim = "<img alt=\"Avatar\" class=\"avatar\" src=\"/storage/dimg/logo-yok.png\">";
                    } else {
                        $resim = "<img alt=\"Avatar\" class=\"avatar\" src=\"{$row['resim']}\">";
                    }

                    return $resim;
                });

            $raw = [
                'adsoyad',
                'resim', 'action',  'tsayfa', 'tders'
            ];
            /* foreach ($daterange as $date) {

                $gun = $date->format('Y-m-d');

                $dt->addColumn($gun, function ($row) use ($gun) {
                    $dersid = explode(',', $row['dersId']);
                    $gunler = explode(',', $row['gunler']);
                    $dersler = explode('*', $row['dersler']);
                    if (in_array($gun, $gunler)) {


                        $tekrar =   array_count_values($gunler);
                        $say = $tekrar[$gun];
                        ' <a  class="duzenleDers btn-xs bg-info  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler)] . '"data-target="#modalDersduzenle">' . $dersler[array_search($gun, $gunler)]
                            . '</a> ';
                        $ders =
                            ' <a  class="duzenleDers btn-xs bg-info  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler)] . '"data-target="#modalDersduzenle">' . $dersler[array_search($gun, $gunler)]
                            . '</a> ';
                        for ($i = 1; $i < $say; $i++) {
                            $ders = $ders
                                . ' <a  class="duzenleDers btn-xs bg-info  col-6 user-select-none" data-toggle="modal" data-dersid="' . $dersid[array_search($gun, $gunler) + $i] . '"data-target="#modalDersduzenle">' . $dersler[array_search($gun, $gunler) + $i]
                                . '</a> ';
                        }
                    } else {
                        $ders = '';
                    }
                    return $ders;
                });
                $raw[] = $gun;
            } */
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }
        $ekle = [

            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Ad Soyad'],
            // ['data' => 'birim', 'name' => 'birim', 'title' => 'Birim'],
            ['data' => 'tsayfa', 'name' => 'tsayfa', 'title' => 'Toplam Sayfa'],
            ['data' => 'tders', 'name' => 'tders', 'title' => 'Toplam Ders'],


        ];





        /*  foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        } */
        $html = $builder->ajax([

            'url' => route('hocahafizlik.indexpost'),
            'type' => 'Post',
            'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
            d.birim_id = '{$request->birim_id}';
            d.hoca_id = '{$request->hoca_id}';
          
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
        ],)->serverSide(false)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3, 4], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ])->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');




        $veri['title'] = 'Hafızlık Hocaları';
        $veri['name'] = 'Hoca';
        $veri['bast'] = $bast;
        $veri['sont'] = $sont;

        $veri['hoca'] = $request->hoca_id;
        $veri['birim'] = $request->birim_id;

        /* dd($html);
        exit; */

        return view('idari.hafizlik.hoca', compact('html', 'veri'));
    }
    public function hocagetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = User::rightJoin('role_user', 'role_user.user_id', '=', 'users.id')->where(['role_user.role_id' => '37', 'users.kullanici_durum' => 1])->whereNotIn('users.id', [1])->select('users.*')->get();
            $gonder[] =
                "<option selected value='0'> Tüm Hocalar</option>";
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['id'] . "\">" . $veri['name'] . "</option>";
            }

            return response()->json($gonder);
        }
    }
    public function birimhocagetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = User::leftJoin('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')
                ->leftJoin('hafizlikhoca', 'hafizlikhoca.kullanici_id', '=', 'birimhoca.kullanici_id')
                ->where('birimhoca.birim_id', '=', $request->birim_id)->whereNotIn('users.id', [1])
                ->select(
                    'users.id as id',
                    'users.name as name',
                    'birimhoca.birim_id as birim_id'
                )->get();

            $gonder[] =
                "<option selected value='0'> Tüm Hocalar</option>";
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['id'] . "\">" . $veri['name'] . "</option>";
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function durum(Request $request)
    {
        //
        if ($request->ajax()) {

            $ogrenciedit
                = DB::table('hafizlikdurum')->select('*')->where('ogrenci_id', $request->id)
                ->rightJoin('ogrenci',  'ogrenci.id', '=', 'hafizlikdurum.ogrenci_id')



                ->select('*')

                ->first();

            return response()->json($ogrenciedit);
        }
    }
    public function dersekle(Request $request)
    {
        //
        if ($request->ajax()) {

            if (str_contains($request->hafizlik_durum, 'Hafız')) {
                if (in_array('0', $request->hafizlik_hizb) && !in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) == 1) {
                    $topl = sizeof($request->hafizlik_cuz);
                    $ders =  '20/'
                        . implode(",", $request->hafizlik_cuz);
                    $hocasayfa = 20;
                    $hocaders = $topl;
                } elseif (in_array('0', $request->hafizlik_hizb) && !in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) > 1) {
                    $ders =
                        '20/' . implode(",", $request->hafizlik_cuz);

                    $hocasayfa = 20 * sizeof($request->hafizlik_cuz);

                    $topl = sizeof($request->hafizlik_cuz);
                    $hocaders = $topl;
                } elseif (in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) > 1) {
                    $topl = $request->hafizlik_cuz[2] - $request->hafizlik_cuz[1] + 1;
                    $ders = 'FN/' . $request->hafizlik_cuz[1] . '-' .
                        $request->hafizlik_cuz[2];
                    $hocasayfa = $topl * 20;
                    $hocaders = $topl;
                } elseif (!in_array('0', $request->hafizlik_hizb)) {
                    $topl = 0.25 * sizeof($request->hafizlik_hizb);
                    $ders = '20/' . $request->hafizlik_cuz[0] . '-';
                    foreach ($request->hafizlik_hizb as  $value) {


                        $ders .= $value[0] . ',';
                    }
                    $hocasayfa = $topl * 20;
                    $hocaders = $topl;
                }
                /*  if (str_contains($request->hafizlik_cuz, '30')) {
                    $durum = 'Hafız(' . (explode('(', $request->hafizlik_durum[1][1]) + 1) . ')';
                } */
                $sayfaders = 20;
                $ders = rtrim($ders, ", ");
                $sond = '20/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
                $hocaders = sizeof($request->hafizlik_cuz);
            } elseif (str_contains($request->hafizlik_durum, 'Has')) {

                $topl = sizeof($request->hafizlik_cuz) / pow(2, intval(substr($request->hafizlik_durum, 0, 1)));
                $ders = $request->hafizlik_sayfa . '/' . implode(",", $request->hafizlik_cuz);
                $sond = $request->hafizlik_sayfa . '/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
                $sayfaders = $request->hafizlik_sayfa;
                $hocasayfa = $request->hafizlik_sayfa * sizeof($request->hafizlik_cuz);
                $hocaders = sizeof($request->hafizlik_cuz);
            } elseif (str_contains($request->hafizlik_durum, 'Ham')) {
                $topl = sizeof($request->hafizlik_cuz);
                $ders = $request->hafizlik_sayfa . '/' . implode(",", $request->hafizlik_cuz);
                $sond = $request->hafizlik_sayfa . '/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
                $sayfaders = $request->hafizlik_sayfa;
                $hocasayfa = $request->hafizlik_sayfa * sizeof($request->hafizlik_cuz);
                $hocaders = sizeof($request->hafizlik_cuz);
            }

            $dersekle = Hafizlikders::create([
                "ogrenci_id" => $request->ogrenci_id,
                "kullanici_id" => $request->hoca_id,
                "hafizlik_sayfa" => $sayfaders,
                "hafizlik_cuz" => implode(",", $request->hafizlik_cuz),
                "hafizlik_ders" => $ders,
                "hafizlik_topl" => $topl,
                "hafizlik_tarih" => $request->hafizlik_tarih,
                "hafizlik_hata" => $request->hafizlik_hata,
                "hafizlik_usul" => $request->hafizlik_usul,
                "hafizlik_durum" => $request->hafizlik_durum,
            ]);
            $sonders = Hafizlikdurum::where('ogrenci_id', $request->ogrenci_id)->update(

                [
                    "hafizlik_son" => $sond,

                ]

            );

            $hrapor = Hocarapor::create([
                "ogrenci_id" => $request->ogrenci_id,
                "kullanici_id" => $request->hoca_id,
                "hrapor_sayfa" => $hocasayfa,
                "ders_id" => $dersekle->id,
                "hrapor_ders" => $hocaders,

                "hrapor_tarih" => $request->hafizlik_tarih,

            ]);
            return response()->json($dersekle);
        }
    }
    public function dersguncelle(Request $request)
    {
        //
        if ($request->sil) {
            $dersekle = DB::table('hfzlkders')->delete($request->ders_id);
        } else {
            if (str_contains($request->hafizlik_durum, 'Hafız')) {
                if (in_array('0', $request->hafizlik_hizb) && !in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) == 1) {
                    $topl = sizeof($request->hafizlik_cuz);
                    $ders =  '20/'
                        . implode(",", $request->hafizlik_cuz);
                    $hocasayfa = 20;
                    $hocaders = $topl;
                } elseif (in_array('0', $request->hafizlik_hizb) && !in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) > 1) {
                    $ders =
                        '20/' . implode(",", $request->hafizlik_cuz);

                    $hocasayfa = 20 * sizeof($request->hafizlik_cuz);

                    $topl = sizeof($request->hafizlik_cuz);
                    $hocaders = $topl;
                } elseif (in_array('FN', $request->hafizlik_cuz) && sizeof($request->hafizlik_cuz) > 1) {
                    $topl = $request->hafizlik_cuz[2] - $request->hafizlik_cuz[1] + 1;
                    $ders = 'FN/' . $request->hafizlik_cuz[1] . '-' .
                        $request->hafizlik_cuz[2];
                    $hocasayfa = $topl * 20;
                    $hocaders = $topl;
                } elseif (!in_array('0', $request->hafizlik_hizb)) {
                    $topl = 0.25 * sizeof($request->hafizlik_hizb);
                    $ders = '20/' . $request->hafizlik_cuz[0] . '-';
                    foreach ($request->hafizlik_hizb as  $value) {


                        $ders .= $value[0] . ',';
                    }
                    $hocasayfa = $topl * 20;
                    $hocaders = $topl;
                }
                /*  if (str_contains($request->hafizlik_cuz, '30')) {
                    $durum = 'Hafız(' . (explode('(', $request->hafizlik_durum[1][1]) + 1) . ')';
                } */
                $sayfaders = 20;
                $ders = rtrim($ders, ", ");
                $sond = '20/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
            } elseif (str_contains($request->hafizlik_durum, 'Has')) {

                $topl = sizeof($request->hafizlik_cuz) / pow(2, intval(substr($request->hafizlik_durum, 0, 1)));
                $ders = $request->hafizlik_sayfa . '/' . implode(",", $request->hafizlik_cuz);
                $sond = $request->hafizlik_sayfa . '/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
                $sayfaders = $request->hafizlik_sayfa;
                $hocasayfa = $request->hafizlik_sayfa * sizeof($request->hafizlik_cuz);
            } elseif (str_contains($request->hafizlik_durum, 'Ham')) {
                $topl = sizeof($request->hafizlik_cuz);
                $ders = $request->hafizlik_sayfa . '/' . implode(",", $request->hafizlik_cuz);
                $sond = $request->hafizlik_sayfa . '/' . $request->hafizlik_cuz[count($request->hafizlik_cuz) - 1];
                $sayfaders = $request->hafizlik_sayfa;
                $hocasayfa = $request->hafizlik_sayfa * sizeof($request->hafizlik_cuz);
                $hocaders = sizeof($request->hafizlik_cuz);
            }


            $dersekle
                = DB::table('hfzlkders')->where('id', $request->ders_id)->update([

                    "kullanici_id" => $request->hoca_id,
                    "hafizlik_sayfa" => $sayfaders,
                    "hafizlik_cuz" => implode(",", $request->hafizlik_cuz),
                    "hafizlik_ders" => $ders,
                    "hafizlik_topl" => $topl,
                    "hafizlik_tarih" => $request->hafizlik_tarih,
                    "hafizlik_hata" => $request->hafizlik_hata,
                    "hafizlik_usul" => $request->hafizlik_usul,
                    "hafizlik_durum" => $request->hafizlik_durum,

                ]);
            $sonders = DB::table('hafizlikdurum')->where('ogrenci_id', $request->ogrenci_id)->update(

                [
                    "hafizlik_son" => $sond,

                ]
            );
            $hrapor = DB::table('hrapor')->where('id', $request->ders_id)->update([

                "kullanici_id" => $request->hoca_id,
                "hrapor_sayfa" => $hocasayfa,

                "hrapor_ders" => $hocaders,

                "hrapor_tarih" => $request->hafizlik_tarih,

            ]);
        }
        return response()->json($dersekle);
    }

    public function ders(Request $request)
    {
        //
        if ($request->ajax()) {
            if ($request->ogrenci_id) {

                $ogrenciedit
                    = DB::table('hfzlkders')->select('*')->orderBy('hfzlkders.id', 'desc')->where('hfzlkders.ogrenci_id', $request->ogrenci_id)
                    ->rightJoin('hafizlikdurum', function ($join) use ($request) {
                        $join->on('hfzlkders.ogrenci_id', '=', 'hafizlikdurum.ogrenci_id');
                    }, null, null, 'FULL')
                    ->rightJoin('ogrenci',  'ogrenci.id', '=', 'hfzlkders.ogrenci_id')



                    ->select(
                        'ogrenci.id as ogrenci_id',
                        'ogrenci.ogrenci_adsoyad as adsoyad',
                        'hfzlkders.id as ders_id',
                        'hfzlkders.kullanici_id as hoca',
                        'hfzlkders.hafizlik_cuz as cuz',
                        'hfzlkders.hafizlik_sayfa as sayfa',
                        'hfzlkders.hafizlik_tarih as tarih',
                        'hfzlkders.hafizlik_ders as sonders',
                        'hfzlkders.hafizlik_usul as usul',
                        'hfzlkders.hafizlik_hata as hata',
                        'hafizlikdurum.hafizlik_durum as durum'
                    )->first();
            } elseif ($request->ders_id) {
                $ogrenciedit
                    = DB::table('hfzlkders')->select('*')->orderBy('hfzlkders.id', 'desc')->where('hfzlkders.id', $request->ders_id)
                    ->rightJoin('hafizlikdurum', function ($join) use ($request) {
                        $join->on('hfzlkders.ogrenci_id', '=', 'hafizlikdurum.ogrenci_id');
                    }, null, null, 'FULL')
                    ->rightJoin('ogrenci',  'ogrenci.id', '=', 'hfzlkders.ogrenci_id')



                    ->select(
                        'ogrenci.id as ogrenci_id',
                        'ogrenci.ogrenci_adsoyad as adsoyad',
                        'hfzlkders.id as ders_id',
                        'hfzlkders.kullanici_id as hoca',
                        'hfzlkders.hafizlik_cuz as cuz',
                        'hfzlkders.hafizlik_sayfa as sayfa',
                        'hfzlkders.hafizlik_tarih as tarih',
                        'hfzlkders.hafizlik_usul as usul',
                        'hfzlkders.hafizlik_hata as hata',
                        'hafizlikdurum.hafizlik_durum as durum'
                    )->first();
            }


            return response()->json($ogrenciedit);
        }
    }

    public function durumguncel(Request $request)
    {
        //

        if ($request->ajax()) {


            $dataf = DB::table('hafizlikdurum')->where('ogrenci_id', $request->ogrenci_id)->update(

                [
                    "hafizlik_durum" => $request->hafizlik_durum,
                    "bast" => $request->bast,
                    "donus_suresi" => $request->donus_suresi,



                ]
            );


            return response()->json($dataf);
        }
    }
    public function hocaguncel(Request $request)
    {
        //

        if ($request->ajax()) {


            $dataf = DB::table('hafizlikdurum')->where('ogrenci_id', $request->ogrenci_id)->update(

                [
                    "hoca" => $request->birimHoca_id,

                ]
            );


            return response()->json($dataf);
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
