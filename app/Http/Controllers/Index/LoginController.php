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
        $credentials = $request->only('account', 'password');

        if (Auth::attempt($credentials)) {
            // 认证通过．．．
            return Msg::success([
                'token'=>'123456'
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