<?php

namespace App\Http\Controllers\Egitim;

use App\Http\Controllers\Controller;
use App\Models\Ogrenci;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class HafizliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        //tarihli dersleri ekle ye ayrı bir dizi olarak ekleyecez
        $ekle = [
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'ogrenci_adsoyad', 'name' => 'ogrenci_adsoyad', 'title' => 'Name'],
            ['data' => 'babaad', 'name' => 'babaad', 'title' => 'Baba Adı'],
            ['data' => 'babatel', 'name' => 'babatel', 'title' => 'Baba Tel'],
            ['data' => '2022-04-01', 'name' => '2022-04-01', 'title' => '2022-04-01'],
            ['data' => '2022-04-02', 'name' => '2022-04-02', 'title' => '2022-04-02'],
            ['data' => '2022-04-03', 'name' => '2022-04-03', 'title' => '2022-04-03'],
            ['data' => '2022-04-04', 'name' => '2022-04-04', 'title' => '2022-04-04'],
            ['data' => 'annead', 'name' => 'annead', 'title' => 'Anne Adı'],
            ['data' => 'annetel', 'name' => 'annetel', 'title' => 'Anne Tel'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],
        ];
        $variable =  ['2022-04-01' => '20', '2022-04-02' => '21', '2022-04-03' => '22', '2022-04-04' => '23'];
        $raw = ['resim', 'action'];
        $html = $builder->columns($ekle)->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');

        if ($request->ajax()) {
            $data = Ogrenci::select('*')

                ->where(['ogrenci.ogrenci_kytdurum' => '1']);



            $dt = DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['ogrenci_resim'] . '">';

                    return $resim;
                })

                ->addColumn('action', function ($row) {
                    if (Gate::denies('islem', 'hafizlik')) {
                        $btn = '


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    } else {
                        $btn = ' <a type="button" class="btn btn-success reset btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '"
                                          data-target="#modalEdit">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                      </a>


                                      <a href="/ogrenci/detay/' . $row['id'] . '" type="button" class="btn btn-outline-primary btn-xs">

                                        <i class="fa-solid fa-angles-right"></i>
                                      </a>';
                    }

                    return $btn;
                });

            foreach ($variable as $key => $value) {
                $dt->addColumn($key, $value);
                $raw[] = $key;
            }
            $dt->rawColumns($raw);

            return  $dt->make(true);
        }
        $dizi = ['data' => 'buzz', 'name' => 'buzz', 'title' => 'Foo'];
        $veri['title'] = 'Öğrenciler';
        $veri['name'] = 'Ogrenci';



        return view('hafizlik.index', compact('html', 'veri'));
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