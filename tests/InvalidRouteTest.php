<?php

use Techademia\User;

class InvalidRouteTest extends TestCase
{
    public function testInvalidRoutes()
    {
        $response = $this->call('GET', '/invalid');
        $this->assertResponseStatus('404');
    }
}
