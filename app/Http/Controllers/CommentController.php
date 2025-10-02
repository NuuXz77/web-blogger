<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Posts $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'status' => 'approved', // Auto approve for now, you can change this
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function like(Comment $comment)
    {
        $user = Auth::user();

        if ($comment->isLikedBy($user)) {
            $comment->likes()->detach($user->id);
            $liked = false;
        } else {
            $comment->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $comment->likes()->count()
        ]);
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $reply = Comment::create([
            'content' => $request->content,
            'post_id' => $comment->post_id,
            'user_id' => Auth::id(),
            'parent_id' => $comment->id,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    /**
     * Display admin comments management page
     */
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'post']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('content', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('post', function($postQuery) use ($search) {
                      $postQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $comments = $query->latest()->paginate(10);

        // Calculate stats
        $stats = [
            'total' => Comment::count(),
            'pending' => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'spam' => Comment::where('status', 'spam')->count(),
        ];

        return view('admin.comments.index', compact('comments', 'stats'));
    }

    /**
     * Show comment details
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'post', 'parent', 'replies.user']);
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Update comment status
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,spam'
        ]);

        $comment->update(['status' => $request->status]);

        $statusText = [
            'approved' => 'disetujui',
            'spam' => 'ditandai sebagai spam',
            'pending' => 'dikembalikan ke status menunggu'
        ];

        return back()->with('success', "Komentar berhasil {$statusText[$request->status]}!");
    }

    /**
     * Delete comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus!');
    }

    /**
     * Bulk actions for comments
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comments,id'
        ]);

        $comments = Comment::whereIn('id', $request->comment_ids);

        switch ($request->action) {
            case 'approve':
                $comments->update(['status' => 'approved']);
                $message = 'Komentar terpilih berhasil disetujui!';
                break;
            case 'reject':
                $comments->update(['status' => 'spam']);
                $message = 'Komentar terpilih berhasil ditandai sebagai spam!';
                break;
            case 'delete':
                $comments->delete();
                $message = 'Komentar terpilih berhasil dihapus!';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Update comment for public users (only own comments or admin)
     */
    public function updatePublic(Request $request, Comment $comment)
    {
        // Check if user can edit this comment (author or admin)
        if (Auth::user()->id !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak dapat mengedit komentar ini.');
        }

        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment->update([
            'content' => $request->content,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Komentar berhasil diperbarui!');
    }

    /**
     * Delete comment for public users (only own comments or admin)
     */
    public function destroyPublic(Comment $comment)
    {
        // Check if user can delete this comment (author or admin)
        if (Auth::user()->id !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak dapat menghapus komentar ini.');
        }

        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}