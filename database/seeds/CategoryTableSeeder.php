<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Winter', 'Spring', 'Summer', 'Fall'];

        foreach ($categories as $category)
        {
            Category::create(['name' => $category]);
        }
    }
}
