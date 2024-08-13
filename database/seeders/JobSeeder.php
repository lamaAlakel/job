<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run()
    {
        Job::create([
            'sub_category_id' => 1,
            'user_id' => 1,
            'title' => 'Senior Web Developer',
            'description' => 'We are looking for a skilled web developer with experience in PHP and JavaScript.',
            'location' => 'Remote',
            'on_site' => false,
            'full_time' => true,
            'max_salary' => 120000,
            'min_salary' => 90000,
            'image' => 'job1.jpg',
            'type' => 'approved',
        ]);
    }
}

