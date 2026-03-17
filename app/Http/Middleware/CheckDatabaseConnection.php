<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckDatabaseConnection
{
    public function handle(Request $request, Closure $next): Response
    {
        // Abaikan route yang diawali dengan "install"
        if ($request->is('install*')) {
            return $next($request);
        }

        // Cek apakah DB_DATABASE sudah diisi di .env
        $dbName = env('DB_DATABASE');
        if (empty($dbName)) {
            return redirect()->route('install.index');
        }

        try {
            // Cek koneksi + pastikan database benar-benar bisa diakses
            DB::connection()->getPdo();
            DB::connection()->getDatabaseName();
            // Tes query ringan untuk memastikan tabel bisa diakses
            DB::select('SELECT 1');
            return $next($request);
        } catch (Exception $e) {
            return redirect()->route('install.index');
        }
    }
}
