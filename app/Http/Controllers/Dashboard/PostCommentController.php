<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postComments = PostComment::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.post-comment.index')->with('postComments', $postComments);
    }

    public function post(Post $post)
    {
        $posts = Post::all();
        $postComments = PostComment::orderBy('created_at', 'desc')->
        where('post_id', '=', $post->id)
        ->paginate(10);

        return view('dashboard.post-comment.post')->with('postComments', $postComments)->
            with('posts', $posts)->
            with('post', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(PostComment $postComment)
    {
        return view('dashboard.post-comment.show')->with('postComment', $postComment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        $postComment->delete();
        return back()->with('message', 'Comentario ' . $postComment->id . ' eliminado con éxito');
    }

    public function approved(PostComment $postComment)
    {
        if ($postComment->approved == '0')
        {
            $postComment->approved = '1';
        } else{
            $postComment->approved = '0';
        }

        $postComment->save();
        return response()->json($postComment->approved);
    }

}
