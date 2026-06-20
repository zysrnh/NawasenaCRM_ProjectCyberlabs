<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-navy">Tambah Data Klien</h1>
                <p class="text-sm text-nw-body mt-0.5">Daftarkan klien baru secara manual dari sisi Admin.</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="btn-hover inline-flex items-center px-3 py-1.5 border border-gray-300 text-navy text-xs font-medium rounded hover:bg-gray-50">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="adminClientForm()">

            @if ($errors->any())
                <div class="flash-msg mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 font-medium">
                    <p class="font-bold mb-1 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Terdapat kesalahan:
                    </p>
                    <ul class="list-disc list-inside ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.clients.store') }}" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                @csrf
                
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="font-semibold text-navy text-sm uppercase tracking-wider">Informasi Klien</h2>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Row 1: Nama & Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_klien" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nama Perusahaan / Klien <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_klien" name="nama_klien" value="{{ old('nama_klien') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="PT. ABC">
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Email Klien <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="email@contoh.com">
                        </div>
                    </div>

                    {{-- Row 2: PIC --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="nama_pic" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nama PIC</label>
                            <input type="text" id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Budi Santoso">
                        </div>
                        <div>
                            <label for="jabatan_pic" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Jabatan PIC</label>
                            <input type="text" id="jabatan_pic" name="jabatan_pic" value="{{ old('jabatan_pic') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Direktur">
                        </div>
                        <div>
                            <label for="nomor_telepon" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">No. Telepon / WA <span class="text-red-500">*</span></label>
                            <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="+628123456789">
                        </div>
                    </div>

                    {{-- Row 3: Alamat --}}
                    <div>
                        <label for="alamat" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Alamat <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" rows="2" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none resize-none" placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Row 4: Kategori --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="sektor_bisnis" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Sektor Bisnis <span class="text-red-500">*</span></label>
                            <select id="sektor_bisnis" name="sektor_bisnis" x-model="sektor" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none bg-white">
                                <option value="" disabled>Pilih Sektor...</option>
                                @foreach($sektorList as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <div x-show="sektor === 'Lainnya'" class="mt-2">
                                <input type="text" name="sektor_bisnis_lainnya" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy" placeholder="Sebutkan sektor...">
                            </div>
                        </div>

                        <div>
                            <label for="kebutuhan_utama" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Kebutuhan <span class="text-red-500">*</span></label>
                            <select id="kebutuhan_utama" name="kebutuhan_utama" x-model="kebutuhan" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none bg-white">
                                <option value="" disabled>Pilih Kebutuhan...</option>
                                @foreach($kebutuhanList as $k)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endforeach
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <div x-show="kebutuhan === 'Lainnya'" class="mt-2">
                                <input type="text" name="kebutuhan_utama_lainnya" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy" placeholder="Sebutkan kebutuhan...">
                            </div>
                        </div>

                        <div>
                            <label for="sumber_info" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Sumber Info <span class="text-red-500">*</span></label>
                            <select id="sumber_info" name="sumber_info" x-model="sumber" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none bg-white">
                                <option value="" disabled>Pilih Sumber...</option>
                                <option value="Admin Input">Input Admin</option>
                                <option value="Instagram">Instagram</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Rekomendasi Teman">Rekomendasi Teman</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <div x-show="sumber === 'Lainnya'" class="mt-2">
                                <input type="text" name="sumber_info_lainnya" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy" placeholder="Sebutkan sumber...">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Opsi Blast WA --}}
                <div class="px-6 py-5 bg-nw-light border-t border-gray-200">
                    <h3 class="font-bold text-navy text-sm uppercase tracking-wider mb-3">Tindakan Selanjutnya</h3>
                    <div class="flex gap-6 mb-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="blast_option" value="nanti" x-model="blastOption" class="text-navy focus:ring-navy">
                            <span class="text-sm font-medium text-gray-700">Simpan Data Saja (Blast Nanti)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="blast_option" value="langsung" x-model="blastOption" class="text-emerald-600 focus:ring-emerald-600">
                            <span class="text-sm font-medium text-emerald-700">Simpan & Kirim Pesan WA Langsung</span>
                        </label>
                    </div>

                    <div x-show="blastOption === 'langsung'" x-transition class="bg-white border border-gray-200 rounded-lg p-4 space-y-4">
                        <div>
                            <label for="pesan_blast" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Pesan WhatsApp yang dikirim</label>
                            <p class="text-[11px] text-gray-400 mb-2">Gunakan <code>{nama}</code> untuk Nama Klien dan <code>{pic}</code> untuk Nama PIC.</p>
                            <textarea id="pesan_blast" name="pesan_blast" x-model="pesan" rows="8" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none resize-y min-h-[120px]"></textarea>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="btn-hover bg-navy text-white px-5 py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-navy-dark focus:ring-2 focus:ring-navy focus:ring-offset-2">
                        <span x-text="blastOption === 'langsung' ? 'Simpan Klien & Kirim WA' : 'Simpan Data Klien'"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function adminClientForm() {
            return {
                sektor: '{{ old('sektor_bisnis', '') }}',
                kebutuhan: '{{ old('kebutuhan_utama', '') }}',
                sumber: '{{ old('sumber_info', 'Admin Input') }}',
                blastOption: '{{ old('blast_option', 'nanti') }}',
                pesan: `Halo {pic} dari {nama},\n\nTerima kasih telah mendaftar sebagai klien Nawasena. Kami siap membantu kebutuhan bisnis Anda.\n\nSalam,\nTim Nawasena`,
            }
        }
    </script>
</x-app-layout>
