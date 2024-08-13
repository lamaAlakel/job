<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MobileUser;
use Illuminate\Support\Facades\Hash;

class MobileUserSeeder extends Seeder
{
    public function run()
    {
        MobileUser::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '1234567890',
            'cv' => 'cv.pdf',
            'link' => json_encode(['linkedin' => 'https://linkedin.com/jane']),
            'experience' => 5,
            'eduction' => 'Bachelor\'s Degree in Computer Science',
            'birth_date' => '1990-01-01',
            'on_work' => true,
        ]);
    }
}
