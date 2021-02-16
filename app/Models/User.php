<?php

namespace App\Models;
//my
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// model --> Authenticatable
class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;



}
