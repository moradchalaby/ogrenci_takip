<?php

namespace App\Http\Controllers\Yapi;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use App\Models\Birimhoca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BirimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('yapi.index');
    }
    public function getBirim(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Birim::select('count(*) as allcount')->count();
        $totalRecordswithFilter =
            Birim::select('birim.*', 'birimhoca.*', 'users.*')
            ->leftJoin(
                'birimhoca',
                'birimhoca.birim_id',
                '=',
                'birim.birim_id'
            )
            ->join('users', 'users.id', '=', 'birimhoca.kullanici_id')

            ->groupBy('birim.birim_id')->where('birim_ad', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records =
            Birim::select('birim.*', 'birimhoca.*', 'users.*')
            ->leftJoin(
                'birimhoca',
                'birimhoca.birim_id',
                '=',
                'birim.birim_id'
            )
            ->leftJoin(
                'users',
                'users.id',
                '=',
                'birimhoca.kullanici_id'
            )


            ->orderBy($columnName, $columnSortOrder)
            ->where('birim.birim_ad', 'like', '%' . $searchValue . '%')
            ->select(

                'birim.*',
                'users.name',
                'users.id'



            )
            ->skip($start)
            ->take($totalRecords)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $birim_id = $record->birim_id;
            $birim_donem = $record->birim_donem;
            $birim_ad = $record->birim_ad;
            $birim_sorumlu = $record->name;


            $data_arr[] = array(

                "birim_ad" =>  $birim_ad,
                "birim_donem" => $birim_donem,
                "birim_id" => '<a href="#" onclick="alert(\'Hello world!\')">' . $birim_id . '</a>',
                "birim_sorumlu" => $birim_sorumlu,
                "islemler" => '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-id="' . $birim_id . '" data-ad="' . $birim_ad . '"
                                          data-target="#modalEdit">

                                         <i class="fa-solid fa-pen-to-square"></i>
                                      </button>'/*  <input type="hidden" id="veri' . $birim_id . '" value="' . strval($record) . '">
                                          <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                          data-target="#modalAdd">
                                          Sil
                                      </button>*/
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
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