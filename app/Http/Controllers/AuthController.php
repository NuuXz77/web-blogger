<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        
        $title = 'Login - Web Blogger';
        
                return view('auth.login', compact('title'));
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            /** @var User $user */
            $user = Auth::user();
            
            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }
            
            return redirect()->intended('/dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . $user->name . '.');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        $title = 'Register - Web Blogger';
        
        return view('auth.register', compact('title'));
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.min' => 'Nama minimal 2 karakter.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin', // Default role
            ]);

            // Auto login after registration
            Auth::login($user);

            return redirect('/dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '.');

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
            ])->withInput();
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Show dashboard
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        $title = 'Dashboard - Web Blogger';
        $userPosts = $user->posts()->latest()->take(5)->get();
        $userComments = $user->comments()->latest()->take(5)->get();

        return view('dashboard', compact('user', 'userPosts', 'userComments', 'title'));
    }

    /**
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        
        $title = 'Admin Dashboard - Web Blogger';
        
        // Get statistics
        $totalViews = Posts::sum('views_count');
        $totalPosts = Posts::count();
        $totalComments = Comments::count();
        $pendingComments = Comments::where('status', 'pending')->count();
        
        $recentPosts = Posts::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'user', 
            'title',
            'totalViews', 
            'totalPosts', 
            'totalComments', 
            'pendingComments',
            'recentPosts',
            'recentUsers'
        ));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();
        $title = 'Profile - Web Blogger';
        
        return view('auth.profile', compact('user', 'title'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'current_password.required_with' => 'Password lama harus diisi untuk mengubah password.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verify current password if trying to change password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password lama tidak benar.',
                ])->withInput();
            }
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
