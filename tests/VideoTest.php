<?php

use Techademia\Video;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    public function testUserCanCreateVideo()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        $video  = factory(\Techademia\Category::class)->create();
        $video  = factory(\Techademia\Video::class)->create();

        $this->visit('/user/profile/video')
             ->seePageIs('/user/profile/video')
             ->type('my video title', 'title')
             ->type('https://youtu.be/AqajUg85Ax4', 'url')
             ->select(1, 'category')
             ->type('some lengthy desciption', 'description')
             ->press('Upload')
             ->seeInDatabase('videos', ['title' => 'my video title']);
    }

    public function testUserCanAccessEditVideoView()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        factory(\Techademia\Category::class)->create();
        factory(\Techademia\Video::class)->create();

        $this->visit('/video/1/edit')
             ->seePageIs('/video/1/edit')
             ->type('new title', 'title')
             ->press('update')
             ->seeInDatabase('videos', ['title' => 'new title']);
    }

    public function testVideoCrudOperations()
    {
        Video::create(['id' => 1, 'title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);

        $this->seeInDatabase('videos', ['title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);

        Video::where('title', 'cs50')->update(['title' => 'new title']);
        $this->seeInDatabase('videos', ['title' => 'new title']);

        $video = Video::where('title', 'cs50')->delete();
        $this->assertEquals(0, $video);
    }

    public function testValidYoutubeVideoUrl()
    {
        $url = 'https://www.youtube.com/watch?v=ySFod5EaTHs';
        $mock = Mockery::mock('Techademia\Repositories\VideoRepository');

        $mock->shouldReceive('getYoutubeEmbedUrl')
            ->with('https://www.youtube.com/watch?v=ySFod5EaTHs')
            ->andReturn('ySFod5EaTHs');
        $this->visit('/user/profile/video');

        $this->assertSame('ySFod5EaTHs', $mock->getYoutubeEmbedUrl($url));
    }

    public function testInvalidYoutubeVideoUrl()
    {
        $url = 'https://www.youtube.com';
        $mock = Mockery::mock('Techademia\Repositories\VideoRepository');

        $mock->shouldReceive('getYoutubeEmbedUrl')
            ->with('https://www.youtube.com')
            ->andReturn('error');
        $this->visit('/user/profile/video');

        $this->assertSame('error', $mock->getYoutubeEmbedUrl($url));
        // $this->call('POST', '/user/profile/video');
        // $this->assertRedirectedTo('/user/profile/video');
    }

    public function testUserCanUpdateVideo()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        factory(\Techademia\Category::class)->create();
        factory(\Techademia\Video::class)->create();

        Video::where('id', 1)->update(['title' => 'new title']);
        $this->seeInDatabase('videos', ['title' => 'new title']);

        $this->visit('/video/1/edit')
            ->seePageIs('/video/1/edit');
    }

    public function testVideoFind()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        factory(\Techademia\Category::class)->create();
        factory(\Techademia\Video::class)->create();

        $see_video = Video::find(1);

        $this->visit('/video/1/edit')->assertViewHas('video');
    }

    // public function testValidationFacade()
    // {
    //     $empty_request = [];
    //     Validator::shouldReceive('fails')->once()->with($empty_request);
    //     // $this->visit('/user/profile/video');

    //     // $this->assertEmpty($v);
    //     $this->visit('/user/profile/video');
    //     // $this->assertRedirectedTo('/user/profile/video');
    // }
}
