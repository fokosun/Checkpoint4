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
use Techademia\Repositories\VideoRepository;
use Techademia\Http\Controllers\Controller;

class UserController extends Controller
{

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
        $format = Carbon::now()->subMonth();
        $videos = $this->video->where('user_id', Auth::user()->id);
        $categories = Category::all();
        $latest = $this->video->whereDateFormat('created_at', '>=', $format);

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

    /**
     * 
     * @param  Request $request [description]
     * @param  $id
     */
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
            
            return back()->with('status', 'Yay! Status updated successfully');
        } catch (QueryException $e) {
            
            return back()->with('status', $e->getMessage());
        }
    }
}
