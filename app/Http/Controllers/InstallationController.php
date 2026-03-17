<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;
use PDO;

class InstallationController extends Controller
{
    /**
     * Tampilkan halaman install atau redirect ke home jika sudah terinstall
     */
    public function index()
    {
        // Jika ada pending migration, jalankan dulu
        if ($this->hasPendingMigration()) {
            return $this->runPendingMigration();
        }

        // Jika DB_DATABASE kosong, tampilkan form installer
        $dbName = env('DB_DATABASE');
        if (empty($dbName)) {
            return view('install.index');
        }

        try {
            DB::connection()->getPdo();
            DB::select('SELECT 1');
            return redirect('/');
        } catch (Exception $e) {
            return view('install.index');
        }
    }

    /**
     * Proses form instalasi
     */
    public function install(Request $request)
    {
        $request->validate([
            'db_host'     => 'required',
            'db_port'     => 'required|numeric',
            'db_database' => 'required',
            'db_username' => 'required',
            'db_password' => 'nullable',
        ]);

        $host     = $request->db_host;
        $port     = $request->db_port;
        $database = $request->db_database;
        $username = $request->db_username;
        $password = $request->db_password ?? '';

        try {
            // 1. Tes koneksi ke MySQL server
            $pdo = new PDO(
                "mysql:host={$host};port={$port}",
                $username,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            // 2. Buat database jika belum ada
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo = null;

            // 3. Tulis kredensial ke file .env
            $this->setEnv([
                'DB_CONNECTION' => 'mysql',
                'DB_HOST'       => $host,
                'DB_PORT'       => $port,
                'DB_DATABASE'   => $database,
                'DB_USERNAME'   => $username,
                'DB_PASSWORD'   => $password,
            ]);

            // 4. Buat flag file untuk menandai bahwa migrasi harus dijalankan
            //    Migrasi akan dijalankan di request BERIKUTNYA karena
            //    php artisan serve (built-in server) sering crash saat
            //    menjalankan operasi DB berat dalam request POST.
            File::put(storage_path('app/install_pending'), json_encode([
                'database' => $database,
                'created_at' => now()->toDateTimeString(),
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Konfigurasi tersimpan! Halaman akan dimuat ulang untuk menyelesaikan migrasi...',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cek apakah ada pending migration
     */
    private function hasPendingMigration(): bool
    {
        return File::exists(storage_path('app/install_pending'));
    }

    /**
     * Jalankan pending migration (dipanggil dari GET /install)
     */
    private function runPendingMigration()
    {
        try {
            // Update process-level env vars agar env() membaca nilai baru
            $envVars = [
                'DB_CONNECTION' => env('DB_CONNECTION', 'mysql'),
                'DB_HOST'       => env('DB_HOST', '127.0.0.1'),
                'DB_PORT'       => env('DB_PORT', '3306'),
                'DB_DATABASE'   => env('DB_DATABASE', ''),
                'DB_USERNAME'   => env('DB_USERNAME', 'root'),
                'DB_PASSWORD'   => env('DB_PASSWORD', ''),
            ];

            // Baca dari .env secara manual jika env() masih kosong
            $envPath = base_path('.env');
            if (File::exists($envPath)) {
                $lines = explode("\n", File::get($envPath));
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line) || str_starts_with($line, '#')) continue;
                    if (str_contains($line, '=')) {
                        [$key, $val] = explode('=', $line, 2);
                        $key = trim($key);
                        $val = trim($val, '"\''); // Hapus kutip
                        if (array_key_exists($key, $envVars)) {
                            $envVars[$key] = $val;
                        }
                    }
                }
            }

            // Set semua env vars di level proses
            foreach ($envVars as $key => $value) {
                putenv("{$key}={$value}");
                $_ENV[$key]    = $value;
                $_SERVER[$key] = $value;
            }

            // Update runtime config
            config([
                'database.default' => 'mysql',
                'database.connections.mysql.host'     => $envVars['DB_HOST'],
                'database.connections.mysql.port'     => $envVars['DB_PORT'],
                'database.connections.mysql.database' => $envVars['DB_DATABASE'],
                'database.connections.mysql.username' => $envVars['DB_USERNAME'],
                'database.connections.mysql.password' => $envVars['DB_PASSWORD'],
            ]);

            DB::purge('mysql');
            DB::reconnect('mysql');

            // Jalankan migrasi + seeder
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);

            // Hapus flag file
            File::delete(storage_path('app/install_pending'));

            // Redirect ke homepage
            return redirect('/')->with('success', 'Instalasi berhasil!');

        } catch (Exception $e) {
            // Hapus flag file agar tidak loop
            File::delete(storage_path('app/install_pending'));

            return response('Migrasi gagal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Menulis nilai ke file .env
     */
    private function setEnv(array $data): void
    {
        $envPath    = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $escaped = str_replace('"', '\\"', trim($value));
            $line    = "{$key}=\"{$escaped}\"";

            if (preg_match("/^{$key}=.*/m", $envContent)) {
                $envContent = preg_replace("/^{$key}=.*/m", $line, $envContent);
            } else {
                $envContent .= "\n{$line}\n";
            }
        }

        File::put($envPath, $envContent);
    }
}
