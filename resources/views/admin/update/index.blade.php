@extends('layouts.admin')
@section('title', 'Pembaruan Website')
@section('header', 'Manajemen Pembaruan & Sistem')

@section('content')
<div class="max-w-6xl mx-auto" x-data="updateManager()">
    
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Github Token Config -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6 mb-6">
        <h3 class="text-base font-semibold text-gray-800 dark:text-white border-b dark:border-slate-700 pb-2 mb-4">Pengaturan Github Token</h3>
        
        <form action="{{ route('admin.update.token') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Personal Access Token (Classic)</label>
                <input type="text" name="github_token" value="{{ old('github_token', $githubToken) }}" placeholder="ghp_xxxxxxxxx" class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border dark:placeholder-slate-400">
                <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Gunakan Classic Token dengan akses <code>repo</code> untuk mengotentikasi pembaruan kode via Git Pull. Simpan kode ini ke dalam database.</p>
                @error('github_token') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="pt-2">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan Token
                </button>
            </div>
        </form>
    </div>

    <!-- Actions & Terminal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Actions -->
        <div class="space-y-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white border-b dark:border-slate-700 pb-2 mb-4">Aksi Sistem</h3>
                
                <div class="space-y-3">
                    <button @click="runCommand('clear_config')" :disabled="isRunning" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none transition-colors disabled:opacity-50">
                        <i class="fas fa-cog mr-2"></i> Clear Config
                    </button>
                    <button @click="runCommand('clear_cache')" :disabled="isRunning" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none transition-colors disabled:opacity-50">
                        <i class="fas fa-broom mr-2"></i> Clear Cache
                    </button>
                    <button @click="runCommand('storage_link')" :disabled="isRunning" class="w-full flex justify-center items-center px-4 py-2 border border-blue-200 dark:border-blue-900 rounded-lg text-sm font-medium text-blue-700 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 focus:outline-none transition-colors disabled:opacity-50">
                        <i class="fas fa-link mr-2"></i> Symlink Storage
                    </button>
                    
                    <div class="mt-8 pt-4 border-t border-gray-200 dark:border-slate-700">
                        <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-2">Pembaruan Kode Github</h4>
                        <div class="bg-gray-50 dark:bg-slate-900 p-3 rounded-lg text-xs font-mono text-gray-600 dark:text-slate-400 mb-4 break-all shadow-inner border dark:border-slate-700">
                            <span class="font-bold text-gray-700 dark:text-slate-300 block mb-1"><i class="fab fa-git-alt text-orange-500 mr-1"></i> Commit Lokal Saat Ini:</span>
                            {{ $currentCommit }}
                        </div>
                        <button @click="runCommand('git_pull')" :disabled="isRunning" class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-lg text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none shadow-[0_0_15px_rgba(22,163,74,0.4)] transition-all disabled:opacity-50 disabled:shadow-none">
                            <i class="fas fa-cloud-download-alt mr-2" :class="isRunning ? 'animate-bounce' : ''"></i> Tarik Update Website
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terminal Output -->
        <div class="lg:col-span-2">
            <div class="bg-slate-950 rounded-xl shadow-lg border border-slate-800 overflow-hidden flex flex-col h-full min-h-[400px]">
                <!-- Terminal Header -->
                <div class="bg-slate-900 px-4 py-2 flex items-center justify-between border-b border-slate-800">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <div class="text-slate-400 text-xs font-mono select-none">root@billnesia:~#</div>
                    <div class="w-14"></div> <!-- Spacer for center alignment -->
                </div>
                
                <!-- Terminal Body -->
                <div class="p-4 flex-1 overflow-y-auto font-mono text-sm leading-relaxed whitespace-pre-wrap" id="terminal-body" style="max-height: 500px;">
                    <template x-for="(line, index) in log" :key="index">
                        <div x-html="line" class="word-break text-green-400 mb-1"></div>
                    </template>
                    <div x-show="isRunning" class="text-yellow-400 mt-2 flex items-center">
                        <i class="fas fa-circle-notch fa-spin mr-2"></i> Processing...
                    </div>
                    <div x-show="log.length === 0 && !isRunning" class="text-slate-500 italic select-none">
                        Terminal log disiapkan. Silakan eksekusi aksi di sebelah kiri...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('updateManager', () => ({
            isRunning: false,
            log: [],
            
            pushLog(text, colorClass = 'text-green-400') {
                let html = text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
                this.log.push(`<span class="${colorClass}">${html}</span>`);
                
                // auto scroll terminal
                this.$nextTick(() => {
                    const terminal = document.getElementById('terminal-body');
                    terminal.scrollTop = terminal.scrollHeight;
                });
            },

            async runCommand(action) {
                if (this.isRunning) return;
                
                this.isRunning = true;
                this.pushLog(`\n$ Eksekusi [${action}] dimulai...`, 'text-blue-400 font-bold');
                
                try {
                    const response = await fetch("{{ route('admin.update.run') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ action: action })
                    });
                    
                    if (response.ok) {
                        const result = await response.json();
                        this.pushLog(result.output, result.output.includes('Error:') ? 'text-red-400' : 'text-slate-300');
                    } else {
                        this.pushLog(`Error HTTP: ${response.status} ${response.statusText}`, 'text-red-500');
                    }
                } catch (error) {
                    this.pushLog(`Kesalahan koneksi ke server: ${error.message}`, 'text-red-500 font-bold');
                } finally {
                    this.pushLog(`> Selesai.`, 'text-green-600');
                    this.isRunning = false;
                }
            }
        }));
    });
</script>
@endsection
