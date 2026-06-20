<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-navy">WhatsApp Blast</h1>
                <p class="text-sm text-nw-body mt-0.5">Kirim pesan massal ke klien berdasarkan kategori.</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="btn-hover inline-flex items-center px-3 py-1.5 border border-gray-300 text-navy text-xs font-medium rounded hover:bg-gray-50">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="blastForm()">

            @if (session('success'))
                <div class="flash-msg mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-700 font-medium flex items-center space-x-2">
                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="flash-msg mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 font-medium flex items-center space-x-2">
                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.blast.send') }}">
                @csrf

                {{-- Grid 2 kolom 50-50, stretch agar kolom kanan setinggi kiri --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-items: stretch; height: calc(100vh - 160px); min-height: 550px;">

                    {{-- ============================================ --}}
                    {{-- KOLOM KIRI: Target Penerima + Preview        --}}
                    {{-- ============================================ --}}
                    <div style="display: flex; flex-direction: column; gap: 20px; overflow-y: auto; padding-right: 4px; height: 100%; min-height: 0;">

                        {{-- ===== TARGET PENERIMA ===== --}}
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <div class="px-4 py-3 bg-navy flex items-center space-x-2">
                                <svg class="w-4 h-4 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <h3 class="text-[11px] font-bold text-white uppercase tracking-wider">Target Penerima</h3>
                            </div>
                            <div class="p-3 space-y-2">
                                <div class="flex flex-col gap-2">
                                    <button type="button" @click="setKategori('semua')"
                                        :class="kategori === 'semua' ? 'bg-navy text-white border-navy shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:border-navy/40 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-lg text-xs font-semibold transition-all duration-150">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Semua Klien
                                    </button>
                                    <button type="button" @click="setKategori('sektor')"
                                        :class="kategori === 'sektor' ? 'bg-navy text-white border-navy shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:border-navy/40 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-lg text-xs font-semibold transition-all duration-150">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        Sektor Bisnis
                                    </button>
                                    <button type="button" @click="setKategori('kebutuhan')"
                                        :class="kategori === 'kebutuhan' ? 'bg-navy text-white border-navy shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:border-navy/40 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-lg text-xs font-semibold transition-all duration-150">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        Kebutuhan Layanan
                                    </button>
                                </div>
                                <input type="hidden" name="kategori" :value="kategori">

                                {{-- Sektor Chips --}}
                                <div x-show="kategori === 'sektor'" x-transition.duration.150ms class="border-t border-gray-100 pt-3 mt-1">
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-2 uppercase tracking-widest">Pilih Sektor</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($sektorList as $s)
                                            <button type="button" @click="selectNilai('{{ $s }}')"
                                                :class="nilai === '{{ $s }}' ? 'bg-gold text-navy border-gold font-bold shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-gold/60 hover:bg-amber-50'"
                                                class="px-2.5 py-1.5 border rounded-md text-[11px] font-medium transition-all duration-150 cursor-pointer">{{ $s }}</button>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Kebutuhan Chips --}}
                                <div x-show="kategori === 'kebutuhan'" x-transition.duration.150ms class="border-t border-gray-100 pt-3 mt-1">
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-2 uppercase tracking-widest">Pilih Kebutuhan</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($kebutuhanList as $k)
                                            <button type="button" @click="selectNilai('{{ $k }}')"
                                                :class="nilai === '{{ $k }}' ? 'bg-gold text-navy border-gold font-bold shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-gold/60 hover:bg-amber-50'"
                                                class="px-2.5 py-1.5 border rounded-md text-[11px] font-medium transition-all duration-150 cursor-pointer">{{ $k }}</button>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="nilai" :value="nilai">

                                {{-- Counter badge --}}
                                <div x-show="targetCount !== null" x-transition.duration.150ms
                                    class="bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-2.5 flex items-center space-x-2.5 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">Total Kontak</p>
                                        <p class="text-lg font-bold text-emerald-700 leading-tight"><span x-text="targetCount"></span> <span class="text-xs font-medium text-emerald-600/80">penerima</span></p>
                                    </div>
                                </div>

                                {{-- Empty state --}}
                                <div x-show="targetCount === null" class="rounded-lg bg-gray-50 border border-dashed border-gray-200 py-3 px-3 text-center mt-1">
                                    <p class="text-[11px] text-gray-500 font-medium">Pilih kategori spesifik untuk melihat jumlah target pesan</p>
                                </div>
                            </div>
                        </div>

                        {{-- ===== PREVIEW WA ===== --}}
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm flex flex-col flex-1 min-h-[300px]">
                            <div class="px-4 py-3 bg-navy flex items-center space-x-2 flex-shrink-0">
                                <svg class="w-4 h-4 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <h3 class="text-[11px] font-bold text-white uppercase tracking-wider">Preview Pesan</h3>
                            </div>
                            <div class="p-3 flex flex-col flex-1 min-h-0">
                                <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm flex flex-col flex-1 min-h-0">
                                    <div class="px-3 py-2 flex items-center gap-3 flex-shrink-0" style="background-color: #075E54;">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: rgba(255,255,255,0.2);">
                                            <svg class="w-5 h-5" style="color: rgba(255,255,255,0.8);" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-white text-[12px] font-semibold leading-tight truncate">[Nama PIC]</p>
                                            <p class="text-[10px]" style="color: #b2dfdb;">online</p>
                                        </div>
                                        <svg class="w-4 h-4" style="color: rgba(255,255,255,0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div class="px-3 py-3 flex-1 overflow-y-auto" style="background-color: #ECE5DD;">
                                        <div class="flex justify-center mb-2">
                                            <span class="bg-white/60 text-gray-500 text-[9px] px-2 py-0.5 rounded-full">Hari ini</span>
                                        </div>
                                        <div class="flex justify-end">
                                            <div class="relative rounded-xl rounded-tr-none shadow-sm max-w-[88%] px-3 py-2" style="background-color: #DCF8C6;">
                                                <p class="text-[11.5px] text-gray-800 leading-relaxed whitespace-pre-wrap break-words" x-text="previewText"></p>
                                                <div class="flex items-center justify-end mt-1 space-x-1">
                                                    <span class="text-[9px] text-gray-500" x-text="currentTime"></span>
                                                    <svg class="w-3 h-3" style="color: #53bdeb;" fill="currentColor" viewBox="0 0 24 24"><path d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>{{-- end kolom kiri --}}

                    {{-- ============================================ --}}
                    {{-- KOLOM KANAN: Tulis Isi Pesan                 --}}
                    {{-- ============================================ --}}
                    <div style="display: flex; flex-direction: column; min-height: 0; height: 100%;">
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm flex flex-col flex-1">
                            <div class="px-4 py-3 bg-navy flex items-center space-x-2 flex-shrink-0">
                                <svg class="w-4 h-4 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                <h3 class="text-[11px] font-bold text-white uppercase tracking-wider">Tulis Isi Pesan</h3>
                            </div>

                            {{-- Body card kanan: flex column, isi penuh --}}
                            <div class="flex flex-col flex-1 p-4 gap-3 min-h-0 overflow-y-auto">

                                {{-- Info banner --}}
                                <div class="flex items-start gap-2.5 bg-sky-50 border border-sky-200 rounded-lg px-3 py-2.5 flex-shrink-0">
                                    <svg class="w-4 h-4 text-sky-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div class="flex-1">
                                        <p class="text-[11px] text-sky-800 leading-relaxed">
                                            <strong>"Halo [Nama],"</strong> dan <strong>"Salam, Tim Nawasena"</strong> otomatis ditambahkan. Anda bisa menyisipkan nama di dalam pesan utama dengan mengetik <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100">{nama}</code> atau <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100">{pic}</code>.
                                        </p>
                                    </div>
                                    <button type="button" @click="resetPesan()" class="text-[10px] bg-white border border-sky-200 text-sky-600 px-2 py-1 rounded hover:bg-sky-100 transition-colors flex-shrink-0 shadow-sm font-semibold">
                                        Reset Template
                                    </button>
                                </div>

                                {{-- Format hint --}}
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <span class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Format WA:</span>
                                    <div class="flex items-center gap-1">
                                        <code class="bg-gray-100 px-1.5 py-0.5 rounded text-[10px] font-mono text-gray-600">*tebal*</code>
                                        <span class="text-gray-300">·</span>
                                        <code class="bg-gray-100 px-1.5 py-0.5 rounded text-[10px] font-mono text-gray-600">_miring_</code>
                                        <span class="text-gray-300">·</span>
                                        <code class="bg-gray-100 px-1.5 py-0.5 rounded text-[10px] font-mono text-gray-600">~coret~</code>
                                    </div>
                                </div>

                                {{-- Textarea --}}
                                <div class="flex-1 flex flex-col">
                                    <textarea id="pesan_wa" name="pesan" x-model="pesan"
                                        class="flex-1 w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:border-gold focus:ring-1 focus:ring-gold bg-white transition-all duration-150 resize-none leading-relaxed placeholder-gray-400"
                                        style="min-height: 250px;"
                                        placeholder="Tulis isi pesan Anda di sini..."></textarea>
                                    @error('pesan') <span class="text-xs text-red-500 mt-1.5 block flex-shrink-0">{{ $message }}</span> @enderror
                                </div>

                                {{-- Footer: info target + tombol kirim — SELALU di bawah --}}
                                <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 12px; border-top: 1px solid #f3f4f6; flex-shrink: 0;">
                                    {{-- Kiri: info target --}}
                                    <div>
                                        <div x-show="targetCount !== null && targetCount > 0" x-transition class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center" style="background-color: rgba(37, 211, 102, 0.1);">
                                                <svg class="w-3.5 h-3.5" style="color: #25D366;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            </div>
                                            <span class="text-xs text-gray-600">Dikirim ke <strong class="text-navy" x-text="targetCount"></strong> kontak</span>
                                        </div>
                                        <div x-show="!targetCount || targetCount === 0" class="flex items-center gap-1.5">
                                            <span class="text-[11px] text-gray-400 italic">Belum ada target dipilih</span>
                                        </div>
                                    </div>

                                    {{-- Kanan: char count + tombol kirim --}}
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] text-gray-400" x-text="pesan.length + ' karakter'"></span>
                                        <button type="submit" :disabled="isSendDisabled"
                                            class="btn-hover inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200 shadow-sm"
                                            :style="isSendDisabled ? 'background-color: #25D366; color: white; opacity: 0.5; cursor: not-allowed;' : 'background-color: #25D366; color: white;'">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            <span x-text="buttonText"></span>
                                        </button>
                                    </div>
                                </div>

                            </div>{{-- end body kanan --}}
                        </div>
                    </div>{{-- end kolom kanan --}}

                </div>
            </form>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blastForm', () => ({
                kategori: '',
                nilai: '',
                targetCount: null,
                defaultPesan: 'Kami melihat bisnis {nama} memiliki potensi besar. Oleh karena itu, kami ingin menginformasikan layanan terbaru dari Nawasena Cyberlabs yang relevan untuk meningkatkan performa bisnis Anda. Untuk informasi lebih lanjut atau konsultasi gratis, silakan hubungi kami.',
                pesan: '',

                init() {
                    this.pesan = this.defaultPesan;
                },

                resetPesan() {
                    this.pesan = this.defaultPesan;
                },

                get previewText() {
                    let isi = this.pesan && this.pesan.trim() ? this.pesan : '...';
                    isi = isi.replace(/\{nama\}/gi, '[Nama Klien]').replace(/\{pic\}/gi, '[Nama PIC]');
                    return 'Halo [Nama PIC],\n\n' + isi + '\n\nSalam,\nTim Nawasena';
                },

                get currentTime() {
                    const now = new Date();
                    return now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
                },

                setKategori(val) {
                    this.kategori = val;
                    this.nilai = '';
                    this.targetCount = null;
                    if (val === 'semua') this.countTarget();
                },

                selectNilai(val) {
                    this.nilai = val;
                    this.countTarget();
                },

                countTarget() {
                    if (this.kategori === 'semua' || (this.kategori && this.nilai)) {
                        fetch(`{{ route('admin.blast.count') }}?kategori=${this.kategori}&nilai=${encodeURIComponent(this.nilai)}`)
                            .then(r => r.json())
                            .then(d => { this.targetCount = d.count; });
                    } else {
                        this.targetCount = null;
                    }
                },

                get isSendDisabled() {
                    const ok = this.pesan && this.pesan.trim().length >= 10;
                    if (this.kategori === 'semua') return !ok || !this.targetCount;
                    if (this.kategori && this.nilai) return !ok || !this.targetCount;
                    return true;
                },

                get buttonText() {
                    if (!this.kategori || (this.kategori !== 'semua' && !this.nilai)) return 'Pilih Target Dulu';
                    if (!this.pesan || this.pesan.trim().length < 10) return 'Tulis Pesan Dulu';
                    if (!this.targetCount) return 'Target Kosong';
                    return 'Kirim ke ' + this.targetCount + ' Kontak';
                }
            }))
        })
    </script>
    @endpush
</x-app-layout>