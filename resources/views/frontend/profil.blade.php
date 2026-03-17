<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $siteName }} - Tentang</title>
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
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Tentang {{ $siteName }}</h1>
            @if($tagline)<p class="mt-4 text-xl text-gray-500 dark:text-slate-400">{{ $tagline }}</p>@endif
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm overflow-hidden border border-gray-100 dark:border-slate-800">
            @if($about->image_path)
            <div class="w-full h-64 sm:h-80 md:h-96">
                <img src="{{ asset($about->image_path) }}" alt="Tentang {{ $siteName }}" class="w-full h-full object-cover">
            </div>
            @endif
            <div class="p-8 md:p-12">
                @if($about->content)
                <div class="prose prose-indigo dark:prose-invert max-w-none text-gray-600 dark:text-slate-300 leading-relaxed">
                    {!! $about->content !!}
                </div>
                @else
                <p class="text-center text-gray-400 dark:text-slate-500">Belum ada informasi tentang kami.</p>
                @endif
            </div>
        </div>
    </main>

    @include('frontend.components.footer')
</body>
</html>
