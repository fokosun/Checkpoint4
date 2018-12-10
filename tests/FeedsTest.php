<?php

/**
 * Class FeedsTest
 */
class FeedsTest extends TestCase
{
    public function testFeedsViewHasVideos()
    {
        $response = $this->call('GET', '/feeds');
//        dd($response);

        $this->assertResponseStatus('200');
        $this->assertViewHas('videos');

        $videos = $response->original->getData()['videos'];
        
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $videos);
    }

//    public function feedsIndex()
//    {
//        $this->visit('/feeds')
//            ->see('Upload a new video')
//            ->click('Upload a new video')
//            ->seePageIs('/user/profile/video')
//            ->assertResponseStatus('200');
//    }
//
//    public function testFeedsViewHasLatestUploadDate()
//    {
//        $response = $this->call('GET', '/feeds');
//        $this->assertResponseStatus('200');
//        $this->assertViewHas('latest');
//        $latest = $response->original->getData()['latest'];
//    }
}
