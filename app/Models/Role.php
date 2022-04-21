<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function hasUser($user)
    {

        if ($this->users()->where('id', $user)->first()) return true;

        return false;
    }
}