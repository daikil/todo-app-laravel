<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * usersTable用テストデータ
     *
     * @return void
     */
    public function run(): void
    {
        // usersテーブルにアクセスして行を挿入する
        DB::table('users')->insert([
            // nameに test を代入する
            'name' => 'test',
            // emailに dummy@email.com を代入する
            'email' => 'dummy@email.com',
            // passwordに test1234 を代入する
            // bcrypt()：パスワードをハッシュ化する関数
            'password' => bcrypt('test1234'),
            // 現在の日時を取得してcreated_atに作成日として代入する
            'created_at' => Carbon::now(),
            // 現在の日時を取得してupdated_atに更新日として代入する
            'updated_at' => Carbon::now(),
        ]);
    }
}
