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

            if (
                $user->hasRole($rout) || $user->hasRole('root')
            ) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            } /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });


        Gate::define('islem', function ($user, $post) {
            if (!str_contains($post[0], '/')) {
                $post = '/' . $post;
            }
            if ($user->hasRole($post . '/islem') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });
        Gate::define('yet', function ($user, $arr) {
            if (str_contains($arr, ',')) {
                $arr = explode(',', $arr);
            }
            $val = '';
            if (is_array($arr)) {

                $bole = false;

                foreach ($arr as $key => $value) {
                    $rout = $value;

                    if ($user->hasRole($rout) || $user->hasRole('root') || $user->hasRole('/' . $rout)) {
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
                    return  Response::deny('Bu işlem için yetkiniz yok!');
                }
            } else {
                if ($user->hasRole($arr) || $user->hasRole('root')) {
                    return   Response::allow($val);
                } else {
                    return  Response::deny('Bu işlem için yetkiniz yok!');
                }
            }


            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });
        Gate::define('parent', function ($user, $arr) {
            if (str_contains($arr, ',')) {
                $arr = explode(',', $arr);
            }
            if (is_array($arr)) {

                $bole = false;

                foreach ($arr as $key => $value) {
                    $rout = $value;

                    if ($user->hasRoleparent($rout) || $user->hasRoleparent('root') || $user->hasRoleparent('/' . $rout)) {
                        $bole = true;
                    }
                }
                if (
                    $bole
                ) {
                    return   Response::allow();
                } else {
                    return  Response::deny('Bu işlem için yetkiniz yok!');
                }
            } else {
                if ($user->hasRoleparent($arr) || $user->hasRoleparent('root')) {
                    return   Response::allow();
                } else {
                    return  Response::deny('Bu işlem için yetkiniz yok!');
                }
            }


            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });

        // Normal Kullanıcı mı ?

        Gate::define('array', function ($user, $arr) {
            /*  $bole = false;
            foreach ($arr as $key => $value) {
                // if ($user->hasRole($value)) {
                $bole = true;
                // }

            }
            if ($bole) {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            } else { */
            return   true;
            //  }
        });
        Gate::define('idari', function ($user) {
            if ($user->hasRole('idari') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        });
        Gate::define('birimsorumlu', function ($user) {
            if ($user->hasRole('birimsorumlu') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        });
        /*   Gate::define('ihtisassorumlu', function ($user) {
            if ($user->hasRole('ihtisassorumlu') || $user->hasRole('root')) {

                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        }); */

        // Editör mü ?
        Gate::define('birims', function ($user) {
            if ($user->hasRole('birims') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        });
        Gate::define('root', function ($user) {
            if ($user->hasRole('root') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        });
    }
}