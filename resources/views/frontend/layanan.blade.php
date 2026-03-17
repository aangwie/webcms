<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $siteName }} - Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class'}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}[x-cloak]{display:none!important}</style>
    <script>function darkMode(){return{isDark:localStorage.getItem('darkMode')==='true'||(localStorage.getItem('darkMode')===null&&window.matchMedia('(prefers-color-scheme:dark)').matches),toggle(){this.isDark=!this.isDark;localStorage.setItem('darkMode',this.isDark)}}}</script>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-slate-200 transition-colors" x-data="{mobileMenuOpen:false}">
    @include('frontend.components.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Layanan Kami</h1>
            <p class="mt-4 text-xl text-gray-500 dark:text-slate-400">Fasilitas dan program unggulan untuk mendukung ekosistem pendidikan.</p>
        </div>
        @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $svc)
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-lg transition-all text-center">
                <div class="w-16 h-16 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">
                    {{ $svc->icon ?? $loop->iteration }}
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $svc->name }}</h3>
                <p class="text-gray-500 dark:text-slate-400 text-sm">{{ $svc->description }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-gray-400 dark:text-slate-500"><p class="text-lg">Belum ada layanan.</p></div>
        @endif
    </main>

    @include('frontend.components.footer')
</body>
</html>
