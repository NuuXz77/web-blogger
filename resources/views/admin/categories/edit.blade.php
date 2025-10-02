<x-layouts.app title="Edit Kategori">
    <x-slot:header>
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Kategori</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi kategori</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Kategori
            </a>
        </div>
    </x-slot:header>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Informasi Kategori</h2>
            <p class="text-sm text-gray-600 mt-1">Perbarui detail untuk kategori ini</p>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $category->name) }}"
                       class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-[#0046FF] focus:border-[#0046FF] transition-colors duration-200 @error('name') border-red-300 @else border-gray-300 @enderror"
                       placeholder="Masukkan nama kategori"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Slug saat ini: <code>{{ $category->slug }}</code></p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-[#0046FF] focus:border-[#0046FF] transition-colors duration-200 @error('description') border-red-300 @else border-gray-300 @enderror"
                          placeholder="Masukkan deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Color -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                    Warna Kategori <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-4">
                    <input type="color" 
                           id="color" 
                           name="color" 
                           value="{{ old('color', $category->color) }}"
                           class="h-10 w-20 border rounded-md cursor-pointer @error('color') border-red-300 @else border-gray-300 @enderror">
                    <div class="flex-1">
                        <input type="text" 
                               id="color-text" 
                               value="{{ old('color', $category->color) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#0046FF] focus:border-[#0046FF] transition-colors duration-200"
                               placeholder="#0046FF"
                               readonly>
                    </div>
                </div>
                @error('color')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Pilih warna untuk mewakili kategori ini</p>
            </div>

            <!-- Predefined Colors -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Pilihan Warna Cepat
                </label>
                <div class="grid grid-cols-8 gap-2">
                    @php
                        $colors = [
                            '#0046FF', '#FF6B35', '#F7931E', '#FFD23F', 
                            '#06D6A0', '#073B4C', '#8B5CF6', '#EF4444',
                            '#10B981', '#F59E0B', '#3B82F6', '#8B5A2B',
                            '#EC4899', '#6366F1', '#84CC16', '#F97316'
                        ];
                    @endphp
                    @foreach($colors as $presetColor)
                        <button type="button" 
                                class="w-8 h-8 rounded-md border-2 hover:border-gray-400 transition-colors duration-200 {{ $category->color === $presetColor ? 'border-gray-800' : 'border-gray-200' }}"
                                style="background-color: {{ $presetColor }}"
                                onclick="setColor('{{ $presetColor }}')">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Status
                </label>
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-[#0046FF] focus:ring-[#0046FF] border-gray-300 rounded">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">
                        Aktif (kategori akan terlihat dan dapat dipilih)
                    </label>
                </div>
                @error('is_active')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Posts Count Info -->
            @if($category->posts_count > 0)
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-blue-800">
                                Kategori ini memiliki {{ $category->posts_count }} artikel yang terkait.
                            </p>
                            <p class="text-sm text-blue-600">
                                Perubahan pada kategori ini akan mempengaruhi semua artikel terkait.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-[#0046FF] hover:bg-[#0036D8] text-white rounded-md transition-colors duration-200 shadow-sm">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>

    <script>
        // Color picker functionality
        document.getElementById('color').addEventListener('change', function() {
            document.getElementById('color-text').value = this.value;
        });

        function setColor(color) {
            document.getElementById('color').value = color;
            document.getElementById('color-text').value = color;
            
            // Update border highlighting
            document.querySelectorAll('.grid button').forEach(btn => {
                btn.classList.remove('border-gray-800');
                btn.classList.add('border-gray-200');
            });
            
            event.target.classList.remove('border-gray-200');
            event.target.classList.add('border-gray-800');
        }
    </script>

</x-layouts.app>