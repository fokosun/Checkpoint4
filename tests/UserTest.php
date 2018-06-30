<?php

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    public function testUsersLibraryViewHasVideos()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        $this->call('GET', '/user/profile');
        $this->assertResponseStatus('200');
        $this->assertViewHas('videos');
        $this->assertViewHas('categories');;
    }

    public function testUserCanViewEditProfilePage()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        $this->visit('/profile/1/edit')
            ->see('Edit My Profile')
            ->seePageIs('/profile/1/edit')
            ->assertResponseStatus('200');

    }

}
