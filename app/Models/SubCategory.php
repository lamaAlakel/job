<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'name',
    ];
    public function category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
    public function mobileUsers(){
        return $this->belongsToMany(MobileUser::class, 'mobile_users_sub_categories');
    }
    public function jobs(){
        return $this->hasMany(Job::class,'sub_category_id');
    }

}
