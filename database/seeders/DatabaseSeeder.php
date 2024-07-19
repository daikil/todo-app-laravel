<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // runメソッド内に追加して順番を入れ替える
        $this->call(UsersTableSeeder::class);
        $this->call(FoldersTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
