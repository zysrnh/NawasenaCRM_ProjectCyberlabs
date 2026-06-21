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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="flash-msg p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="flash-msg p-3 bg-red-50 text-red-700 border border-red-200 rounded-lg text-sm font-medium">{{ session('error') }}</div>
            @endif

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
                    <a href="{{ route('admin.clients.index') }}" class="text-sm font-medium text-nw-body hover:text-navy transition-colors">&larr; Kembali</a>
                    @if(auth()->user()->is_admin)
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.clients.edit', $client) }}" class="px-4 py-2 border border-gray-300 bg-white text-navy text-sm font-medium rounded hover:bg-gray-50 transition-colors duration-150">Edit Data</a>
                        <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus data klien ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 border border-red-300 text-red-600 bg-white text-sm font-medium rounded hover:bg-red-50 transition-colors duration-150">Hapus</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Kirim WA Perorangan Card --}}
            <div id="kirim-wa" class="bg-white border border-gray-200 rounded overflow-hidden shadow-sm">
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex items-center">
                    <svg class="w-5 h-5 text-[#25D366] mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <h2 class="font-semibold text-navy text-sm uppercase tracking-wider">Kirim Pesan WhatsApp</h2>
                </div>
                <div class="p-5 sm:p-8">
                    <form method="POST" action="{{ route('admin.clients.send-wa', $client) }}">
                        @csrf
                        <div class="flex items-start gap-2 bg-sky-50 border border-sky-100 rounded-lg p-3 mb-4">
                            <svg class="w-4 h-4 text-sky-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-[11px] text-sky-800 leading-relaxed">
                                <strong>"Halo [Nama],"</strong> otomatis ditambahkan oleh template di awal pesan. Anda cukup mengetik isi pesan utamanya (dan penutup/salam jika perlu). Gunakan <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100 shadow-sm">{nama}</code> atau <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100 shadow-sm">{pic}</code> jika diperlukan dalam teks.
                            </p>
                        </div>
                        <textarea name="pesan_blast" rows="4" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none resize-none bg-white mb-4" placeholder="Ketik isi pesan di sini..."></textarea>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="btn-hover px-5 py-2.5 bg-[#25D366] text-white text-sm font-bold rounded shadow hover:bg-emerald-600 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                Kirim Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 
            <!-- FITUR SEMENTARA DI-HIDE SESUAI PERMINTAAN -->
            <div class="bg-white border border-gray-200 rounded overflow-hidden shadow-sm">
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h2 class="font-semibold text-navy text-sm uppercase tracking-wider">Riwayat Pesan WhatsApp</h2>
                    </div>
                    <span class="bg-gray-200 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $client->whatsappLogs->count() }} Pesan</span>
                </div>
                ...
            </div> 
            --}}

        </div>
    </div>
</x-app-layout>
