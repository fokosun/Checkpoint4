<?php

use Techademia\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthTests extends TestCase
{
    private $socialiteMock;

    /**
     * Test Registration view
     * @return [type] [description]
     */
    public function testGetRegistrationPage()
    {
        $response = $this->call('GET', '/auth/register');
        $this->assertResponseStatus('200');
    }

    /**
     * Test Login view
     * @return [type] [description]
     */
    public function testGetLoginPage()
    {
        $response = $this->call('GET', '/auth/login');
        $this->assertResponseStatus('200');
    }

    /**
     * Test Login
     */

    public function testPostLogin()
    {
        $user = factory(\Techademia\User::class)->create();

        $this->visit('/auth/login')
            ->type('user@gmail.com', 'email')
            ->type('secret', 'password')
            ->press('Sign In')
            ->assertResponseStatus('200');
    }

    /**
     * Test logout
     * @return [type] [description]
     */
    public function testGetLogout()
    {
        $this->call('GET', '/auth/logout');
        $this->assertRedirectedTo('/');
        $this->assertResponseStatus('302');
    }

    /**
     * Test Registration
     * @return [type] [description]
     */
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

    /**
     * Test Social redirect for facebook
     * @return [type] [description]
     */
    public function testFacebookSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/facebook');
        $this->assertResponseStatus('302');
    }

    /**
     * Test social redirect for github
     * @return [type] [description]
     */
    public function testGithubSocialAuthRedirect()
    {
        $this->call('GET', '/auth/login/github');
        $this->assertResponseStatus('302');
    }

    /**
     * Test Social Auth
     * @return [type] [description]
     */
    public function testGithubSocialOAuth()
    {
        User::create(['id' => 1, 'fullname' => 'andela-fokosun', 'username' => 'andela-fokosun', 'provider_id' => 7254731, 'avatar' => 'https://avatars.githubusercontent.com/u/7254731?v=3']);
        $user = User::where('provider_id', '=', 7254731)->first();

        $userData = [
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

    public function testFacebookSocialOAuth()
    {
        User::create(['id' => 1, 'fullname' => 'florence', 'username' => 'florence', 'provider_id' => 1146673212009898, 'avatar' => 'https://graph.facebook.com/v2.5/1146673212009898/picture?type=normal']);
        $user = User::where('provider_id', '=', 1146673212009898)->first();

        $userData = [
            'id' => 1146673212009898,
            'nickname' => 'florence',
            'name' => 'florence',
            'email' => 'okosunuzflorence@gmail.com',
            'avatar' => 'https://graph.facebook.com/v2.5/1146673212009898/picture?type=normal'
        ];

        $provider = 'github';

        $mock = Mockery::mock('Techademia\Repositories\UserRepository');
        $mock->shouldReceive('findByProviderIdOrCreate')
            ->with($userData, $provider)
            ->andReturn($user);

        $this->assertSame($user, $mock->findByProviderIdOrCreate($userData, $provider));
    }
}
