<x-layouts.guest title="{{ $title }}">
    <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-primary rounded-full flex items-center justify-center mb-4">
                <!-- User Icon -->
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
            <p class="text-gray-600">Masuk ke akun Web Blogger Anda</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Email Icon -->
                        <svg class="h-8 w-8 text-black" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        class="appearance-none relative block w-full pl-10 pr-3 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 sm:text-sm transition-all duration-300"
                        placeholder="Masukkan email Anda" required>
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Lock Icon -->
                        <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <input id="password" name="password" type="password"
                        class="appearance-none relative block w-full pl-10 pr-3 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:z-10 sm:text-sm transition-all duration-300"
                        placeholder="Masukkan password Anda" required>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>
                <div class="text-sm">
                    <a href="#"
                        class="font-medium text-primary hover:text-blue-700 transition-colors duration-300">
                        Lupa password?
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:scale-105">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <!-- Login Arrow Icon -->
                        <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </span>
                    Masuk
                </button>
            </div>

            <!-- Notes -->
            <div class="mt-4 space-y-3">
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-700">Catatan Admin</p>
                    <div class="mt-2 text-sm text-gray-800">
                        <p>Gunakan kredensial berikut untuk login sebagai admin:</p>
                        <ul class="mt-1 list-disc list-inside">
                            <li>Email: <span class="font-mono">admin@a.com</span></li>
                            <li>Password: <span class="font-mono">adminadmin</span></li>
                        </ul>
                    </div>
                </div>
                <p class="text-sm text-gray-700">
                    Ingin menjadi penulis? <a href="{{ route('register') }}" class="text-primary hover:text-blue-700 font-medium">Daftar untuk menjadi writer</a>.
                </p>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-medium text-primary hover:text-blue-700 transition-colors duration-300">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </form>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Success Check Icon -->
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Error Warning Icon -->
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-800">Terjadi kesalahan, silakan periksa form Anda.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.guest>
