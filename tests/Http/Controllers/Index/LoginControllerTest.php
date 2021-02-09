<?php

namespace Tests\Http\Controllers\Index;


use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testLogin()
    {
        $response = $this->post('/login', [
            'account'  => 'test',
            'password' => '123456',
        ]);

        dd($response);
    }
}
