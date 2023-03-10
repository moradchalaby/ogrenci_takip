<?php

namespace App\Http\Controllers\Personel;

use App\Http\Controllers\Controller;
use App\Models\Birim;
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

        $role_id = $request->role_id ==  null ? 0 : $request->role_id;
        $birim_id = $request->birim_id ==  null ? 0 : $request->birim_id;


        if (request()->ajax()) {

            $data = User::whereNot('user.id', 1)->leftJoin(
                'role_user',
                function ($join) {
                    $join->on('users.id', '=', 'role_user.user_id')
                        ->where('roles.vazife_id', 1)
                        ->rightJoin(
                            'roles',
                            'roles.id',
                            '=',
                            'role_user.role_id'
                        );
                },

            )->leftJoin(
                'birimhoca',
                function ($join) {
                    $join->on('birimhoca.kullanici_id', '=', 'users.id')
                        ->rightJoin(
                            'birim',
                            'birim.birim_id',
                            '=',
                            'birimhoca.birim_id'
                        );
                },

            )->select(
                'users.id as id',
                'users.name as name',
                'users.email as email',
                'users.kullanici_gsm as gsm',
                'users.kullanici_adres as adres',

                DB::raw('GROUP_CONCAT(CASE WHEN birimhoca.kullanici_id = users.id AND birim.birim_durum = 1 THEN birim.birim_ad ELSE NULL END
                     ORDER BY users.id ASC SEPARATOR ", ") AS birim '),
                DB::raw('GROUP_CONCAT(CASE WHEN birimhoca.kullanici_id = users.id AND birim.birim_durum = 1 THEN birim.birim_id ELSE NULL END
                     ORDER BY users.id ASC SEPARATOR " ") AS birimid '),
                DB::raw('GROUP_CONCAT(CASE WHEN role_user.user_id = users.id AND roles.vazife_id = 1 THEN roles.id ELSE NULL END
                     ORDER BY users.id ASC SEPARATOR " ") AS rolumid '),
                DB::raw('GROUP_CONCAT(CASE WHEN role_user.user_id = users.id AND roles.vazife_id = 1 THEN roles.name ELSE NULL END
                     ORDER BY roles.id ASC SEPARATOR ", ") AS rolum '),

            )->groupBy('users.id')->orderBy('name')
                ->when($role_id != 0, function ($q) use ($role_id) {
                    return $q->havingRaw("rolumid LIKE '%{$role_id}%'");
                }, function ($q) {
                    return $q;
                })
                ->when($birim_id != 0, function ($q) use ($birim_id) {
                    return $q->havingRaw("birimid LIKE '%{$birim_id}%'");
                }, function ($q) {
                    return $q;
                })
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vazife', function ($row) {
                    $vazife = implode(', ', array_unique(explode(', ', $row['rolum'])));
                    return $vazife;
                })
                ->addColumn('birim', function ($row) {
                    $vazife = implode(', ', array_unique(explode(', ', $row['birim'])));
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
                ->rawColumns(['resim', 'gsm', 'vazife', 'iletisim', 'email', 'action', 'birim'])
                ->make(true);
        }
        $html = $builder->ajax([

            'url' => route('personel.indexpost'),
            'type' => 'Post',
            'data' => "function(d) {
            d.birim_id = '{$request->birim_id}';
            d.role_id = '{$request->role_id}';

        }",
        ])->columns([
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Id'],
            ['data' => 'resim', 'name' => 'resim', 'title' => 'Resim'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'gsm', 'name' => 'gsm', 'title' => 'Telefon'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'adres', 'name' => 'adres', 'title' => 'Adres'],
            ['data' => 'birim', 'name' => 'birim', 'title' => 'Birim'],
            ['data' => 'vazife', 'name' => 'vazife', 'title' => 'Vazife'],
            ['data' => 'iletisim', 'name' => 'iletisim', 'title' => 'İletişim'],
            ['data' => 'action', 'name' => 'action', 'title' => 'İşlemler'],

        ])->lengthMenu([
            [-1, 10, 25, 50],
            ["Tümü", 10, 25, 50]
        ],)->serverSide(true)->search([
            "caseInsensitive" => true
        ])->parameters([
            'columnDefs' => [
                ['targets' => [2, 3], "orderDataType" => "dom-text", "type" => "locale-compare"],
                ['targets' => [0],  "type" => "numeric"]

            ]
        ])->initComplete('function() { window.LaravelDataTables["example1"].buttons().container().appendTo($(".col-md-6:eq(0)", window.LaravelDataTables["example1"].table().container()));}');


        $veri['title'] = 'Personeller';
        $veri['name'] = 'Personel';
        $veri['role'] =  $role_id;
        $veri['birim'] = $birim_id;
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
    public function rolegetir(Request $request)
    {


        //
        if ($request->ajax()) {

            $data = Role::where('vazife_id', 1)->get();
            $gonder[] =
                "<option selected value='0'> Tüm Personel</option>";
            foreach ($data as $veri) {
                $gonder[] = "<option value='" . $veri['id'] . "'>" . $veri['name'] . "</option>";
            }

            return response()->json($gonder);
        }
    }

    public function birimgetir(Request $request)
    {

        //
        if ($request->ajax()) {
            $gonder[] = "<option selected value='0'> Tüm Birimler</option>";
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
