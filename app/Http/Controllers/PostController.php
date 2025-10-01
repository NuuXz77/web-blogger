<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display welcome page with latest published posts.
     */
    public function welcome()
    {
        $posts = Posts::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('welcome', compact('posts'));
    }

        /**
     * Display the specified post by slug for public view.
     */
    public function show($slug)
    {
        $post = Posts::with(['user', 'category', 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get related posts
        $relatedPosts = Posts::with(['user', 'category'])
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display the specified post in admin panel.
     */
    public function adminShow(Posts $post)
    {
        $post->load(['user', 'category', 'comments.user']);
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Posts::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('posts', 'public');
        }

        // Create the post
        $post = Posts::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'status' => $validated['status'],
            'featured_image' => $featuredImagePath,
            // 'meta_title' => $validated['meta_title'] ?? $validated['title'],
            // 'meta_description' => $validated['meta_description'] ?? $validated['excerpt'],
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Posts $post)
    {
        // Check if user can edit this post (author or admin)
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Posts $post)
    {
        // Check if user can edit this post (author or admin)
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post->id)
            ],
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Handle featured image upload
        $featuredImagePath = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $featuredImagePath = $request->file('featured_image')->store('posts', 'public');
        }

        // Handle status change to published
        $publishedAt = $post->published_at;
        if ($validated['status'] === 'published' && $post->status !== 'published') {
            $publishedAt = now();
        } elseif ($validated['status'] === 'draft') {
            $publishedAt = null;
        }

        // Update the post
        $post->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'status' => $validated['status'],
            'featured_image' => $featuredImagePath,
            // 'meta_title' => $validated['meta_title'] ?? $validated['title'],
            // 'meta_description' => $validated['meta_description'] ?? $validated['excerpt'],
            'category_id' => $validated['category_id'],
            'published_at' => $publishedAt,
        ]);

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post berhasil diperbarui!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Posts $post)
    {
        // Check if user can delete this post (author or admin)
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        // Delete the post (this will also delete related comments due to cascade)
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post berhasil dihapus!');
    }

    /**
     * Toggle post status between draft and published.
     */
    public function toggleStatus(Posts $post)
    {
        // Check if user can edit this post (author or admin)
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $newStatus = $post->status === 'published' ? 'draft' : 'published';
        $publishedAt = $newStatus === 'published' ? now() : null;

        $post->update([
            'status' => $newStatus,
            'published_at' => $publishedAt,
        ]);

        $message = $newStatus === 'published' ? 'Post berhasil dipublikasikan!' : 'Post berhasil diubah ke draft!';

        return back()->with('success', $message);
    }

    /**
     * Duplicate a post.
     */
    public function duplicate(Posts $post)
    {
        // Check if user can duplicate this post (author or admin)
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copy)';
        $newPost->slug = $post->slug . '-copy-' . time();
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->user_id = Auth::id();
        $newPost->created_at = now();
        $newPost->updated_at = now();
        $newPost->save();

        return redirect()
            ->route('admin.posts.edit', $newPost)
            ->with('success', 'Post berhasil diduplikasi!');
    }

    /**
     * Search posts by title or content.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $posts = Posts::with(['user', 'category'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhere('excerpt', 'like', "%{$query}%")
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts', 'query'));
    }

    /**
     * Generate slug from title.
     */
    public function generateSlug(Request $request)
    {
        $title = $request->get('title');
        $slug = Str::slug($title);
        
        // Make sure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        
        while (Posts::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }
}
