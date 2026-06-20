<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-navy">Kelola Kategori</h1>
                <p class="text-sm text-nw-body mt-0.5">Atur kategori Sektor Bisnis & Kebutuhan Layanan</p>
            </div>
            <a href="{{ route('admin.clients.index') }}"
                class="btn-hover inline-flex items-center px-4 py-2 border border-gray-300 text-navy text-sm font-medium rounded hover:bg-gray-50">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flash-msg mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-sm font-medium">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="flash-msg mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded text-sm font-medium">{{ session('error') }}</div>
            @endif

            {{-- Tambah Kategori --}}
            <div class="bg-white border border-gray-200 rounded overflow-hidden mb-6 animate-fade-in">
                <div class="px-6 py-4 border-b border-gray-100 bg-nw-light/50">
                    <h2 class="text-sm font-bold text-navy uppercase tracking-wider">Tambah Kategori Baru</h2>
                </div>
                <form method="POST" action="{{ route('admin.kategori.store') }}" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-nw-body mb-1">Tipe Kategori</label>
                            <select name="tipe" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold bg-white">
                                <option value="" disabled selected>-- Pilih Tipe --</option>
                                <option value="sektor">Sektor Bisnis</option>
                                <option value="kebutuhan">Kebutuhan Layanan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body mb-1">Nama Kategori</label>
                            <input type="text" name="nama" required class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold" placeholder="Contoh: Properti, Logistik...">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn-hover w-full px-4 py-2 bg-navy text-white text-sm font-medium rounded hover:bg-navy-dark">
                                <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Daftar Kategori --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Sektor Bisnis --}}
                <div class="bg-white border border-gray-200 rounded overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="px-5 py-3 border-b border-gray-100 bg-navy flex items-center justify-between">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Sektor Bisnis</h3>
                        <span class="text-xs text-gray-300">{{ $sektorList->count() }} kategori</span>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse ($sektorList as $kat)
                            <div class="flex items-center justify-between px-5 py-3 hover:bg-nw-light/50 transition-colors">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-gold rounded-full flex-shrink-0"></span>
                                    <span class="text-sm text-navy font-medium">{{ $kat->nama }}</span>
                                </div>
                                <form method="POST" action="{{ route('admin.kategori.destroy', $kat) }}" onsubmit="return confirm('Hapus kategori {{ $kat->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 transition-colors font-medium">Hapus</button>
                                </form>
                            </div>
                        @empty
                            <div class="px-5 py-8 text-center text-sm text-nw-body">Belum ada kategori sektor</div>
                        @endforelse
                    </div>
                </div>

                {{-- Kebutuhan Layanan --}}
                <div class="bg-white border border-gray-200 rounded overflow-hidden animate-fade-in" style="animation-delay: 0.15s;">
                    <div class="px-5 py-3 border-b border-gray-100 bg-navy flex items-center justify-between">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Kebutuhan Layanan</h3>
                        <span class="text-xs text-gray-300">{{ $kebutuhanList->count() }} kategori</span>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse ($kebutuhanList as $kat)
                            <div class="flex items-center justify-between px-5 py-3 hover:bg-nw-light/50 transition-colors">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full flex-shrink-0"></span>
                                    <span class="text-sm text-navy font-medium">{{ $kat->nama }}</span>
                                </div>
                                <form method="POST" action="{{ route('admin.kategori.destroy', $kat) }}" onsubmit="return confirm('Hapus kategori {{ $kat->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 transition-colors font-medium">Hapus</button>
                                </form>
                            </div>
                        @empty
                            <div class="px-5 py-8 text-center text-sm text-nw-body">Belum ada kategori kebutuhan</div>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded animate-fade-in" style="animation-delay: 0.2s;">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div class="text-xs text-yellow-800 leading-relaxed">
                        <strong class="font-bold">Info:</strong> Kategori yang ditambahkan di sini akan otomatis muncul sebagai pilihan di <strong>Form Registrasi Klien</strong> dan filter <strong>WhatsApp Blast</strong>. Klien tetap bisa mengisi "Lain-lain" secara manual.
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
