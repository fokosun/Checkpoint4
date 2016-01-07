<?php

namespace Techademia\Repositories;

use Techademia\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {
        $twitter = $provider;
        $user = ( isset($twitter))?$this->createByTwitter($userData, $provider):$this->createByFaceBookOrGithub($userData, $provider);
        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    public function createByTwitter($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'provider' => $provider,
                'fullname' => $userData->name,
                'username' => $userData->nickname,
                'avatar' => $userData->avatar,
            ]);
        }

        return $user;
    }

    public function createByFacebookOrGithub($userData, $provider)
    {
        dd($userData->email . ' ' . $userData->name);
        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'provider' => $provider,
                'fullname' => $userData->name,
                'username' => $userData->nickname,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
            ]);
        }

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
