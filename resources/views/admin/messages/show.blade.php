@extends('layouts.admin')
@section('title', 'Detail Pesan Kontak')
@section('header', 'Detail Pesan Kontak')

@section('content')
<div class="mb-6 flex space-x-3">
    <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 bg-white dark:bg-slate-800 text-gray-700 dark:text-slate-300 border border-gray-300 dark:border-slate-600 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition">Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b dark:border-slate-700 pb-2">Informasi Pengirim</h3>
        <dl class="space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Nama Lengkap</dt>
                <dd class="mt-1 text-base text-gray-900 dark:text-white font-medium">{{ $message->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Email</dt>
                <dd class="mt-1 text-base text-gray-900 dark:text-white">
                    <a href="mailto:{{ $message->email }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $message->email }}</a>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Tanggal Dikirim</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $message->created_at->format('d M Y H:i:s') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Status Balasan</dt>
                <dd class="mt-1">
                    @if($message->replied_at)
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Dibalas pada {{ \Carbon\Carbon::parse($message->replied_at)->format('d M Y H:i') }}</span>
                    @else
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Belum dibalas</span>
                    @endif
                </dd>
            </div>
        </dl>

        <div class="mt-6 pt-4 border-t dark:border-slate-700">
            <h4 class="text-sm font-medium text-gray-500 dark:text-slate-400 mb-2">Isi Pesan</h4>
            <div class="bg-gray-50 dark:bg-slate-900 p-4 rounded-lg text-gray-800 dark:text-slate-200 border border-gray-100 dark:border-slate-800 whitespace-pre-wrap">
{{ $message->message }}
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b dark:border-slate-700 pb-2">Balas Pesan via Email</h3>
        @if(empty(\App\Models\Setting::get('smtp_host')))
            <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg text-sm dark:bg-yellow-900/30 dark:border-yellow-800/50 dark:text-yellow-200">
                <p><strong>Peringatan!</strong> Anda belum mengkonfigurasi SMTP. Fitur balas email ini belum bisa digunakan.</p>
                <a href="{{ route('admin.settings.index') }}" class="underline font-medium mt-1 inline-block">Buka Pengaturan SMTP</a>
            </div>
        @endif
        
        <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Kepada</label>
                    <input type="text" disabled value="{{ $message->email }}" class="mt-1 block w-full rounded-lg bg-gray-100 border-gray-300 text-gray-500 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-400 px-3 py-2 cursor-not-allowed border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Subjek</label>
                    <input type="text" name="subject" required value="Balasan: Pesan Anda di {{ \App\Models\Setting::get('site_name', 'WebCMS') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Pesan Balasan</label>
                    <textarea name="reply_message" rows="6" required class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border" placeholder="Ketik balasan email Anda di sini..."></textarea>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-indigo-700 transition" {{ empty(\App\Models\Setting::get('smtp_host')) ? 'disabled' : '' }}>
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Balasan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
