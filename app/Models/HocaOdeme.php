<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HocaOdeme
 *
 * @property int $id
 * @property int $hoca_id
 * @property float $tutar
 * @property string $kur
 * @property int $user_id
 * @property string $tarih
 * @property string $ay
 * @property int $makbuz_id
 * @property string $odeme_sekli
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme query()
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereAy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereHocaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereKur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereMakbuzId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereOdemeSekli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereTutar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HocaOdeme whereUserId($value)
 * @mixin \Eloquent
 */
class HocaOdeme extends Model
{
    use HasFactory;

    protected $guarded = [];
}
