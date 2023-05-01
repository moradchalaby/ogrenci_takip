<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OgrenciOdeme
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property float $tutar
 * @property string $kur
 * @property int $user_id
 * @property string $tarih
 * @property string $ay
 * @property int $makbuz_id
 * @property string $odeme_sekli
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme query()
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereAy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereKur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereMakbuzId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereOdemeSekli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereTutar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OgrenciOdeme whereUserId($value)
 * @mixin \Eloquent
 */
class OgrenciOdeme extends Model
{
    use HasFactory;

    protected $guarded = [];
}
