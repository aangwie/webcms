@extends('layouts.admin')
@section('title', 'Berita')
@section('header', 'Berita')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700">
    <div class="p-4 sm:p-6 border-b dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Berita</h2>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Berita
        </a>
    </div>

    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-slate-300">
                <tr>
                    <th class="px-6 py-3 text-left font-medium">Gambar</th>
                    <th class="px-6 py-3 text-left font-medium">Judul</th>
                    <th class="px-6 py-3 text-left font-medium">Kategori</th>
                    <th class="px-6 py-3 text-left font-medium">Status</th>
                    <th class="px-6 py-3 text-left font-medium">Tanggal</th>
                    <th class="px-6 py-3 text-right font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-slate-700">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <td class="px-6 py-3">
                        @if($post->image_path)
                            <img src="{{ asset($post->image_path) }}" class="w-16 h-12 rounded object-cover" alt="">
                        @else
                            <div class="w-16 h-12 bg-gray-100 dark:bg-slate-700 rounded flex items-center justify-center text-gray-400 dark:text-slate-500 text-xs">No img</div>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-white max-w-xs truncate">{{ $post->title }}</td>
                    <td class="px-6 py-3 text-gray-500 dark:text-slate-400">{{ $post->category ?? '-' }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $post->is_published ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                            {{ $post->is_published ? 'Publish' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-500 dark:text-slate-400 text-xs">{{ $post->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3 text-right space-x-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400 dark:text-slate-500">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="sm:hidden divide-y dark:divide-slate-700">
        @forelse($posts as $post)
        <div class="p-4 flex gap-3">
            @if($post->image_path)
                <img src="{{ asset($post->image_path) }}" class="w-16 h-16 rounded object-cover flex-shrink-0" alt="">
            @endif
            <div class="flex-grow min-w-0">
                <p class="font-medium text-gray-800 dark:text-white truncate">{{ $post->title }}</p>
                <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">{{ $post->category ?? '-' }} · {{ $post->created_at->format('d M Y') }}</p>
                <div class="flex items-center space-x-3 mt-2">
                    <span class="px-2 py-0.5 text-xs rounded-full {{ $post->is_published ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">{{ $post->is_published ? 'Publish' : 'Draft' }}</span>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs text-indigo-600 dark:text-indigo-400">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 dark:text-red-400">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-400 dark:text-slate-500">Belum ada berita.</div>
        @endforelse
    </div>
</div>
@endsection
