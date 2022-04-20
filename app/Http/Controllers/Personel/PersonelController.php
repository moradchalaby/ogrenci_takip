<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Birimhoca;
use \Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {


        if (request()->ajax()) {
            $data
                = User::select('users.*')


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


        return view('personel.index', compact('html'));
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
