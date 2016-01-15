<?php

use Techademia\Video;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    public function createUser()
    {
        return User::create([
            'id'            => 1,
            'fullname'      => 'jeffrey wey',
            'username'      => 'jeffrey',
            'password'      => md5('password'),
            'occupation'    => 'Software Engineer',
            'email'         => 'jeffrey.wey@laravel.com',

        ]);
    }

    public function createVideo()
    {
        return Video::create([
            'id'            => 1,
            'title'         => 'test',
            'description'   => 'some pretty lengthy description',
            'url'           => 'Dji9ALCgfpM',
            'user_id'       => 1,
            'category_id'   => 1,
        ]);
    }

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

    public function testUserCanUpdateVideo()
    {
        $user   = factory(\Techademia\User::class)->create();
        $this->actingAs($user)
            ->withSession(['username' => 'jeffrey']);

        $video  = factory(\Techademia\Category::class)->create();
        $video  = factory(\Techademia\Video::class)->create();

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
}
