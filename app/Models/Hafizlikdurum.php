<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafizlikdurum extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ogrenci_id', 'hafizlik_durum', 'bast', 'sont', 'hafizlik_son', 'hoca', 'donus_suresi',

    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hafizlikdurum';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
}
