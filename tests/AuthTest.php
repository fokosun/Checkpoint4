<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthTests extends TestCase
{

    public function testGetRegistrationPage()
    {
        $response = $this->call('GET', '/auth/register');
        $this->assertResponseStatus('200');
    }

    public function testGetLoginPage()
    {
        $response = $this->call('GET', '/auth/login');
        $this->assertResponseStatus('200');
    }

    public function testPostLogin()
    {
        $user = factory(\Techademia\User::class)->create();

        $this->visit('/auth/login')
            ->type('user@gmail.com', 'email')
            ->type('secret', 'password')
            ->press('Sign In')
            ->assertResponseStatus('200');
    }

    public function testGetLogout()
    {
        $this->call('GET', '/auth/logout');
        $this->assertRedirectedTo('/');
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
         ->seeInDatabase('users', ['username' => 'taylor']);
    }

    public function testFacebookSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/facebook');
        $this->assertResponseStatus('302');
    }

    // public function testTwitterSocialAuthRedirect()
    // {
    //     $this->call('GET', '/auth/login/twitter');
    //     $this->assertResponseStatus('302');
    // }

    public function testGithubSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/github');
        $this->assertResponseStatus('302');
    }
}
