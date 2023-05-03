<?php

namespace App\Providers;


use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];



    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Admin  mi ?
        Gate::define('yetkili', function ($user, $rout = '') {

            if ($rout == '') {
                $rout =  Request::route()->getPrefix();

            }
            if (empty($rout)) {
                $rout = '/takvim';
            }
            if (!str_contains($rout[0], '/')) {
                $rout = '/' . $rout;
            }

            if ($user->hasRole($rout)) {
               // echo $rout;
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yoktur.');
            } /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });


        Gate::define('islem', function ($user, $post) {
            $post =  Request::route()->getPrefix();
            if (!str_contains($post[0], '/')) {
                $post = '/' . $post;
            }
            if ($user->hasRole($post . '/islem') ) {

                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yoktur.');
            }
            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });
        Gate::define('yet', function ($user, $arr)  {
            if (str_contains($arr, ',')) {
                $arr = explode(',', $arr);
            }elseif ($arr == '') {
                $arr =  Request::route()->getPrefix();

            }elseif (!str_contains($arr[0], '/')) {
                $rout = '/' . $arr;
            }

            $val = '';
            if (is_array($arr)) {

                $bole = false;

                foreach ($arr as $key => $value) {


if ($user->hasRole($value) || $user->hasRole('/' . $value)) {
                        $bole = true;
                        $val = $value;
                        break;
                    }
            }
                if (
                    $bole
                ) {
                    return   Response::allow($val);
                } else {
                    return  Response::deny('Bu işlem için yetkiniz yoktur.');
                }
            } else {
                if ($user->hasRole($arr) || $user->hasRole('/' . $arr)) {
                    return   Response::allow($val);
                } else {
                    return  Response::deny('Bu işlem için yetkiniz yoktur.');
                }
            }


            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });
        Gate::define('parent', function ($user, $arr) {
            //$rout =  Request::route()->getPrefix();
            if (str_contains($arr, ',')) {
                $arr = explode(',', $arr);
            }

            if (is_array($arr)) {

                $bole = false;

                foreach ($arr as $key => $value) {
                    $rout = $value;

                    if ($user->hasRoleparent($rout) || $user->hasRoleparent('/' . $rout) ) {
                        $bole = true;
                    }
                }
                if (
                    $bole
                ) {
                    return   Response::allow();
                } else {
                    return  Response::deny('Bu işlem ' . $rout . ' için yetkiniz yok!');
                }
            } else {
                 if ($user->hasRoleparent($arr) || $user->hasRoleparent('/' . $arr) ) {
                    return   Response::allow();
                } else {
                    return  Response::deny('Bu işlem ' . $arr . ' için yetkiniz yok!');
                }
            }


            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });


        // Editör mü ?

        Gate::define('root', function ($user) {
            if ($user->hasRole('root') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem ROOT için yetkiniz yok!');
            }
        });
    }
}
