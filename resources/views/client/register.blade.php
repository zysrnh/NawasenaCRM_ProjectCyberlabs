<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Klien - Nawasena CRM</title>
    <meta name="description" content="Form registrasi klien Nawasena. Daftarkan bisnis Anda untuk mendapatkan layanan terbaik dari kami.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-group { animation: fadeInUp 0.5s ease-out both; }
        .form-group:nth-child(1) { animation-delay: 0.05s; }
        .form-group:nth-child(2) { animation-delay: 0.10s; }
        .form-group:nth-child(3) { animation-delay: 0.15s; }
        .form-group:nth-child(4) { animation-delay: 0.20s; }
        .form-group:nth-child(5) { animation-delay: 0.25s; }
        .form-group:nth-child(6) { animation-delay: 0.30s; }
        .form-group:nth-child(7) { animation-delay: 0.35s; }
        .form-group:nth-child(8) { animation-delay: 0.40s; }
        .form-group:nth-child(9) { animation-delay: 0.45s; }
        input, select, textarea { transition: border-color 0.2s ease, box-shadow 0.2s ease; }
        .btn-submit { transition: background-color 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(250, 185, 91, 0.3); }
        .btn-submit:active { transform: translateY(0); box-shadow: none; }
    </style>
</head>
<body class="bg-nw-light text-gray-900 antialiased" x-data="clientForm()">

    <!-- Top accent bar -->
    <div class="h-1 bg-gold w-full"></div>

    <div class="min-h-screen flex flex-col items-center px-4 py-8 sm:py-12">

        <!-- Header -->
        <div class="mb-6 text-center" style="animation: fadeInUp 0.4s ease-out both;">
            <img src="{{ asset('img/nawasena-logo-white.png') }}" alt="Nawasena" class="h-10 sm:h-12 mx-auto mb-4 bg-navy p-2 rounded">
            <h1 class="text-2xl sm:text-3xl font-bold text-navy tracking-tight">Registrasi Klien</h1>
            <p class="text-nw-body mt-1 text-sm sm:text-base">Lengkapi data di bawah untuk mendaftar sebagai klien Nawasena</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="w-full max-w-2xl mb-4 p-4 bg-red-50 text-red-700 border border-red-200 rounded text-sm" style="animation: fadeInUp 0.3s ease-out both;">
                <p class="font-semibold mb-1">Terdapat kesalahan pada isian Anda:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded overflow-hidden">

            <!-- Card header -->
            <div class="px-5 sm:px-8 py-5 border-b border-gray-200 bg-navy">
                <h2 class="font-semibold text-white text-sm uppercase tracking-wider">Data Klien</h2>
            </div>

            <form method="POST" action="{{ route('client.store') }}" class="px-5 sm:px-8 py-6 space-y-5">
                @csrf

                <div class="form-group">
                    <label for="nama_klien" class="block text-sm font-medium text-navy mb-1">Nama Lengkap Klien / Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_klien" name="nama_klien" value="{{ old('nama_klien') }}" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Contoh: PT. Nawasena Nusantara">
                </div>

                <div class="form-group grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pic" class="block text-sm font-medium text-navy mb-1">Nama PIC (Person in Charge)</label>
                        <p class="text-xs text-nw-body mb-1.5">Wajib jika atas nama Perusahaan</p>
                        <input type="text" id="nama_pic" name="nama_pic" value="{{ old('nama_pic') }}" class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Contoh: Budi Santoso">
                    </div>
                    <div>
                        <label for="jabatan_pic" class="block text-sm font-medium text-navy mb-1">Jabatan PIC</label>
                        <p class="text-xs text-nw-body mb-1.5">Misal: Direktur, Legal Manager, HRD</p>
                        <input type="text" id="jabatan_pic" name="jabatan_pic" value="{{ old('jabatan_pic') }}" class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Contoh: Direktur">
                    </div>
                </div>

                <div class="form-group border-t border-gray-100"></div>

                <div class="form-group grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-navy mb-1">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                        <p class="text-xs text-nw-body mb-1.5">Gunakan format +628...</p>
                        <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="+6281234567890">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-navy mb-1">Alamat Email Utama <span class="text-red-500">*</span></label>
                        <p class="text-xs text-nw-body mb-1.5">Email aktif untuk info & newsletter</p>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="email@perusahaan.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="block text-sm font-medium text-navy mb-1">Alamat Domisili / Kantor <span class="text-red-500">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400 resize-none" placeholder="Jalan Raya No. 123, Kota...">{{ old('alamat') }}</textarea>
                </div>

                <div class="form-group border-t border-gray-100"></div>
                <div class="form-group">
                    <h3 class="font-semibold text-navy text-sm uppercase tracking-wider">Informasi Tambahan</h3>
                </div>

                <div class="form-group">
                    <label for="sektor_bisnis" class="block text-sm font-medium text-navy mb-1">Sektor / Industri Bisnis <span class="text-red-500">*</span></label>
                    <select id="sektor_bisnis" name="sektor_bisnis" x-model="sektor" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none bg-white">
                        <option value="" disabled>Pilih Sektor Bisnis...</option>
                        <template x-for="item in sektorOptions" :key="item">
                            <option :value="item" x-text="item"></option>
                        </template>
                        <option value="Lainnya">Lain-lain (Isi sendiri)</option>
                    </select>
                    <div x-show="sektor === 'Lainnya'" x-transition.duration.200ms class="mt-2">
                        <input type="text" name="sektor_bisnis_lainnya" value="{{ old('sektor_bisnis_lainnya') }}" class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Sebutkan sektor bisnis Anda...">
                    </div>
                </div>

                <div class="form-group">
                    <label for="kebutuhan_utama" class="block text-sm font-medium text-navy mb-1">Kebutuhan Utama Layanan <span class="text-red-500">*</span></label>
                    <select id="kebutuhan_utama" name="kebutuhan_utama" x-model="kebutuhan" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none bg-white">
                        <option value="" disabled>Pilih Kebutuhan Layanan...</option>
                        <template x-for="item in kebutuhanOptions" :key="item">
                            <option :value="item" x-text="item"></option>
                        </template>
                        <option value="Lainnya">Lain-lain (Isi sendiri)</option>
                    </select>
                    <div x-show="kebutuhan === 'Lainnya'" x-transition.duration.200ms class="mt-2">
                        <input type="text" name="kebutuhan_utama_lainnya" value="{{ old('kebutuhan_utama_lainnya') }}" class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Sebutkan kebutuhan layanan Anda...">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sumber_info" class="block text-sm font-medium text-navy mb-1">Dari Mana Anda Mengetahui Kami? <span class="text-red-500">*</span></label>
                    <select id="sumber_info" name="sumber_info" x-model="sumber" required class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none bg-white">
                        <option value="" disabled>Pilih Sumber Informasi...</option>
                        <option value="Instagram">Instagram</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="BNI Unity">BNI Unity</option>
                        <option value="Rekomendasi Teman">Rekomendasi Teman / Kolega</option>
                        <option value="Pencarian Google">Pencarian Google</option>
                        <option value="Lainnya">Lain-lain (Isi sendiri)</option>
                    </select>
                    <div x-show="sumber === 'Lainnya'" x-transition.duration.200ms class="mt-2">
                        <input type="text" name="sumber_info_lainnya" value="{{ old('sumber_info_lainnya') }}" class="block w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Sebutkan dari mana Anda tahu kami...">
                    </div>
                </div>

                <div class="form-group pt-4 border-t border-gray-100">
                    <button type="submit" class="btn-submit w-full px-6 py-3 bg-gold font-semibold text-sm text-navy rounded focus:outline-none focus:ring-2 focus:ring-gold focus:ring-offset-2 hover:bg-gold-dark">
                        KIRIM REGISTRASI
                    </button>
                    <p class="text-xs text-nw-body text-center mt-3">Data Anda akan disimpan dan dikelola sesuai kebijakan privasi kami.</p>
                </div>
            </form>
        </div>

        <!-- Contact -->
        <div class="mt-8 text-center" style="animation: fadeInUp 0.5s ease-out 0.5s both;">
            <div class="inline-flex items-center justify-center space-x-2 text-sm text-nw-body bg-white px-4 py-2 rounded-full border border-gray-200 shadow-sm transition-transform duration-300 hover:-translate-y-1 hover:shadow-md group">
                <span>Butuh bantuan? Hubungi kami di</span>
                <a href="https://wa.me/62811869212" class="inline-flex items-center text-[#25D366] font-semibold transition-colors group-hover:text-[#128C7E]">
                    <svg class="w-5 h-5 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    +62 811-869-212
                </a>
            </div>
            <p class="text-xs text-gray-400 mt-4">&copy; {{ date('Y') }} Nawasena. All rights reserved.</p>
        </div>
    </div>

    <script>
        function clientForm() {
            return {
                sektor: '{{ old('sektor_bisnis', '') }}',
                kebutuhan: '{{ old('kebutuhan_utama', '') }}',
                sumber: '{{ old('sumber_info', '') }}',
                sektorOptions: [],
                kebutuhanOptions: [],

                init() {
                    fetch('/api/kategori')
                        .then(res => res.json())
                        .then(data => {
                            this.sektorOptions = data.sektor || [];
                            this.kebutuhanOptions = data.kebutuhan || [];
                        })
                        .catch(() => {
                            // Fallback hardcoded jika API gagal
                            this.sektorOptions = ['IT', 'F&B', 'Manufaktur', 'Kesehatan', 'Pendidikan'];
                            this.kebutuhanOptions = ['Pengembangan Website / Web App', 'Pengembangan Aplikasi Mobile', 'Desain UI/UX & Branding', 'Konsultasi IT & Sistem Bisnis', 'Digital Marketing'];
                        });
                }
            }
        }
    </script>
</body>
</html>
