<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknikhoca extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teknikpersonel';
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
