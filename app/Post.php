<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'published_at',
        'user_id'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function imageDelete()
    {
        File::delete(public_path('storage/' . $this->image));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function scopeSearch($query)
    {
        $search = request()->query('search');
        if (!$search) {
            return $query;
        } else {
            return $query->where('title', 'LIKE', "%{$search}%");
        }
    }
}
