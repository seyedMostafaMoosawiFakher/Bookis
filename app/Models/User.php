<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// model --> Authenticatable
class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    protected $table = 'users';
    protected $fillable = ['username','password','email', 'mobile'];
    protected $guarded = ['id','created_at','updated_at'];

    public function otps ()
    {
        return $this->hasMany(Otp::class);
    }

}
