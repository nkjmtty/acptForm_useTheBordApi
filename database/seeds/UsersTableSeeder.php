<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('users')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $users = [
            [
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_MAIL'),
                'password' => Hash::make(env('ADMIN_PASS')),
                'email_verified_at' => new DateTime(),
                'board_api_key' => env('ADMIN_BOARD_API_KEY'),
                'board_api_token' => env('ADMIN_BOARD_API_TOKEN'),
                'board_verified_at' => new DateTime(),
                'admin_level' => 9
            ]
        ];

        // 登録
        foreach($users as $user) {
            \App\User::create($user);
        }
    }
}
