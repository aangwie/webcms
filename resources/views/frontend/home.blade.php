<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $siteName }} - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class'}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Inter',sans-serif}
        [x-cloak]{display:none!important}
        .carousel-track{display:flex;transition:transform .5s ease}
        .no-scrollbar::-webkit-scrollbar{display:none}
        .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
    </style>
    <script>
        function darkMode(){return{isDark:localStorage.getItem('darkMode')==='true'||(localStorage.getItem('darkMode')===null&&window.matchMedia('(prefers-color-scheme:dark)').matches),toggle(){this.isDark=!this.isDark;localStorage.setItem('darkMode',this.isDark)}}}
    </script>
</head>
<body class="bg-white dark:bg-slate-950 text-gray-800 dark:text-slate-200 transition-colors" x-data="{mobileMenuOpen:false}">

    @include('frontend.components.navbar')

    {{-- ═══════ HERO CAROUSEL ═══════ --}}
    <section x-data="{current:0,total:{{ $portfolios->count() > 0 ? $portfolios->count() : 1 }}}" x-init="setInterval(()=>{current=(current+1)%total},4000)" class="relative h-[500px] sm:h-[600px] overflow-hidden bg-slate-900">
        @if($portfolios->count() > 0)
            @foreach($portfolios as $i => $pf)
            <div x-show="current==={{ $i }}" x-transition:enter="transition-opacity duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                @if($pf->image_path)
                <img src="{{ asset($pf->image_path) }}" alt="{{ $pf->title }}" class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute bottom-16 left-0 right-0 px-6 sm:px-12 lg:px-20 text-white">
                    <h2 class="text-2xl sm:text-4xl font-bold mb-2 drop-shadow-lg">{{ $pf->title }}</h2>
                    @if($pf->description)<p class="text-sm sm:text-base text-gray-200 max-w-2xl drop-shadow">{{ Str::limit(strip_tags($pf->description), 120) }}</p>@endif
                </div>
            </div>
            @endforeach
        @else
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center">
            <div class="text-center text-white px-6">
                <h1 class="text-4xl sm:text-6xl font-extrabold mb-4">{{ $siteName }}</h1>
                <p class="text-xl text-indigo-200">{{ $tagline }}</p>
            </div>
        </div>
        @endif
        {{-- Dots --}}
        @if($portfolios->count() > 1)
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2">
            @foreach($portfolios as $i => $pf)
            <button @click="current={{ $i }}" :class="current==={{ $i }}?'bg-white w-8':'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>
        @endif
    </section>

    {{-- ═══════ TENTANG RINGKAS ═══════ --}}
    <section class="py-20 bg-gray-50 dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:gap-12">
            @if($about && $about->image_path)
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <img src="{{ asset($about->image_path) }}" alt="Tentang" class="rounded-2xl shadow-lg w-full h-64 sm:h-80 object-cover">
            </div>
            @endif
            <div class="{{ $about && $about->image_path ? 'lg:w-1/2' : 'max-w-3xl mx-auto text-center' }}">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase mb-2">Tentang Kami</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">{{ $siteName }}</h3>
                @if($about && $about->content)
                <p class="text-gray-600 dark:text-slate-400 leading-relaxed mb-6">{{ Str::limit(strip_tags($about->content), 300) }}</p>
                @endif
                <a href="{{ route('profil') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition-colors">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════ LAYANAN ═══════ --}}
    @if($services->count() > 0)
    <section class="py-20 bg-white dark:bg-slate-950 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Layanan Kami</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Solusi Terbaik Untuk Anda</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $svc)
                <div class="group bg-gray-50 dark:bg-slate-900 rounded-2xl p-8 border border-gray-100 dark:border-slate-800 hover:border-indigo-200 dark:hover:border-indigo-800 hover:shadow-lg transition-all duration-300">
                    <div class="h-14 w-14 rounded-xl bg-indigo-600 text-white flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <span class="font-bold text-xl">{{ $svc->icon ?? $loop->iteration }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $svc->name }}</h3>
                    <p class="text-gray-500 dark:text-slate-400 text-sm leading-relaxed">{{ Str::limit($svc->description, 120) }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('layanan') }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat semua layanan &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ PORTOFOLIO CAROUSEL ═══════ --}}
    @if($portfolios->count() > 0)
    <section class="py-20 bg-gray-50 dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Portofolio</h2>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Karya Kami</p>
                </div>
                <a href="{{ route('portofolio') }}" class="hidden sm:inline-flex text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat semua &rarr;</a>
            </div>
            <div class="flex gap-6 overflow-x-auto no-scrollbar pb-4 snap-x snap-mandatory">
                @foreach($portfolios as $pf)
                <div class="flex-shrink-0 w-72 sm:w-80 snap-start">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                        @if($pf->image_path)
                        <img src="{{ asset($pf->image_path) }}" class="w-full h-48 object-cover" alt="{{ $pf->title }}">
                        @else
                        <div class="w-full h-48 bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-400">Portofolio</div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">{{ $pf->title }}</h3>
                            @if($pf->client)<p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">{{ $pf->client }}</p>@endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="sm:hidden text-center mt-4">
                <a href="{{ route('portofolio') }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat semua &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ BERITA TERBARU ═══════ --}}
    @if($posts->count() > 0)
    <section class="py-20 bg-white dark:bg-slate-950 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Berita Terbaru</h2>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Kabar & Pengumuman</p>
                </div>
                <a href="{{ route('berita') }}" class="hidden sm:inline-flex text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat semua &rarr;</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="bg-gray-50 dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border border-gray-100 dark:border-slate-800">
                    @if($post->image_path)
                    <img src="{{ asset($post->image_path) }}" class="w-full h-48 object-cover" alt="{{ $post->title }}">
                    @else
                    <div class="w-full h-48 bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-300 text-sm">Berita</div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-xs text-gray-400 dark:text-slate-500 space-x-2 mb-3">
                            <span>{{ $post->created_at->format('d M Y') }}</span>
                            @if($post->category)<span>&bull;</span><span class="text-indigo-600 dark:text-indigo-400 font-medium">{{ $post->category }}</span>@endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-500 dark:text-slate-400 text-sm line-clamp-2 mb-4">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('berita.detail', $post->slug) }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-medium hover:underline">Baca selengkapnya &rarr;</a>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="sm:hidden text-center mt-6">
                <a href="{{ route('berita') }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat semua &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ MITRA ═══════ --}}
    @if($partners->count() > 0)
    <section class="py-16 bg-gray-50 dark:bg-slate-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Mitra Kami</h2>
                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">Dipercaya Oleh</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12">
                @foreach($partners as $p)
                <div class="group flex flex-col items-center" title="{{ $p->name }}">
                    @if($p->image_path)
                    <img src="{{ asset($p->image_path) }}" alt="{{ $p->name }}" class="h-16 sm:h-20 w-auto object-contain grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition-all duration-300">
                    @else
                    <div class="h-16 w-24 bg-gray-200 dark:bg-slate-700 rounded flex items-center justify-center text-gray-400 text-xs">{{ $p->name }}</div>
                    @endif
                    <span class="mt-2 text-xs text-gray-500 dark:text-slate-400 font-medium">{{ $p->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ CTA ═══════ --}}
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Siap Berkolaborasi?</h2>
            <p class="text-indigo-200 text-lg mb-8 max-w-2xl mx-auto">Hubungi kami untuk konsultasi dan diskusi kebutuhan Anda. Kami siap membantu mewujudkan ide terbaik Anda.</p>
            <a href="{{ route('kontak') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-gray-100 transition-colors shadow-lg">
                Hubungi Kami
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>

    @include('frontend.components.footer')
</body>
</html>
