<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ogrenciokul extends Model
{
    use HasFactory;
    protected $table = 'ogrenciokul';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'ogrenci_id',
        'okul_id',


    ];
}