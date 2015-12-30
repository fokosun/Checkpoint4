<?php

namespace Techademia;

use Techademia\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{
    public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($hasCode, $listener, $provider)
    {
        if(! $hasCode) {
            return $this->getAuthorization($provider);
        }
        $user = $this->getUser($provider);
        return $listener->userAuthenticated($user);
    }

    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getAuthorization($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    public function getUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }
}
