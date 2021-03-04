<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiResponseController;

class PostController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('post_images', 'post_images.post_id', '=', 'posts.id')->
        join('categories', 'categories.id', '=', 'posts.category_id')->
        select('posts.id', 'posts.title', 'posts.category_id', 'categories.title as category', 'post_images.name')->
        orderBy('posts.created_at', 'asc')->paginate(15);

        return $this->successResponse($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->image; // cargar la informacion de la imagen
        $post->category; // cargar la informacion de la categoria
        return $this->successResponse($post);
    }

    public function urlClean(String $url_clean)
    {
        $post = Post::where('url_clean', $url_clean)->firstOrFail();
        $post->image; // cargar la informacion de la imagen
        $post->category; // cargar la informacion de la categoria
        return $this->successResponse($post);
    }

    public function category(Category $category)
    {
        return $this->successResponse(['posts' =>$category->post()->paginate(5), 'category' => $category]);
    }
}
