<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birimsorumlu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'birimsorumlu';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'birim_id',
        'kullanici_id',


    ];

    public function birim()
    {
        return $this->belongsTo(Birim::class);
    }



    public function hasBirim($id)
    {

        return Birimsorumlu::find($id)->birim()->where('birim_id', $id)->first();
    }
}