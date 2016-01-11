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
        $data = [
                'provider_id'   => $userData->getId(),
                'fullname'      => $userData->getName(),
                'avatar'        => $userData->getAvatar(),
            ];

        $data['username'] = $userData->getId();

        $user = User::where('provider_id', '=', $userData->id)->first();

        if(!$user) {
            $user = User::create([
                'fullname' => $data['fullname'],
                'username' => $data['username'],
                'provider' => $provider,
                'provider_id' => $data['provider_id'],
                'avatar' => $data['avatar'],
            ]);
        } else {
            if ($user->email == $userData->getEmail() || $user->username == $userData->getNickName()) {
                $this->auth->login($user, true);
            }
        }

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
            $user->avatar = $userData['avatar'];
            $user->fullname = $userData['fullname'];
            $user->username = $userData['username'];
            $user->save();
        }
    }
}
