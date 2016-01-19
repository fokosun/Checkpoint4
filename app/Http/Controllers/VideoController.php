<?php

namespace Techademia\Http\Controllers;

use Auth;
use Validator;
use Techademia\Video;
use Techademia\Category;
use Techademia\Http\Requests;
use Illuminate\Http\Request;
use Techademia\Repositories\VideoRepository;
use Techademia\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function __construct(VideoRepository $video)
    {
        $this->middleware('auth');
        $this->video = $video;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.upload', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $youtube_id =  $this->video->getYoutubeEmbedUrl($request->url);

        if ($youtube_id == 'error') {
            $error = ['warning'=> 'That url is so wrong! It has to be a valid youtube video link'];
            return redirect()->back()->withErrors($error);
        }

        $url = 'http://www.youtube.com/embed/' . $youtube_id . '?autoplay=0';
        
        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required|max:255',
            'category'      => 'required',
            'url'           => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['url'] = $url;

        $this->video->create($data);

        return redirect()->back()->with('status', 'Check out your library now or upload new video.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->video->find($id);
        $categories = Category::all();

        return view('pages.editvideo')->with('video', $video)->with('categories', $categories);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = $this->video->find($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->category_id = $request->category;
        $video->save();

        return redirect()->back()->with('status', 'Like a real boss, you did it!');
    }

    /**
     * [deleteView description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteView($id)
    {
        $video = $this->video->find($id);

        return view('pages.deletevideo')->with('video', $video);
    }

    /**
     * [deleteVideo description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteVideo($id)
    {
        $video = $this->video->find($id);

        $video->delete();
        return redirect('/user/profile');
    }
}
