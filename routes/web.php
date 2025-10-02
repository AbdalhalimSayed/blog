<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('mixmind.index');
Route::get('/about', [HomeController::class, 'about'])->name('mixmind.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('mixmind.contact');
Route::get('/blogs', [HomeController::class, 'posts'])->name('mixmind.posts');

Route::get("/category/{category}/posts", [HomeController::class, "postsCategory"])->name("mixmind.category.post");
Route::get("/post/{post}/read", [HomeController::class, "post"])->name("mixmind.post.read");;

Route::get("/post/{post}/comment/", [HomeController::class, "comment"])->name("mixmind.post.comment")->middleware("auth");
Route::post("/post/store/comment/", [HomeController::class, "store"])->name("mixmind.post.comment.store")->middleware("auth");

Auth::routes(["verify" => true]);

Route::get('/home', [HomeController::class, 'index'])->middleware("verified")->name('home');
