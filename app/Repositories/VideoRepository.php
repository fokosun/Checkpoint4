<?php

namespace Techademia\Repositories;

use Techademia\Video;
use Illuminate\Contracts\Auth\Guard;

class VideoRepository
{
    const SHORT_URL_REGEX  = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    const LONG_URL_REGEX  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    /**
     * 
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function find($id)
    {
        $videos = Video::find($id);
        return $videos;
    }

    /**
     *
     * 
     */

    public function getYoutubeEmbedUrl($url)
    {
        if (preg_match(self::LONG_URL_REGEX, $url, $matches)) {
            return end($matches);
        }

        if (preg_match(self::SHORT_URL_REGEX, $url, $matches)) {
            return end($matches);
        }

        return 'error';
    }

    /**
     * 
     * 
     * @param  [type] $depth [description]
     * @return [type]        [description]
     */
    public function paginate($depth)
    {
        return Video::paginate($depth);
    }

    /**
     * 
     * 
     * @return [type] [description]
     */
    public function whereDateFormat($field, $operator, $format)
    {
        return Video::where($field, $operator, $format)->get()->last();
    }

    /**
     * 
     * 
     * @return [type] [description]
     */
    public function where($key, $val)
    {
        return Video::where($key, $val)->get();
    }

    /**
     * [create description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function create($data)
    {
        return Video::create($data);
    }
}
