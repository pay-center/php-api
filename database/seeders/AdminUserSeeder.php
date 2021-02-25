<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminUserSeeder
 * @package Database\Seeders
 */
class AdminUserSeeder extends Seeder
{
    protected $avatar = [
        '汉堡',
        '樱桃',
        '牛肉面',
        '甜甜圈',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'account'  => 'admin',
            'nickname' => '管理员',
            'avatar'   => '/users/'.$this->avatar[0].'.png',
            'email'    => 'admin@qq.my',
            'password' => Hash::make('123456'),
        ]);

        AdminUser::create([
            'account'  => 'test',
            'nickname' => '测试',
            'avatar'   => '/users/'.$this->avatar[rand(1, count($this->avatar))].'.png',
            'email'    => 'test@qq.my',
            'password' => Hash::make('123456'),
        ]);
    }
}
