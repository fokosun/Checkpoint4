<?php

use Techademia\User;

class UsersTest extends TestCase
{
    public function testUserRegistrationWithCompleteFormParams()
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

    public function testUserRegistrationWithInCompleteFormParams()
    {
        $this->visit('/auth/register')
            ->press('Register')
            ->seePageIs('/auth/register');
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

    public function testLogout()
    {
       //
    }
}
