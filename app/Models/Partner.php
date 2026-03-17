<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'image_path', 'is_active', 'order_index'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
