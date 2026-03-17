<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{'dark':isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $favicon = \App\Models\Setting::get('site_favicon',''); @endphp
    @if($favicon)<link rel="icon" type="image/webp" href="{{ asset($favicon) }}">@endif
    <title>{{ $siteName }} - Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class'}</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}[x-cloak]{display:none!important}</style>
    <script>function darkMode(){return{isDark:localStorage.getItem('darkMode')==='true'||(localStorage.getItem('darkMode')===null&&window.matchMedia('(prefers-color-scheme:dark)').matches),toggle(){this.isDark=!this.isDark;localStorage.setItem('darkMode',this.isDark)}}}</script>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-slate-200 flex flex-col min-h-screen transition-colors" x-data="{mobileMenuOpen:false}">
    @include('frontend.components.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 flex-grow">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Hubungi Kami</h1>
            <p class="mt-4 text-xl text-gray-500 dark:text-slate-400">Kami siap menjawab pertanyaan dan melayani Anda.</p>
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm p-8 md:p-12 border border-gray-100 dark:border-slate-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Informasi Kontak</h3>
                    <div class="space-y-4">
                        @if($settings['address'])
                        <div class="flex items-start"><span class="text-indigo-600 dark:text-indigo-400 mr-3">📍</span><span class="text-gray-600 dark:text-slate-400">{{ $settings['address'] }}</span></div>
                        @endif
                        @if($settings['phone'])
                        <div class="flex items-start"><span class="text-indigo-600 dark:text-indigo-400 mr-3">📞</span><span class="text-gray-600 dark:text-slate-400">{{ $settings['phone'] }}</span></div>
                        @endif
                        @if($settings['email'])
                        <div class="flex items-start"><span class="text-indigo-600 dark:text-indigo-400 mr-3">📧</span><span class="text-gray-600 dark:text-slate-400">{{ $settings['email'] }}</span></div>
                        @endif
                        @if($settings['whatsapp'])
                        <div class="flex items-start"><span class="text-indigo-600 dark:text-indigo-400 mr-3">💬</span><a href="https://wa.me/{{ $settings['whatsapp'] }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">WhatsApp: {{ $settings['whatsapp'] }}</a></div>
                        @endif
                        @if(!$settings['address'] && !$settings['phone'] && !$settings['email'] && !$settings['whatsapp'])
                        <p class="text-gray-400 dark:text-slate-500">Informasi kontak belum diatur.</p>
                        @endif
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Kirim Pesan</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Nama Lengkap</label>
                            <input type="text" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Email</label>
                            <input type="email" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Pesan</label>
                            <textarea rows="4" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 border"></textarea>
                        </div>
                        <button type="button" class="w-full bg-indigo-600 text-white py-2.5 px-4 rounded-lg hover:bg-indigo-700 transition font-medium">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('frontend.components.footer')
</body>
</html>
