<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-navy">Email Blast</h1>
                <p class="text-sm text-nw-body mt-0.5">Kirim email massal ke klien berdasarkan kategori.</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="btn-hover inline-flex items-center px-3 py-1.5 border border-gray-300 text-navy text-xs font-medium rounded hover:bg-gray-50">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="emailBlastForm()">

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

            <form method="POST" action="{{ route('admin.email_blast.send') }}">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5" style="align-items: start;">

                    {{-- ============================================ --}}
                    {{-- KOLOM KIRI: Target Penerima                  --}}
                    {{-- ============================================ --}}
                    <div class="flex flex-col gap-5">
                        {{-- ===== TARGET PENERIMA ===== --}}
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <div class="px-4 py-3 bg-navy flex items-center space-x-2">
                                <svg class="w-4 h-4 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <h3 class="text-[11px] font-bold text-white uppercase tracking-wider">Target Penerima (Email)</h3>
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
                                    <button type="button" @click="setKategori('klien')"
                                        :class="kategori === 'klien' ? 'bg-navy text-white border-navy shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:border-navy/40 hover:bg-gray-50'"
                                        class="w-full flex items-center gap-2.5 px-3 py-2.5 border rounded-lg text-xs font-semibold transition-all duration-150">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        Cari Nama Klien
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

                                {{-- Klien Select --}}
                                <div x-show="kategori === 'klien'" x-transition.duration.150ms class="border-t border-gray-100 pt-3 mt-1">
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-2 uppercase tracking-widest">Cari Nama Klien</label>
                                    <select :value="nilai" @change="selectNilai($event.target.value)" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none bg-white">
                                        <option value="" disabled selected>Pilih Klien...</option>
                                        @foreach ($klienList as $klien)
                                            <option value="{{ $klien->id }}">{{ $klien->nama_klien }} ({{ $klien->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="nilai" :value="nilai">

                                {{-- Counter badge --}}
                                <div x-show="targetCount !== null" x-transition.duration.150ms
                                    class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2.5 flex items-center space-x-2.5 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">Total Kontak</p>
                                        <p class="text-lg font-bold text-blue-700 leading-tight"><span x-text="targetCount"></span> <span class="text-xs font-medium text-blue-600/80">alamat email</span></p>
                                    </div>
                                </div>

                                {{-- Empty state --}}
                                <div x-show="targetCount === null" class="rounded-lg bg-gray-50 border border-dashed border-gray-200 py-3 px-3 text-center mt-1">
                                    <p class="text-[11px] text-gray-500 font-medium">Pilih kategori spesifik untuk melihat jumlah target email</p>
                                </div>
                            </div>
                        </div>

                    </div>{{-- end kolom kiri --}}

                    {{-- ============================================ --}}
                    {{-- KOLOM KANAN: Tulis Isi Email                 --}}
                    {{-- ============================================ --}}
                    <div>
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <div class="px-4 py-3 bg-navy flex items-center space-x-2">
                                <svg class="w-4 h-4 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                <h3 class="text-[11px] font-bold text-white uppercase tracking-wider">Tulis Konten Email</h3>
                            </div>

                            <div class="p-4 flex flex-col gap-3">

                                {{-- Info banner --}}
                                <div class="flex items-start gap-2.5 bg-sky-50 border border-sky-200 rounded-lg px-3 py-2.5">
                                    <svg class="w-4 h-4 text-sky-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div class="flex-1">
                                        <p class="text-[11px] text-sky-800 leading-relaxed">
                                            Anda bisa menyisipkan nama di dalam pesan utama dengan mengetik <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100">{nama}</code> atau <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100">{pic}</code>.
                                        </p>
                                    </div>
                                </div>

                                {{-- Subjek Email --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Subjek Email</label>
                                    <input type="text" name="subjek" x-model="subjek"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none bg-white"
                                        placeholder="Subjek email..." required>
                                    @error('subjek') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                {{-- Textarea --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Isi Pesan Email</label>
                                    <textarea id="pesan_email" name="pesan" x-model="pesan"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy bg-white transition-all duration-150 resize-y leading-relaxed placeholder-gray-400"
                                        style="min-height: 250px;"
                                        placeholder="Tulis isi pesan Anda di sini..."></textarea>
                                    @error('pesan') <span class="text-xs text-red-500 mt-1.5 block">{{ $message }}</span> @enderror
                                </div>

                                {{-- Footer: info target + tombol kirim --}}
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <div class="flex items-center gap-3 ml-auto">
                                        <span class="text-[10px] text-gray-400" x-text="pesan.length + ' karakter'"></span>
                                        <button type="submit" :disabled="isSendDisabled"
                                            class="btn-hover inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg transition-all duration-200 shadow-sm"
                                            :style="isSendDisabled ? 'background-color: #3b82f6; color: white; opacity: 0.5; cursor: not-allowed;' : 'background-color: #3b82f6; color: white;'">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
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
            Alpine.data('emailBlastForm', () => ({
                kategori: '',
                nilai: '',
                targetCount: null,
                subjek: 'Informasi Layanan Terbaru Nawasena Cyberlabs',
                defaultPesan: 'Halo {pic},\n\nKami melihat bisnis {nama} memiliki potensi besar. Oleh karena itu, kami ingin menginformasikan layanan terbaru dari Nawasena Cyberlabs yang relevan untuk meningkatkan performa bisnis Anda.\n\nUntuk informasi lebih lanjut atau konsultasi gratis, silakan hubungi kami atau balas email ini.\n\nSalam Hangat,\nTim Nawasena Cyberlabs',
                pesan: '',

                init() {
                    this.pesan = this.defaultPesan;
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
                        fetch(`{{ route('admin.email_blast.count') }}?kategori=${this.kategori}&nilai=${encodeURIComponent(this.nilai)}`)
                            .then(r => r.json())
                            .then(d => { this.targetCount = d.count; });
                    } else {
                        this.targetCount = null;
                    }
                },

                get isSendDisabled() {
                    const ok = this.pesan && this.pesan.trim().length >= 10 && this.subjek && this.subjek.trim().length >= 5;
                    if (this.kategori === 'semua') return !ok || !this.targetCount;
                    if (this.kategori && this.nilai) return !ok || !this.targetCount;
                    return true;
                },

                get buttonText() {
                    if (!this.kategori || (this.kategori !== 'semua' && !this.nilai)) return 'Pilih Target';
                    if (!this.subjek || this.subjek.trim().length < 5) return 'Isi Subjek';
                    if (!this.pesan || this.pesan.trim().length < 10) return 'Tulis Pesan';
                    if (!this.targetCount) return 'Target Kosong';
                    return 'Kirim ke ' + this.targetCount + ' Email';
                }
            }))
        })
    </script>
    @endpush
</x-app-layout>
