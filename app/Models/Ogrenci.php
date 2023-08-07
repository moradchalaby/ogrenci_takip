<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ogrenci
 *
 * @property int $id
 * @property string $ogrenci_adsoyad
 * @property int|null $kullanici_id
 * @property string $ogrenci_dt
 * @property string|null $ogrenci_tc
 * @property string|null $babaad
 * @property string|null $annead
 * @property string|null $babames
 * @property string|null $annemes
 * @property string|null $babatel
 * @property string|null $annetel
 * @property string|null $ogrenci_tel
 * @property string|null $ogrenci_sehir
 * @property string|null $ogrenci_adres
 * @property string|null $ogrenci_resim
 * @property string|null $ogrenci_kmlk
 * @property string|null $ogrenci_sglk
 * @property string|null $ogrenci_belge1
 * @property string|null $ogrenci_belge2
 * @property string|null $ogrenci_belge3
 * @property string|null $ogrenci_aciklama
 * @property string $ogrenci_yetim
 * @property string $ogrenci_bosanma
 * @property string $ogrenci_kytdurum
 * @property string|null $ayrilma_tarih
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Birim> $birim_ogrenci
 * @property-read int|null $birim_ogrenci_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Okul> $okul_ogrenci
 * @property-read int|null $okul_ogrenci_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnemes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnetel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAyrilmaTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabaad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabatel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAdsoyad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBosanma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciKmlk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciKytdurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciSehir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciSglk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciYetim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ogrenci extends Model
{
    use HasFactory;
    protected $table = 'ogrenci';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function okul_ogrenci()
    {
        return $this->belongsToMany(Okul::class, 'ogrenciokul', 'ogrenci_id', 'okul_id');
    }
    public function birim_ogrenci()
    {
        return $this->belongsToMany(Birim::class, 'ogrencibirim', 'ogrenci_id', 'birim_id');
    }
    public function okul()
    {
        return $this->belongsToMany(Okul::class,'ogrenciokul', 'ogrenci_id', 'okul_id');
    }

    public function sinif()
    {
        return $this->belongsToMany(Sinif::class,'ogrencisinif', 'ogrenci_id', 'sinif_id');
    }
}
