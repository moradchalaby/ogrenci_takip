<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Birimhoca;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Image;
use \Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Editor\Fields\Select;

class PersonelController extends Controller
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

        /*  */
        /*  ->select(

                'users.id as id',
                'users.name as name',
                'users.email as email',
                'users.kullanici_resim as resim',

                'roles.*'
            ) */
        /*
        foreach ($data->getRelation('name') as $key => $value) {
            echo $key;
            echo '<br>';
            echo $value;
        } */


        if (request()->ajax()) {
            $data = User::leftJoin(
                'role_user',
                'role_user.user_id',
                '=',
                'users.id'
            )
                ->leftJoin(
                    'roles',
                    'roles.id',
                    '=',
                    'role_user.role_id'
                )
                ->select(
                    'users.id as id',
                    'users.name as name',
                    'users.email as email',
                    'users.kullanici_gsm as gsm',
                    'users.kullanici_adres as adres',

                    'roles.name as roll',

                    DB::raw('GROUP_CONCAT(CASE WHEN role_user.user_id = users.id AND roles.vazife_id = 1 THEN roles.name ELSE NULL END
                     ORDER BY users.id ASC SEPARATOR ", ") AS rolum ')
                )->groupBy('users.id')->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vazife', function ($row) {
                    $vazife = $row['rolum'];
                    return $vazife;
                })
                ->addColumn('resim', function ($row) {

                    $resim = '<img alt="Avatar" class="avatar" src="' . $row['kullanici_resim'] . '">';

                    return $resim;
                })

                ->addColumn('email', function ($row) {
                    $gsm = '<a href = "mailto:' . $row['email'] . '?subject = AKMESCİD ÖĞRENCİ BİLGİ SİSTEMİ&body = MESAJINIZI BURAYA YAZINIZ">' . $row['email'] . '</a>';
                    return $gsm;
                })
                ->addColumn('iletisim', function ($row) {
                    $gsm = '<a href="tel:+90' . $row['gsm'] . '"><i class="fa-solid fa-phone"></i></a>
                    <a href="https://wa.me/+90' . str_replace([' ', '-', '(', ')'], '', $row['gsm']) . '" class="text-success"><i class="fa-brands fa-whatsapp-square"></i></a>';
                    return $gsm;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a type="button" class="btn btn-success btn-xs editmodal" data-toggle="modal" data-id="' . $row['id'] . '" data-target="#modalEdit">

                                          Düzenle
                                      </a>
                                      <a href="/yetki/' . $row['id'] . '" type="button" class="btn btn-success btn-xs">

                                        Yetkiler
                                      </a>';

                    return $btn;
                })
                ->rawColumns(['resim', 'gsm', 'vazife', 'iletisim', 'email', 'action'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'gsm', 'name' => 'gsm', 'title' => 'Telefon'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'adres', 'name' => 'adres', 'title' => 'Adres'],
            ['data' => 'vazife', 'name' => 'vazife', 'title' => 'Vazife'],
            ['data' => 'iletisim', 'name' => 'iletisim', 'title' => 'İletişim'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->parameters([
            'columnDefs' => [
                ["targets" => [4], "className" => "truncate"],
                ['targets' => [0],  "type" => "numeric"]

            ],

        ])

            ->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');
        $veri['title'] = 'Personeller';
        $veri['name'] = 'Personel';



        return view('idari.index', compact('html', 'veri'));
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function birim(Request $request)
    {
        //
        $data = User::get(['id', 'name', 'email']);
        if ($request->ajax()) {

            $data = User::get(['id', 'name', 'email']);


            return response()->json($data);
        }
        return view('idari.birim');
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
    public function edit(Request $requeste)
    {
        //

        if ($requeste->ajax()) {

            $ogrenciedit
                = DB::table('users')->select('*')->where('users.id', $requeste->id)



                ->select('*')

                ->first();

            return response()->json($ogrenciedit);
        }
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

            $userkay = DB::table('users')->where('id', $request['kullanici_id'])->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'kullanici_dt' => $request['kullanici_dt'],
                'kullanici_tc' => $request['kullanici_tc'],
                'kullanici_gsm' => $request['kullanici_gsm'],
                'kullanici_adres' => $request['kullanici_adres'],


            ]);


            $name = $request['kullanici_id'] . 'resimHoca';



            if ($request->file('file') != null) {



                $img = Image::make($request->file('file'));

                $img->fit(256, 256);
                //  $img->path = '/dimg' . $name . '.jpg'; // isterseniz resmi orantılı bir şekilde boyutlandır
                // isterseniz resmi orantılı bir şekilde boyutlandır
                $img->save(storage_path('app\public\dimg' . "\\" . $name . '.jpg'), 80);
                // storage dosyasına resmi %60 kalitede kaydet
                DB::table('users')->where('id', '=', $request['kullanici_id'])->update(
                    ['kullanici_resim' => '/storage/dimg' . '/' . $name . '.jpg']
                );
            }
            return response()->json($userkay);
        }
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