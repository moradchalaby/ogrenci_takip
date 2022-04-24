<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ogrenci extends Model
{
    use HasFactory;
    protected $table = 'ogrenci';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ogrenci_id',
        'ogrenci_adsoyad',



    ];
}