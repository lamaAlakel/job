<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable=[
       'sub_category_id',
        'user_id',
        'title',
        'description',
        'location',
        'on_site',
        'full_time',
        'max_salary',
        'min_salary',
        'image',
        'type'
    ];
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class , 'sub_category_id');
    }
    public function mobileUsers(){
        return $this->belongsToMany(MobileUser::class , 'requests');
    }
}
