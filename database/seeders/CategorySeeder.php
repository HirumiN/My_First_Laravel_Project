<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Design',
            'slug'=> 'web-design',
            'color' => 'red',
        ]);
        Category::create([
            'name' => 'UI UX',
            'slug'=> 'ui-ux',
            'color' => 'green',
        ]);
        Category::create([
            'name' => 'Marketing',
            'slug'=> 'marketing',
            'color' => 'blue',
        ]);
        Category::create([
            'name' => 'Mobile Design',
            'slug'=> 'mobile-design',
            'color' => 'yellow',
        ]);
        Category::create([
            'name' => 'Machine Learning',
            'slug'=> 'machine-learning',
            'color' => 'lime',
        ]);
    }
}
