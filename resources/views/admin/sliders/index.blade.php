@extends('layouts.admin')
@section('title', 'Slider Hero')
@section('header', 'Slider Hero Carousel')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500 dark:text-slate-400">Kelola gambar hero carousel di halaman utama. <span class="text-amber-600 dark:text-amber-400 font-medium">Maks 800KB per gambar.</span></p>
        <a href="{{ route('admin.sliders.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">+ Tambah Slider</a>
    </div>

    @if($sliders->count() > 0)
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-slate-700 text-left">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300 w-16">#</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300">Gambar</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300">Judul</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300 w-20">Urutan</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300 w-20">Status</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300 w-28">Ukuran</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-slate-300 w-32 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                @foreach($sliders as $slider)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <td class="px-4 py-3 text-gray-400 dark:text-slate-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title }}" class="h-16 w-28 object-cover rounded-lg border dark:border-slate-600">
                    </td>
                    <td class="px-4 py-3 text-gray-800 dark:text-white font-medium">{{ $slider->title ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-slate-400">{{ $slider->order_index }}</td>
                    <td class="px-4 py-3">
                        @if($slider->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 dark:bg-slate-600 dark:text-slate-400">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 dark:text-slate-400 text-xs">
                        @if(file_exists(public_path($slider->image_path)))
                            {{ number_format(filesize(public_path($slider->image_path)) / 1024, 0) }} KB
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 text-xs font-medium">Edit</a>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline" onsubmit="return confirm('Hapus slider ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-xs font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-12 text-center">
        <svg class="w-12 h-12 text-gray-300 dark:text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="text-gray-500 dark:text-slate-400 mb-4">Belum ada slider hero carousel.</p>
        <a href="{{ route('admin.sliders.create') }}" class="inline-flex px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Tambah Slider Pertama</a>
    </div>
    @endif
</div>
@endsection
