<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $kullanici_resim
 * @property string $password
 * @property string|null $telegramId
 * @property string $kullanici_dt
 * @property string|null $kullanici_tc
 * @property string|null $kullanici_gsm
 * @property string|null $kullanici_adres
 * @property string $kullanici_durum
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
    public  function hasRoleparent($role)
    {
        $id = Role::where('roles_slug', $role)->first();
        if (!is_null($id)) {

            if ($this->roles()->where('parent_id', $id->parent_id)->first()) return true;

            return false;
        } else {
            return false;
        }
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