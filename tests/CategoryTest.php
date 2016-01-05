<?php

use Techademia\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    public function testDatabase()
    {
        Category::create(['title' => 'robotics', 'description' => 'dummy description']);

        $this->seeInDatabase('categories', ['title' => 'robotics', 'description' => 'dummy description']);
    }
}
