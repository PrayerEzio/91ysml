<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'roles';

    public $guarded = [];

    protected $guard_name = 'web';
}
