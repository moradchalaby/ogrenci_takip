<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Makbuz
 *
 * @property int $id
 * @property string $adsoyad
 * @property string $kullanici
 * @property int $user_id
 * @property int|null $ogrenci_id
 * @property int|null $hoca_id
 * @property float $tutar
 * @property string $kur
 * @property string $odeme_sekli
 * @property string $tarih
 * @property string $tur
 * @property string|null $aciklama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereAdsoyad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereHocaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereKullanici($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereKur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereOdemeSekli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereTur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereTutar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Makbuz whereUserId($value)
 * @mixin \Eloquent
 */
class Makbuz extends Model
{
    use HasFactory;
    protected $guarded = [];


}
