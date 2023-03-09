<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafizlikders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ogrenci_id', 'kullanici_id', 'hafizlik_sayfa', 'hafizlik_cuz', 'hafizlik_ders', 'hafizlik_topl', 'hafizlik_tarih', 'hafizlik_hata', 'hafizlik_usul', 'hafizlik_durum',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hfzlkders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}