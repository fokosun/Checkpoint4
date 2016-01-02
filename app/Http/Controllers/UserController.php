<?php

namespace Techademia\Http\Controllers;

use Auth;
use Cloudder;
use Techademia\User;
use Techademia\Category;
use Techademia\Video;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use Techademia\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        $categories = Category::all();

        return view('pages.profile', compact('videos'))->with('categories', $categories);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.editprofile');
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
        //
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

    /**
    * Upload avatar to cloudinary
    *
    * @param  \Illuminate\Http\Request  $request
    * @return
    */
    protected function uploadAvatarCloudinary($avatar)
    {
        Cloudder::upload($avatar, null, ["width" => 175, "height" => 155, "crop" => "scale"]);
        $url = Cloudder::getResult()['url'];

        return $url;
    }

    public function postUpdateUserProfile(Request $request, $id)
    {
        // var_dump(User::where('id', Auth::user()->id)->first());
        $id = Auth::user()->id;
        // dd($id);
        try {
            $user               = User::find($id);
            $user->avatar       = $this->uploadAvatarCloudinary($request->avatar);
            $user->fullname     = $request->fullname;
            $user->occupation   = $request->occupation;
            $user->save();
            //redirect
            return back()->with('status', 'Yay! Status updated successfully');
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }
}
