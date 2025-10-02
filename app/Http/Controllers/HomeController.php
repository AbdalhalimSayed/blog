<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $categories = Category::where("type", 0)->get();
        return view('home');
    }

    public function about()
    {

        return view("about");
    }

    public function contact()
    {

        return view("contact");
    }

    public function posts()
    {
        $posts = Post::where("status", "published")->latest()->get();
        return view("posts", ["posts" => $posts]);
    }

    public function subscribes()
    {

        return view("subscribe");
    }

    public function postsCategory($category)
    {
        $category = Category::find($category);
        if (is_null($category)) {
            return to_route("mixmind.index");
        }
        $posts = $category->posts()->where("status", "published")->latest()->get();

        return view("postCategory", ["posts" => $posts, "category" => $category]);
    }

    public function post($post)
    {
        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("mixmind.index");
        }
        $comments = $post->comments()->where("status", "published")->latest()->get();
        return view("post", ["post" => $post, "comments" => $comments]);
    }





    public function comment($post)
    {

        $post = Post::find($post);
        if (is_null($post)) {
            return to_route("mixmind.index");
        }

        return view("comment", ["post" => $post]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "content" => ["required", "min:3", "max:100"],
            "post" => ["required", "exists:posts,id"]
        ]);
        $post = Post::find($request->post);
        $postType = $post::class;
        $user = request()->user()->id;

        Comment::create([
            "content" => $request->content,
            "user_id" => $user,
            "commentable_id" => $post->id,
            "commentable_type" => $postType,
        ]);
        return to_route("mixmind.post.read", $post)->with("success", "Successfully Create Comment!!");
    }
}
