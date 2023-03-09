<?php

namespace App\Http\Controllers\Yapi;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Birimhoca;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\Facades\DataTables;

class BirimController extends Controller
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
        if (request()->ajax()) {
            $data = Birim::where('birim_durum', '1')->get();



            return DataTables::of($data)
                ->addIndexColumn()


                ->addColumn('action', function ($row) {
                    if (Gate::denies('islem', 'birimogrenci')) {
                        $btn = '


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    } else {
                        $btn = '


                                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-id="' . $row['birim_id'] . '" data-ad="' . $row['birim_ad'] . '"
                                          data-target="#modalEdit">

                                         <i class="fa-solid fa-pen-to-square"></i>
                                      </button>
                                      <button type="button" class="btn btn-danger btn-xs deletebirim" data-id="' . $row['birim_id'] . '">

                                       <i class="fa-solid fa-trash-can"></i>
                                      </button>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],

            ['data' => 'birim_ad', 'name' => 'birim_ad', 'title' => 'BİRİM'],
            ['data' => 'birim_donem', 'name' => 'birim_donem', 'title' => 'Birim Dönem'],

            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        $veri['title'] = 'BİRİMLER';
        $veri['name'] = 'Birimler';


        return view('idari.yapi.index', compact('html', 'veri'));
    }


    /**
     *  Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function birimadd(Request $request)
    {

        //
        /*  echo 'geldik'; */
        if ($request->ajax()) {

            $data = Birim::create([
                'birim_ad' => $request->birim_ad,
                'birim_donem' => $request->birim_donem,
            ]);
            print_r($request);
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
    public function edit(Request $request)
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
    public function update(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Birim::updateOrCreate(['birim_id' => $request->birim_id], [
                'birim_ad' => $request->birim_ad,

            ]);

            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Birim::updateOrCreate(['birim_id' => $request->birim_id], [
                'birim_durum' => '0',

            ]);

            return response()->json($data);
        }
    }
}
