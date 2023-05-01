<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Birimhoca
 *
 * @property int $id
 * @property int $kullanici_id
 * @property int $birim_id
 * @property string|null $vazife
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereVazife($value)
 * @mixin \Eloquent
 */
class Birimhoca extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'birimhoca';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'birim_id',
        'kullanici_id',


    ];
}