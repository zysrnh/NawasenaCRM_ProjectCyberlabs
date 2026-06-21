<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nawasena - Client Registration</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
    <meta name="description" content="Form registrasi klien Nawasena.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAFAFA; color: #263145; }
        .text-brand-gray { color: #263145; }
        .bg-brand-gray { background-color: #263145; }
        .text-brand-gold { color: #FAB95B; }
        .bg-brand-gold { background-color: #FAB95B; }
        .border-brand-gold { border-color: #FAB95B; }
        
        .wizard-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.375rem;
            background-color: #F8FAFC;
            font-size: 0.875rem;
            color: #475569;
            transition: all 0.2s ease;
        }
        .wizard-input::placeholder { color: #94A3B8; }
        .wizard-input:focus {
            outline: none;
            border-color: #FAB95B;
            box-shadow: 0 0 0 3px rgba(250, 185, 91, 0.2);
            background-color: #FFFFFF;
        }
        
        /* Custom Radio Button for Sektor */
        .radio-custom {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }
        .radio-custom input {
            display: none;
        }
        .radio-custom .checkmark {
            width: 1.25rem;
            height: 1.25rem;
            border: 1px solid #CBD5E1;
            border-radius: 50%;
            margin-right: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .radio-custom input:checked + .checkmark {
            border-color: #FAB95B;
        }
        .radio-custom input:checked + .checkmark::after {
            content: '';
            width: 0.625rem;
            height: 0.625rem;
            background-color: #FAB95B;
            border-radius: 50%;
        }

        .max-w-custom { max-width: 1100px; }
        .max-w-wizard { max-width: 700px; }
        .text-wizard-label { font-size: 11px; white-space: nowrap; margin-top: 8px; }
        .text-heading { font-size: 24px; }
        .text-tiny { font-size: 10px; }
        .min-h-card { min-height: 500px; }
        .w-left-panel { width: 35%; }
        .w-right-panel { width: 65%; }
        .watermark-img { width: 140%; max-width: none; opacity: 0.06; filter: grayscale(100%); }
    </style>
</head>
<body x-data="clientForm()">

    <!-- Topbar Header -->
    <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4 flex items-center justify-between relative z-20">
        <img src="{{ asset('img/logo-transparent-color.png') }}" alt="Nawasena Logo" class="h-10 object-contain">
    </header>

    <div class="max-w-custom mx-auto pt-6 pb-6 px-4">
        
        <!-- Wizard Progress Bar -->
        <div class="relative flex justify-between items-center mb-8 max-w-wizard mx-auto">
            <!-- Background Line -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-gray-200 z-0"></div>
            <!-- Active Line -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-brand-gold z-0 transition-all duration-500 ease-in-out" 
                 :style="'width: ' + ((step - 1) * 50) + '%'"></div>
            
            <!-- Step 1 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300"
                     :class="step >= 1 ? 'bg-brand-gold text-white shadow-md' : 'bg-white border-2 border-gray-200 text-gray-400'">
                    <span x-show="step === 1">1</span>
                    <svg x-show="step > 1" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="absolute top-10 text-wizard-label font-semibold" :class="step >= 1 ? 'text-brand-gold' : 'text-gray-400'">Biodata & Kontak</span>
            </div>
            
            <!-- Step 2 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300"
                     :class="step >= 2 ? 'bg-brand-gold text-white shadow-md' : 'bg-white border-2 border-gray-200 text-gray-400'">
                    <span x-show="step <= 2">2</span>
                    <svg x-show="step > 2" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="absolute top-10 text-wizard-label font-semibold" :class="step >= 2 ? 'text-brand-gold' : 'text-gray-400'">Alamat & Sektor Bisnis</span>
            </div>
            
            <!-- Step 3 -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-300"
                     :class="step >= 3 ? 'bg-brand-gold text-white shadow-md' : 'bg-white border-2 border-gray-200 text-gray-400'">3</div>
                <span class="absolute top-10 text-wizard-label font-semibold" :class="step >= 3 ? 'text-brand-gold' : 'text-gray-400'">Mengetahui Kami</span>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded-lg text-sm">
                <p class="font-semibold mb-1">Terdapat kesalahan:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 flex overflow-hidden min-h-card">
            
            <!-- Left Watermark Area (Hidden on mobile) -->
            <div class="hidden md:flex w-left-panel border-r border-gray-100 items-center justify-center relative overflow-hidden bg-white">
                <img src="{{ asset('img/nawasena-logo-bg-white.jpg-removebg-preview.png') }}" class="watermark-img object-contain select-none" alt="Watermark">
            </div>

            <!-- Right Form Area -->
            <div class="w-full md:w-right-panel p-6 md:p-10 relative">
                <form method="POST" action="{{ route('client.store') }}" id="mainForm" class="h-full flex flex-col justify-center">
                    @csrf
                    
                    <!-- STEP 1: Biodata & Kontak -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <h2 class="text-heading font-light text-brand-gray mb-1">MASUKKAN <span class="font-bold text-brand-gray">BIODATA & KONTAK</span> ANDA</h2>
                        <p class="text-sm text-gray-500 mb-6">Lengkapi data diri atau perusahaan Anda untuk mulai mengakses seluruh layanan yang tersedia.</p>
                        
                        <div class="space-y-3">
                            <div>
                                <input type="text" name="nama_klien" value="{{ old('nama_klien') }}" required class="wizard-input" placeholder="Nama Lengkap / Nama Perusahaan">
                            </div>
                            <div>
                                <input type="text" name="nama_pic" value="{{ old('nama_pic') }}" class="wizard-input" placeholder="Nama PIC (Person in Charge)">
                                <p class="text-tiny text-gray-400 mt-0.5 italic">Wajib diisi jika Anda adalah perusahaan</p>
                            </div>
                            <div>
                                <input type="text" name="jabatan_pic" value="{{ old('jabatan_pic') }}" class="wizard-input" placeholder="Jabatan PIC">
                            </div>
                            <div class="flex relative">
                                <select name="kode_negara" class="bg-brand-gray text-white pl-2 pr-6 rounded-l-lg border border-brand-gray text-sm font-medium focus:outline-none focus:ring-0 outline-none appearance-none cursor-pointer relative z-10 w-[76px] text-center">
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
                                <div class="absolute left-[52px] top-0 bottom-0 flex items-center pointer-events-none z-20">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required class="wizard-input !rounded-l-none !border-l-0 w-full" placeholder="Contoh: 8123456789">
                            </div>
                            <div>
                                <input type="email" name="email" value="{{ old('email') }}" required class="wizard-input" placeholder="Email">
                                <p class="text-tiny text-gray-400 mt-0.5 italic">Gunakan email aktif untuk mendapatkan newsletter/informasi</p>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between items-center">
                            <a href="{{ url('/') }}" class="text-sm font-medium text-brand-gray flex items-center hover:text-brand-gold transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                            </a>
                            <button type="button" @click="nextStep()" class="bg-brand-gold hover:bg-yellow-500 text-brand-gray font-semibold text-sm px-6 py-2.5 rounded shadow-sm transition-all flex items-center">
                                Selanjutnya <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Alamat & Sektor Bisnis -->
                    <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <h2 class="text-heading font-light text-brand-gray mb-1">MASUKKAN <span class="font-bold text-brand-gray">ALAMAT & SEKTOR BISNIS</span></h2>
                        <p class="text-sm text-gray-500 mb-5">Lengkapi alamat dan profil bisnis Anda untuk mempermudah proses registrasi.</p>
                        
                        <div class="space-y-3">
                            <div>
                                <textarea name="alamat" required rows="3" class="wizard-input resize-none" placeholder="Alamat Lengkap Domisili / Perusahaan">{{ old('alamat') }}</textarea>
                            </div>

                            <div class="pt-2">
                                <h3 class="text-sm font-bold text-brand-gray uppercase tracking-wider mb-2">Sektor Bisnis</h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-3">
                                    <template x-for="item in sektorOptions" :key="item">
                                        <label class="radio-custom text-sm text-gray-600">
                                            <input type="radio" name="sektor_bisnis" :value="item" x-model="sektor" required>
                                            <span class="checkmark"></span>
                                            <span x-text="item"></span>
                                        </label>
                                    </template>
                                    <label class="radio-custom text-sm text-gray-600">
                                        <input type="radio" name="sektor_bisnis" value="Lainnya" x-model="sektor" required>
                                        <span class="checkmark"></span>
                                        Lainnya
                                    </label>
                                </div>
                                <div x-show="sektor === 'Lainnya'" x-transition class="mb-3">
                                    <input type="text" name="sektor_bisnis_lainnya" class="wizard-input border-b-2 border-t-0 border-l-0 border-r-0 rounded-none bg-transparent px-0 focus:ring-0 focus:border-brand-gold" placeholder="Sebutkan sektor bisnis Anda...">
                                </div>
                            </div>
                            
                            <div class="pt-1">
                                <h3 class="text-sm font-bold text-brand-gray uppercase tracking-wider mb-2">Kebutuhan Layanan</h3>
                                <select name="kebutuhan_utama" x-model="kebutuhan" required class="wizard-input appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23263145%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:10px_10px] bg-no-repeat bg-[position:right_1rem_center]">
                                    <option value="" disabled>Pilih Kebutuhan Anda...</option>
                                    <template x-for="item in kebutuhanOptions" :key="item">
                                        <option :value="item" x-text="item"></option>
                                    </template>
                                    <option value="Lainnya">Lain-lain (Isi sendiri)</option>
                                </select>
                                <div x-show="kebutuhan === 'Lainnya'" x-transition class="mt-2">
                                    <input type="text" name="kebutuhan_utama_lainnya" class="wizard-input border-b-2 border-t-0 border-l-0 border-r-0 rounded-none bg-transparent px-0 focus:ring-0 focus:border-brand-gold" placeholder="Sebutkan kebutuhan layanan Anda...">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between items-center">
                            <button type="button" @click="prevStep()" class="text-sm font-medium text-brand-gray flex items-center hover:text-brand-gold transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                            </button>
                            <button type="button" @click="nextStep()" class="bg-brand-gold hover:bg-yellow-500 text-brand-gray font-semibold text-sm px-6 py-2.5 rounded shadow-sm transition-all flex items-center">
                                Selanjutnya <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: Mengetahui Kami -->
                    <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <h2 class="text-heading font-light text-brand-gray mb-1">DARI MANA ANDA <span class="font-bold text-brand-gray">MENGETAHUI</span> KAMI?</h2>
                        <p class="text-sm text-gray-500 mb-6">Bantu kami mengetahui bagaimana Anda menemukan layanan kami.</p>
                        
                        <div class="space-y-4">
                            <div>
                                <select name="sumber_info" x-model="sumber" required class="wizard-input appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23263145%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:10px_10px] bg-no-repeat bg-[position:right_1rem_center]">
                                    <option value="" disabled>Pilih Sumber Informasi...</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="Rekomendasi Teman">Rekomendasi Teman / Kolega</option>
                                    <option value="Pencarian Google">Pencarian Google</option>
                                    <option value="Lainnya">Lain-lain (Isi sendiri)</option>
                                </select>
                            </div>
                            <div x-show="sumber === 'Lainnya'" x-transition class="mt-3">
                                <input type="text" name="sumber_info_lainnya" class="wizard-input border-b-2 border-t-0 border-l-0 border-r-0 rounded-none bg-transparent px-0 focus:ring-0 focus:border-brand-gold" placeholder="Sebutkan dari mana Anda tahu kami...">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between items-center">
                            <button type="button" @click="prevStep()" class="text-sm font-medium text-brand-gray flex items-center hover:text-brand-gold transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                            </button>
                            <button type="submit" class="bg-brand-gold hover:bg-yellow-500 text-brand-gray font-bold text-sm px-8 py-2.5 rounded shadow-md transition-all flex items-center transform hover:-translate-y-0.5">
                                Selesai <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="mt-8 text-center text-xs text-gray-400">
            Copyright &copy; {{ date('Y') }} Nawasena | Powered by <a href="https://cyberlabs.co.id" class="underline hover:text-brand-gold transition-colors" target="_blank">CyberLabs</a>
        </div>
    </div>

    <script>
        function clientForm() {
            return {
                step: 1,
                sektor: '{{ old('sektor_bisnis', '') }}',
                kebutuhan: '{{ old('kebutuhan_utama', '') }}',
                sumber: '{{ old('sumber_info', '') }}',
                sektorOptions: [],
                kebutuhanOptions: [],

                init() {
                    @if($errors->any())
                        this.step = 1;
                    @endif

                    fetch('/api/kategori')
                        .then(res => res.json())
                        .then(data => {
                            this.sektorOptions = data.sektor || ['Kesehatan', 'Pendidikan', 'Ritel & Perdagangan', 'Kuliner & Food Service', 'Pariwisata & Perhotelan', 'Jasa Profesional', 'Konstruksi & Properti', 'Teknologi Informasi', 'Logistik & Transportasi', 'Manufaktur & Industri'];
                            this.kebutuhanOptions = data.kebutuhan || ['Pengembangan Website', 'Aplikasi Mobile', 'Desain UI/UX', 'Konsultasi IT', 'Digital Marketing'];
                        })
                        .catch(() => {
                            this.sektorOptions = ['Kesehatan', 'Pendidikan', 'Ritel & Perdagangan', 'Kuliner & Food Service', 'Pariwisata & Perhotelan', 'Jasa Profesional', 'Konstruksi & Properti', 'Teknologi Informasi', 'Logistik & Transportasi', 'Manufaktur & Industri'];
                            this.kebutuhanOptions = ['Pengembangan Website / Web App', 'Pengembangan Aplikasi Mobile', 'Desain UI/UX & Branding', 'Konsultasi IT & Sistem Bisnis', 'Digital Marketing'];
                        });
                },
                
                nextStep() {
                    let form = document.getElementById('mainForm');
                    let currentStepInputs = form.querySelectorAll(`div[x-show="step === ${this.step}"] [required]`);
                    let allValid = true;
                    
                    currentStepInputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.reportValidity();
                            allValid = false;
                        }
                    });

                    if (allValid && this.step < 3) {
                        this.step++;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },
                
                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            }
        }
    </script>
</body>
</html>
