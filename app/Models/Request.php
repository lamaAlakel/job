<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable=[
        'mobile_user_id',
        'job_id',
        'salary',
        'message',
        'cv',
        'type'
    ];

    public function mobile_user()
    {
        return $this->belongsTo(MobileUser::class , 'mobile_user_id') ;
    }
    public function job()
    {
        return $this->belongsTo(Job::class , 'job_id') ;
    }

}
