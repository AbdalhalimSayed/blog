<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        "title",
        "content",
        "user_id",
        "category_id",
        "status"
    ];

    public function getCreatedAtAttribute($value)
    {
        $date = date_create($value);
        return date_format($date, "Y-m-d");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comment()
    {
        return $this->morphOne(Comment::class, "commentable");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, "commentable");
    }
}
