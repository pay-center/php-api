<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Msg;
use App\Models\AdminUser;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController
{
    /**
     * @param  Request  $request
     * @return mixed
     */
    public function info(Request $request)
    {
        /** @var AdminUser $user */
        $user = $request->user();

        // roles, name, avatar, introduction
        return Msg::success([
            'id'           => $user->id,
            'name'         => $user->nickname,
            'avatar'       => '',
            'introduction' => 'admin user remark',
            'roles'        => ['admin'],
        ]);
    }

    /**
     * @param  Request  $request
     */
    public function logout(Request $request)
    {
    }
}