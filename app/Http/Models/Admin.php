<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    use HasRoles;

    protected $guard_name = 'web';

    protected $table = 'admins';

    protected $fillable = ['nickname', 'email', 'password', 'register_ip', 'status'];

}
