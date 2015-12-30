<?php

namespace Techademia\Repositories;

use Techademia\User;

class UserRepository
{
    /**
     * Construct the user Repository instance
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the user avatar
     *
     * @return string
     */
    public function getAvatarUrl($user)
    {
        $avatar =  "http://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email))) . "?d=mm&s=140";
        // $avatar = $user->avatar;
        //save avatar to database
        $user->avatar = $avatar;
        $user->save();
        return $userAvatar;
    }

     /**
     * @param $userData
     * @return static
     */
    public function findByUsernameOrCreate($userData)
    {
        $user = User::firstOrCreate([
            'email' => $userData->email,
            'name' => $userData->nickname? $userData->nickname : $userData->name ,
            'password' => bcrypt('password')
        ]);
        return $user;
    }

    public function findBySocialIdOrCreate($user)
    {
        $authUser = User::firstOrNew(['social_id' => $user->id]);
        if (! is_null($authUser->id)) {
            return $authUser;
        }
        $authUser->username     = ($user->name)? $user->name : $user->nickname;
        $authUser->email        = ($user->email)? $user->email: "";
        $authUser->password     = bcrypt($user->id);
        $authUser->social_id    = $user->id;
        $authUser->avatar_url       = $user->avatar;
        $authUser->save();
        return $authUser;
    }
}