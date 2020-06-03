<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'name',
        'access_token',
    ];
}
