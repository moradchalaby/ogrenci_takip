<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Yetki;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

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
            if (!str_contains($rout, '/')) {
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
            if ($user->hasRole($post . '/islem') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });


        // Normal Kullanıcı mı ?
        Gate::define('idari', function ($user) {
            if ($user->hasRole('idari') || $user->hasRole('root')) {
                return   Response::allow();
            } else {
                return  Response::deny('Bu işlem için yetkiniz yok!');
            }
        });

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