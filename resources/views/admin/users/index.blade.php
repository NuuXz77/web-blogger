<x-layouts.app title="Kelola Users">
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Users</h1>
                <p class="text-gray-600 mt-1">Kelola akun pengguna</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah User
            </a>
        </div>
    </x-slot:header>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <div class="mb-6">
            <form action="{{ route('admin.users.search') }}" method="GET" class="flex gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari user berdasarkan nama atau email..."
                        class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0046FF] focus:border-[#0046FF] sm:text-sm transition duration-200"
                    >
                </div>
                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#0046FF] hover:bg-[#0036D8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0046FF] transition duration-200"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
                @if(request('q'))
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0046FF] transition duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Bersihkan
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    Semua Users ({{ $users->total() }})
                    @if(request('q'))
                        <span class="text-sm text-gray-500"> - Hasil pencarian untuk "{{ request('q') }}"</span>
                    @endif
                </h2>
            </div>

            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('admin.users.show', $user) }}" class="hover:text-[#0046FF]">
                                                {{ $user->name }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Bergabung {{ $user->created_at?->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="relative inline-block text-left">
                                            <div>
                                                <button
                                                    type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0046FF]"
                                                    onclick="toggleUserDropdown({{ $user->id }})"
                                                >
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div
                                                id="user-dropdown-{{ $user->id }}"
                                                class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                                            >
                                                <div class="py-1" role="menu">
                                                    <a
                                                        href="{{ route('admin.users.show', $user) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        Lihat User
                                                    </a>

                                                    <a
                                                        href="{{ route('admin.users.edit', $user) }}"
                                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit User
                                                    </a>

                                                    <div class="border-t border-gray-100"></div>

                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="block"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-red-700 text-left hover:bg-red-50 hover:text-red-900"
                                                            role="menuitem"
                                                        >
                                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Hapus User
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-6.13a4 4 0 11-8 0 4 4 0 018 0zM7 10a4 4 0 108 0"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        @if(request('q'))
                            User tidak ditemukan untuk "{{ request('q') }}"
                        @else
                            Belum ada user
                        @endif
                    </h3>
                    <p class="text-gray-500 mb-6">
                        @if(request('q'))
                            Coba sesuaikan kata kunci pencarian Anda atau lihat semua user.
                        @else
                            Tambahkan user baru untuk mulai mengelola akses.
                        @endif
                    </p>
                    @if(!request('q'))
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah User
                        </a>
                    @else
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200 mr-3">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Lihat Semua Users
                        </a>
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah User
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleUserDropdown(userId) {
            const dropdown = document.getElementById('user-dropdown-' + userId);
            const allDropdowns = document.querySelectorAll('[id^="user-dropdown-"]');

            allDropdowns.forEach(function(element) {
                if (element.id !== 'user-dropdown-' + userId) {
                    element.classList.add('hidden');
                }
            });

            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const allDropdowns = document.querySelectorAll('[id^="user-dropdown-"]');
            const isDropdownButton = event.target.closest('button[onclick^="toggleUserDropdown"]');

            if (!isDropdownButton && !event.target.closest('[id^="user-dropdown-"]')) {
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const allDropdowns = document.querySelectorAll('[id^="user-dropdown-"]');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
</x-layouts.app>
