<?php

namespace Techademia\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Techademia\Video;
use Techademia\Category;
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
        if(Auth::user()) {
            Auth::logout();
        }
       return view('welcome');
    }

    public function feeds()
    {
        $videos = Video::paginate(6);
        $latest = Video::where('created_at', '>=', Carbon::now()->subMonth())->get()->last();
        $categories = Category::all();

       return view('pages.feed', compact('videos', 'latest'))->with('categories', $categories);
    }
}
