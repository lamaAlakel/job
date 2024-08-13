<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run()
    {
        Skill::create(['name' => 'PHP']);
        Skill::create(['name' => 'JavaScript']);
    }
}
