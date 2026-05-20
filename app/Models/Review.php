<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'organisation',
        'rating',
        'message',
        'is_verified',
    ];
}


