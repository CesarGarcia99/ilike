<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

//usuario
Route::get('/user/configuracion',[UserController::class,'config'])->name('user.config');
Route::post('/user/update',[UserController::class,'update'])->name('user.update');
Route::get('/user/avatar/{filename}',[UserController::class,'getAvatar'])->name('user.avatar');
Route::get('/user/profile/{id}',[UserController::class,'profile'])->name('user.profile');

//publicaciones
Route::get('/publi/up',[ImageController::class,'postear'])->name('publi.up');
Route::post('/publi/create',[ImageController::class,'create'])->name('publi.create');
Route::get('/publi/image/{filename}',[ImageController::class,'getImage'])->name('publi.image');
Route::get('/publi/image/detail/{id}',[ImageController::class,'detail'])->name('publi.detail');
Route::get('/publi/delete/{id}',[ImageController::class,'delete'])->name('publi.delete');

//comentarios
Route::post('/comment/save',[CommentController::class,'save'])->name('comment.save');
Route::get('/comment/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');

//likes
Route::get('/like/{image_id}',[LikeController::class,'like'])->name('like.save');
Route::get('/dislike/{image_id}',[LikeController::class,'dislike'])->name('like.delete');
