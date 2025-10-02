<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        'type'
    ];

    public function getCreatedAtAttribute($value)
    {
        $date = date_create($value);
        return date_format($date, "Y-m-d");
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, "type");
    }
}
