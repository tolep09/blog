<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\WebController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\CategoryController;

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

Route::resource('dashboard/categories', CategoryController::class);

Route::resource('dashboard/users', UserController::class);

Route::post('dashboard/posts/{post}/image', [PostController::class, 'image'])->name('posts.image');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
