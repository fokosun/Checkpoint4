<?php

namespace Techademia\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Techademia\Video;
use Techademia\Category;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use Techademia\Http\Controllers\Controller;


class ShitCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function shit()
    {
        $url = 'http://www.youtube.com/watch?v=fHBFvlQ3JGY';
preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
        $url,
        $matches
    );
$id = $matches[1];

$width = '640';
$height = '385';
echo '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
    }

}
