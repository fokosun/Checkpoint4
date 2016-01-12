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
}
