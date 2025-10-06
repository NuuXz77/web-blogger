<x-layouts.app title="Tambah Pengguna">
    <x-slot:header>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Tambah Pengguna Baru
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Isi formulir di bawah untuk mendaftarkan pengguna baru.
                </p>
            </div>
            <div class="flex items-center mt-4 md:mt-0">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot:header>

    <div class="mt-6">
        <div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                            <div class="px-6 py-5 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Informasi Pengguna
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <div class="mt-1 relative rounded-md shadow-sm group">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                        </div>
                                        <input class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('title') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200" type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full rounded-md border border-gray-300 pl-10 text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-2 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500/50 focus:border-red-500' : 'focus:ring-primary/50 focus:border-primary' }}" placeholder="John Doe" required>
                                    </div>
                                    @error('name')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                    <div class="mt-1 relative rounded-md shadow-sm group">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </div>
                                        <input class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('title') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200" type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full rounded-md border border-gray-300 pl-10 text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-2 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed {{ $errors->has('email') ? 'border-red-500 focus:ring-red-500/50 focus:border-red-500' : 'focus:ring-primary/50 focus:border-primary' }}" placeholder="you@example.com" required>
                                    </div>
                                    @error('email')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select id="role" name="role" class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base text-gray-900 transition focus:outline-none focus:ring-2 {{ $errors->has('role') ? 'border-red-500 focus:ring-red-500/50 focus:border-red-500' : 'focus:ring-primary/50 focus:border-primary' }}" required>
                                        <option value="">Pilih Role</option>
                                        <option value="user" @selected(old('role') === 'user')>Author</option>
                                        <option value="auditor" @selected(old('role') === 'auditor')>Auditor</option>
                                    </select>
                                    @error('role')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                            <div class="px-6 py-5 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Password
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('title') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200" type="password" name="password" id="password" class="mt-1 block w-full rounded-md border border-gray-300 text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-2 sm:text-sm {{ $errors->has('password') ? 'border-red-500 focus:ring-red-500/50 focus:border-red-500' : 'focus:ring-primary/50 focus:border-primary' }}" required>
                                    @error('password')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                    <input class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm @error('title') border-red-300 focus:ring-red-500 focus:border-red-300 @enderror transition duration-200" type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border border-gray-300 text-gray-900 placeholder-gray-400 shadow-sm transition focus:outline-none focus:ring-2 sm:text-sm focus:ring-primary/50 focus:border-primary" required>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Simpan Pengguna
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>