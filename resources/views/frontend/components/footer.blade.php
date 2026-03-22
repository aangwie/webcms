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
                    @if($sFacebook)
                    <a href="{{ $sFacebook }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-indigo-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors" title="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                    @if($sInstagram)
                    <a href="{{ $sInstagram }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-pink-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors" title="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                    @if($sYoutube)
                    <a href="{{ $sYoutube }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-red-600 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors" title="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                    @php $sWhatsapp = \App\Models\Setting::get('whatsapp', ''); @endphp
                    @if($sWhatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sWhatsapp) }}" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-green-500 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors" title="WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.013 2.002c-5.514 0-9.998 4.48-9.998 9.995 0 1.956.556 3.844 1.615 5.452L2 22l4.678-1.614c1.554 1.006 3.385 1.543 5.335 1.543 5.513 0 9.997-4.48 9.997-9.996C22 6.483 17.525 2.002 12.013 2.002zm5.411 14.28c-.227.636-1.317 1.229-1.808 1.272-.493.042-1.077.208-3.414-.76-2.825-1.166-4.636-4.04-4.773-4.22-.136-.182-1.144-1.52-1.144-2.895 0-1.376.717-2.053.97-2.327.253-.272.548-.344.73-.344.182 0 .363.003.522.01.171.008.401-.064.63.486.237.568.793 1.933.864 2.078.071.146.12.316.03.504-.092.188-.138.304-.275.467-.136.162-.288.354-.413.486-.134.143-.276.297-.123.565.152.268.68 1.127 1.458 1.817.994.882 1.83 1.155 2.1 1.282.268.127.424.106.581-.072.158-.18 .675-.785.856-1.055.181-.27.362-.224.607-.132.245.093 1.551.732 1.815.864.265.132.443.197.508.307.065.109.065.635-.162 1.27z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} {{ $siteName }}. Semua hak cipta dilindungi.
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<div x-data="{ show: false }" 
     @scroll.window="show = window.pageYOffset > 300" 
     class="fixed bottom-6 right-6 z-50 transition-all duration-500 ease-in-out"
     :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10 pointer-events-none'">
    <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="p-3 bg-indigo-600/70 hover:bg-indigo-600 dark:bg-indigo-500/70 dark:hover:bg-indigo-500 text-white backdrop-blur-md rounded-full shadow-lg hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 border border-white/20 dark:border-white/10"
            aria-label="Kembali ke atas">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>
</div>
