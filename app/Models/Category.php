<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'order'
    ];

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $builder, $sort = 'asc')
     {
         $builder->orderBy('order', $sort);
     }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
