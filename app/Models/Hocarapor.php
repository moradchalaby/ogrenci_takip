<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hocarapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'kullanici_id', 'ogrenci_id', 'ders_id', 'hrapor_sayfa', 'hrapor_ders', 'hrapor_tarih',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrapor';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}
