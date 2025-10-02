<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $postsCount             = Post::all()->count();
        $totalPostPublish       = Post::where("status", "published")->count();
        $totalPostDraft         = Post::where("status", "draft")->count();
        $totalPostArchive       = Post::where("status", "archive")->count();

        $usersCount             = User::all()->count();

        $monthlyPostsCount      = Post::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get()->count();
        $lastMonthPostsCount    = Post::whereMonth('created_at', now()->subMonth())->whereYear('created_at', now()->year)->get()->count();
        $commentsCount          = Comment::all()->count();
        $totalCommentPublish    = Comment::where("status", "published")->count();
        $totalCommentDraft      = Comment::where("status", "draft")->count();
        $monthlyCommentsCount   = Comment::whereMonth("created_at", now()->month)->whereYear("created_at", now()->year)->get()->count();
        $lastMonthCommentsCount = Comment::whereMonth("created_at", now()->subMonth())->whereYear("created_at", now()->year)->get()->count();
        $categoriesCount        = Category::all()->count();
        $latestPosts            = Post::latest()->take(5)->get();
        $latestComments         = Comment::latest()->take(5)->get();
        $monthlyComment         = [
            comment::whereMonth('created_at', 1)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 2)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 3)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 4)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 5)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 6)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 7)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 8)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 9)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 10)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 11)->whereYear('created_at', now()->year)->count(),
            comment::whereMonth('created_at', 12)->whereYear('created_at', now()->year)->count()
        ];

        $monthlyPosts = [
            Post::whereMonth('created_at', 1)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 2)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 3)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 4)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 5)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 6)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 7)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 8)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 9)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 10)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 11)->whereYear('created_at', now()->year)->count(),
            Post::whereMonth('created_at', 12)->whereYear('created_at', now()->year)->count(),
        ];

        return view("admin.index", [
            "postsCount"                    => $postsCount,
            "publishedPostsCount"           => $totalPostPublish,
            "draftsCount"                   => $totalPostDraft,
            "totalPostArchive"              => $totalPostArchive,
            "usersCount"                    => $usersCount,
            "approvedCommentsCount"         => $totalCommentPublish,
            "pendingCommentsCount"          => $totalCommentDraft,
            "commentsCount"                 => $commentsCount,
            "categoriesCount"               => $categoriesCount,
            "monthlyPostsCount"             => $monthlyPostsCount,
            "lastMonthPostsCount"           => $lastMonthPostsCount,
            "monthlyCommentsCount"          => $monthlyCommentsCount,
            "lastMonthCommentsCount"        => $lastMonthCommentsCount,
            "latestPosts"                   => $latestPosts,
            "latestComments"                => $latestComments,
            "monthlyPosts"                  => $monthlyPosts,
            "monthlyComment"                => $monthlyComment,

        ]);
    }
}
