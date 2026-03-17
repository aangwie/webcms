<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto-Installer CMS | Setup System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">
    
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full border border-gray-100" x-data="installer()">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800">🚀 Konfigurasi Database</h2>
            <p class="text-sm text-slate-500 mt-1">Sistem gagal mengakses database. Silahkan isi form berikut.</p>
        </div>
        
        <form @submit.prevent="submitForm" class="space-y-4">
            <input type="hidden" id="crsf_token" value="{{ csrf_token() }}">

            <div>
                <label class="block text-sm font-medium text-slate-700">DB Host</label>
                <input type="text" x-model="form.db_host" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">DB Port</label>
                    <input type="text" x-model="form.db_port" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Database Name</label>
                    <input type="text" x-model="form.db_database" placeholder="contoh: my_cms" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">DB Username</label>
                    <input type="text" x-model="form.db_username" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">DB Password</label>
                    <input type="password" x-model="form.db_password" placeholder="(bisa kosong)" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <button type="submit" :disabled="loading" class="mt-6 w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                <span x-show="!loading">Simpan & Jalankan Instalasi</span>
                <span x-show="loading" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan & Migrasi...
                </span>
            </button>
        </form>

        <div x-show="message" x-transition.opacity class="mt-4 p-3 rounded-lg text-sm text-center" :class="isError ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'">
            <span x-text="message"></span>
        </div>
    </div>

    <script>
        function installer() {
            return {
                form: {
                    db_host: '127.0.0.1',
                    db_port: '3306',
                    db_database: '',
                    db_username: 'root',
                    db_password: ''
                },
                loading: false,
                message: '',
                isError: false,
                async submitForm() {
                    this.loading = true;
                    this.message = '';
                    try {
                        let response = await fetch('/install', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.getElementById('crsf_token').value
                            },
                            body: JSON.stringify(this.form)
                        });
                        
                        let result = await response.json();
                        
                        if(result.success) {
                            this.message = result.message;
                            this.isError = false;
                            // Reload halaman — GET /install akan menjalankan migrasi
                            setTimeout(() => window.location.href = '/install', 1500);
                        } else {
                            this.message = result.message;
                            this.isError = true;
                            this.loading = false;
                        }
                    } catch (error) {
                        // Koneksi mungkin terputus, tapi .env sudah tersimpan.
                        // Reload untuk menjalankan migrasi di request baru.
                        this.message = 'Menyimpan konfigurasi... Memuat ulang halaman.';
                        this.isError = false;
                        setTimeout(() => window.location.href = '/install', 3000);
                    }
                }
            }
        }
    </script>
</body>
</html>
