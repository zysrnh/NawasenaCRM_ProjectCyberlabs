<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold text-navy">WhatsApp Blast</h1>
            <p class="text-sm text-nw-body mt-0.5">Kirim pesan WhatsApp massal berdasarkan kategori klien.</p>
        </div>
    </x-slot>

    <div class="py-6" x-data="blastForm()">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flash-msg mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded flex items-start space-x-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-sm font-bold text-emerald-800">Berhasil!</h3>
                        <p class="text-sm text-emerald-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-msg mb-4 p-4 bg-red-50 border border-red-200 rounded flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-sm font-bold text-red-800">Gagal</h3>
                        <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded overflow-hidden shadow-sm animate-fade-in">
                <div class="px-6 py-5 border-b border-gray-100 bg-nw-light/50 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <h2 class="text-sm font-bold text-navy uppercase tracking-wider">Pengaturan Blast</h2>
                </div>

                <form method="POST" action="{{ route('admin.blast.send') }}" class="p-6 space-y-6">
                    @csrf
                    
                    {{-- Filter Target --}}
                    <div class="bg-gray-50 border border-gray-200 rounded p-5 space-y-4">
                        <h3 class="text-sm font-semibold text-navy">1. Tentukan Target Penerima</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-nw-body mb-1">Pilih Kategori</label>
                                <select x-model="kategori" name="kategori" @change="updateOptions" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold bg-white transition-colors">
                                    <option value="" disabled selected>-- Pilih Kategori Filter --</option>
                                    <option value="semua">Semua Klien Terdaftar</option>
                                    <option value="sektor">Berdasarkan Sektor Bisnis</option>
                                    <option value="kebutuhan">Berdasarkan Kebutuhan Layanan</option>
                                </select>
                                @error('kategori') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div x-show="kategori !== 'semua' && kategori !== ''" x-transition>
                                <label class="block text-xs font-medium text-nw-body mb-1">Pilih Nilai Kategori</label>
                                <select x-model="nilai" name="nilai" @change="countTarget" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold bg-white transition-colors">
                                    <option value="">-- Pilih Nilai --</option>
                                    <template x-for="opt in optionsList" :key="opt">
                                        <option :value="opt" x-text="opt"></option>
                                    </template>
                                </select>
                                @error('nilai') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 text-sm" x-show="targetCount !== null" x-transition>
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-nw-body">Total target penerima:</span>
                            <span class="font-bold text-navy bg-gold/20 px-2 py-0.5 rounded text-xs" x-text="targetCount + ' Kontak'"></span>
                        </div>
                    </div>

                    {{-- Pesan Textarea --}}
                    <div>
                        <h3 class="text-sm font-semibold text-navy mb-2">2. Tulis Pesan WhatsApp</h3>
                        <p class="text-xs text-nw-body mb-3">Tuliskan pesan yang akan dikirim. Anda dapat mempersonalisasi pesan dengan variabel berikut:</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <button type="button" @click="insertText('{nama}')" class="px-2.5 py-1 bg-navy/5 border border-navy/10 hover:bg-navy/10 text-navy text-xs rounded transition-colors font-medium">{nama} (Nama Klien)</button>
                            <button type="button" @click="insertText('{pic}')" class="px-2.5 py-1 bg-navy/5 border border-navy/10 hover:bg-navy/10 text-navy text-xs rounded transition-colors font-medium">{pic} (Nama PIC)</button>
                        </div>
                        
                        <textarea id="pesan_wa" x-ref="pesan" name="pesan" rows="8" class="block w-full px-4 py-3 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold bg-white transition-colors resize-y leading-relaxed" placeholder="Halo {nama},&#10;&#10;Kami dari Nawasena ingin menginformasikan layanan terbaru kami yang relevan dengan sektor Anda..."></textarea>
                        @error('pesan') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        
                        <p class="text-xs text-gray-400 mt-2 text-right">Mendukung format standar WhatsApp: *tebal*, _miring_, ~coret~.</p>
                    </div>

                    {{-- Submit --}}
                    <div class="border-t border-gray-100 pt-5 flex justify-end">
                        <button type="submit" :disabled="isSendDisabled" class="btn-hover inline-flex items-center px-6 py-2.5 bg-navy text-white text-sm font-medium rounded hover:bg-navy-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Kirim Blast Sekarang
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded animate-fade-in" style="animation-delay: 0.15s;">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div class="text-xs text-yellow-800 leading-relaxed">
                        <strong class="font-bold">Informasi Sistem:</strong> Fitur ini memproses data berdasarkan filter "Sektor Bisnis" atau "Kebutuhan Utama" seperti yang dicatat pada registrasi awal. Pastikan Anda telah mengonfigurasi API Gateway WhatsApp pada Backend sistem untuk benar-benar mengirim pesan.
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blastForm', () => ({
                kategori: '',
                nilai: '',
                optionsList: [],
                targetCount: null,
                
                // Data from server injected via Blade
                sektorList: @json($sektorList),
                kebutuhanList: @json($kebutuhanList),

                init() {
                    this.$watch('kategori', value => {
                        this.nilai = '';
                        this.targetCount = null;
                        this.updateOptions();
                        if (value === 'semua') {
                            this.countTarget();
                        }
                    });
                },

                updateOptions() {
                    if (this.kategori === 'sektor') {
                        this.optionsList = this.sektorList;
                    } else if (this.kategori === 'kebutuhan') {
                        this.optionsList = this.kebutuhanList;
                    } else {
                        this.optionsList = [];
                    }
                },

                countTarget() {
                    if (this.kategori === 'semua' || (this.kategori && this.nilai)) {
                        fetch(`{{ route('admin.blast.count') }}?kategori=${this.kategori}&nilai=${encodeURIComponent(this.nilai)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.targetCount = data.count;
                            });
                    } else {
                        this.targetCount = null;
                    }
                },

                get isSendDisabled() {
                    if (this.kategori === 'semua') return this.targetCount === null || this.targetCount === 0;
                    if (this.kategori && this.nilai) return this.targetCount === null || this.targetCount === 0;
                    return true;
                },

                insertText(text) {
                    const textarea = this.$refs.pesan;
                    const startPos = textarea.selectionStart;
                    const endPos = textarea.selectionEnd;
                    
                    const before = textarea.value.substring(0, startPos);
                    const after = textarea.value.substring(endPos, textarea.value.length);
                    
                    textarea.value = before + text + after;
                    textarea.selectionStart = textarea.selectionEnd = startPos + text.length;
                    textarea.focus();
                }
            }))
        })
    </script>
    @endpush
</x-app-layout>
