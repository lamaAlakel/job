<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'IT']);
        Category::create(['name' => 'Finance']);
        SubCategory::create([
            'category_id' => 1 ,
            'name' => 'React'
        ]) ;
    }
}
