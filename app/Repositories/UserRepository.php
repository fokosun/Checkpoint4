<?php

namespace Techademia\Repositories;

use Techademia\User;
use Illuminate\Contracts\Auth\Guard;

class UserRepository
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * find user by username or create a new user
     * @param
     * @return
     */

    public function findByUserNameOrCreate($userData, $provider)
    {
        dd($userData);
        // $user = User::where('username', '=', $userData->id)->first();

        if(!$user) {
            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => $userData->getId(),
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
                'provider' => $provider,
            ]);
        }
        $this->auth->loginUsingId($user->id);
        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }


    /**
     * check if the user's info needs updating
     * @param
     * @return
     */

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->getAvatar(),
            'fullname' => $userData->getName(),
            'username' => $userData->getNickName(),
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'fullname' => $user->fullname,
            'username' => $user->username,
        ];

        if (!empty(array_diff($dbData, $socialData))) {
            $user->avatar = $userData->getAvatar();
            $user->fullname = $userData->getName();
            $user->username = $userData->getNickName();
            $user->save();
        }
    }

    /**
     * create a new instance of a user
     * @param $data
     */

    public function create($data)
    {
        User::create($data);
    }
}
