<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $fillable = [
        'label',
        'path',
        'user_id',
    ];
}
