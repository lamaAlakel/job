<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable=[
        'name'
    ];

    public function mobileUsers(){
        return $this->belongsToMany(MobileUser::class,'mobile_users_skills');
    }
}
