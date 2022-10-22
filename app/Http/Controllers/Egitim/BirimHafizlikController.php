<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Birimsorumlu;
use App\Models\Hafizlikhoca;
use App\Models\Ogrenci;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class BirimHafizlikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder, $id = 1)
    {

        $user_birim = Birim::leftJoin('birimhoca', 'birim.birim_id', '=', 'birimhoca.birim_id')
            ->select()
            ->where('birimhoca.kullanici_id', Auth::user()->id)
            ->get();
        $birim_id = $user_birim[0]->birim_id;
        for ($i = 0; $i < count($user_birim); $i++) {
            if ($user_birim[$i]->birim_id == $id) {
                $birim_id = $user_birim[$i]->birim_id;
                break;
            }
        }


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
                Ogrenci::where(['ogrenci.ogrenci_kytdurum' => '1'])

                ->rightJoin('ogrencibirim', function ($join) use ($birim_id) {
                    $join->on('ogrenci.id', '=', 'ogrencibirim.ogrenci_id')
                        ->where('ogrencibirim.birim_id', '=', $birim_id);
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

                ->orderBy('ogrenci.ogrenci_adsoyad', 'asc')

                ->select(
                    'ogrenci.id as id',
                    'ogrenci.ogrenci_resim',
                    'ogrenci.ogrenci_adsoyad as adsoyad',

                    'birim.birim_id as birim_id',
                    'birim.birim_ad as birim',
                    'hafizlikdurum.hafizlik_durum as durum',
                    'hafizlikdurum.hoca as hoca',
                    'hafizlikdurum.bast as bast',
                    'hafizlikdurum.donus_suresi as donus',
                    'hafizlikdurum.sont as sont',
                    'hafizlikdurum.hafizlik_son as sonders',
                    DB::raw("SUBSTRING_INDEX(hafizlikdurum.hafizlik_son, '/', 1) AS sayfa"),

                    DB::raw('SUM(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE 0 END )  say '),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_ders ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR "*") AS dersler '),
                    /* DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE NULL END
                     WITH ROLLUP) AS say'), */
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_tarih ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS gunler'),
                    DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.id ELSE NULL END
                     ORDER BY hfzlkders.id ASC SEPARATOR ",") AS dersId')

                )
                ->groupBy('ogrenci.id')->when($request->kota != null, function ($q) use ($request) {
                    return $q->havingRaw("say >= {$request->kota}");
                }, function ($q) {
                    return $q;
                })->when($request->sayfa != null, function ($q) use ($request) {
                    return $q->havingRaw("sayfa >= {$request->sayfa}");
                }, function ($q) {
                    return $q;
                })->when($request->durum != null, function ($q) use ($request) {
                    return $q->where("hafizlikdurum.hafizlik_durum", "like", "%{$request->durum}%");
                }, function ($q) {
                    return $q;
                })->get();


            $dt = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('adsoyad', function ($row) {
                    $name = ' <a  class="ekleDers text-navy" data-toggle="modal" data-id="' . $row['id'] . '"data-target="#modalDersekle">' . $row['adsoyad']
                        . '</a> ';

                    return $name;
                })
                ->addColumn('hoca', function ($row) {

                    $hoca = ' <a  class="editHoca" data-toggle="modal" data-ogrenci="' . $row['id'] . '" data-birim="' . $row['birim_id'] . '" data-id="0" data-target="#modalHoca">-</a> ';
                    if ($row['hoca'] != null) {
                        $hocam = User::find($row['hoca']);
                        $hoca = ' <a  class="editHoca" data-toggle="modal" data-ogrenci="' . $row['id'] . '" data-birim="' . $row['birim_id'] . '" data-id="' . $hocam->id . '"data-target="#modalHoca">' . $hocam->name . '</a> ';
                    }

                    return $hoca;
                })

                ->addColumn('hfzlkdurum', function ($row) {
                    $durum = ' <a  class="editDurum" data-toggle="modal" data-id="' . $row['id'] . '"data-target="#modalDurum">' . $row['durum']
                        . '</a> ';

                    $simdiki_tarih = Carbon::now();
                    $ileriki_tarih = Carbon::parse($row['bast'])->addDay(intval($row['donus']));
                    $gun_farki    = $simdiki_tarih->diffInDays($ileriki_tarih, false);

                    if ($gun_farki  <= 0) {
                        $durum = $durum . '<br> <span class="text-danger">' . $gun_farki . ' gün geçti </span>';
                    } else {
                        $durum = $durum .
                            '<br> <span class="text-info">' . $gun_farki . ' gün kaldı </span>';
                    }




                    return $durum;
                })

                ->addColumn('sayfa', function ($row) {

                    $sayfa = $row['sayfa'];


                    return intval($sayfa);
                })

                ->addColumn('toplam', function ($row) use ($request) {



                    $toplam = $row['say'];



                    return $toplam;
                })

                ->addColumn('resim', function ($row) {

                    $resim = "<img alt=\"Avatar\" class=\"avatar\" src=\"{$row['ogrenci_resim']}\">";

                    return $resim;
                });

            $raw = [
                'adsoyad',
                'resim', 'action', 'hfzlkdurum', 'toplam', 'sayfa', 'hoca'
            ];
            foreach ($daterange as $date) {

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
            }
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }
        $ekle = [

            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'adsoyad', 'name' => 'adsoyad', 'title' => 'Ad Soyad'],
            ['data' => 'hoca', 'name' => 'hoca', 'title' => 'Hocası'],
            ['data' => 'birim', 'name' => 'birim', 'title' => 'Birimx'],
            ['data' => 'hfzlkdurum', 'name' => 'hfzlkdurum', 'title' => 'Durum'],
            ['data' => 'sayfa', 'name' => 'sayfa', 'title' => 'Sayfa'],
            ['data' => 'toplam', 'name' => 'toplam', 'title' => 'Toplam'],

        ];





        foreach ($daterange as $date) {

            $gun = $date->format('Y-m-d');
            array_push($ekle, ['data' => $gun, 'name' => $gun, 'title' => $gun]);
        }
        $html = $builder->ajax([

            'url' => route('birimhafizlik.index', $birim_id),
            'type' => 'Get',
            'data' => "function(d) { d.tarihar = '{$bast} - {$sont} ';
            d.birim_id = '{$birim_id}';
            d.hoca_id = '{$request->hoca_id}';
            d.kota = '{$request->kota}';
            d.sayfa = '{$request->sayfa}';
            d.durum = '{$request->durum}';
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
        ],)->serverSide(true)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3, 4], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ])->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');




        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';
        $veri['bast'] = $bast;
        $veri['sont'] = $sont;
        $veri['kota'] = $request->kota;
        $veri['sayfa'] = $request->sayfa;
        $veri['hoca'] = $request->hoca_id;
        $veri['birim'] = $birim_id;
        $veri['durum'] = $request->durum;
        /* dd($html);
        exit; */

        return view('birim.hafizlik.index', compact('html', 'veri'));
    }
    public function hocagetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.id', '37')->select('users.*')
                ->get();
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
            User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.id', '37')->select('users.*')
                ->get();
            $data = User::leftJoin('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')
                ->leftJoin('hafizlikhoca', 'hafizlikhoca.kullanici_id', '=', 'birimhoca.kullanici_id')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.id', '37')
                ->where('birimhoca.birim_id', '=', $request->birim_id)
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


            $dersekle
                = DB::table('hfzlkders')->insertGetId([
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
            $sonders = DB::table('hafizlikdurum')->where('ogrenci_id', $request->ogrenci_id)->update(

                [
                    "hafizlik_son" => $sond,

                ]

            );
            $hrapor = DB::table('hrapor')->insert([
                "ogrenci_id" => $request->ogrenci_id,
                "kullanici_id" => $request->hoca_id,
                "hrapor_sayfa" => $hocasayfa,
                "ders_id" => $dersekle,
                "hrapor_ders" => $hocaders,

                "hrapor_tarih" => $request->hafizlik_tarih,

            ]);
            return response()->json($hrapor);
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