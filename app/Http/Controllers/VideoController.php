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
    public function __construct(VideoRepository $videos)
    {
        $this->middleware('auth');
        $this->videos = $videos;
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
        $youtube_id =  $this->videos->getYoutubeEmbedUrl($request->url);
        if ($youtube_id == 'error') {
            $error = ['warning'=> 'That url is so wrong! It has to be a valid youtube video link'];
            return redirect()->back()->withErrors($error);
        }
        $url = 'http://www.youtube.com/embed/' . $youtube_id . '?autoplay=0';
        $v = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required|max:255',
            'category'      => 'required',
            'url'           => 'required'
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['url'] = $url;
        Video::create($data);

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
        $video = Video::find($id);
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
    public function update($requestData, $id)
    {
        $video = Video::find($id);
        $video->title = $requestData['title'];
        $video->description = $requestData['description'];
        $video->url = $requestData['url'];
        $video->category_id = $requestData['category'];
        $video->save();

        return redirect()->back()->with('status', 'Like a real boss, you did it!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function checkDiff(Request $request, $id)
    {
        $requestData = [
            'title'         => $request->title,
            'description'   => $request->description,
            'category'      => $request->category,
            'url'           => $request->url,
        ];

        $data = [
            'title'         => $this->videos->find($id)->title,
            'description'   => $this->videos->find($id)->description,
            'category'      => $this->videos->find($id)->category,
            'url'           => $this->videos->find($id)->url,
        ];

        if(! is_null(array_diff($requestData, $data))) {
            return $this->update($requestData, $id);
        }
    }
}
