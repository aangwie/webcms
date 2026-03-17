@php
    $siteName = \App\Models\Setting::get('site_name', 'EduCMS');
    $sAddress = \App\Models\Setting::get('address', '');
    $sPhone = \App\Models\Setting::get('phone', '');
    $sEmail = \App\Models\Setting::get('email', '');
    $sFacebook = \App\Models\Setting::get('facebook', '');
    $sInstagram = \App\Models\Setting::get('instagram', '');
    $sYoutube = \App\Models\Setting::get('youtube', '');
@endphp
<footer class="bg-gray-900 dark:bg-slate-950 mt-auto transition-colors">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div>
                <h3 class="text-xl font-bold text-white mb-3">{{ $siteName }}</h3>
                @if($sAddress)
                <p class="text-gray-400 text-sm">{{ $sAddress }}</p>
                @endif
            </div>
            <!-- Menu -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('profil') }}" class="text-gray-400 hover:text-white transition-colors">Tentang</a></li>
                    <li><a href="{{ route('portofolio') }}" class="text-gray-400 hover:text-white transition-colors">Portofolio</a></li>
                    <li><a href="{{ route('berita') }}" class="text-gray-400 hover:text-white transition-colors">Berita</a></li>
                    <li><a href="{{ route('layanan') }}" class="text-gray-400 hover:text-white transition-colors">Layanan</a></li>
                </ul>
            </div>
            <!-- Kontak -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    @if($sPhone)<li>📞 {{ $sPhone }}</li>@endif
                    @if($sEmail)<li>📧 {{ $sEmail }}</li>@endif
                </ul>
            </div>
            <!-- Sosmed -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Ikuti Kami</h4>
                <div class="flex space-x-3">
                    @if($sFacebook)<a href="{{ $sFacebook }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-indigo-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors text-sm">f</a>@endif
                    @if($sInstagram)<a href="{{ $sInstagram }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-pink-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors text-sm">ig</a>@endif
                    @if($sYoutube)<a href="{{ $sYoutube }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-red-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors text-sm">yt</a>@endif
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} {{ $siteName }}. Semua hak cipta dilindungi.
        </div>
    </div>
</footer>
