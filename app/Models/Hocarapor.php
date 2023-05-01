<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hocarapor
 *
 * @property int $id
 * @property int $kullanici_id
 * @property int $ogrenci_id
 * @property int $ders_id
 * @property string $hrapor_sayfa
 * @property string $hrapor_ders
 * @property string $hrapor_tarih
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereDersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporDers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporSayfa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hocarapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'kullanici_id', 'ogrenci_id', 'ders_id', 'hrapor_sayfa', 'hrapor_ders', 'hrapor_tarih',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrapor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}
