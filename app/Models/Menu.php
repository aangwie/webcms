<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'url', 'order_index', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
