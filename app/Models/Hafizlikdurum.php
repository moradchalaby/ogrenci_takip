<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hafizlikdurum
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property string $hafizlik_durum
 * @property string|null $bast
 * @property string|null $sont
 * @property string|null $hafizlik_son
 * @property int|null $hoca
 * @property string $donus_suresi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereBast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereDonusSuresi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHafizlikDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHafizlikSon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHoca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereSont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hafizlikdurum extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ogrenci_id', 'hafizlik_durum', 'bast', 'sont', 'hafizlik_son', 'hoca', 'donus_suresi',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hafizlikdurum';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}
