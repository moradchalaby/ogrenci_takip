<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Birimhoca;
use App\Models\Birimsorumlu;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use \Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

class BirimsorumluController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:yetkili');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        //
        $veri['title'] = 'Birim Sorumluları';
        $veri['name'] = 'Birim Sorumlusu';


        if (request()->ajax()) {
            $data
                = User::select('users.*', 'birimsorumlu.*')
                ->join('birimsorumlu', 'birimsorumlu.kullanici_id', '=', 'users.id')
                ->join('birim', 'birim.birim_id', '=', 'birimsorumlu.birim_id')


                ->select('users.*', 'users.id', 'users.email', 'users.kullanici_resim', 'birim.birim_ad as birim');



            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['kullanici_resim'] . '">';

                    return $resim;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a type="button" class="btn btn-success btn-xs" data-toggle="modal" data-id="' . $row['id'] . '" data="' . strval($row) . '"
                                          data-target="#modalAdd">

                                          Düzenle
                                      </a>';

                    return $btn;
                })
                ->rawColumns(['resim', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'birim', 'name' => 'birim', 'title' => 'Birim'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],
        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        return view('idari.birimsorumlu', compact('html', 'veri'));
    }

    public function hocagetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = User::get(['id', 'name']);
            $gonder[] = "<option >HOCA SEÇİNİZ</option>";
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
            $gonder[] = "<option > BİRİM SEÇİNİZ</option>";
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Birimsorumlu::updateOrCreate(
                ['birim_id' => $request->birim_id,],
                [
                    'kullanici_id' => $request->kullanici_id,
                    'birim_id' => $request->birim_id,
                ]
            );

            $yetki = RoleUser::create(

                [
                    'role_id' => 3,
                    'user_id' => $request->kullanici_id,
                ],

            );

            return response()->json($data);
        }
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
            $data =
                User::select('users.*', 'birimsorumlu.*', 'birim.*')
                ->join('birimsorumlu', 'birimsorumlu.kullanici_id', '=', 'users.id')
                ->join('birim', 'birim.birim_id', '=', 'birimsorumlu.birim_id')


                ->select('users.*', 'birim.birim_ad', 'birim.birim_id as birimid');


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
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