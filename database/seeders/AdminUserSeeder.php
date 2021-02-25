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
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::insert([
            'account'  => 'admin',
            'nickname' => '管理员',
            'email'    => 'admin@qq.my',
            'password' => Hash::make('123456'),
        ]);

        AdminUser::insert([
            'account'  => 'test',
            'nickname' => '测试',
            'email'    => 'test@qq.my',
            'password' => Hash::make('123456'),
        ]);
    }
}
