<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Birim
 *
 * @property int $birim_id
 * @property string $birim_ad
 * @property string|null $birim_donem
 * @property string $birim_durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Birim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimDonem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Birim extends Model
{
    protected $fillable = [
        'birim_id',
        'birim_ad',
        'birim_donem',
        'birim_durum',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'birim';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'birim_id';


    public function birimsorumlu()
    {
        return $this->hasMany(Birimsorumlu::class);
    }
}
