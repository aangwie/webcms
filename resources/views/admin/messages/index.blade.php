@extends('layouts.admin')
@section('title', 'Pesan Kontak')
@section('header', 'Pesan Kontak')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 overflow-hidden">
    <div class="p-6 border-b dark:border-slate-700">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Daftar Pesan Masuk</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 dark:bg-slate-700/50 border-b dark:border-slate-700 hidden md:table-row">
                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Nama</th>
                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                    <th class="py-3 px-6 text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($messages as $msg)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors {{ !$msg->is_read ? 'bg-indigo-50/30 dark:bg-indigo-900/10' : '' }} flex flex-col md:table-row">
                    <td class="py-4 px-6 md:py-3 whitespace-nowrap">
                        <div class="flex items-center">
                            @if(!$msg->is_read)
                            <span class="h-2.5 w-2.5 rounded-full bg-indigo-600 mr-2 shrink-0"></span>
                            @endif
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $msg->name }}</div>
                        </div>
                    </td>
                    <td class="py-1 px-6 md:py-3 whitespace-nowrap">
                        <div class="text-sm text-gray-500 dark:text-slate-400">{{ $msg->email }}</div>
                    </td>
                    <td class="py-1 px-6 md:py-3 whitespace-nowrap">
                        @if($msg->replied_at)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Dibalas</span>
                        @elseif($msg->is_read)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-slate-700 dark:text-slate-300">Dibaca</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Baru</span>
                        @endif
                    </td>
                    <td class="py-1 px-6 md:py-3 whitespace-nowrap text-sm text-gray-500 dark:text-slate-400">
                        {{ $msg->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="py-3 px-6 md:py-3 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Detail</a>
                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pesan ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500 dark:text-slate-400">Belum ada pesan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="p-4 border-t dark:border-slate-700">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
