<?php

use Techademia\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use WithoutMiddleware;

    public function testSeeCategoryView()
    {
        $this->call('POST', '/category');
        $this->assertResponseStatus('302');
    }

    public function testSeeInDatabase()
    {
        Category::create(['title' => 'robotics']);

        $this->seeInDatabase('categories', ['title' => 'robotics']);
    }
}
