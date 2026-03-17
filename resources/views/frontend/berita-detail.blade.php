<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $post->title }} - {{ $siteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class'}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}[x-cloak]{display:none!important}</style>
    <script>function darkMode(){return{isDark:localStorage.getItem('darkMode')==='true'||(localStorage.getItem('darkMode')===null&&window.matchMedia('(prefers-color-scheme:dark)').matches),toggle(){this.isDark=!this.isDark;localStorage.setItem('darkMode',this.isDark)}}}</script>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-slate-200 flex flex-col min-h-screen transition-colors" x-data="{mobileMenuOpen:false}">
    @include('frontend.components.navbar')

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
        <nav class="mb-6 text-sm text-gray-400 dark:text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('berita') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600 dark:text-slate-300">{{ Str::limit($post->title, 40) }}</span>
        </nav>
        <article class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm overflow-hidden border border-gray-100 dark:border-slate-800">
            @if($post->image_path)
            <div class="w-full h-64 sm:h-80 md:h-96">
                <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
            @endif
            <div class="p-6 sm:p-10">
                <div class="flex flex-wrap items-center text-sm text-gray-400 dark:text-slate-500 space-x-3 mb-4">
                    <span>{{ $post->created_at->format('d M Y') }}</span>
                    @if($post->category)<span class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full text-xs font-medium">{{ $post->category }}</span>@endif
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">{{ $post->title }}</h1>
                <div class="prose prose-indigo dark:prose-invert max-w-none text-gray-600 dark:text-slate-300 leading-relaxed">
                    {!! $post->content !!}
                </div>
            </div>
        </article>
        <div class="mt-8">
            <a href="{{ route('berita') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:underline font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Berita
            </a>
        </div>
    </main>

    @include('frontend.components.footer')
</body>
</html>
