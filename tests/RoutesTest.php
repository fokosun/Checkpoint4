<?php

use Techademia\User;

class RoutesTest extends TestCase
{
    public function testInvalidRoutes()
    {
        $response = $this->call('GET', '/invalid');
        $this->assertResponseStatus('404');
    }

    public function testGetLandingPage()
    {
        $response = $this->call('GET', '/');
        $this->assertResponseStatus('200');
    }

    public function testSeeRegistrationLinkOnLandingPage()
    {
        $this->visit('/')->see('REGISTER')->assertResponseStatus('200');
    }

    public function testSeeLoginLinkOnLandingPage()
    {
        $this->visit('/')->see('LOG IN')->assertResponseStatus('200');
    }

    public function testSeeGettingStartedLinkOnLandingPage()
    {
        $this->visit('/')
            ->see('Getting Started')
            ->click('Getting Started')
            ->seePageIs('/')
            ->assertResponseStatus('200');
    }

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
}
