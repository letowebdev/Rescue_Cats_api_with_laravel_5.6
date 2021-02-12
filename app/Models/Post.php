<?php

namespace App\Models;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Taggable;

    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function addComment($comment)
    {
        $this->comments()->create($comment);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
