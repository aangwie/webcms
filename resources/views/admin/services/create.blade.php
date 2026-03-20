@extends('layouts.admin')
@section('title', 'Tambah Layanan')
@section('header', 'Tambah Layanan')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div x-data="iconPicker()" class="relative">
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Icon <span class="text-gray-400 dark:text-slate-500 text-xs">(Pilih dari daftar)</span></label>
                
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-12 h-12 rounded-lg border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 flex items-center justify-center text-xl text-indigo-600 dark:text-indigo-400">
                        <template x-if="selectedIcon">
                            <i :class="selectedIcon"></i>
                        </template>
                        <template x-if="!selectedIcon">
                            <span class="text-xs text-gray-400">?</span>
                        </template>
                    </div>
                    <div class="flex-grow">
                        <input type="text" x-model="search" placeholder="Cari icon (misal: book, user, heart)..." class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border dark:placeholder-slate-400 text-sm">
                        <input type="hidden" name="icon" x-model="selectedIcon">
                    </div>
                </div>

                <div class="h-48 overflow-y-auto border border-gray-200 dark:border-slate-700 rounded-lg p-3 bg-gray-50 dark:bg-slate-900 grid grid-cols-6 sm:grid-cols-8 gap-2">
                    <template x-for="icon in filteredIcons" :key="icon">
                        <button type="button" @click="selectedIcon = icon" 
                                class="w-10 h-10 rounded flex items-center justify-center text-lg transition-colors border"
                                :class="selectedIcon === icon ? 'bg-indigo-100 dark:bg-indigo-900/50 border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'bg-white dark:bg-slate-800 border-transparent hover:border-gray-300 dark:hover:border-slate-600 text-gray-600 dark:text-slate-300'">
                            <i :class="icon"></i>
                        </button>
                    </template>
                    <template x-if="filteredIcons.length === 0">
                        <div class="col-span-full py-4 text-center text-sm text-gray-400 dark:text-slate-500">Ikon tidak ditemukan</div>
                    </template>
                </div>
            </div>

            <script>
                function iconPicker() {
                    return {
                        search: '',
                        selectedIcon: '{{ old('icon', 'fas fa-star') }}',
                        // A selection of popular FontAwesome 6 Free icons
                        icons: [
                            'fas fa-star', 'fas fa-heart', 'fas fa-user', 'fas fa-home', 'fas fa-cog', 
                            'fas fa-check', 'fas fa-info-circle', 'fas fa-exclamation-triangle', 'fas fa-envelope', 'fas fa-phone',
                            'fas fa-camera', 'fas fa-image', 'fas fa-music', 'fas fa-video', 'fas fa-search',
                            'fas fa-globe', 'fas fa-map-marker-alt', 'fas fa-calendar', 'fas fa-clock', 'fas fa-shopping-cart',
                            'fas fa-chart-bar', 'fas fa-briefcase', 'fas fa-book', 'fas fa-graduation-cap', 'fas fa-laptop',
                            'fas fa-desktop', 'fas fa-mobile-alt', 'fas fa-cogs', 'fas fa-wrench', 'fas fa-hammer',
                            'fas fa-car', 'fas fa-plane', 'fas fa-truck', 'fas fa-ship', 'fas fa-rocket',
                            'fas fa-leaf', 'fas fa-fire', 'fas fa-water', 'fas fa-sun', 'fas fa-moon',
                            'fas fa-snowflake', 'fas fa-bolt', 'fas fa-cloud', 'fas fa-umbrella', 'fas fa-shield-alt',
                            'fas fa-lock', 'fas fa-unlock', 'fas fa-key', 'fas fa-eye', 'fas fa-eye-slash',
                            'fas fa-thumbs-up', 'fas fa-thumbs-down', 'fas fa-handshake', 'fas fa-users', 'fas fa-user-tie',
                            'fas fa-building', 'fas fa-hospital', 'fas fa-school', 'fas fa-store', 'fas fa-university',
                            'fas fa-code', 'fas fa-database', 'fas fa-server', 'fas fa-network-wired', 'fas fa-microchip',
                            'fas fa-headset', 'fas fa-microphone', 'fas fa-volume-up', 'fas fa-paint-brush', 'fas fa-palette',
                            'fas fa-pen', 'fas fa-pencil-alt', 'fas fa-print', 'fas fa-save', 'fas fa-share',
                            'fas fa-trash', 'fas fa-edit', 'fas fa-copy', 'fas fa-layer-group', 'fas fa-puzzle-piece',
                            'fas fa-trophy', 'fas fa-medal', 'fas fa-crown', 'fas fa-gem', 'fas fa-gift',
                            'fas fa-bullhorn', 'fas fa-bell', 'fas fa-comment', 'fas fa-comments', 'fas fa-paper-plane',
                            'fas fa-compass', 'fas fa-map', 'fas fa-route', 'fas fa-anchor', 'fas fa-life-ring',
                            'fas fa-folder', 'fas fa-folder-open', 'fas fa-file', 'fas fa-file-alt', 'fas fa-address-book',
                            'fas fa-id-card', 'fas fa-ticket-alt', 'fas fa-tags', 'fas fa-qrcode', 'fas fa-barcode'
                        ],
                        get filteredIcons() {
                            if (this.search === '') {
                                return this.icons;
                            }
                            return this.icons.filter(icon => icon.includes(this.search.toLowerCase()));
                        }
                    }
                }
            </script>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-gray-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
                <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-slate-300">Aktifkan layanan ini</label>
            </div>
            <div class="flex items-center space-x-3 pt-2">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Simpan</button>
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-slate-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
