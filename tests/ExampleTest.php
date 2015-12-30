<?php

use Techademia\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function testDatabase()
    {
        Category::create(['title' => 'greece']);
        $this->seeInDatabase('categories', ['title' => 'greece']);
    }
}
