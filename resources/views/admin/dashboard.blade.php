@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 bg-opacity-90 rounded-2xl shadow-lg border-0 p-5 transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center relative z-10">
            <div class="w-14 h-14 bg-white/20 text-white rounded-xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div class="ml-4 text-white">
                <p class="text-indigo-100 font-medium text-sm mb-0.5">Total Berita</p>
                <p class="text-3xl font-extrabold">{{ \App\Models\Post::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-700 bg-opacity-90 rounded-2xl shadow-lg border-0 p-5 transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center relative z-10">
            <div class="w-14 h-14 bg-white/20 text-white rounded-xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="ml-4 text-white">
                <p class="text-purple-100 font-medium text-sm mb-0.5">Portofolio</p>
                <p class="text-3xl font-extrabold">{{ \App\Models\Portfolio::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-rose-500 to-rose-700 bg-opacity-90 rounded-2xl shadow-lg border-0 p-5 transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center relative z-10">
            <div class="w-14 h-14 bg-white/20 text-white rounded-xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="ml-4 text-white">
                <p class="text-rose-100 font-medium text-sm mb-0.5">Layanan</p>
                <p class="text-3xl font-extrabold">{{ \App\Models\Service::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 bg-opacity-90 rounded-2xl shadow-lg border-0 p-5 transform hover:scale-105 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-white opacity-10 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex items-center relative z-10">
            <div class="w-14 h-14 bg-white/20 text-white rounded-xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </div>
            <div class="ml-4 text-white">
                <p class="text-emerald-100 font-medium text-sm mb-0.5">Menu (Hidden)</p>
                <p class="text-3xl font-extrabold">{{ \App\Models\Menu::count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-800 p-8 transform hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
    <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-50 dark:bg-indigo-900/10 rounded-full blur-3xl"></div>
    <div class="relative z-10">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2 tracking-tight">Selamat Datang di Panel Admin ✨</h3>
        <p class="text-gray-500 dark:text-slate-400 text-lg">Gunakan menu di navigasi samping untuk mulai mengelola konten website Anda dengan mudah dan cepat.</p>
    </div>
</div>
@endsection
