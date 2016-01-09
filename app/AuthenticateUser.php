<?php

namespace Techademia;

use Request;
use Illuminate\Contracts\Auth\Guard;
use Techademia\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{

    private $socialite;
    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider)
    {
        if (! $request) {

            return $this->getAuthorizationFirst($provider);
        }
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);

        $this->auth->login($user, true);

        return redirect('/feeds');
    }

    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }
}
