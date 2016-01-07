<?php

namespace Techademia\Repositories;

use Techademia\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {
        $user = User::where('username', '=', $userData->name)->first();
        if(!$user) {
            if ($provider !== 'twitter') {
                $user = User::create([
                    'provider_id' => $userData->id,
                    'fullname' => $userData->name,
                    'username' => $userData->nickname,
                    'email' => $userData->email,
                    'avatar' => $userData->avatar,
                ]);
            }
            $user = User::create([
                'provider_id' => $userData->id,
                'fullname' => $userData->name,
                'username' => $userData->nickname,
                'email' => $userData->name . '@' . 'twitter.com',
                'avatar' => $userData->avatar,
            ]);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'fullname' => $userData->name,
            'username' => $userData->nickname,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'fullname' => $user->fullname,
            'username' => $user->username,
        ];
        if (!empty(array_diff($dbData, $socialData))) {
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->fullname = $userData->name;
            $user->username = $userData->nickname;
            $user->save();
        }
    }
}
