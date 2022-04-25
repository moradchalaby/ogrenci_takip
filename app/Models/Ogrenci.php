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
    protected $guarded = [];

    public function okul_ogrenci()
    {

        return $this->hasMany('App\Okul', 'ogrenciokul', 'ogrenci_id', 'okul_id');
    }
}