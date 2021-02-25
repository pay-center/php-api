<?php


namespace App\Http\Controllers\Index;


use App\Http\Controllers\Msg;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = [
            'account'  => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::validate($credentials)) {
            // 认证通过．．．
            return Msg::success([
                'token' => Auth::user()->getRememberToken(),
            ]);
        }

        return Msg::error('error password');
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return Msg::ok();
    }
}