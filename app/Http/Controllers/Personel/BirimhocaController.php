<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use App\Models\Birim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Birimhoca;

use Datatables;

class BirimhocaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //
        if ($request->ajax()) {

            $data = User::get(['id', 'name']);
            foreach ($data as $veri) {
                $gonder[] = "<option value=\"" . $veri['id'] . "\">" . $veri['name'] . "</option>";
            }

            return response()->json($gonder);
        }
        return view('personel.birim');
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
        $totalRecords = Birimhoca::select('count(*) as allcount')->count();
        /*    select('count(*) as allcount')->count(); */
        $totalRecordswithFilter =
            User::select('users.*', DB::raw('count(kullanici_id) as allcount'))
            ->rightJoin(
                'birimhoca',
                'birimhoca.kullanici_id',
                '=',
                'users.id'
            )
            ->groupBy('users.id')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records =
            User::select('users.*', 'birimhoca.*', 'birim.*')
            ->join('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')
            ->join('birim', 'birim.birim_id', '=', 'birimhoca.birim_id')

            ->orderBy($columnName, $columnSortOrder)
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->select('users.*', 'birim.birim_ad', 'birim.birim_id as birimid')
            ->skip($start)
            ->take($totalRecords)
            ->get();


        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $kullanici_resim = $record->kullanici_resim;
            $name = $record->name;

            $birim  = $record->birim_ad;

            $data_arr[] = array(

                "kullanici_resim" => '<img alt="Avatar" class="avatar" src="' . $kullanici_resim . '">',

                "name" => '<a href="#" onclick="alert(\'Hello world!\')">' . $name . '</a>',

                "birim_ad" => $birim,
                "islemler" => '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-id="' . $id . '" data="' . strval($record) . '"
                                          data-target="#modalAdd">

                                          Suzenle
                                      </button><input type="hidden" id="veri' . $id . '" value="' . strval($record) . '">
                                          <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                          data-target="#modalAdd">
                                          Sil
                                      </button>'
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