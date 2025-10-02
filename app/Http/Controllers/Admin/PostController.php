<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ...existing methods...

    /**
     * Filter posts based on status and category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $query = Posts::with('category')->latest();
        
        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Apply category filter if provided
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Get filtered posts
        $posts = $query->take(10)->get();
        
        return response()->json([
            'posts' => $posts
        ]);
    }

    // ...existing methods...
}