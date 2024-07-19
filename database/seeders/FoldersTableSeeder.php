<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Carbonライブラリを使えるように名前空間でインポートする
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * foldersTable用テストデータ
     *
     * @return void
     */
    public function run(): void
    {
        // テストデータを3つ作成する
        $titles = ['プライベート', '仕事', '旅行'];
        // 上記のタイトルでテーブル行を3つ挿入するループを実行する
        foreach ($titles as $title) {
            // foldersテーブルにアクセスして行を挿入する
            DB::table('folders')->insert([
                // 配列$titlesの値をtitleに代入する
                'title' => $title,
                // Carbonライブラリで現在の日時を取得してcreated_atに作成日として代入する
                'created_at' => Carbon::now(),
                // Carbonライブラリで現在の日時を取得してupdated_atに更新日として代入する
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
