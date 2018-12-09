<?php

namespace Techademia\Http\Controllers;

use Carbon\Carbon;
use Techademia\User;
use Techademia\Category;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Techademia\Repositories\VideoRepository;

/**
 * Class UserController
 * @package Techademia\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * @param VideoRepository $video
     */
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
        $username = Auth::user()->username;
        $categories = Category::all();
        $latest = $this->video->whereDateFormat('created_at', '>=', $format);

        return view('pages.library', compact('videos', 'latest', 'username'))->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.editprofile');
    }

    /**
     * Upload avatar to cloudinary
     *
     * @param $avatar
     *
     * @return string
     */
    protected function uploadAvatarCloudinary($avatar)
    {
        Cloudder::upload($avatar, null, ["width" => 175, "height" => 155, "crop" => "scale"]);
        $url = Cloudder::getResult()['url'];

        return $url;
    }

    /**
     * Update User profile
     *
     * @param  Request $request [description]
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdateUserProfile(Request $request)
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
