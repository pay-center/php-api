<?php


namespace App\Services\Auth;


interface Token
{
    /**
     * @param $uid
     * @return array
     */
    public function make($uid): array;

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool|int
     */
    public function validate(array $credentials = []);
}