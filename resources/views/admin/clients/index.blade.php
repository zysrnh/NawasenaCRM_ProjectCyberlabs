<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-navy">Dashboard</h1>
                <p class="text-sm text-nw-body mt-0.5">Ringkasan data klien Nawasena</p>
            </div>
            <a href="{{ route('client.create') }}" target="_blank"
                class="btn-hover inline-flex items-center px-4 py-2 bg-gold text-navy text-sm font-semibold rounded hover:bg-gold-dark">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Form Registrasi
            </a>
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
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="table-container bg-white border border-gray-200 rounded overflow-hidden">
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-navy">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Klien</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kontak</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Sektor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Kebutuhan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Sumber</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($clients as $client)
                                <tr class="table-row">
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
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('admin.clients.show', $client) }}" class="link-animated text-xs font-medium text-navy hover:text-gold-dark">Detail</a>
                                            <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus data klien ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-xs font-medium text-red-400 hover:text-red-600 transition-colors">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-4 py-12 text-center text-nw-body text-sm">Belum ada data klien</td></tr>
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
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.clients.show', $client) }}" class="text-xs font-medium text-navy">Detail</a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-red-500">Hapus</button>
                                    </form>
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
</x-app-layout>
