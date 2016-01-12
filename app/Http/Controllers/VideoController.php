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
        $data['url'] = $this->getYoutubeEmbedUrl($request);

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

    /**
     * get youtube mebed url
     *
     * @param  $request
     * @return
     */
    public function getYoutubeEmbedUrl(Request $request)
    {
        $id = NULL;
        $videoIdRegex = NULL;
        if (strpos($request->url, 'youtu') !== FALSE) {
            if (strpos($request->url, 'youtube.com') !== FALSE) {
                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $request->url, $matches);
                $id = $matches[1];
            } else if (strpos($request->url, 'youtu.be') !== FALSE) {
                $videoIdRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
                preg_match($videoIdRegex, $request->url, $matches);
                $id = $matches[1];
            }
        }
        return $src = 'http://www.youtube.com/embed/' . $id . '?autoplay=0';
    }
}
