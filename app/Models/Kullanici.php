<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kullanici
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $kullanici_resim
 * @property string $password
 * @property string $kullanici_dt
 * @property string|null $kullanici_tc
 * @property string|null $kullanici_gsm
 * @property string|null $kullanici_adres
 * @property string|null $kullanici_yetki
 * @property string|null $kullanici_birim
 * @property string|null $kullanici_sinif
 * @property string $kullanici_durum
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciBirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciSinif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciYetki($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kullanici extends Model
{
    protected $table = "kullanici";
}