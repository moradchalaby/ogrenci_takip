<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use App\Models\Birim;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Birimhoca;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use \Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

class BirimhocaController extends Controller
{
    public function __construct()
    {
        /*
routes 'e prefix isimlerini ekleyeceğiz
user_route 'a yetkilendirme yapacağız
*/
        if (Gate::allows('yetkili', Request::route()->getPrefix())) {
            $this->middleware('auth');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        $veri['title'] = 'Birim Sorumluları';
        $veri['name'] = 'Birim Sorumlusu';


        if (request()->ajax()) {
            $data
                = User::select('users.*', 'birimhoca.*')
                ->join('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')


                ->select('users.*', 'users.id', 'users.email', 'users.kullanici_resim');



            return Datatables::of($data)
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
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');




        return view('personel.birim', compact('html', 'veri'));
    }
    public function hocagetir(Request $request)
    {
        dd(Request::route()->getPrefix());
        exit;

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

            $data = Birimhoca::updateOrCreate(
                ['birim_id' => $request->birim_id],
                [
                    'kullanici_id' => $request->kullanici_id,
                    'birim_id' => $request->birim_id,
                ]
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
                User::select('users.*', 'birimhoca.*', 'birim.*')
                ->join('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')
                ->join('birim', 'birim.birim_id', '=', 'birimhoca.birim_id')


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