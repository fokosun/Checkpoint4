<?php

namespace Techademia\Repositories;

use Techademia\User;

class UserRepository
{
    public function findByUsernameOrCreate($userData, $provider)
    {
        $user = $this->createBySocialAccount($userData, $provider);

        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    public function createBySocialAccount($userData, $provider)
    {
        $social_username = "";
        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {

            if ($userData->getNickName() === null) {
                $social_username = str_replace(" ", "-", $userData->getName());
            } else {
                $social_username = $userData->getNickName();
            }

            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => $social_username,
                'email' => $userData->getEmail(),
                'provider' => $provider,
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
            ]);
        }

        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->getAvatar(),
            'email' => $userData->getEmail(),
            'fullname' => $userData->getName(),
            'username' => $userData->getNickName(),
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'fullname' => $user->fullname,
            'username' => $user->username,
        ];
        if (!empty(array_diff($dbData, $socialData))) {
            $user->avatar = $userData['avatar'];
            $user->email = $userData['email'];
            $user->fullname = $userData['fullname'];
            $user->username = $userData['username'];
            $user->save();
        }
    }
}
