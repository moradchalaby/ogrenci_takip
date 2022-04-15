<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    //
    protected $fillable = ['id', 'title', 'aciklama', 'color', 'kullanici_id', 'start', 'end', 'allDay', 'created_at', 'updated_at'];
}