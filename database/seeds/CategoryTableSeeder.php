<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create(array('name' => 'Bug'));
        Category::create(array('name' => 'Backlog'));
        Category::create(array('name' => 'Feature Request'));
        Category::create(array('name' => 'Sales Question'));
        Category::create(array('name' => 'How To'));
        Category::create(array('name' => 'Cancellation'));
        Category::create(array('name' => 'Technical Issue'));
        Category::create(array('name' => 'Uncategorized'));
    }
}
