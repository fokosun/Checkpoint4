<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class FeedsTest extends TestCase
{
    use WithoutMiddleware;

    public function testFeedsViewHasVideos()
    {
        $user = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey'])
            ->visit('/feeds');

        $response = $this->call('GET', '/feeds');
        $this->assertResponseStatus('200');
        $this->assertViewHas('videos');
        $videos = $response->original->getData()['videos'];
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $videos);
    }

    public function feedsIndex()
    {
        $this->visit('/feeds')
            ->see('Upload a new video')
            ->click('Upload a new video')
            ->seePageIs('/user/profile/video')
            ->assertResponseStatus('200');
    }

    public function testFeedsViewHasLatestUploadDate()
    {
        $user = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey'])
            ->visit('/feeds');

        $response = $this->call('GET', '/feeds');
        $this->assertResponseStatus('200');
        $this->assertViewHas('latest');
        $latest = $response->original->getData()['latest'];
    }
}
