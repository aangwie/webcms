@php
    $siteName = \App\Models\Setting::get('site_name', 'EduCMS');
    $siteLogo = \App\Models\Setting::get('site_logo', '');
@endphp
<nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm border-b border-gray-100 dark:border-slate-800 sticky top-0 z-50 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                @if($siteLogo)
                    <a href="{{ route('home') }}"><img src="{{ asset($siteLogo) }}" alt="{{ $siteName }}" class="h-10 w-auto"></a>
                @else
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $siteName }}</a>
                @endif
            </div>
            <div class="hidden md:flex md:space-x-6 md:items-center">
                @php $links=[['route'=>'home','label'=>'Beranda'],['route'=>'profil','label'=>'Tentang'],['route'=>'portofolio','label'=>'Portofolio'],['route'=>'berita','label'=>'Berita'],['route'=>'layanan','label'=>'Layanan'],['route'=>'kontak','label'=>'Kontak']]; @endphp
                @foreach($links as $l)
                <a href="{{ route($l['route']) }}" class="{{ request()->routeIs($l['route'])?'text-indigo-600 dark:text-indigo-400 border-indigo-500':'text-gray-600 dark:text-slate-300 border-transparent hover:text-indigo-600 dark:hover:text-indigo-400 hover:border-indigo-300' }} border-b-2 px-1 pt-1 text-sm font-medium transition-colors">{{ $l['label'] }}</a>
                @endforeach
                <button @click="$root.__x.$data.toggle()" class="p-2 rounded-lg text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors" title="Mode Gelap">
                    <svg x-show="!$root.__x.$data.isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="$root.__x.$data.isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <a href="/login" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Login</a>
            </div>
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="$root.__x.$data.toggle()" class="p-2 mr-1 rounded-lg text-gray-400 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800">
                    <svg x-show="!$root.__x.$data.isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="$root.__x.$data.isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <button @click="mobileMenuOpen=!mobileMenuOpen" class="p-2 rounded-md text-gray-400 dark:text-slate-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-800">
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
    <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($links as $l)
            <a href="{{ route($l['route']) }}" class="{{ request()->routeIs($l['route'])?'bg-indigo-50 dark:bg-indigo-900/30 border-indigo-500 text-indigo-700 dark:text-indigo-400':'border-transparent text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ $l['label'] }}</a>
            @endforeach
            <a href="/login" class="border-transparent text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-slate-800 block pl-3 pr-4 py-2 text-base font-medium">Login Admin</a>
        </div>
    </div>
</nav>
