<?php

use Techademia\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Programming',
            'description' => 'This is the description for this category',
            'slug' => 'programming'
        ]);

        Category::create([
            'title' => 'DevOps',
            'description' => 'This is the description for this category',
            'slug' => 'devops'
        ]);

        Category::create([
            'title' => 'Design Patterns',
            'description' => 'This is the description for this category',
            'slug' => 'design-patterns'
        ]);

        Category::create([
            'title' => 'Game Development',
            'description' => 'This is the description for this category',
            'slug' => 'game-development'
        ]);
    }
}
