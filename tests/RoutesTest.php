<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    public function testLandingPage()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }
}
