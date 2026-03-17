@extends('layouts.admin')
@section('title', 'Edit Mitra')
@section('header', 'Edit Mitra')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nama Mitra <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" required class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Logo Mitra <span class="text-gray-400 text-xs">(maks 500KB)</span></label>
                @if($partner->image_path)
                <div class="mb-2">
                    <img src="{{ asset($partner->image_path) }}" class="h-16 w-auto rounded-lg border dark:border-slate-600 object-contain bg-gray-50 dark:bg-slate-700 p-1" alt="">
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 file:cursor-pointer">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Urutan</label>
                <input type="number" name="order_index" value="{{ old('order_index', $partner->order_index) }}" class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-slate-300">Aktifkan mitra ini</label>
            </div>
            <div class="flex items-center space-x-3 pt-2">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Perbarui</button>
                <a href="{{ route('admin.partners.index') }}" class="px-5 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-slate-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
