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
        /* call seeder list */
        $this->call(FoldersTableSeeder::class);
        // runメソッド内に追加する
        $this->call(TasksTableSeeder::class);
    }
}
