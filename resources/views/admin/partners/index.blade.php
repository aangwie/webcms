@extends('layouts.admin')
@section('title', 'Mitra')
@section('header', 'Mitra')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700">
    <div class="p-4 sm:p-6 border-b dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Mitra</h2>
        <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Mitra
        </a>
    </div>

    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-slate-300">
                <tr>
                    <th class="px-6 py-3 text-left font-medium">Logo</th>
                    <th class="px-6 py-3 text-left font-medium">Nama</th>
                    <th class="px-6 py-3 text-left font-medium">Urutan</th>
                    <th class="px-6 py-3 text-left font-medium">Status</th>
                    <th class="px-6 py-3 text-right font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-slate-700">
                @forelse($partners as $p)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <td class="px-6 py-3">
                        @if($p->image_path)
                            <img src="{{ asset($p->image_path) }}" class="h-10 w-auto rounded object-contain bg-gray-50 dark:bg-slate-600 p-1" alt="">
                        @else
                            <div class="h-10 w-16 bg-gray-100 dark:bg-slate-600 rounded flex items-center justify-center text-gray-400 text-xs">No img</div>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-white">{{ $p->name }}</td>
                    <td class="px-6 py-3 text-gray-500 dark:text-slate-400">{{ $p->order_index }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $p->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-right space-x-2">
                        <a href="{{ route('admin.partners.edit', $p) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                        <form action="{{ route('admin.partners.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada mitra.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="sm:hidden divide-y dark:divide-slate-700">
        @forelse($partners as $p)
        <div class="p-4 flex items-center gap-3">
            @if($p->image_path)
                <img src="{{ asset($p->image_path) }}" class="h-12 w-12 rounded object-contain bg-gray-50 dark:bg-slate-600 p-1 flex-shrink-0" alt="">
            @endif
            <div class="flex-grow min-w-0">
                <p class="font-medium text-gray-800 dark:text-white">{{ $p->name }}</p>
                <div class="flex space-x-3 mt-1">
                    <a href="{{ route('admin.partners.edit', $p) }}" class="text-xs text-indigo-600">Edit</a>
                    <form action="{{ route('admin.partners.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400">Belum ada mitra.</div>
        @endforelse
    </div>
</div>
@endsection
