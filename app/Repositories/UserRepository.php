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
                'fullname' => $userData->getName(),
                'username' => $userData->getNickName(),
                'provider' => $provider,
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
            ]);
        }

        return $user;
    }

    public function createByFacebookOrGithub($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();
        if($provider == 'Facebook') {
            if(!$user) {
                $user = User::create([
                    'fullname' => $userData->getName(),
                    'email' => $userData->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $userData->getId(),
                    'avatar' => $userData->getAvatar(),
                    'username' => $userData->getNickName(),
                ]);
            }
        } elseif($provider == 'Github') {
            if(!$user) {
                $user = User::create([
                    'fullname' => $userData->getName(),
                    'username' => $userData->getNickName(),
                    'email' => $userData->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $userData->getId(),
                    'avatar' => $userData->getAvatar(),
                ]);
            }
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
