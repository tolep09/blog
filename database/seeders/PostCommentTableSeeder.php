<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Database\Seeder;

class PostCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostComment::truncate();

        $posts = Post::all()->where('id', '<=', '20');

        foreach($posts as $key => $post)
        {
            for ($i = 1; $i <= ($key + 1); $i++)
            {
                PostComment::create([
                    'title' => "Título del contenido $post->title",
                    'comments' => 'Este es el cuerpo del comentario',
                    'user_id' => 3,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
