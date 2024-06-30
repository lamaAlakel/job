<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MobileUser extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
        'name',
        'email',
        'password',
        'phone_number',
        'cv',
        'link',
        'experience',
        'eduction',
        'birth_date',
        'on_work',
    ];

    public function sub_categories(){
        return $this->belongsToMany(SubCategory::class , 'mobile_users_sub_categories');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class , 'mobile_users_skills');
    }
    public function jobs(){
        return $this->belongsToMany(Job::class ,'requests');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
