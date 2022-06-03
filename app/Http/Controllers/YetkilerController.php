<?php

namespace App\Http\Controllers;

use App\Models\Birimhoca;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;

class YetkilerController extends Controller
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
    public function index($id)
    {

        $yetki = DB::table('roles')->get();

        $user = User::find($id);
        $birimler = DB::table('birim')->where('birim_durum', 1)->get();
        $user_birim = DB::table('birimhoca')
            ->rightJoin('birim', 'birim.birim_id', '=', 'birimhoca.birim_id')->select()
            ->where('birimhoca.kullanici_id', $id)->get();

        return view('idari.yapi.yetki',  [
            'yetki' => $yetki,
            'user' => $user,
            'id' => $id,
            'birimler' => $birimler,
            'birimi' => $user_birim
        ]);
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
            if ($request->tur == 'birim') {
                $data = Birimhoca::create(

                    [
                        'birim_id' => $request->role_id,
                        'kullanici_id' => $request->user_id,
                    ]
                );
            } else {
                $data = RoleUser::create(

                    [
                        'role_id' => $request->role_id,
                        'user_id' => $request->user_id,
                    ]
                );
            }


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
    public function destroy(Request $request)
    {
        //
        if ($request->ajax()) {
            if ($request->tur == 'birim') {
                $data = Birimhoca::where('birim_id', '=', $request->role_id)->where('kullanici_id', '=', $request->user_id)->delete();
            } else {
                $data
                    = RoleUser::where('role_id', '=', $request->role_id)->where('user_id', '=', $request->user_id)->delete();
            }
            return response()->json($data);
        }
    }
}