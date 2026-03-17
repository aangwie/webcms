<!DOCTYPE html>
@php $loginSiteName = \App\Models\Setting::get('site_name','EduCMS'); $loginFavicon = \App\Models\Setting::get('site_favicon',''); @endphp
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($loginFavicon)<link rel="icon" type="image/webp" href="{{ asset($loginFavicon) }}">@endif
    <title>Login Admin - {{ $loginSiteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-4">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-500/30 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
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

                <div>
                    <label for="password" class="block text-sm font-medium text-indigo-200 mb-1.5">Password</label>
                    <input id="password" type="password" name="password" required
                           class="w-full bg-white/10 border border-white/20 text-white placeholder-indigo-300/50 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all"
                           placeholder="••••••••">
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
