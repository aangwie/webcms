<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $adminSiteName = \App\Models\Setting::get('site_name', 'EduCMS'); $favicon = \App\Models\Setting::get('site_favicon', ''); @endphp
    <title>@yield('title', 'Admin Panel') - {{ $adminSiteName }}</title>
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class'}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}[x-cloak]{display:none!important}</style>
    <script>
        function darkMode(){
            return {
                isDark: localStorage.getItem('darkMode')==='true'||(localStorage.getItem('darkMode')===null&&window.matchMedia('(prefers-color-scheme:dark)').matches),
                toggle(){this.isDark=!this.isDark;localStorage.setItem('darkMode',this.isDark)}
            }
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-slate-950 min-h-screen transition-colors" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed')==='true' }" x-init="$watch('sidebarCollapsed',val=>localStorage.setItem('sidebarCollapsed',val))">

    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false" class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

    <aside :class="[sidebarOpen?'translate-x-0':'-translate-x-full',sidebarCollapsed?'lg:w-20':'lg:w-64']" class="fixed top-0 left-0 z-50 w-64 h-full bg-slate-900 text-white transition-all duration-300 lg:translate-x-0 lg:z-30">
        <div class="flex items-center h-16 px-4 border-b border-slate-700" :class="sidebarCollapsed?'justify-center':'justify-between'">
            <a href="/admin" class="flex items-center min-w-0" :class="sidebarCollapsed?'justify-center':''">
                <span class="text-xl font-bold text-indigo-400 truncate" x-show="!sidebarCollapsed">{{ $adminSiteName }}</span>
                <span class="text-xl font-bold text-indigo-400" x-show="sidebarCollapsed" x-cloak>{{ mb_substr($adminSiteName,0,1) }}</span>
            </a>
            <button @click="sidebarOpen=false" class="lg:hidden text-slate-400 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <nav class="px-3 py-6 space-y-1">
            @php $nav=[
                ['route'=>'admin.dashboard','match'=>'admin.dashboard','label'=>'Dashboard','icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4'],
                ['route'=>'admin.about.edit','match'=>'admin.about.*','label'=>'Tentang','icon'=>'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.posts.index','match'=>'admin.posts.*','label'=>'Berita','icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.portfolios.index','match'=>'admin.portfolios.*','label'=>'Portofolio','icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.services.index','match'=>'admin.services.*','label'=>'Layanan','icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                ['route'=>'admin.partners.index','match'=>'admin.partners.*','label'=>'Mitra','icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['route'=>'admin.settings.index','match'=>'admin.settings.*','label'=>'Pengaturan','icon'=>'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
            ]; @endphp
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}" class="flex items-center rounded-lg text-sm font-medium transition-colors {{ request()->routeIs($item['match'])?'bg-indigo-600 text-white':'text-slate-300 hover:bg-slate-800 hover:text-white' }}" :class="sidebarCollapsed?'justify-center px-2 py-2.5':'px-3 py-2.5'" title="{{ $item['label'] }}">
                <svg class="w-5 h-5 flex-shrink-0" :class="sidebarCollapsed?'':'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                <span x-show="!sidebarCollapsed" x-transition class="truncate">{{ $item['label'] }}</span>
            </a>
            @endforeach
            <div class="border-t border-slate-700 mt-6 pt-4">
                <a href="/" target="_blank" class="flex items-center rounded-lg text-sm text-slate-400 hover:bg-slate-800 hover:text-white transition-colors" :class="sidebarCollapsed?'justify-center px-2 py-2.5':'px-3 py-2.5'" title="Lihat Website">
                    <svg class="w-5 h-5 flex-shrink-0" :class="sidebarCollapsed?'':'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span x-show="!sidebarCollapsed" x-transition>Lihat Website</span>
                </a>
            </div>
        </nav>
        <div class="hidden lg:flex absolute bottom-4 left-0 right-0 justify-center">
            <button @click="sidebarCollapsed=!sidebarCollapsed" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors" title="Toggle Sidebar">
                <svg class="w-5 h-5 transition-transform" :class="sidebarCollapsed?'rotate-180':''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </button>
        </div>
    </aside>

    <div class="min-h-screen flex flex-col transition-all duration-300" :class="sidebarCollapsed?'lg:ml-20':'lg:ml-64'">
        <header class="sticky top-0 z-20 bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-700 shadow-sm">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                <button @click="sidebarOpen=true" class="lg:hidden text-gray-500 dark:text-slate-400 hover:text-gray-700"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button>
                <h1 class="text-lg font-semibold text-gray-800 dark:text-white hidden sm:block">@yield('header','Dashboard')</h1>
                <div class="flex items-center space-x-3" x-data="{profileOpen:false}">
                    <button @click="$root.__x.$data.toggle()" class="p-2 rounded-lg text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800" title="Mode Gelap">
                        <svg x-show="!$root.__x.$data.isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="$root.__x.$data.isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                    <div class="relative">
                        <button @click="profileOpen=!profileOpen" class="flex items-center text-sm text-gray-600 dark:text-slate-300 hover:text-gray-900 dark:hover:text-white">
                            <span class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center font-semibold text-sm mr-2">{{ mb_substr(Auth::user()->name,0,1) }}</span>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen=false" x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border dark:border-slate-700 py-1 z-50">
                            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-700">Logout</button></form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-grow p-4 sm:p-6">
            @if(session('success'))<div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 rounded-lg text-sm" x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)" x-transition>{{ session('success') }}</div>@endif
            @if(session('error'))<div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 rounded-lg text-sm">{{ session('error') }}</div>@endif
            @yield('content')
        </main>
    </div>
</body>
</html>
