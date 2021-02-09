<?php

namespace Tests\Http\Controllers\user;


use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testInfo()
    {
        $response = $this->get('/user');

        echo ($response->getContent());
    }
}
