<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalPosts = Posts::count();
        $totalCategories = \App\Models\Category::count(); // Add this line
        $totalComments = Comment::count() ?? 0;
        $pendingComments = Comment::where('status', 'pending')->count();
        $totalViews = Posts::sum('views') ?: rand(1000, 5000); // Placeholder for views

        // Recent Posts (last 10)
        $recentPosts = Posts::with(['category', 'user'])
            ->withCount(['comments' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Recent Comments (last 10)
        $recentComments = Comment::with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get categories for the filter dropdown
        $categories = \App\Models\Category::orderBy('name')->get();
        dd($totalCategories);
        return view('admin.dashboard', compact(
            'totalPosts',
            'totalCategories', // Add this line
            'totalComments', 
            'pendingComments',
            'totalViews',
            'recentPosts',
            'recentComments',
            'categories'
        ));
    }
}
