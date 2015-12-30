<?php

namespace Techademia\Http\Controllers;

use Auth;
use Socialite;
use Techademia\User;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use Techademia\Http\Controllers\Controller;

class OauthController extends Controller
{
    /**
     * Get user id
     *
     * @param  $username
     */
    public function getUserID($username)
    {
        $user = User::whereUsername($username)->first();
        return $user->id;
    }

    // public function doRedirect(Request $request, $provider)
    // {
    //    return $this->redirect(($request->has('code') || $request->has('oauth_token')), $provider);
    // }


    /**
     * Social ouath login/registration
     *
     * @param  $request
     * @param  $provider
     */
    public function redirect(Request $request, $provider )
    {
        // dd($request->has('code'));
        if (!($request->has('code') || $request->has('oauth_token'))) {
            return Socialite::driver( $provider )->redirect();
        }

        $data = $this->getOauth($provider);

        if ($this->checkUserExist($userData, $provider) === null) {
            return $this->getUserData($data, $provider);
        }

        $user = $this->findByIDorCreate($data, $provider);
        Auth::login($user, true);
        return $this->userHasLoggedIn();
    }
    /**
     * checkUserExist Check if user details already
     *
     * @param  $value
     * @param  $provider
     */
    public function checkUserExist($value, $provider)
    {
        $columnName  = $provider.'ID';
        $user = User::where($columnName, $value->getId())->orWhere('username', $value->getNickname())->orWhere('username', Str::slug($value->getName()))->orWhere('email', $value->getEmail())->first();
        return $user;
    }
    /**
     * getOauth Get the social account details
     *
     * @param  $provider
     */
    public function getOauth($provider)
    {
        return Socialite::driver( $provider )->user();
    }
    /**
     * userHasLoggedIn Redirect to main page
     *
     * @param  none
     */
    public function userHasLoggedIn()
    {
        return redirect('/login');
    }
    /**
     * findByIDorCreate check if user already exist
     *
     * @param  $userData
     * @param  $provider
     */
    public function findByIDorCreate($data, $provider)
    {
        $columnName  = $provider.'ID';
        $user = $this->checkUserExist($userData, $provider);
        if ($user) {
            User::where('id', $user->id)->update([$columnName => $userData->getId()]);
            return $user;
        }
    }

    /**
     * getSocialData Pass the user details to signup form
     *
     * @param  $userData
     * @param  $provider
     */
    protected function getUserData($data, $provider)
    {
        $array = ['username' => $data->getNickname(), 'email' => $data->getEmail(), 'facebookID' => 0, 'twitterID' => 0, 'githubID'=> 0];
        $array[$provider.'ID'] = $data->getId();

        if ($data->getNickname() === null) {
            $array['username'] = Str::slug($userData->getName());
        }

        $user = User::create($array);

        if ($user) {
            $this->createAvatar($array['username'], $data->getAvatar());
            Auth::loginUsingId($user->id, true);

            return $this->userHasLoggedIn();
        }
    }

}
