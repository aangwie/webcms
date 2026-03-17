@extends('layouts.admin')
@section('title', 'Edit Slider')
@section('header', 'Edit Slider Hero')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-gray-400">(opsional)</span></label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar <span class="text-gray-400 text-xs">(maks 800KB, kosongkan jika tidak ganti)</span></label>
                @if($slider->image_path)
                <div class="mb-3">
                    <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->title }}" class="h-32 w-full object-cover rounded-lg border">
                    <span class="text-xs text-gray-500 mt-1 block">Gambar saat ini
                        @if(file_exists(public_path($slider->image_path)))
                            — {{ number_format(filesize(public_path($slider->image_path)) / 1024, 0) }} KB
                        @endif
                    </span>
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 file:cursor-pointer">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="order_index" value="{{ old('order_index', $slider->order_index) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-gray-700">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-between pt-2">
                <a href="{{ route('admin.sliders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
