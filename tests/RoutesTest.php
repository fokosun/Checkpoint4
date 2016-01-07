<?php

use Techademia\User;

class RoutesTest extends TestCase
{
    public function testGetLandingPage()
    {
        $response = $this->call('GET', '/');
        $this->assertResponseOk();
        $this->assertEquals(200, $response->status());
    }

    public function testSeeRegistrationLinkOnLandingPage()
    {
        $this->visit('/')->see('REGISTER');
    }

    public function testSeeLoginLinkOnLandingPage()
    {
        $this->visit('/')->see('LOG IN');
    }

    public function testSeeGettingStartedLinkOnLandingPage()
    {
        $this->visit('/')->see('Getting Started')->click('Getting Started')->seePageIs('/');
    }

    public function testGetRegistrationPage()
    {
        $response = $this->call('GET', '/auth/register');
        $this->assertEquals(200, $response->status());
    }

    public function testGetLoginPage()
    {
        $response = $this->call('GET', '/auth/login');
        $this->assertEquals(200, $response->status());
    }
}
