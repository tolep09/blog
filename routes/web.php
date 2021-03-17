<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\WebController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//carga el contenido desde vue
Route::get('/', [WebController::class, 'index'])->name('index');
//ruta gestionada por vue
Route::get('/post/{id}', [WebController::class, 'detail']);
//ruta gestionada por vue
Route::get('/post-category/{id}', [WebController::class, 'postCategory']);
//ruta gestionada por vue
Route::get('/contact', [WebController::class, 'contact']);
//ruta gestionada por vue
Route::get('/categories', [WebController::class, 'categories']);


Route::resource('dashboard/posts', PostController::class);
Route::get('dashboard/excel/posts-export', [PostController::class, 'export'])->name('posts.export');

Route::resource('dashboard/categories', CategoryController::class);

Route::resource('dashboard/users', UserController::class);

Route::resource('dashboard/contact', ContactController::class)->only([
    'index', 'show', 'destroy'
]);

Route::resource('dashboard/post-comment', PostCommentController::class)->only([
    'index', 'show', 'destroy'
]);

Route::delete('dashboard/posts/image-delete/{image}', [PostController::class, 'imageDelete'])->name('post.image-delete');

Route::post('dashboard/post-comment/approved/{postComment}', [PostCommentController::class, 'approved']);

Route::get('dashboard/post-comment/{post}/post', [PostCommentController::class, 'post'])->name('post-comment.post');

Route::post('dashboard/posts/{post}/image', [PostController::class, 'image'])->name('posts.image');

Route::post('dashboard/posts/content-image', [PostController::class, 'contentImage']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
