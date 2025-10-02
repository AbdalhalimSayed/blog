<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::where("status", "published")->paginate(5);
        return view("admin.posts.index", ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::where("role", "author")->get();
        $categories = Category::where("type", "!=", "0")->get();
        return view("admin.posts.create", ["users" => $users, "categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "title"         => ["required", "min:10", 'unique:posts,title'],
            "content"       => ["required", "min:50"],
            "status"        => ["required", Rule::in(["published", "archive", "draft"])],
            "user_id"       => ["required", 'exists:users,id'],
            "category_id"   => ["required", 'exists:categories,id']
        ]);
        Post::create($request->all());
        return to_route("admin.posts.create")->with("success", "Create Posts Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $post)
    {
        //
        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("admin.posts.index")->with("alert", "Posts Not Exists");
        }
        return view("admin.posts.show", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $post)
    {
        //
        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("admin.posts.index")->with("alert", "Posts Not Exists");
        }
        $users = User::where("role", "author")->get();
        $categories = Category::where("type", "!=", "0")->get();
        return view("admin.posts.edit", ["users" => $users, "categories" => $categories, "post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $post)
    {
        //
        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("admin.posts.index")->with("alert", "Posts Not Exists");
        }
        $request->validate([
            "title"         => ["required", "min:10", Rule::unique("posts", "title")->ignore($post->id)],
            "content"       => ["required", "min:50"],
            "status"        => ["required", Rule::in(["published", "archive", "draft"])],
            "user_id"       => ["required", 'exists:users,id'],
            "category_id"   => ["required", 'exists:categories,id']
        ]);
        $post->update($request->all());
        return to_route("admin.posts.edit", $post->id)->with("success", "Update Post Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $post)
    {
        //
        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("admin.posts.index")->with("alert", "Posts Not Exists");
        }

        $post->delete();
        return redirect()->back()->with("success", "Delete Post Successfully");
    }

    public function draft()
    {
        $posts = Post::where("status", "draft")->paginate(5);
        return view("admin.posts.draft", ["posts" => $posts]);
    }

    public function archive()
    {
        $posts = Post::where("status", "archive")->paginate(5);
        return view("admin.posts.archive", ["posts" => $posts]);
    }
}
