<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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