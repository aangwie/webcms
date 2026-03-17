@extends('layouts.admin')
@section('title', 'Tentang')
@section('header', 'Halaman Tentang')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Halaman Tentang <span class="text-gray-400 text-xs">(maks 500KB, otomatis konversi WebP)</span></label>
                @if($about->image_path)
                <div class="mb-3 flex items-center space-x-4">
                    <img src="{{ asset($about->image_path) }}" class="h-24 rounded-lg border object-cover" alt="Tentang">
                    <div>
                        <span class="text-xs text-gray-500 block">Gambar saat ini</span>
                        @php
                            $imgSize = file_exists(public_path($about->image_path)) ? getimagesize(public_path($about->image_path)) : null;
                        @endphp
                        @if($imgSize)
                        <span class="text-xs text-indigo-600 font-medium">{{ $imgSize[0] }} × {{ $imgSize[1] }} px</span>
                        @endif
                    </div>
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 file:cursor-pointer">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten Halaman Tentang</label>
                <p class="text-xs text-gray-400 mb-2">Mendukung format HTML. Tulis profil, visi, misi, dan informasi organisasi Anda di sini.</p>
                <textarea name="content" rows="14" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border font-mono text-sm">{{ old('content', $about->content) }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
