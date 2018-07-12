<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeBanner($query)
    {
        return $query->where('position','banner');
    }
}
