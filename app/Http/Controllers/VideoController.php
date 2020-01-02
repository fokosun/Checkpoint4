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
        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required|max:237|min:230',
            'category'      => 'required',
            'url'           => 'required|youtube'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['url'] = $this->video->getYoutubeEmbedUrl($request->url);;

        $this->video->create($data);
        $videoUrl = url() . "/videos/" . str_replace(" ", "-", $request->title);

        return redirect()->back()->with('status', $videoUrl);
    }

    /**
     * @param $title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($title)
    {
        $video = $this->video->where("title", str_replace("-", " ", $title));
        return view('pages.video', compact('video'));
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
