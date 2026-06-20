<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-navy">Edit Data Klien</h1>
                <p class="text-sm text-nw-body mt-0.5">Perbarui informasi klien yang sudah terdaftar.</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="btn-hover inline-flex items-center px-3 py-1.5 border border-gray-300 text-navy text-xs font-medium rounded hover:bg-gray-50">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="adminClientEditForm()">

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

            <form method="POST" action="{{ route('admin.clients.update', $client) }}" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                @csrf
                @method('PUT')
                
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="font-semibold text-navy text-sm uppercase tracking-wider">Informasi Klien</h2>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Row 1: Nama & Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_klien" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nama Perusahaan / Klien <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_klien" name="nama_klien" value="{{ old('nama_klien', $client->nama_klien) }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="PT. ABC">
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Email Klien <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $client->email) }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="email@contoh.com">
                        </div>
                    </div>

                    {{-- Row 2: PIC --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="nama_pic" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Nama PIC</label>
                            <input type="text" id="nama_pic" name="nama_pic" value="{{ old('nama_pic', $client->nama_pic) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Budi Santoso">
                        </div>
                        <div>
                            <label for="jabatan_pic" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Jabatan PIC</label>
                            <input type="text" id="jabatan_pic" name="jabatan_pic" value="{{ old('jabatan_pic', $client->jabatan_pic) }}" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="Direktur">
                        </div>
                        <div>
                            <label for="nomor_telepon" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">No. Telepon / WA <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <select name="kode_negara" class="block w-[76px] px-2 py-2 border border-gray-300 border-r-0 rounded-l-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none outline-none focus:ring-0 bg-gray-50 text-gray-600 text-center">
                                    <option value="+62" {{ old('kode_negara', $kode_negara) == '+62' ? 'selected' : '' }}>+62</option>
                                    <option value="+60" {{ old('kode_negara', $kode_negara) == '+60' ? 'selected' : '' }}>+60</option>
                                    <option value="+65" {{ old('kode_negara', $kode_negara) == '+65' ? 'selected' : '' }}>+65</option>
                                    <option value="+66" {{ old('kode_negara', $kode_negara) == '+66' ? 'selected' : '' }}>+66</option>
                                    <option value="+63" {{ old('kode_negara', $kode_negara) == '+63' ? 'selected' : '' }}>+63</option>
                                    <option value="+84" {{ old('kode_negara', $kode_negara) == '+84' ? 'selected' : '' }}>+84</option>
                                    <option value="+1" {{ old('kode_negara', $kode_negara) == '+1' ? 'selected' : '' }}>+1</option>
                                    <option value="+44" {{ old('kode_negara', $kode_negara) == '+44' ? 'selected' : '' }}>+44</option>
                                    <option value="+61" {{ old('kode_negara', $kode_negara) == '+61' ? 'selected' : '' }}>+61</option>
                                    <option value="+81" {{ old('kode_negara', $kode_negara) == '+81' ? 'selected' : '' }}>+81</option>
                                    <option value="+82" {{ old('kode_negara', $kode_negara) == '+82' ? 'selected' : '' }}>+82</option>
                                    <option value="+86" {{ old('kode_negara', $kode_negara) == '+86' ? 'selected' : '' }}>+86</option>
                                    <option value="+91" {{ old('kode_negara', $kode_negara) == '+91' ? 'selected' : '' }}>+91</option>
                                </select>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $nomor_telepon) }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-r-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none" placeholder="8123456789">
                            </div>
                        </div>
                    </div>

                    {{-- Row 3: Alamat --}}
                    <div>
                        <label for="alamat" class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Alamat <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" rows="2" required class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy focus:ring-1 focus:ring-navy focus:outline-none resize-none" placeholder="Alamat lengkap...">{{ old('alamat', $client->alamat) }}</textarea>
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
                                <option value="Pencarian Google">Pencarian Google</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <div x-show="sumber === 'Lainnya'" class="mt-2">
                                <input type="text" name="sumber_info_lainnya" class="block w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:border-navy" placeholder="Sebutkan sumber...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="btn-hover bg-gold text-navy px-6 py-2.5 rounded-md text-sm font-bold shadow-sm hover:bg-yellow-500 focus:ring-2 focus:ring-gold focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function adminClientEditForm() {
            return {
                sektor: '{{ old('sektor_bisnis', $client->sektor_bisnis) }}',
                kebutuhan: '{{ old('kebutuhan_utama', $client->kebutuhan_utama) }}',
                sumber: '{{ old('sumber_info', $client->sumber_info) }}'
            }
        }
    </script>
</x-app-layout>
