<?php

use Techademia\User;
use Techademia\Video;
use Techademia\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function testDatabase()
    {
        Category::create(['title' => 'robotics']);
        Video::create(['title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);

        $this->seeInDatabase('categories', ['title' => 'robotics']);
        $this->seeInDatabase('videos', ['title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);
    }
}
