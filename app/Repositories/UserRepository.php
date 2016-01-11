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

    public function findByUserNameOrCreate($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();

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
}
