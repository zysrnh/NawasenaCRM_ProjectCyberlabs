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
                            <input type="text" id="nama_klien" name="nama_klien" value="{{ old('nama_klien') }}" x-model="clientNama" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="PT. ABC">
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
                            <input type="text" id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}" x-model="clientPic" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Budi Santoso">
                        </div>
                        <div>
                            <label for="jabatan_pic" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Jabatan PIC</label>
                            <input type="text" id="jabatan_pic" name="jabatan_pic" value="{{ old('jabatan_pic') }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Direktur">
                        </div>
                        <div>
                            <label for="nomor_telepon" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">No. Telepon / WA <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <select name="kode_negara" class="block w-[76px] px-2 py-2 border border-gray-300 border-r-0 rounded-l-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none outline-none focus:ring-0 bg-gray-50 text-gray-600 text-center">
                                    <option value="+62">+62</option>
                                    <option value="+60">+60</option>
                                    <option value="+65">+65</option>
                                    <option value="+66">+66</option>
                                    <option value="+63">+63</option>
                                    <option value="+84">+84</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                    <option value="+61">+61</option>
                                    <option value="+81">+81</option>
                                    <option value="+82">+82</option>
                                    <option value="+86">+86</option>
                                    <option value="+91">+91</option>
                                </select>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-r-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="8123456789">
                            </div>
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

                    <div x-show="blastOption === 'langsung'" x-transition class="bg-white border border-gray-200 rounded-lg p-0 flex flex-col md:flex-row overflow-hidden shadow-sm mt-4">
                        {{-- Kolom Kiri: Preview WA --}}
                        <div class="w-full md:w-1/3 border-b md:border-b-0 md:border-r border-gray-200 flex flex-col" style="background-color: #f0f2f5; min-height: 280px;">
                            <div class="px-3 py-2 flex items-center gap-3 flex-shrink-0 shadow-sm z-10" style="background-color: #075E54;">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: rgba(255,255,255,0.2);">
                                    <svg class="w-5 h-5" style="color: rgba(255,255,255,0.8);" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white text-[12px] font-semibold leading-tight truncate" x-text="clientPic || clientNama || '[Nama PIC]'"></p>
                                    <p class="text-[10px]" style="color: #b2dfdb;">online</p>
                                </div>
                                <svg class="w-4 h-4" style="color: rgba(255,255,255,0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="px-3 py-3 flex-1 overflow-y-auto" style="background-color: #ECE5DD; background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');">
                                <div class="flex justify-center mb-3 mt-1">
                                    <span class="bg-white/70 text-gray-600 text-[9px] px-2.5 py-1 rounded-full shadow-sm font-medium">Hari ini</span>
                                </div>
                                <div class="flex justify-end">
                                    <div class="relative rounded-xl rounded-tr-none shadow-sm max-w-[90%] px-3 py-2" style="background-color: #DCF8C6;">
                                        <p class="text-[11.5px] text-gray-800 leading-relaxed whitespace-pre-wrap break-words" x-text="previewText"></p>
                                        <div class="flex items-center justify-end mt-1 space-x-1">
                                            <span class="text-[9px] text-gray-500" x-text="currentTime"></span>
                                            <svg class="w-3.5 h-3.5" style="color: #53bdeb;" fill="currentColor" viewBox="0 0 24 24"><path d="M18 7l-1.41-1.41-6.34 6.34 1.41 1.41L18 7zm4.24-1.41L11.66 16.17 7.48 12l-1.41 1.41L11.66 19l12-12-1.42-1.41zM.41 13.41L6 19l1.41-1.41L1.83 12 .41 13.41z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Input Pesan --}}
                        <div class="w-full md:w-2/3 p-5 flex flex-col bg-white">
                            <label for="pesan_blast" class="block text-xs font-bold text-navy uppercase tracking-widest mb-3">Tulis Pesan Utama</label>
                            
                            <div class="flex items-start gap-2 bg-sky-50 border border-sky-100 rounded-lg p-2.5 mb-4">
                                <svg class="w-4 h-4 text-sky-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-[10.5px] text-sky-800 leading-relaxed">
                                    <strong>"Halo [Nama],"</strong> dan <strong>"Salam, Tim Nawasena"</strong> otomatis ditambahkan oleh template Twilio. Anda cukup mengetik isi intinya saja. Gunakan <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100 shadow-sm">{nama}</code> atau <code class="bg-white px-1 py-0.5 rounded text-sky-600 font-bold border border-sky-100 shadow-sm">{pic}</code>.
                                </p>
                            </div>

                            <textarea id="pesan_blast" name="pesan_blast" x-model="pesan" rows="6" class="block w-full flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none resize-none bg-gray-50" placeholder="Ketik isi pesan di sini..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="btn-hover bg-gold text-navy px-6 py-2.5 rounded-md text-sm font-bold shadow-sm hover:bg-yellow-500 focus:ring-2 focus:ring-gold focus:ring-offset-2">
                        <span x-text="blastOption === 'langsung' ? 'Simpan Klien & Kirim WA' : 'Simpan Data Klien'"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function adminClientForm() {
            return {
                clientNama: '{{ old('nama_klien', '') }}',
                clientPic: '{{ old('nama_pic', '') }}',
                sektor: '{{ old('sektor_bisnis', '') }}',
                kebutuhan: '{{ old('kebutuhan_utama', '') }}',
                sumber: '{{ old('sumber_info', 'Admin Input') }}',
                blastOption: '{{ old('blast_option', 'nanti') }}',
                pesan: `Terima kasih telah mendaftar sebagai klien Nawasena. Kami siap membantu kebutuhan bisnis Anda.`,
                
                get previewText() {
                    let text = `Halo {{1}},\n\n{{2}}\n\nSalam,\nTim Nawasena Cyberlabs`;
                    let p = this.pesan || '';
                    
                    let namaVal = this.clientNama || '[Nama Klien]';
                    let picVal = this.clientPic || '[Nama PIC]';
                    let targetName = this.clientPic ? this.clientPic : (this.clientNama ? this.clientNama : '[Nama PIC/Klien]');
                    
                    p = p.replace(/{nama}/g, namaVal);
                    p = p.replace(/{pic}/g, picVal);
                    
                    text = text.replace('{{1}}', targetName);
                    text = text.replace('{{2}}', p);
                    
                    return text;
                },
                get currentTime() {
                    const now = new Date();
                    return now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
                }
            }
        }
    </script>
</x-app-layout>
