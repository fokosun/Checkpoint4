<?php

namespace Techademia\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Techademia\Video;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use Techademia\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $videos = Video::paginate(4);
       $latest = Video::where('created_at', '>=', Carbon::now()->subMonth())->get()->last();

       return view('welcome', compact('videos', 'latest'));
    }
}
