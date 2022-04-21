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
        Gate::define('yetkili', function ($user) {
            return
                $user->hasRole(Request::route()->getPrefix()) ? Response::allow() : Response::deny('Bu işlem için kullanıcı olmalısınız!');
            /* return
                $user->hasRole('admin') ? Response::allow() : Response::deny('Bu işlem için admin olmalısınız!'); */
        });

        // Normal Kullanıcı mı ?
        Gate::define('is-user', function ($user) {
            return
                $user->hasRole('madmin') ? Response::allow() : Response::deny('Bu işlem için kullanıcı olmalısınız!');
        });

        // Editör mü ?
        Gate::define('is-editor', function ($user) {
            return
                $user->hasRole('editor') ? Response::allow() :  Response::deny('Bu işlem için editor olmalısınız!');
        });
    }
}