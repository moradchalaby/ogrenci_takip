<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hafizlikders
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $kullanici_id
 * @property string|null $hafizlik_sayfa
 * @property string|null $hafizlik_cuz
 * @property string|null $hafizlik_ders
 * @property string|null $hafizlik_topl
 * @property string|null $hafizlik_tarih
 * @property string|null $hafizlik_hata
 * @property string|null $hafizlik_usul
 * @property string|null $hafizlik_durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikCuz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikDers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikHata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikSayfa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikTopl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikUsul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hafizlikders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ogrenci_id', 'kullanici_id', 'hafizlik_sayfa', 'hafizlik_cuz', 'hafizlik_ders', 'hafizlik_topl', 'hafizlik_tarih', 'hafizlik_hata', 'hafizlik_usul', 'hafizlik_durum',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hfzlkders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}