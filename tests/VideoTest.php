<?php

use Techademia\Video;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{

    public function testIndexHasVideos()
    {
        $response = $this->call('GET', '/');

        $this->assertViewHas('videos');

        $videos = $response->original->getData()['videos'];

        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $videos);
    }

    public function testCanCreateVideo()
    {
        Video::create(['title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);

        $this->seeInDatabase('videos', ['title' => 'cs50', 'description' => 'Sample description', 'url' => 'https://www.youtube.com/embed/NqVC_4NiAjI', 'user_id' => 1, 'category_id' => 1]);
    }

    public function testCanUpdateVideo()
    {

    }
}
