<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    public function testUsersLibraryViewHasVideos()
    {
        $response = $this->call('GET', '/user/profile');
        $this->assertResponseStatus('302');
    }

    public function testEdituserProfile()
    {

    }
}
