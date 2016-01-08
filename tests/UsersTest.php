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
            ->type('passed', 'password')
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
        $params = [
            'email'     => 'john@doe.com',
            'password'  => 'passed'
        ];

        $auth = Auth::shouldReceive('attempt')->once()->with($params, true);

        dd($auth);
    }

    public function testLogout()
    {
       //
    }
}
