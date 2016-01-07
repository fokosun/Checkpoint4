<?php

namespace Techademia\Http\Controllers;

use Auth;
use Cloudder;
use Carbon\Carbon;
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
        $latest = Video::where('created_at', '>=', Carbon::now()->subMonth())->get()->last();
        $categories = Category::all();

        return view('pages.profile', compact('videos', 'latest'))->with('categories', $categories);
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
        $id = Auth::user()->id;
        try {
            $user = User::find($id);
            if( isset($request->avatar)) {
                $user->avatar       = $this->uploadAvatarCloudinary($request->avatar);
                $user->fullname     = $request->fullname;
                $user->occupation   = $request->occupation;
            } else {
                $user->fullname     = $request->fullname;
                $user->occupation   = $request->occupation;
            }
            $user->save();
            //redirect
            return back()->with('status', 'Yay! Status updated successfully');
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }
}
