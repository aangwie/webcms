@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Menu</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Menu::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Berita</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Post::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Portofolio</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Portfolio::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Layanan</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Service::count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-xl shadow-sm border p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Selamat Datang di Panel Admin</h3>
    <p class="text-gray-500">Gunakan menu di sidebar untuk mengelola konten website Anda.</p>
</div>
@endsection
