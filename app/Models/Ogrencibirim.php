<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ogrencibirim
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $birim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ogrencibirim extends Model
{
    use HasFactory;
    protected $table = 'ogrencibirim';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
}
