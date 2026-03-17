<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['content', 'image_path'];

    /**
     * Get the singleton about record (creates one if none exists).
     */
    public static function first()
    {
        return static::query()->first() ?? static::create([]);
    }
}
