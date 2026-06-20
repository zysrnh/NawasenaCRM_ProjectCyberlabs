<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-navy">Kelola Akun Admin</h1>
                <p class="text-sm text-nw-body mt-0.5">Daftar pengguna sistem dan administrator</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="btn-hover inline-flex items-center px-4 py-2 bg-navy text-white text-sm font-medium rounded hover:bg-navy-dark">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                Tambah Admin
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flash-msg mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded text-sm font-medium">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="flash-msg mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded text-sm font-medium">{{ session('error') }}</div>
            @endif

            <div class="bg-white border border-gray-200 rounded overflow-hidden animate-fade-in shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-navy text-white text-xs uppercase tracking-wider">
                                <th class="px-6 py-3 font-medium">Nama</th>
                                <th class="px-6 py-3 font-medium">Email</th>
                                <th class="px-6 py-3 font-medium">Role</th>
                                <th class="px-6 py-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse ($users as $user)
                                <tr class="hover:bg-nw-light/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-navy">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->is_admin)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gold/20 text-navy">Admin</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">User</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</a>
                                        @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('Hapus akun ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-xs">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada akun terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
