<?php

namespace Techademia\Http\Controllers;

use Auth;
use Validator;
use Techademia\Video;
use Techademia\Category;
use Techademia\Http\Requests;
use Illuminate\Http\Request;
use Techademia\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'url'           => 'required|video_url'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;

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
    public function update(Request $request, $id)
    {
        try {
            $video = Video::find($id);
            $video->title = $request->title;
            $video->description = $request->description;
            $video->url = $request->url;
            $video->category_id = $request->category;
            $video->save();
            //redirect
            return back()->with('status', 'Like a real boss, you did it!');
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
