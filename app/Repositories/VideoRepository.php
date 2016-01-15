<?php

namespace Techademia\Repositories;

use Techademia\Video;
use Illuminate\Contracts\Auth\Guard;

class VideoRepository
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function find($id)
    {
        $videos = Video::find($id);
        return $videos;
    }

    public function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            return end($matches);
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            return end($matches);
        }

        return 'error';
    }
}
