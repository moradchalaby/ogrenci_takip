<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Okul
 *
 * @property int $id
 * @property string $okul
 * @property string|null $okul_ad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Okul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul query()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereOkul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereOkulAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Okul extends Model
{
    use HasFactory;
    protected $table = 'okul';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
}