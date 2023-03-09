<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:yetkili');
    }
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //  protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        if ($errors->any()) {
            foreach ($errors->all() as $error) {
                echo $error;
            }
        }
        if ($request->ajax()) {

            $userkay = User::create(['id' => $request['kullanici_id']], [
                'name' => $request['name'],
                'email' => $request['email'],
                'kullanici_dt' => $request['kullanici_dt'],
                'kullanici_tc' => $request['kullanici_tc'],
                'kullanici_gsm' => $request['kullanici_gsm'],
                'kullanici_adres' => $request['kullanici_adres'],


                'password' => Hash::make($request['password']),
            ]);
            RoleUser::create([
                'role_id' => 6,
                'user_id' => $userkay->id,
            ]);

            $name = $userkay->id . 'resimHoca';

            dd($request['kullanici_id']);

            if ($request->file('file') != null) {



                $img = Image::make($request->file('file'));

                $img->fit(256, 256);
                //  $img->path = '/dimg' . $name . '.jpg'; // isterseniz resmi orantılı bir şekilde boyutlandır
                // isterseniz resmi orantılı bir şekilde boyutlandır
                $img->save(storage_path('app\public\dimg' . "\\" . $name . '.jpg'), 80);
                // storage dosyasına resmi %60 kalitede kaydet
                User::updateOrCreate(
                    ['id' => $userkay->id],
                    ['kullanici_resim' => '/storage/dimg' . '/' . $name . '.jpg']
                );
            }
            return response()->json($userkay);
        }
    }
}
