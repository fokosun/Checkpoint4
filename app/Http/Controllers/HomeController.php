<?php

namespace Techademia\Http\Controllers;

use Carbon\Carbon;
use Techademia\Video;
use Techademia\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Techademia\Repositories\VideoRepository;

/**
 * Class HomeController
 * @package Techademia\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param VideoRepository $video
     */
    public function __construct(VideoRepository $video)
    {
        $this->video = $video;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()) {
            return redirect('/feeds');
        }

        return view('welcome');
    }

    /**
     * Displays videos all users have uploaded.
     * accessible by both guests and registered users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View [type] [description]
     */
    public function feeds()
    {
        $videos = $this->video->paginate(6);
        $format = Carbon::now()->subMonth();
        $latest = $this->video->whereDateFormat('created_at', '>=', $format);

        return view('pages.feed', compact('videos', 'latest'));
    }

    /**
     * display all videos from a particular category
     * @param $id
     * @return \Illuminate\Http\Response
     */

    public function feedsByCategory($id)
    {
        $videos = Video::where('category_id', '=', $id)->get();
        $format = Carbon::now()->subMonth();
        $latest = $this->video->whereDateFormat('created_at', '>=', $format);

        return view('pages.categoryfeeds', compact('videos', 'latest'));
    }
}
