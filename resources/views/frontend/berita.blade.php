<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $siteName }} - Berita</title>
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
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Berita & Pengumuman</h1>
            <p class="mt-4 text-xl text-gray-500 dark:text-slate-400">Informasi terbaru seputar kegiatan dan agenda.</p>
        </div>
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach($posts as $post)
            <article class="bg-white dark:bg-slate-900 rounded-xl shadow-sm flex flex-col md:flex-row overflow-hidden hover:shadow-md transition border border-gray-100 dark:border-slate-800">
                <div class="md:w-1/3 h-48 md:h-auto flex-shrink-0">
                    @if($post->image_path)
                        <img src="{{ asset($post->image_path) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                    @else
                        <div class="w-full h-full bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-400 text-sm">Gambar</div>
                    @endif
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center text-xs text-gray-400 dark:text-slate-500 space-x-2 mb-2">
                            <span>{{ $post->created_at->format('d M Y') }}</span>
                            @if($post->category)<span>&bull;</span><span class="text-indigo-600 dark:text-indigo-400 font-medium">{{ $post->category }}</span>@endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-500 dark:text-slate-400 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                    </div>
                    <a href="{{ route('berita.detail', $post->slug) }}" class="text-indigo-600 dark:text-indigo-400 font-medium text-sm hover:underline">Baca selengkapnya &rarr;</a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-gray-400 dark:text-slate-500"><p class="text-lg">Belum ada berita yang dipublikasikan.</p></div>
        @endif
    </main>

    @include('frontend.components.footer')
</body>
</html>
