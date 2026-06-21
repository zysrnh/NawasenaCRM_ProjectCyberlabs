<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-navy">WA Log Keseluruhan</h1>
                <p class="text-sm text-nw-body mt-0.5">Riwayat pesan WhatsApp yang terkirim ke semua klien</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded overflow-hidden shadow-sm">
                @if($logs->isEmpty())
                    <div class="py-16 text-center text-gray-500">
                        <svg class="mx-auto text-gray-300 mb-4" style="width: 64px; height: 64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p class="text-sm">Belum ada riwayat pesan WhatsApp yang dikirimkan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-nw-body uppercase bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold">Tanggal & Waktu</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Klien (Penerima)</th>
                                    <th scope="col" class="px-6 py-4 font-semibold w-1/3">Isi Pesan</th>
                                    <th scope="col" class="px-6 py-4 font-semibold">Pengirim</th>
                                    <th scope="col" class="px-6 py-4 font-semibold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($logs as $log)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                            {{ $log->created_at->format('d M Y') }} <br>
                                            <span class="text-xs text-gray-400">{{ $log->created_at->format('H:i') }} WIB</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-navy">{{ $log->client->nama_klien ?? 'Klien Dihapus' }}</div>
                                            @if($log->client)
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $log->client->nomor_telepon }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs xl:max-w-md">
                                                <div class="text-gray-700 bg-gray-50 rounded border border-gray-100 p-2 text-xs line-clamp-3 hover:line-clamp-none transition-all cursor-pointer" title="Klik untuk meluaskan">
                                                    {{ $log->pesan }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="inline-flex items-center">
                                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                <span class="text-gray-600 font-medium">{{ $log->admin->name ?? 'Sistem' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($log->status === 'success')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Sukses
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    Gagal
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($logs->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                            {{ $logs->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
