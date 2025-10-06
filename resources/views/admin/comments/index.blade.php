<x-layouts.app title="Kelola Komentar">
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Komentar</h1>
                <p class="text-gray-600 mt-1">Kelola dan moderasi komentar dari pembaca</p>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Komentar</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-50 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Menunggu Persetujuan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-red-50 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Spam</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['spam'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <form method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari komentar, penulis, atau postingan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>
                <div class="flex gap-2 flex-wrap">
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="spam" {{ request('status') === 'spam' ? 'selected' : '' }}>Spam</option>
                    </select>
                    <select name="post_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent min-w-48">
                        <option value="">Semua Postingan</option>
                        @foreach($postsWithComments as $post)
                            <option value="{{ $post->id }}" {{ request('post_id') == $post->id ? 'selected' : '' }}>
                                {{ Str::limit($post->title, 40) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Filter
                    </button>
                    <a href="{{ route('admin.comments.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Comments List -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            @if(isset($comments) && $comments->count() > 0)
                <!-- Bulk Actions -->
                <div class="p-6 border-b border-gray-200">
                    <form id="bulkActionForm" method="POST" action="{{ route('admin.comments.bulk') }}">
                        @csrf
                        <div class="flex items-center gap-4">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-primary focus:ring-primary">
                            <label for="selectAll" class="text-sm text-gray-600">Pilih Semua</label>
                            
                            <select name="action" id="bulkAction" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                <option value="">Pilih Aksi</option>
                                <option value="approve">Setujui</option>
                                <option value="reject">Tandai Spam</option>
                                <option value="delete">Hapus</option>
                            </select>
                            
                            <button type="submit" id="bulkSubmit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm" disabled>
                                Jalankan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($comments as $comment)
                        <div class="p-6 hover:bg-gray-50 transition duration-200">
                            <div class="flex items-start space-x-4">
                                <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="comment-checkbox mt-1 rounded border-gray-300 text-primary focus:ring-primary">
                                
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr($comment->user->name ?? $comment->user_name ?? 'G', 0, 1) }}
                                    </span>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <h4 class="font-medium text-gray-900">{{ $comment->user->name ?? $comment->user_name ?? 'Guest' }}</h4>
                                            <span class="text-sm text-gray-500">•</span>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            @if($comment->parent_id)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Balasan
                                                </span>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            {{ $comment->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($comment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($comment->status === 'approved' ? 'Disetujui' : ($comment->status === 'pending' ? 'Menunggu' : 'Spam')) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-700 mb-3">{{ $comment->content }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <span class="font-medium">Postingan:</span>
                                            @if($comment->post)
                                                <a href="{{ route('posts.show', $comment->post->slug) }}" class="text-primary hover:underline" target="_blank">
                                                    {{ $comment->post->title }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">Post tidak ditemukan</span>
                                            @endif
                                            @if($comment->parent)
                                                <span class="ml-4 font-medium">Membalas:</span>
                                                <span class="italic">{{ Str::limit($comment->parent->content, 50) }}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center space-x-2">
                                            @if($comment->status === 'pending')
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="spam">
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('admin.comments.show', $comment) }}" class="text-primary hover:text-blue-800 text-sm font-medium">
                                                Detail
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $comments->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada komentar</h3>
                    <p class="text-gray-500">Komentar akan muncul di sini ketika pembaca mulai berinteraksi dengan postingan Anda.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Bulk actions functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const commentCheckboxes = document.querySelectorAll('.comment-checkbox');
        const bulkActionSelect = document.getElementById('bulkAction');
        const bulkSubmitButton = document.getElementById('bulkSubmit');
        const bulkActionForm = document.getElementById('bulkActionForm');

        selectAllCheckbox.addEventListener('change', function() {
            commentCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActionButton();
        });

        commentCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActionButton);
        });

        bulkActionSelect.addEventListener('change', updateBulkActionButton);

        function updateBulkActionButton() {
            const selectedCheckboxes = document.querySelectorAll('.comment-checkbox:checked');
            const hasSelection = selectedCheckboxes.length > 0;
            const hasAction = bulkActionSelect.value !== '';
            
            bulkSubmitButton.disabled = !(hasSelection && hasAction);
        }

        bulkActionForm.addEventListener('submit', function(e) {
            const selectedCheckboxes = document.querySelectorAll('.comment-checkbox:checked');
            
            if (selectedCheckboxes.length === 0) {
                e.preventDefault();
                alert('Pilih setidaknya satu komentar.');
                return;
            }

            if (!bulkActionSelect.value) {
                e.preventDefault();
                alert('Pilih aksi yang akan dijalankan.');
                return;
            }

            if (bulkActionSelect.value === 'delete') {
                if (!confirm('Yakin ingin menghapus komentar yang dipilih? Tindakan ini tidak dapat dibatalkan.')) {
                    e.preventDefault();
                    return;
                }
            }

            // Add selected comment IDs to form
            selectedCheckboxes.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'comment_ids[]';
                input.value = checkbox.value;
                bulkActionForm.appendChild(input);
            });
        });
    </script>
</x-layouts.app>