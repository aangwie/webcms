<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'image_path', 'order_index', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
