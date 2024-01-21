<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // すべての記事を取得
        $posts = DB::table('posts')->select('id')->get();

        foreach ($posts as $post) {
            // 記事ごとにランダムな数のテストデータを生成 (1 から 5 件)
            $numberOfComments = rand(1, 10);

            for ($i = 0; $i < $numberOfComments; $i++) {
                DB::table('comments')->insert([
                    'user_id' => rand(1, 5),
                    'post_id' => $post->id,
                    'content' => 'これはテストコメントの内容です。',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
