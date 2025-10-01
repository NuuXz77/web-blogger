<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'user_id',
        'category_id',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    /**
     * Get the user (author) that owns the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the author (alias for user relationship)
     */
    public function author()
    {
        return $this->user();
    }

    /**
     * Get the category that owns the post
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all comments for this post
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }

    /**
     * Get approved comments for this post
     */
    public function approvedComments()
    {
        return $this->comments()->where('status', 'approved');
    }

    /**
     * Get parent comments (not replies) for this post
     */
    public function parentComments()
    {
        return $this->comments()->whereNull('parent_id')->where('status', 'approved');
    }

    /**
     * Scope to get published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get draft posts
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Generate slug from title
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Check if post is published
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }

    /**
     * Get route key name for model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
