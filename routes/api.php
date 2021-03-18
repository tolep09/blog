<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//obtener posts por paginacion y obtener un unico post mediante su id
Route::resource('posts', PostController::class)->only([
    'index', 'show'
]);
//obtener todos los posts de una cateogia determinada
Route::get('posts/{category}/category', [PostController::class, 'category']);
//obtener un post mediante url limpia de un post
Route::get('posts/{url_clean}/url_clean', [PostController::class, 'urlClean']);

//obtener todas las categorias
Route::get('categories/all', [CategoryController::class, 'all']);
//obtener categorias por paginacion
Route::get('categories', [CategoryController::class, 'index']);

//almacenar un contacto
Route::post('contact', [ContactController::class, 'store']);