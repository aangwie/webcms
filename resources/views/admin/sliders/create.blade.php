@extends('layouts.admin')
@section('title', 'Tambah Slider')
@section('header', 'Tambah Slider Hero')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Judul <span class="text-gray-400 dark:text-slate-500">(opsional)</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border dark:placeholder-slate-400" placeholder="Judul overlay pada slider">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Gambar <span class="text-red-500">*</span> <span class="text-gray-400 dark:text-slate-500 text-xs">(maks 800KB, otomatis konversi WebP)</span></label>
                <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-600 dark:file:text-indigo-400 file:font-medium hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 file:cursor-pointer">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="order_index" value="{{ old('order_index', 0) }}" class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-gray-700 dark:text-slate-300">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-between pt-2">
                <a href="{{ route('admin.sliders.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-white">&larr; Kembali</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
