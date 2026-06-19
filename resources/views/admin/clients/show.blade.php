<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.clients.index') }}" class="text-nw-body hover:text-navy transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-navy">Detail Klien</h1>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded overflow-hidden">
                <div class="px-5 sm:px-8 py-5 border-b border-gray-200 bg-navy flex items-center justify-between">
                    <div>
                        <h2 class="font-bold text-lg text-white">{{ $client->nama_klien }}</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Terdaftar {{ $client->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="inline-flex px-2.5 py-1 bg-gold/20 text-gold text-xs font-semibold rounded">{{ $client->sektor_bisnis }}</span>
                </div>
                <div class="px-5 sm:px-8 py-6 space-y-5">
                    @if ($client->nama_pic)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Nama PIC</label>
                            <p class="text-sm text-navy font-medium">{{ $client->nama_pic }}</p>
                        </div>
                        @if ($client->jabatan_pic)
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Jabatan PIC</label>
                            <p class="text-sm text-navy font-medium">{{ $client->jabatan_pic }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="border-t border-gray-100"></div>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">WhatsApp</label>
                            <p class="text-sm text-navy font-medium">{{ $client->nomor_telepon }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Email</label>
                            <p class="text-sm text-navy font-medium">{{ $client->email }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-100"></div>
                    <div>
                        <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Alamat</label>
                        <p class="text-sm text-navy-light leading-relaxed">{{ $client->alamat }}</p>
                    </div>
                    <div class="border-t border-gray-100"></div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Sektor Bisnis</label>
                            <span class="inline-flex px-2 py-0.5 bg-gold/15 text-gold-dark text-xs font-medium rounded">{{ $client->sektor_bisnis }}</span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Kebutuhan</label>
                            <p class="text-sm text-navy-light">{{ $client->kebutuhan_utama }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body uppercase tracking-wider mb-1">Sumber Info</label>
                            <p class="text-sm text-navy-light">{{ $client->sumber_info }}</p>
                        </div>
                    </div>
                </div>
                <div class="px-5 sm:px-8 py-4 border-t border-gray-200 bg-nw-light flex items-center justify-between">
                    <a href="{{ route('admin.clients.index') }}" class="text-sm text-nw-body hover:text-navy transition-colors">&larr; Kembali</a>
                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus data klien ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-4 py-2 border border-red-300 text-red-600 text-sm font-medium rounded hover:bg-red-50 transition-colors duration-150">Hapus Klien</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
