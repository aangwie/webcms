@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('header', 'Pengaturan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Profil Organisasi --}}
            <div>
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-4">Profil Organisasi</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Situs / Organisasi</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo <span class="text-gray-400 text-xs">(maks 500KB, otomatis konversi WebP)</span></label>
                        @if($settings['site_logo'])
                        <div class="mb-3 flex items-center space-x-4">
                            <img src="{{ asset($settings['site_logo']) }}" class="h-16 w-auto rounded-lg border object-contain bg-gray-50 p-1" alt="Logo">
                            <div>
                                <span class="text-xs text-gray-500 block">Logo saat ini</span>
                                @if($logoDimensions)
                                <span class="text-xs text-indigo-600 font-medium">{{ $logoDimensions }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <input type="file" name="site_logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 file:cursor-pointer">
                        @error('site_logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Favicon --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Favicon <span class="text-gray-400 text-xs">(maks 500KB, disarankan 32×32 atau 64×64 px)</span></label>
                        @if($settings['site_favicon'])
                        <div class="mb-3 flex items-center space-x-4">
                            <img src="{{ asset($settings['site_favicon']) }}" class="h-8 w-8 rounded border object-contain bg-gray-50 p-0.5" alt="Favicon">
                            <div>
                                <span class="text-xs text-gray-500 block">Favicon saat ini</span>
                                @if($faviconDimensions)
                                <span class="text-xs text-indigo-600 font-medium">{{ $faviconDimensions }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <input type="file" name="site_favicon" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 file:cursor-pointer">
                        @error('site_favicon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div>
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-4">Kontak</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">{{ old('address', $settings['address']) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $settings['phone']) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp']) }}" placeholder="628xxx" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email']) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div>
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-4">Media Sosial</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $settings['facebook']) }}" placeholder="https://facebook.com/..." class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $settings['instagram']) }}" placeholder="https://instagram.com/..." class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                        <input type="text" name="youtube" value="{{ old('youtube', $settings['youtube']) }}" placeholder="https://youtube.com/..." class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
