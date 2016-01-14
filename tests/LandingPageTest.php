<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LandingPageTest extends TestCase
{
    public function testIndexWithoutMIddleware()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
        $this->assertResponseStatus('200');
    }

    public function testUserIsRedirectedToFeedsIfSessionIsOn()
    {
        $user = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey', 'password' => 'passed']);
        $this->call('GET', '/');
        $this->assertRedirectedTo('/feeds');
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
