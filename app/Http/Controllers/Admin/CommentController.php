<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::latest()->paginate(5);
        return view("admin.comments.index", ["comments" => $comments]);
    }



    /**
     * Display the specified resource.
     */
    public function show(int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        return view("admin.comments.show", ["comment" => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        return view("admin.comments.edit", ["comment" => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        $request->validate([
            "status" => ["required", Rule::in(["draft", "published"])],
            "content" => ["required", "min:4", "max:100"]
        ]);
        $comment->update([
            "status" => $request->status,
            "content" => $request->content,
        ]);
        return to_route("admin.comments.edit", ["comment" => $comment->id])->with("success", "Update Comment Successfully!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        $comment->delete();
        return redirect()->back()->with("success", "Successfully Delete Comment!");
    }

    public function publish(int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        $comment->update([
            "status" => "draft"
        ]);
        return redirect()->back()->with("warning", "Successfully Make Comment Draft!!");
    }

    public function draft(int $comment)
    {
        //
        $comment = Comment::find($comment);
        if (is_null($comment)) {
            return to_route("admin.comments.index")->with("alert", "This Comment Not Exists!!");
        }
        $comment->update([
            "status" => "published"
        ]);
        return redirect()->back()->with("warning", "Successfully Make Comment published!!");
    }
}
