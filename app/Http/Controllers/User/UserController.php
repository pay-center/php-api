<?php


namespace App\Http\Controllers\User;
use Illuminate\Http\Request;

class UserController
{
    public function info(Request $request)
    {
        return $request->user();
    }
}