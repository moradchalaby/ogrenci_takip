<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MakbuzSet
 *
 * @property int $id
 * @property string $data
 * @property string $set_tur
 * @property string $set_parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereSetParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereSetTur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MakbuzSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MakbuzSet extends Model
{
    use HasFactory;
    protected $guarded = [];
    /*protected $fillable = [
        'set_data',
        'set_tur',
        'set_parent',
        'id',

    ];*/



}
