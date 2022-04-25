<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Okul extends Model
{
    use HasFactory;
    protected $table = 'okul';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'oklul',


    ];
    public function ogrenci_okul()
    {

        return $this->hasMany('App\Ogrenci', 'ogrenciokul', 'ogrenci_id', 'okul_id');
    }
}