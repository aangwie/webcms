<!DOCTYPE html>
@php $loginSiteName = \App\Models\Setting::get('site_name','EduCMS'); $loginFavicon = \App\Models\Setting::get('site_favicon',''); @endphp
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($loginFavicon)<link rel="icon" type="image/webp" href="{{ asset($loginFavicon) }}">@endif
    <title>Login Admin - {{ $loginSiteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-4">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            @if($loginFavicon)
                <img src="{{ asset($loginFavicon) }}" alt="{{ $loginSiteName }}" class="inline-block w-16 h-16 object-contain rounded-2xl shadow-lg shadow-indigo-500/30 bg-white p-2 mb-4">
            @else
                <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-500/30 mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            @endif
            <h1 class="text-2xl font-bold text-white">{{ $loginSiteName }}</h1>
            <p class="text-indigo-300 text-sm mt-1">Panel Administrasi</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-8 shadow-2xl">
            <h2 class="text-lg font-semibold text-white mb-6">Masuk ke Akun Anda</h2>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-500/20 border border-red-500/30 rounded-lg text-sm text-red-200">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('status'))
                <div class="mb-4 p-3 bg-green-500/20 border border-green-500/30 rounded-lg text-sm text-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-indigo-200 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-white/10 border border-white/20 text-white placeholder-indigo-300/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all"
                           placeholder="admin@educms.com">
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-medium text-indigo-200 mb-1.5">Password</label>
                    <div class="relative">
                        <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                               class="w-full bg-white/10 border border-white/20 text-white placeholder-indigo-300/50 rounded-lg px-4 py-2.5 pr-10 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all"
                               placeholder="••••••••">
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-indigo-300 hover:text-white focus:outline-none transition-colors">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/10 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-indigo-200">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-lg transition-colors shadow-lg shadow-indigo-500/30">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-indigo-400/60 mt-6">&copy; {{ date('Y') }} {{ $loginSiteName }}. All rights reserved.</p>
    </div>
</body>
</html>
