<?php


namespace App\Services\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

/**
 * Class JwtGuard
 * @package App\Services\Auth
 */
class JwtGuard implements Guard
{
    use GuardHelpers;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var Token
     */
    protected $token;

    /**
     * JwtGuard constructor.
     * @param  UserProvider  $provider
     * @param  Token  $token
     * @param  Request  $request
     */
    public function __construct(UserProvider $provider, Token $token, Request $request)
    {
        $this->provider = $provider;
        $this->token    = $token;
        $this->request  = $request;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $token = $this->request->bearerToken();

        if (!empty($token)) {
            $uid = $this->token->validate(['str' => $token]);

            if ($uid) {
                $this->user                                        = $this->provider->retrieveById($uid);
                $this->user->{$this->user->getRememberTokenName()} = $token;
            }
        }

        return $this->user;
    }

    /**
     * 登陆验证
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        /** @var \Illuminate\Database\Eloquent\Model|\Illuminate\Contracts\Auth\Authenticatable $user */
        $user = $this->provider->retrieveByCredentials($credentials);

        if (!is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
            $tokenArr                              = $this->token->make($user->getAuthIdentifier());
            $user->{$user->getRememberTokenName()} = $tokenArr['str'];

            $user->save();
            $this->setUser($user);
            return true;
        }

        return false;
    }
}