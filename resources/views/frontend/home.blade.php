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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Inter',sans-serif}
        [x-cloak]{display:none!important}
        .no-scrollbar::-webkit-scrollbar{display:none}
        .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
    </style>
    <script>
        function darkMode(){
            const stored=localStorage.getItem('themeMode');
            const prefersDark=window.matchMedia('(prefers-color-scheme:dark)');
            function resolve(mode){return mode==='dark'||(mode==='auto'&&prefersDark.matches)}
            return{
                themeMode:stored||'auto',
                isDark:resolve(stored||'auto'),
                setTheme(mode){this.themeMode=mode;localStorage.setItem('themeMode',mode);this.isDark=resolve(mode)},
                cycleTheme(){const modes=['light','dark','auto'];const i=(modes.indexOf(this.themeMode)+1)%3;this.setTheme(modes[i])},
                init(){prefersDark.addEventListener('change',()=>{if(this.themeMode==='auto')this.isDark=prefersDark.matches})}
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-slate-200 transition-colors" x-data="{mobileMenuOpen:false}">

    @include('frontend.components.navbar')

    {{-- ═══════ HERO SECTION (SPLIT LAYOUT) ═══════ --}}
    <section class="relative py-16 sm:py-24 lg:py-32 bg-gradient-to-br from-purple-100 via-white to-purple-100 dark:bg-none dark:bg-slate-900 border-b border-purple-100 dark:border-slate-800 transition-colors overflow-hidden">
        {{-- Custom decorative blur elements --}}
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-purple-300/40 dark:bg-purple-900/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-80 h-80 rounded-full bg-indigo-200/50 dark:bg-indigo-900/20 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center justify-between gap-12 lg:gap-8 relative z-10">
            {{-- Left Side: Text --}}
            <div class="w-full lg:w-7/12 text-center lg:text-left">
                <span class="inline-block py-1 px-4 rounded-full bg-purple-100 text-purple-700 font-semibold mb-6 shadow-sm border border-purple-200 dark:bg-purple-900/30 dark:text-purple-300 dark:border-purple-800/50">✨ Solusi Digital Masa Depan</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight tracking-tight">
                    {{ $siteName }}
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    {{ $tagline ?: 'Menyediakan solusi digital profesional yang sesuai dengan kebutuhan dan menunjang kesuksesan bisnis Anda di era modern.' }}
                </p>
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="{{ route('portofolio') }}" class="px-8 py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 shadow-lg hover:shadow-indigo-500/30 transition-all hover:-translate-y-0.5">Lihat Karya Kami</a>
                    <a href="{{ route('kontak') }}" class="px-8 py-3.5 bg-white text-indigo-600 dark:bg-slate-800 dark:text-indigo-400 font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors border border-indigo-200 dark:border-slate-700 shadow-sm">Hubungi Kami</a>
                </div>
            </div>
            
            {{-- Right Side: Carousel --}}
            <div class="w-full sm:w-10/12 md:w-8/12 lg:w-5/12 flex-shrink-0 mx-auto lg:mx-0 relative z-10">
                <div x-data="{current:0,total:{{ $sliders->count() > 0 ? $sliders->count() : 1 }}}" x-init="setInterval(()=>{current=(current+1)%total},4500)" class="relative w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl ring-4 sm:ring-8 ring-white/60 dark:ring-slate-800 backdrop-blur-sm">
                    @if($sliders->count() > 0)
                        @foreach($sliders as $i => $sl)
                        <div x-show="current==={{ $i }}" x-transition:enter="transition-opacity duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                            @if($sl->image_path)
                            <img src="{{ asset($sl->image_path) }}" alt="{{ $sl->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-200 dark:from-slate-800 dark:to-slate-700 flex items-center justify-center text-indigo-400">Slider {{ $i+1 }}</div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            @if($sl->title)
                            <div class="absolute bottom-10 left-0 right-0 px-6 text-white text-center">
                                <h3 class="text-xl font-bold drop-shadow-md leading-tight">{{ $sl->title }}</h3>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 flex flex-col items-center justify-center p-6 text-center">
                        <span class="text-white font-bold text-lg mb-2">Carousel Image</span>
                        <span class="text-indigo-200 text-sm">Disarankan ukuran: 800px x 600px (atau rasio 4:3)</span>
                    </div>
                    @endif
                    
                    {{-- Dots --}}
                    @if($sliders->count() > 1)
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                        @foreach($sliders as $i => $sl)
                        <button @click="current={{ $i }}" :class="current==={{ $i }}?'bg-white w-6':'bg-white/40 w-2 hover:bg-white/70'" class="h-2 rounded-full transition-all duration-300"></button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    
    {{-- ═══════ LAYANAN ═══════ --}}
    @if($services->count() > 0)
    <section class="py-20 bg-gray-50 dark:bg-slate-950 transition-colors border-b border-gray-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Layanan Kami</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Solusi Terbaik Untuk Anda</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services->take(9) as $svc)
                <div class="group bg-white dark:bg-slate-900 rounded-2xl p-8 border border-gray-100 dark:border-slate-800 hover:border-indigo-200 dark:hover:border-indigo-800 hover:shadow-lg transition-all duration-300">
                    <div class="h-14 w-14 rounded-xl bg-indigo-600 text-white flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        @if($svc->icon && (str_starts_with($svc->icon, 'fas ') || str_starts_with($svc->icon, 'fab ') || str_starts_with($svc->icon, 'far ')))
                            <i class="{{ $svc->icon }} text-xl"></i>
                        @else
                            <span class="font-bold text-xl">{{ $svc->icon ?? $loop->iteration }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $svc->name }}</h3>
                    <p class="text-gray-500 dark:text-slate-400 text-sm leading-relaxed">{{ Str::limit($svc->description, 120) }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('layanan') }}" class="inline-flex py-3 px-6 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 transition">Lihat Semua Layanan &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ PORTOFOLIO (Menggantikan Tentang Kami) ═══════ --}}
    @if($portfolios->count() > 0)
    <section class="py-20 bg-gray-50 dark:bg-slate-950 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Portofolio</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Karya Unggulan Kami</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($portfolios->take(9) as $pf)
                <div class="group bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-slate-800">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        @if($pf->image_path)
                        <img src="{{ asset($pf->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $pf->title }}">
                        @else
                        <div class="w-full h-full bg-indigo-50 dark:bg-slate-800"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                            <div>
                                <h3 class="font-bold text-white text-lg leading-tight mb-1">{{ $pf->title }}</h3>
                                @if($pf->client)<p class="text-xs text-indigo-300 font-medium">{{ $pf->client }}</p>@endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('portofolio') }}" class="inline-flex py-3 px-6 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 transition">Lihat Semua Portofolio &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ BERITA TERBARU (3 Berita Terakhir) ═══════ --}}
    @if($posts->count() > 0)
    <section class="py-20 bg-white dark:bg-slate-900 transition-colors border-b border-gray-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Berita Terbaru</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Kabar & Pengumuman</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts->take(3) as $post)
                <article class="bg-gray-50 dark:bg-slate-950 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border border-gray-100 dark:border-slate-800 flex flex-col h-full group">
                    @if($post->image_path)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset($post->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                    </div>
                    @else
                    <div class="w-full aspect-video bg-indigo-100 dark:bg-slate-800 flex items-center justify-center text-indigo-300 text-sm">Berita</div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-xs text-gray-500 dark:text-slate-400 space-x-2 mb-3">
                            <span>{{ $post->created_at->format('d M Y') }}</span>
                            @if($post->category)<span>&bull;</span><span class="text-indigo-600 dark:text-indigo-400 font-medium bg-indigo-50 dark:bg-indigo-900/30 px-2 py-0.5 rounded-full">{{ $post->category }}</span>@endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            <a href="{{ route('berita.detail', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-500 dark:text-slate-400 text-sm line-clamp-3 mb-5 flex-grow leading-relaxed">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        <a href="{{ route('berita.detail', $post->slug) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 text-sm font-medium hover:underline mt-auto">
                            Baca selengkapnya 
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('berita') }}" class="inline-flex py-3 px-6 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 transition">Lihat Semua Berita &rarr;</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ MITRA ═══════ --}}
    @if($partners->count() > 0)
    <section class="py-16 bg-white dark:bg-slate-900 transition-colors border-b border-gray-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Mitra Kami</h2>
                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">Dipercaya Oleh</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12">
                @foreach($partners as $p)
                <div class="group flex flex-col items-center" title="{{ $p->name }}">
                    @if($p->image_path)
                    <img src="{{ asset($p->image_path) }}" alt="{{ $p->name }}" class="h-16 sm:h-20 w-auto object-contain grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition-all duration-300 rounded-lg">
                    @else
                    <div class="h-16 w-24 bg-gray-100 dark:bg-slate-800 rounded-lg flex items-center justify-center text-gray-400 text-xs font-medium">{{ $p->name }}</div>
                    @endif
                    <span class="mt-3 text-xs text-gray-500 dark:text-slate-400 font-medium opacity-0 group-hover:opacity-100 transition-opacity">{{ $p->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════ CTA ═══════ --}}
    <section class="py-20 bg-gradient-to-br from-indigo-600 to-purple-700 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-500/20 rounded-full blur-2xl"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-6 tracking-tight">Siap Berkolaborasi?</h2>
            <p class="text-indigo-100 text-lg sm:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">Hubungi kami untuk konsultasi dan diskusi kebutuhan Anda. Kami siap membantu mewujudkan ide terbaik Anda.</p>
            <a href="{{ route('kontak') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-gray-50 transition-colors shadow-xl hover:shadow-2xl hover:-translate-y-1 duration-300">
                Hubungi Kami Sekarang
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>

    @include('frontend.components.footer')
</body>
</html>
