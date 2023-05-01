<?php

namespace App\Http\Controllers\Muhasebe;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Birimhoca;
use App\Models\MakbuzSet;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\Facades\DataTables;

class MakbuzSetController extends Controller
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
            $data = MakbuzSet::whereSetTur('muhasebe')->get();



            return DataTables::of($data)
                ->addIndexColumn()


                ->addColumn('action', function ($row) {

                        $btn = '<button type="button" class="btn btn-success btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-ad="' . $row['set_data'] . '" data-tur="' . $row['set_tur'] . '"
                                          data-target="#modalEdit">

                                         <i class="fa-solid fa-pen-to-square"></i>
                                      </button>
                                      <button type="button" class="btn btn-danger btn-xs deleteset" data-id="' . $row['id'] . '">

                                       <i class="fa-solid fa-trash-can"></i>
                                      </button>';


                    return $btn;
                })
                ->addColumn('set_data',function ($row){
                    return $row['set_data'];
                })
                ->rawColumns(['action','set_data'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'set_data', 'name' => 'set_data', 'title' => 'Ayar'],

            ['data' => 'set_parent', 'name' => 'set_parent', 'title' => 'Parent'],


            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        $veri['title'] = 'MAKBUZ AYAR';
        $veri['name'] = 'Makbuz Ayarları';


        return view('muhasebe.makbuzset.index', compact('html', 'veri'));
    }


    /**
     *  Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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

            $data = MakbuzSet::create([
                'set_data' => $request->set_data,
                'set_tur' => $request->set_tur,
                'set_parent'=>'1'
            ]);
            return response()->json($data);
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

            $data = MakbuzSet::updateOrCreate(['id' => $request->set_id], [
                'set_data' => $request->set_data,
                'set_tur' => $request->set_tur,

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

            $data = MakbuzSet::destroy($request->set_id);

            return response()->json($data);
        }
    }
}
