<?php

use Techademia\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    public function testSeeCategoryViewWithoutMIddleware()
    {
        $this->withoutMiddleware();

        $this->call('GET', '/category');
        $this->assertResponseStatus('200');
    }

    public function testSeeCategoryViewWithMiddleware()
    {
        $this->call('GET', '/category');
        $this->assertResponseStatus('302');
    }

    public function testSeeInDatabase()
    {
        Category::create(['title' => 'robotics']);

        $this->seeInDatabase('categories', ['title' => 'robotics']);
    }

    public function testUserCanCreateCategory()
    {
        $this->withoutMiddleware();
        $this->visit('/category')
         ->type('new category', 'title')
         ->press('Create')
         ->seeInDatabase('categories', ['title' => 'new category']);

        $this->call('POST', '/category');
        $this->assertResponseStatus('302');
    }
}
