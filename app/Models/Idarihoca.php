<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idarihoca extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'idarihoca';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'kullanici_id',


    ];
}
