<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->ajax()) {
            $pass = Hash::make($request['password'] ? '' : 'akmescid1453');
            $dt = $request['kullanici_dt'] ? '' : '2023-01-01';
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'kullanici_dt' => $dt,
                'kullanici_tc' => $request['kullanici_tc'],
                'kullanici_gsm' => $request['kullanici_gsm'],
                'kullanici_adres' => $request['kullanici_adres'],


                'password' => $pass,
            ]);
            RoleUser::create([
                'role_id' => 6,
                'user_id' => $user->id,
            ]);

            $name = $user->id . 'resimHoca';

            // dd($request['kullanici_id']);
            if ($request->file('file') != null) {



                $img = Image::make($request->file('file'));

                $img->fit(256, 256);
                //  $img->path = '/dimg' . $name . '.jpg'; // isterseniz resmi orantılı bir şekilde boyutlandır
                // isterseniz resmi orantılı bir şekilde boyutlandır
                $img->save(storage_path('app\public\dimg' . "\\" . $name . '.jpg'), 80);
                // storage dosyasına resmi %60 kalitede kaydet
                User::updateOrCreate(
                    ['id' => $user->id],
                    ['kullanici_resim' => '/storage/dimg' . '/' . $name . '.jpg']
                );
            }
            /* if ($roleuser) {
            event(new Registered($user));

           // Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } */

            return response()->json($user);
        }
    }
}
