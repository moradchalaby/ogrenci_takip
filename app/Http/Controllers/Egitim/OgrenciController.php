<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Ogrenci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class OgrenciController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:yetkili');
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {

        if (request()->ajax()) {
            $data = Ogrenci::select('*')

                ->where(['ogrenci.ogrenci_kytdurum' => 1]);



            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . '/dist/img/logo-yok.png' . '">';

                    return $resim;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::denies('islem', 'ogrenci')) {
                        $btn = '


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    } else {
                        $btn = '
                    <a type="button" class="btn btn-outline-warning btn-xs" data-toggle="modal" data-id="' . $row['id'] . '" data="' . strval($row) . '"
                                          data-target="#modalAdd">

                                         <i class="fa-solid fa-pen-to-square"></i>
                                      </a>

                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    }

                    return $btn;
                })
                ->rawColumns(['resim', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'ogrenci_adsoyad', 'name' => 'ogrenci_adsoyad', 'title' => 'Name'],
            ['data' => 'babaad', 'name' => 'babaad', 'title' => 'Baba Adı'],
            ['data' => 'babatel', 'name' => 'babaad', 'title' => 'Baba Tel'],
            ['data' => 'annead', 'name' => 'babaad', 'title' => 'Anne Adı'],
            ['data' => 'annetel', 'name' => 'babaad', 'title' => 'Anne Tel'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';



        return view('egitim.index', compact('html', 'veri'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('egitim.create');
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