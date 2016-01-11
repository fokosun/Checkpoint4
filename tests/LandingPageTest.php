<?php

use Techademia\User;

class LandingPageTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->call('GET', '/');
        $this->assertResponseStatus('200');
    }

    public function testSeeRegistrationLinkOnLandingPage()
    {
        $this->visit('/')->see('Register')->assertResponseStatus('200');
    }

    public function testSeeLoginLinkOnLandingPage()
    {
        $this->visit('/')->see('Log In')->assertResponseStatus('200');
    }

    public function testSeeGettingStartedLinkOnLandingPage()
    {
        $this->visit('/')
            ->see('Getting Started')
            ->click('Getting Started')
            ->seePageIs('/')
            ->assertResponseStatus('200');
    }
}
