<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthTests extends TestCase
{
    private $socialiteMock;

    // public function setUp()
    // {
    //     parent::setUp();
    //     $this->socialiteMock = Mockery::mock('Laravel\Socialite\Contracts\Factory');
    // }

    // public function tearDown() { Mockery::close(); }

    // public function testFb()
    // {
    //     try {
    //         $this->socialiteMock
    //         ->shouldReceive('driver')
    //         ->with('github')
    //         ->andReturn('code');
    //         $this->visit('/auth/login/github');
    //     } catch (Exception $e) {
    //         dd($e->getMessage());
    //     }

    // }

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

    public function testGithubSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/github');
        $this->assertResponseStatus('302');
    }

    public function testSocialOAuth()
    {
        $user = User::where('provider_id', '=', 7254731)->first();

        $userData = [
            'token' => '60a16af08cc20ae8a87af355bb48bdf6d5e4a088',
            'id' => 7254731,
            'nickname' => 'andela-fokosun',
            'name' => 'andela-fokosun',
            'email' => 'okosunuzflorence@gmail.com',
            'avatar' => 'https://avatars.githubusercontent.com/u/7254731?v=3'
        ];

        $provider = 'github';

        $mock = Mockery::mock('Techademia\Repositories\UserRepository');
        $mock->shouldReceive('findByProviderIdOrCreate')
            ->with($userData, $provider)
            ->andReturn($user);

        $this->assertSame($user, $mock->findByProviderIdOrCreate($userData, $provider));
    }
}
