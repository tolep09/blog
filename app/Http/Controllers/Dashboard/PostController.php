<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostImage;
use App\Helpers\CustomUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostPost;
use App\Http\Requests\UpdatePostPut;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::orderBy('created_at', 'desc')->get();
        //with carga eager
        $posts = Post::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        return view('dashboard.posts.create')->with('post', new Post())->with('categories', $categories)
        ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostPost $spp)
    {
        $urlClean = '';
        if ($spp->url_clean == '')
        {
            $urlClean = $spp->title;
        } else
        {
            $urlClean = $spp->url_clean;
        }

        $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($urlClean, '-', true));

        $request = $spp->validated();
        $request['url_clean'] = $urlClean;

        $validator = Validator::make($request, StorePostPost::myRules());

        if ($validator->fails()) {
            return redirect('dashboard/posts/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $post = Post::create($request);
        //agregar o eliminar de la bd las etiquetas seleccionadas
        $post->tags()->sync($spp->tags_id);

        return back()->with('message', 'Entrada guardada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(Post $post)
    {
        return view('dashboard.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::pluck('id', 'title');

        $categories = Category::pluck('id', 'title');
        
        return view('dashboard.posts.edit')->with('post', $post)->with('categories', $categories)
        ->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostPut $upp, Post $post)
    {
        //agregar o eliminar de la bd las etiquetas seleccionadas
        $post->tags()->sync($upp->tags_id);
        
        $post->update($upp->validated());

        return back()->with('message', 'Post ' . $post->id . ' actualizado con éxito');
    }

    /**
     * upload an image to db.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png,gif|max:2048'
        ]);

        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('posts-images'), $filename);
        //$path = $request->image->store('images-post');


        PostImage::create(['name' => $filename, 'post_id' => $post->id]);
        //PostImage::create(['name' => $path, 'post_id' => $post->id]);

        return back()->with('message', 'Imagen para el post ' . $post->title . ' subida con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('message', 'Post ' . $post->id . ' eliminado con éxito');
    }

    public function contentImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png,gif|max:2048'
        ]);

        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('posts-images'), $filename);

        return response()->json(['default' => URL::to('/') . '/posts-images/' . $filename]);
    }

    public function imageDelete(PostImage $image)
    {
        if (File::exists(public_path('/posts-images/' . $image->name)))
        {
            File::delete(public_path('/posts-images/' . $image->name));
        }

        $image->delete();
        return back()->with('message', 'Imagen  eliminada con éxito');
    }
}
