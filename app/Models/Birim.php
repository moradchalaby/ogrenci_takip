<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
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
    protected $fillable = [
        'birim_id',
        'birim_ad',
        'birim_donem',
        'birim_durum',

    ];

    public function birimsorumlu()
    {
        return $this->hasMany(Birimsorumlu::class);
    }
}