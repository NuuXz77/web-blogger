<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id',
        'status',
        'user_name',
        'user_email',
    ];

    /**
     * Get the post that this comment belongs to
     */
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }

    /**
     * Get the user that wrote this comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment (for nested comments)
     */
    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    /**
     * Get all child comments (replies)
     */
    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }

    /**
     * Get approved replies
     */
    public function approvedReplies()
    {
        return $this->replies()->where('status', 'approved');
    }

    /**
     * Scope to get approved comments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get pending comments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get parent comments (not replies)
     */
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Check if comment is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if comment is a reply
     */
    public function isReply()
    {
        return !is_null($this->parent_id);
    }

    /**
     * Get author name (from user or guest)
     */
    public function getAuthorNameAttribute()
    {
        return $this->user ? $this->user->name : $this->user_name;
    }

    /**
     * Get author email (from user or guest)
     */
    public function getAuthorEmailAttribute()
    {
        return $this->user ? $this->user->email : $this->user_email;
    }
}
