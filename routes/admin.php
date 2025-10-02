<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", [AdminController::class, "index"])->name("index");

Route::resources([
    "users"         => UserController::class,
    "posts"         => PostController::class,
    "categories"    => CategoryController::class,

]);
Route::resource("comments", CommentController::class)->except(["create", "store"]);

Route::get("posts/draft", [PostController::class, "draft"])->name("posts.draft");
Route::get("posts/archive", [PostController::class, "archive"])->name("posts.archive");

Route::get("/users/search", [UserController::class, "search"])->name("users.search");
Route::get("/categories/search", [CategoryController::class, "search"])->name("categories.search");

Route::get("/comments/{comment}/publish", [CommentController::class, "publish"])->name("comments.published");
Route::get("/comments/{comment}/draft", [CommentController::class, "draft"])->name("comments.draft");

Route::fallback(function () {
    return view("admin.noFound");
});
