<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $fillable = ['mobile','otp','user_id'];
    protected $guarded = ['id','created_at','updated_at'];
}