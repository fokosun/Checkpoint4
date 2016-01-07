<?php

use Techademia\User;

class RoutesTest extends TestCase
{
    public function testgetLandingPage()
    {
        $response = $this->call('GET', '/');
        $this->assertResponseOk();
    }

    public function testgetRegistrationPage()
    {
        $response = $this->call('GET', '/auth/register');
        $this->assertEquals(200, $response->status());
    }

    public function testRegistrationFunctionalityWorksCorrectly()
    {
        $this->visit('/auth/register')
            ->type('john doe', 'fullname')
            ->type('johndoe', 'username')
            ->type('programmer', 'occupation')
            ->type('john@doe.com', 'email')
            ->type('password', 'password')
            ->check('terms')
            ->press('Register')
            ->seePageIs('/auth/login')
            ->seeInDatabase('users', ['username' => 'johndoe']);
    }



    public function testgetLoginPage()
    {
        $response = $this->call('GET', '/auth/login');
        $this->assertEquals(200, $response->status());
    }

    public function testUserLogin()
    {
        Session::start();
        $params = [
            '_token' => csrf_token(),
            'email'     => 'florence.okosun@andela.com',
            'password'  => 'pass'
        ];

        $response = $this->call('POST', '/auth/login', $params);
        $this->assertEquals(302, $response->status());
    }

    public function testUserLogout()
    {
        Session::start();
        $params = [
            '_token' => csrf_token()
        ];

        $response = $this->call('GET', '/auth/logout', $params);
        $this->assertEquals(302, $response->status());
    }
}
