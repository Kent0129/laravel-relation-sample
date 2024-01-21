<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // すべてのユーザーを取得
        $users = DB::table('users')->select('id')->get();

        foreach ($users as $user) {
            // ユーザーごとにランダムな数のテストデータを生成 (1 から 5 件)
            $numberOfPosts = rand(1, 5);

            for ($i = 0; $i < $numberOfPosts; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $user->id,
                    'title' => 'テスト投稿 ' . ($i + 1),
                    'content' => 'これはテスト投稿の内容です。',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
