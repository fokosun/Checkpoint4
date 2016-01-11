<?php

namespace Techademia\Repositories;

use Techademia\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {
        if ($provider == 'facebook') {
            $user = $this->facebook($userData, $provider);
        }

        if ($provider == 'twitter') {
            $user = $this->twitter($userData, $provider);
        }

        if ($provider == 'github') {
            $user = $this->github($userData, $provider);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    public function twitter($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => $userData->getName(),
                'provider' => $provider,
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
            ]);
        }

        return $user;
    }

    public function facebook($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        // dd($user);
        if(!$user) {
            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => str_replace(" ", "-", $userData->getName()) . 'fb',
                'provider' => $provider,
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
            ]);
        }

        return $user;
    }

    public function github($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => $userData->getName(),
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
