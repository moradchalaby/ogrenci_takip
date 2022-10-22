<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role)
    {

        if ($this->roles()->where('roles_slug', $role)->first()) return true;

        return false;
    }
    public static function hasRol($role, $user)
    {

        if (User::find($user)->roles()->where('roles_slug', $role)->first()) return true;

        return false;
    }

    public function hasUser($id)
    {

        return User::find($id)->roles()->where('user_id', $id)->first();
    }

    public function sorumlu()
    {
        return $this->belongsTo(Birimsorumlu::class);
    }
    public function hasUserBirim($id)
    {

        return User::find($id)->sorumlu()->where('kullanici_id', $id)->first();
    }
}