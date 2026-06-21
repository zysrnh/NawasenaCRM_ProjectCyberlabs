<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-navy">Dashboard</h1>
                <p class="text-sm text-nw-body mt-0.5">Ringkasan data klien Nawasena</p>
            </div>
            <div class="flex items-center space-x-2">
                @if(auth()->user()->is_admin)
                <a href="{{ route('admin.kategori.index') }}"
                    class="btn-hover inline-flex items-center px-3 py-2 border border-gray-300 text-navy text-sm font-medium rounded hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7-7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </a>
                @endif

                <a href="{{ route('client.create') }}" target="_blank"
                    class="btn-hover inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Link Public Form
                </a>
                <a href="{{ route('admin.clients.create') }}"
                    class="btn-hover inline-flex items-center px-3 py-2 bg-gold text-navy text-sm font-semibold rounded hover:bg-gold-dark">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Klien
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Stat Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="stat-card bg-white border border-gray-200 rounded p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-nw-body uppercase tracking-wider">Total Klien</span>
                        <div class="w-8 h-8 bg-navy/10 rounded flex items-center justify-center">
                            <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-navy stat-number">{{ $totalClients }}</p>
                    <p class="text-xs text-nw-body mt-1">Semua data terdaftar</p>
                </div>

                <div class="stat-card bg-white border border-gray-200 rounded p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-nw-body uppercase tracking-wider">Bulan Ini</span>
                        <div class="w-8 h-8 bg-emerald-50 rounded flex items-center justify-center">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-navy stat-number">{{ $clientsBulanIni }}</p>
                    <p class="text-xs text-nw-body mt-1">Klien baru</p>
                </div>

                <div class="stat-card bg-white border border-gray-200 rounded p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-nw-body uppercase tracking-wider">Top Sektor</span>
                        <div class="w-8 h-8 bg-gold/10 rounded flex items-center justify-center">
                            <svg class="w-4 h-4 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <p class="text-xl font-bold text-navy truncate">{{ $topSektor->sektor_bisnis ?? '-' }}</p>
                    <p class="text-xs text-nw-body mt-1">{{ $topSektor->total ?? 0 }} klien</p>
                </div>

                <div class="stat-card bg-white border border-gray-200 rounded p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-nw-body uppercase tracking-wider">Top Sumber</span>
                        <div class="w-8 h-8 bg-navy/10 rounded flex items-center justify-center">
                            <svg class="w-4 h-4 text-navy-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xl font-bold text-navy truncate">{{ $topSumber->sumber_info ?? '-' }}</p>
                    <p class="text-xs text-nw-body mt-1">{{ $topSumber->total ?? 0 }} klien</p>
                </div>
            </div>

            @if (session('success'))
                <div class="flash-msg mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-sm font-medium">{{ session('success') }}</div>
            @endif

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                <div class="bg-white border border-gray-200 rounded p-5 shadow-sm">
                    <h3 class="text-sm font-bold text-navy mb-4">Pertumbuhan Klien (Tahun Ini)</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="pertumbuhanChart"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded p-5 shadow-sm">
                    <h3 class="text-sm font-bold text-navy mb-4">Sektor Bisnis Terbanyak</h3>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="sektorChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Filters --}}
            <div class="filter-bar bg-white border border-gray-200 rounded mb-4">
                <form method="GET" action="{{ route('admin.clients.index') }}" class="p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-medium text-nw-body mb-1">Cari</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none placeholder-gray-400" placeholder="Nama, email, no. telp...">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body mb-1">Sektor</label>
                            <select name="sektor" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none bg-white">
                                <option value="">Semua</option>
                                @foreach ($sektorList as $s)
                                    <option value="{{ $s }}" {{ request('sektor') == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-nw-body mb-1">Kebutuhan</label>
                            <select name="kebutuhan" class="block w-full px-3 py-2 border border-gray-300 rounded text-sm focus:border-gold focus:ring-1 focus:ring-gold focus:outline-none bg-white">
                                <option value="">Semua</option>
                                @foreach ($kebutuhanList as $k)
                                    <option value="{{ $k }}" {{ request('kebutuhan') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="btn-hover flex-1 px-4 py-2 bg-navy text-white text-sm font-medium rounded hover:bg-navy-dark">Filter</button>
                            <a href="{{ route('admin.clients.index') }}" class="px-4 py-2 border border-gray-300 text-nw-body text-sm rounded hover:bg-gray-50 transition-colors duration-150">Reset</a>
                            <a href="{{ route('admin.clients.export', request()->query()) }}" class="btn-hover px-4 py-2 bg-[#217346] text-white text-sm font-medium rounded hover:bg-[#1e603a] flex items-center transition-colors" title="Export ke Excel/CSV">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Export
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Bulk action bar (shown via JS) --}}
            <div id="bulk-action-bar" style="display:none;" class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-4 flex items-center justify-between shadow-sm">
                <div class="text-sm text-red-800 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span id="selected-count" class="font-bold mr-1">0</span> klien dipilih
                </div>
                @if(auth()->user()->is_admin)
                <button type="button" onclick="confirmBulkDelete()" class="btn-hover px-4 py-1.5 bg-red-600 text-white text-xs font-bold rounded hover:bg-red-700 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Terpilih
                </button>
                @endif
            </div>

            <div class="table-container bg-white border border-gray-200 rounded overflow-hidden">
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-navy">
                            <tr>
                                <th class="px-4 py-3 text-left w-10">
                                    <input type="checkbox" id="check-all" onchange="toggleAllClients(this)" class="rounded border-gray-400 cursor-pointer">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Klien</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kontak</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Sektor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kebutuhan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Sumber</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Tgl Regis</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status Blast</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($clients as $client)
                                <tr class="table-row">
                                    <td class="px-4 py-3 w-10">
                                        <input type="checkbox" class="client-checkbox rounded border-gray-300 text-red-600 focus:ring-red-500 cursor-pointer" value="{{ $client->id }}" onchange="updateBulkBar()">
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-navy">{{ $client->nama_klien }}</div>
                                        @if ($client->nama_pic)
                                            <div class="text-xs text-nw-body mt-0.5">PIC: {{ $client->nama_pic }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-navy-light">{{ $client->nomor_telepon }}</div>
                                        <div class="text-xs text-nw-body">{{ $client->email }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge-hover inline-flex px-2 py-0.5 bg-gold/15 text-gold-dark text-xs font-medium rounded">{{ $client->sektor_bisnis }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-navy-light">{{ Str::limit($client->kebutuhan_utama, 25) }}</td>
                                    <td class="px-4 py-3 text-xs text-nw-body">{{ $client->sumber_info }}</td>
                                    <td class="px-4 py-3 text-xs text-nw-body">{{ $client->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        @if($client->blast_status === 'Terkirim')
                                            <div class="flex items-center text-emerald-600 font-medium" title="Terkirim">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Terkirim
                                            </div>
                                            <div class="text-[10px] text-gray-400 mt-0.5">
                                                {{ \Carbon\Carbon::parse($client->last_blasted_at)->format('d/m/y, H:i') }}
                                            </div>
                                        @elseif($client->blast_status === 'Gagal')
                                            <div class="flex items-center text-red-500 font-medium" title="Gagal">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Gagal
                                            </div>
                                            <div class="text-[10px] text-gray-400 mt-0.5">
                                                {{ \Carbon\Carbon::parse($client->last_blasted_at)->format('d/m/y, H:i') }}
                                            </div>
                                        @else
                                            <div class="flex items-center text-gray-400 italic" title="Belum blast">
                                                <svg class="w-4 h-4 mr-1 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Belum
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('admin.clients.show', $client) }}#kirim-wa" class="text-[#25D366] hover:text-emerald-700 transition-colors" title="Kirim WA Perorangan">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            </a>
                                            <a href="{{ route('admin.clients.show', $client) }}" class="link-animated text-xs font-medium text-navy hover:text-gold-dark">Detail</a>
                                            @if(auth()->user()->is_admin)
                                            <a href="{{ route('admin.clients.edit', $client) }}" class="link-animated text-xs font-medium text-sky-600 hover:text-sky-800">Edit</a>
                                            <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus data klien ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-xs font-medium text-red-400 hover:text-red-600 transition-colors">Hapus</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-4 py-12 text-center text-nw-body text-sm">Belum ada data klien</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="md:hidden divide-y divide-gray-100">
                    @forelse ($clients as $client)
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div class="text-sm font-semibold text-navy">{{ $client->nama_klien }}</div>
                                <span class="text-xs text-nw-body">{{ $client->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="text-xs text-nw-body mb-2">{{ $client->nomor_telepon }} &middot; {{ $client->email }}</div>
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="px-2 py-0.5 bg-gold/15 text-gold-dark text-xs font-medium rounded">{{ $client->sektor_bisnis }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                <span class="text-xs text-nw-body">via {{ $client->sumber_info }}</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.clients.show', $client) }}#kirim-wa" class="text-[#25D366] hover:text-emerald-700 transition-colors" title="Kirim WA">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.clients.show', $client) }}" class="text-xs font-medium text-navy">Detail</a>
                                    @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.clients.edit', $client) }}" class="text-xs font-medium text-sky-600">Edit</a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-red-500">Hapus</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-nw-body text-sm">Belum ada data klien</div>
                    @endforelse
                </div>
                @if ($clients->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200 bg-nw-light">{{ $clients->links() }}</div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleAllClients(checkbox) {
            document.querySelectorAll('.client-checkbox').forEach(cb => {
                cb.checked = checkbox.checked;
            });
            updateBulkBar();
        }

        function updateBulkBar() {
            const checked = document.querySelectorAll('.client-checkbox:checked');
            const bar = document.getElementById('bulk-action-bar');
            const countEl = document.getElementById('selected-count');
            if (checked.length > 0) {
                bar.style.display = 'flex';
                countEl.textContent = checked.length;
            } else {
                bar.style.display = 'none';
            }
        }

function confirmBulkDelete() {
            const checked = document.querySelectorAll('.client-checkbox:checked');
            const ids = Array.from(checked).map(cb => cb.value);
            if (ids.length === 0) return;

            // Tampilkan custom modal
            document.getElementById('modal-count').textContent = ids.length;
            document.getElementById('delete-modal').style.display = 'flex';
            window._pendingDeleteIds = ids;
        }

        function closeBulkModal() {
            document.getElementById('delete-modal').style.display = 'none';
            window._pendingDeleteIds = [];
        }

        function executeBulkDelete() {
            const ids = window._pendingDeleteIds || [];
            if (ids.length === 0) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.clients.bulk-destroy") }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }

        // Tutup modal kalau klik backdrop
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) closeBulkModal();
        });
    </script>
    @endpush

    {{-- Custom Delete Modal --}}
    <div id="delete-modal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(15,23,42,0.55); backdrop-filter:blur(4px); align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 24px 48px rgba(0,0,0,0.18); width:100%; max-width:400px; margin:16px; overflow:hidden; animation: modalIn 0.2s ease-out;">
            {{-- Header --}}
            <div style="background:linear-gradient(135deg,#1e3a5f,#263145); padding:20px 24px; display:flex; align-items:center; gap:12px;">
                <div style="width:40px; height:40px; border-radius:50%; background:rgba(239,68,68,0.2); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg width="20" height="20" fill="none" stroke="#f87171" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <div>
                    <div style="color:#fff; font-size:15px; font-weight:700;">Konfirmasi Hapus</div>
                    <div style="color:rgba(255,255,255,0.6); font-size:12px; margin-top:2px;">Nawasena CRM</div>
                </div>
            </div>
            {{-- Body --}}
            <div style="padding:24px;">
                <p style="color:#374151; font-size:14px; line-height:1.6; margin:0 0 8px;">
                    Anda akan menghapus <strong style="color:#dc2626;" id="modal-count">0</strong> data klien secara permanen.
                </p>
                <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:10px 14px; display:flex; align-items:flex-start; gap:8px;">
                    <svg width="16" height="16" fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0; margin-top:1px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    <span style="color:#b91c1c; font-size:12px; line-height:1.5;">Tindakan ini tidak dapat dibatalkan. Data yang dihapus tidak bisa dipulihkan.</span>
                </div>
            </div>
            {{-- Footer --}}
            <div style="padding:0 24px 20px; display:flex; gap:10px; justify-content:flex-end;">
                <button onclick="closeBulkModal()" style="padding:9px 20px; border:1.5px solid #d1d5db; border-radius:8px; background:#fff; color:#374151; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.15s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#fff'">Batal</button>
                <button onclick="executeBulkDelete()" style="padding:9px 20px; border:none; border-radius:8px; background:#dc2626; color:#fff; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; transition:all 0.15s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Ya, Hapus Sekarang
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Line Chart (Pertumbuhan)
            const bulanData = @json($chartBulanData);
            const lineCtx = document.getElementById('pertumbuhanChart').getContext('2d');
            
            // Gradient for line chart
            let gradient = lineCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(30, 58, 95, 0.5)'); // navy
            gradient.addColorStop(1, 'rgba(30, 58, 95, 0.0)');
            
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: bulanData.map(d => d.bulan),
                    datasets: [{
                        label: 'Klien Baru',
                        data: bulanData.map(d => d.total),
                        borderColor: '#1E3A5F', // navy
                        backgroundColor: gradient,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FAB95B', // gold
                        pointBorderColor: '#fff',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#f3f4f6' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Data for Doughnut Chart (Sektor)
            const sektorData = @json($chartSektor);
            const doughnutCtx = document.getElementById('sektorChart').getContext('2d');
            new Chart(doughnutCtx, {
                type: 'doughnut',
                data: {
                    labels: sektorData.map(d => d.sektor_bisnis),
                    datasets: [{
                        data: sektorData.map(d => d.total),
                        backgroundColor: [
                            '#1E3A5F', // navy
                            '#FAB95B', // gold
                            '#2E5A8F', // lighter navy
                            '#FCCC85', // lighter gold
                            '#112238', // dark navy
                            '#e5e7eb'  // gray
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 12, font: { size: 11 } } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
