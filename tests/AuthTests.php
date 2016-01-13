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

    public function testGetLogout()
    {
        $this->call('POST', '/auth/logout');
        $this->assertResponseStatus('302');
    }

    public function testPostRegister()
    {
        $this->visit('/auth/register')
         ->type('Taylor Otwell', 'fullname')
         ->type('taylor', 'username')
         ->type('I am a Developer', 'occupation')
         ->type('taylor.otwell@laravel.com', 'email')
         ->type('passed', 'password')
         ->check('terms')
         ->press('Register')
         ->seePageIs('/feeds')
         ->seeInDatabase('users', ['username' => 'taylor']);

        $this->call('GET', '/auth/register');
        $this->assertResponseStatus('302');
    }

    public function testFacebookSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/facebook');
        $this->assertResponseStatus('302');
    }

    public function testTwitterSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/twitter');
        $this->assertResponseStatus('302');
    }

    public function testGithubSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/github');
        $this->assertResponseStatus('302');
    }
}
