<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    public function testInvalidEndpoint()
    {
        $response = $this->call('GET', '/invalid');

        $this->assertEquals(404, $response->status());
    }

    public function testLandingPage()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(500, $response->status());
    }
}
