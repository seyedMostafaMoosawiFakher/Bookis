<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = ['name','family','age', 'education','job','biography','favorits_reading','user_id'];

    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}
