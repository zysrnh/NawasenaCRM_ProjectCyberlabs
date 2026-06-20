<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-navy">Tambah Akun</h1>
                <p class="text-sm text-nw-body mt-0.5">Tambahkan pengguna atau administrator baru</p>
            </div>
            <a href="{{ route('admin.users.index') }}"
                class="btn-hover inline-flex items-center px-4 py-2 border border-gray-300 text-navy text-sm font-medium rounded hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded overflow-hidden shadow-sm animate-fade-in">
                <form method="POST" action="{{ route('admin.users.store') }}" class="p-6">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-nw-body mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold" placeholder="Masukkan nama">
                        @error('name')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-nw-body mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold" placeholder="email@contoh.com">
                        @error('email')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-nw-body mb-1">Role</label>
                        <select name="is_admin" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold">
                            <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>User Biasa</option>
                            <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        @error('is_admin')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-nw-body mb-1">Password</label>
                        <input type="password" name="password" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold">
                        @error('password')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-nw-body mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold">
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="btn-hover px-6 py-2 bg-navy text-white text-sm font-medium rounded hover:bg-navy-dark">
                            Simpan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
