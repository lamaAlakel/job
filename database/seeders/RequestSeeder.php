<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestSeeder extends Seeder
{
    public function run()
    {
        Request::create([
            'mobile_user_id' => 1,
            'job_id' => 1,
            'message' => 'I am interested in this job and have the required skills and experience.',
            'salary' => 100000,
            'cv' => 'cv.pdf',
        ]);
    }
}
