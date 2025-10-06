<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [PostController::class, 'welcome'])->name('welcome');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Comment routes (authenticated users only)
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::patch('/comments/{comment}', [CommentController::class, 'updatePublic'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroyPublic'])->name('comments.destroy');
});

// Authentication routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Protected routes (authenticated users only)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // User dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // User Posts CRUD (users can only manage their own posts)
    Route::prefix('user')->name('user.')->group(function () {
        
    });
    
    // User profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware(['auth', 'role:auditor'])->prefix('auditor')->name('auditor.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'auditDashboard'])->name('dashboard');
    
    // Auditor audit routes
    Route::get('/audit', [App\Http\Controllers\AuditController::class, 'auditorIndex'])->name('audit.index');
    Route::get('/audit/recap', [App\Http\Controllers\AuditController::class, 'auditorRecap'])->name('audit.recap');
    Route::get('/audit/{audit}', [App\Http\Controllers\AuditController::class, 'auditorShow'])->name('audit.show');
    Route::get('/audit/{audit}/report', [App\Http\Controllers\AuditController::class, 'auditorReport'])->name('audit.report');
    Route::post('/audit/{audit}/report', [App\Http\Controllers\AuditController::class, 'auditorStoreReport'])->name('audit.store-report');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::resource('posts', UserPostController::class)->except(['show']);
        Route::get('/posts/{post}', [UserPostController::class, 'userShow'])->name('posts.show');
        Route::post('/posts/{post}/toggle-status', [UserPostController::class, 'toggleStatus'])->name('posts.toggle-status');
        Route::post('/posts/{post}/duplicate', [UserPostController::class, 'duplicate'])->name('posts.duplicate');
        Route::get('/posts-search', [UserPostController::class, 'search'])->name('posts.search');
        Route::get('/posts/filter/{status?}', [UserPostController::class, 'getPostsByStatus'])->name('posts.filter');
        Route::get('/generate-slug', [UserPostController::class, 'generateSlug'])->name('posts.generate-slug');
    
    // User audit routes
    Route::get('/audit', [App\Http\Controllers\User\AuditController::class, 'index'])->name('audit.index');
    Route::get('/audit/{audit}', [App\Http\Controllers\User\AuditController::class, 'show'])->name('audit.show');
    Route::post('/audit/{audit}/confirm', [App\Http\Controllers\User\AuditController::class, 'confirm'])->name('audit.confirm');
    Route::post('/audit/{audit}/request-reschedule', [App\Http\Controllers\User\AuditController::class, 'requestReschedule'])->name('audit.request-reschedule');
});
// Admin routes (admin role only)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
    
    // Posts management with resource controller (using adminShow method)
    Route::resource('posts', PostController::class)->except(['show']);
    Route::get('/posts/{post}', [PostController::class, 'adminShow'])->name('posts.show');
    
    // Additional post routes
    Route::post('/posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');
    Route::post('/posts/{post}/duplicate', [PostController::class, 'duplicate'])->name('posts.duplicate');
    Route::get('/posts-search', [PostController::class, 'search'])->name('posts.search');
    Route::get('/generate-slug', [PostController::class, 'generateSlug'])->name('posts.generate-slug');
    
    // Categories management
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::get('/categories-search', [CategoryController::class, 'search'])->name('categories.search');
    
    // Comments management
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/bulk', [CommentController::class, 'bulkAction'])->name('comments.bulk');
    
    // Users management
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::get('/users/{user}', [AdminUserController::class, 'adminShow'])->name('users.show');
    Route::get('/users-search', [AdminUserController::class, 'search'])->name('users.search');
    
    // Audit/Visits management
    // Chart data endpoint for visits (for admin dashboard) - MUST be before resource route
    Route::get('/audit/visits-chart-data', [App\Http\Controllers\AuditController::class, 'visitsChartData'])->name('audit.chart-data');
    
    Route::resource('audit', App\Http\Controllers\AuditController::class);
    Route::post('/audit/{audit}/approve', [App\Http\Controllers\AuditController::class, 'approve'])->name('audit.approve');
    Route::post('/audit/{audit}/reject', [App\Http\Controllers\AuditController::class, 'reject'])->name('audit.reject');
    Route::post('/audit/{audit}/confirm', [App\Http\Controllers\AuditController::class, 'confirmReport'])->name('audit.confirm');
    Route::post('/audit/{audit}/reject-report', [App\Http\Controllers\AuditController::class, 'rejectReport'])->name('audit.reject-report');
    Route::post('/audit/{audit}/approve-reschedule', [App\Http\Controllers\AuditController::class, 'approveReschedule'])->name('audit.approve-reschedule');
    Route::post('/audit/{audit}/reject-reschedule', [App\Http\Controllers\AuditController::class, 'rejectReschedule'])->name('audit.reject-reschedule');
    
    // Debug route to test chart data (remove this later)
    Route::get('/debug-chart', function() {
        try {
            $visits = App\Models\Visits::select('id', 'created_at', 'auditor_id')->get();
            return response()->json([
                'total_visits' => $visits->count(),
                'visits_sample' => $visits->take(3),
                'current_user' => Auth::user() ? [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'role' => Auth::user()->role
                ] : 'Not logged in',
                'now' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    });
    
    // Posts routes
    Route::get('/posts/filter', [App\Http\Controllers\Admin\PostController::class, 'filter'])->name('posts.filter');
});


// Blog routes (public) - now implemented
// All public post routes are handled above in the main routes section
// All public post routes are handled above in the main routes section
