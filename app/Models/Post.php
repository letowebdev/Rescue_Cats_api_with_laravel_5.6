<?php

namespace App\Models;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;

class Post extends Model
{
    use Taggable;

    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImagesAttribute()
    {
        return [
            'thumbnail' => $this->getImagePath('thumbnail'),
            'original' => $this->getImagePath('original'),
            'large' => $this->getImagePath('large')
        ];
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

    protected function getImagePath($size)
    {
        return Storage::disk($this->disk)
        ->url("uploads/posts/{$size}" . $this->image);
    }
}
