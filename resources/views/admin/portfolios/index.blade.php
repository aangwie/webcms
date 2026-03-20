@extends('layouts.admin')
@section('title', 'Portofolio')
@section('header', 'Portofolio')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700">
    <div class="p-4 sm:p-6 border-b dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Portofolio</h2>
        <a href="{{ route('admin.portfolios.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Portofolio
        </a>
    </div>

    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-slate-300">
                <tr>
                    <th class="px-6 py-3 text-left font-medium">Gambar</th>
                    <th class="px-6 py-3 text-left font-medium">Judul</th>
                    <th class="px-6 py-3 text-left font-medium">Klien</th>
                    <th class="px-6 py-3 text-left font-medium">Tanggal Selesai</th>
                    <th class="px-6 py-3 text-right font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-slate-700">
                @forelse($portfolios as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <td class="px-6 py-3">
                        @if($item->image_path)
                            <img src="{{ asset($item->image_path) }}" class="w-16 h-12 rounded object-cover" alt="">
                        @else
                            <div class="w-16 h-12 bg-gray-100 dark:bg-slate-700 rounded flex items-center justify-center text-gray-400 dark:text-slate-500 text-xs">No img</div>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-white">{{ $item->title }}</td>
                    <td class="px-6 py-3 text-gray-500 dark:text-slate-400">{{ $item->client ?? '-' }}</td>
                    <td class="px-6 py-3 text-gray-500 dark:text-slate-400 text-sm">{{ $item->completion_date ? $item->completion_date->format('d M Y') : '-' }}</td>
                    <td class="px-6 py-3 text-right space-x-2">
                        <a href="{{ route('admin.portfolios.edit', $item) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400 dark:text-slate-500">Belum ada portofolio.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="sm:hidden divide-y dark:divide-slate-700">
        @forelse($portfolios as $item)
        <div class="p-4 flex gap-3">
            @if($item->image_path)
                <img src="{{ asset($item->image_path) }}" class="w-16 h-16 rounded object-cover flex-shrink-0" alt="">
            @endif
            <div class="flex-grow min-w-0">
                <p class="font-medium text-gray-800 dark:text-white truncate">{{ $item->title }}</p>
                <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">{{ $item->client ?? '-' }} · {{ $item->completion_date ? $item->completion_date->format('d M Y') : '-' }}</p>
                <div class="flex space-x-3 mt-2">
                    <a href="{{ route('admin.portfolios.edit', $item) }}" class="text-xs text-indigo-600 dark:text-indigo-400">Edit</a>
                    <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 dark:text-red-400">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 dark:text-slate-500">Belum ada portofolio.</div>
        @endforelse
    </div>
</div>
@endsection
