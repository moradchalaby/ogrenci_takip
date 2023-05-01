<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ogrenciokul
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $okul_id
 * @property string|null $aciklama
 * @property string|null $basari
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereBasari($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereOkulId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ogrenciokul extends Model
{
    use HasFactory;
    protected $table = 'ogrenciokul';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
}
