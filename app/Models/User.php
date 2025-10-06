<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all posts created by this user
     */
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    /**
     * Get all comments created by this user
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    /**
     * Get all visits where this user is the auditor
     */
    public function visitsAsAuditor()
    {
        return $this->hasMany(Visits::class, 'auditor_id');
    }

    /**
     * Get all visits where this user is the author being visited
     */
    public function visitsAsAuthor()
    {
        return $this->hasMany(Visits::class, 'author_id');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAuditor()
    {
        return $this->role === 'auditor';
    }

    /**
     * Get published posts by this user
     */
    public function publishedPosts()
    {
        return $this->posts()->where('status', 'published');
    }
}
