<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'permissions';

    public $guarded = [];

    protected $guard_name = 'web';

}
