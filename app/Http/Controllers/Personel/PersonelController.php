<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Birimhoca;

class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        /*  $data = User::get(['id', 'name', 'email']);
        if ($request->ajax()) {

            $data = User::get(['id', 'name', 'email']);


            return response()->json($data);
        } */
        return view('personel.index');
    }
    public function getEmployees(Request $request)
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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName, $columnSortOrder)

            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->orwhere('users.email', 'like', '%' . $searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($totalRecords)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $kullanici_resim = $record->kullanici_resim;
            $name = $record->name;
            $email = $record->email;

            $data_arr[] = array(

                "kullanici_resim" => '<img alt="Avatar" class="avatar" src="' . $kullanici_resim . '">',

                "name" => '<a href="#" onclick="alert(\'Hello world!\')">' . $name . '</a>',
                "email" => $email,
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
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function birim(Request $request)
    {
        //
        /*  $data = User::get(['id', 'name', 'email']);
        if ($request->ajax()) {

            $data = User::get(['id', 'name', 'email']);


            return response()->json($data);
        } */
        return view('personel.birim');
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
            User::select('users.*', DB::raw('count(kullanici_id) as allcount'))
            ->rightJoin('birimhoca', 'birimhoca.kullanici_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy($columnName, $columnSortOrder)
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($totalRecords)
            ->get();


        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $kullanici_resim = $record->kullanici_resim;
            $name = $record->name;
            $email = $record->email;

            $data_arr[] = array(

                "kullanici_resim" => '<img alt="Avatar" class="avatar" src="' . $kullanici_resim . '">',

                "name" => '<a href="#" onclick="alert(\'Hello world!\')">' . $name . '</a>',
                "email" => $email,
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
     * @return \Illuminate\Http\Response
     */
    public function create($data)
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