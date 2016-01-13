<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthTests extends TestCase
{
    use WithoutMiddleware;

    public function testPostLogin()
    {
        $this->call('POST', '/auth/login');
        $this->assertResponseStatus('302');
    }
}
