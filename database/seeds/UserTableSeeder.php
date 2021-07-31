<?php

use Illuminate\Database\Seeder;

/**
* mentorsテーブルの情報取得・usersテーブルに情報格納用シーダークラス
*/
class UserTableSeeder extends Seeder
{
    public function run()
    {
        // usersテーブルの情報を削除
        DB::table('users')->truncate();
        
        // usersテーブルに情報を格納
        $mentors = DB::table('mentors')->get();
        foreach ($mentors as $mentor) {
            DB::table('users')->insert(
                ['name' => $mentor->slack_name,
                 'password' => Hash::make(config('app.users_password'))]
            );
        }
    }
}
