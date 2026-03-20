@extends('layouts.admin')
@section('title', 'Layanan')
@section('header', 'Layanan')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700">
    <div class="p-4 sm:p-6 border-b dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Layanan</h2>
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Layanan
        </a>
    </div>

    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-slate-300">
                <tr>
                    <th class="px-6 py-3 text-left font-medium">Nama</th>
                    <th class="px-6 py-3 text-left font-medium">Icon</th>
                    <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                    <th class="px-6 py-3 text-left font-medium">Status</th>
                    <th class="px-6 py-3 text-right font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-slate-700">
                @forelse($services as $svc)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">{{ $svc->name }}</td>
                    <td class="px-6 py-4 text-gray-500 dark:text-slate-400">{{ $svc->icon ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-500 dark:text-slate-400 max-w-xs truncate">{{ Str::limit($svc->description, 60) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $svc->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                            {{ $svc->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.services.edit', $svc) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.services.destroy', $svc) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400 dark:text-slate-500">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="sm:hidden divide-y dark:divide-slate-700">
        @forelse($services as $svc)
        <div class="p-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium text-gray-800 dark:text-white">{{ $svc->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-1 line-clamp-2">{{ Str::limit($svc->description, 80) }}</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full flex-shrink-0 {{ $svc->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                    {{ $svc->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <div class="flex space-x-3 mt-3">
                <a href="{{ route('admin.services.edit', $svc) }}" class="text-sm text-indigo-600 dark:text-indigo-400">Edit</a>
                <form action="{{ route('admin.services.destroy', $svc) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 dark:text-red-400">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 dark:text-slate-500">Belum ada layanan.</div>
        @endforelse
    </div>
</div>
@endsection
