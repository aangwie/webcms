<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class UpdateWebsiteController extends Controller
{
    public function index()
    {
        $githubToken = Setting::get('github_token', '');
        
        // Attempt to get current commit details
        $currentCommit = 'Tidak diketahui';
        try {
            $process = Process::fromShellCommandline('git log -1 --format="%h - %s (%ci)" 2>&1', base_path());
            $process->run();
            if ($process->isSuccessful()) {
                $currentCommit = trim($process->getOutput());
            }
        } catch (\Exception $e) {}

        return view('admin.update.index', compact('githubToken', 'currentCommit'));
    }

    public function saveToken(Request $request)
    {
        $request->validate([
            'github_token' => 'required|string|starts_with:ghp_'
        ], [
            'github_token.starts_with' => 'Token GitHub harus diawali dengan ghp_.'
        ]);

        Setting::set('github_token', $request->github_token);

        return redirect()->back()->with('success', 'Token GitHub (Personal Access Token) berhasil disimpan.');
    }

    public function runCommand(Request $request)
    {
        $action = $request->input('action');
        $output = '';

        try {
            if ($action === 'clear_cache') {
                Artisan::call('cache:clear');
                $output = "Cache cleared successfully:\n" . Artisan::output();
            } elseif ($action === 'clear_config') {
                Artisan::call('config:clear');
                $output = "Configuration cache cleared successfully:\n" . Artisan::output();
            } elseif ($action === 'storage_link') {
                Artisan::call('storage:link');
                $output = "Storage link created successfully:\n" . Artisan::output();
            } elseif ($action === 'git_pull') {
                $token = Setting::get('github_token', '');
                if (!$token) {
                    return response()->json(['output' => "Error: Token GitHub belum disimpan. Harap simpan token Anda terlebih dahulu untuk mengotentikasi ke Github."]);
                }

                // Run git pull. 
                // We use process to run a shell command. 
                // Note: The remote repository must be properly set up, and the token can be configured globally or passed inside the URL by the user, or we can adjust remote URL dynamically if needed.
                // We will just run standard `git pull origin main` and capture output. 
                // If the remote requires the token seamlessly, we can inject it into the remote URL.
                $processRemote = Process::fromShellCommandline('git config --get remote.origin.url', base_path());
                $processRemote->run();
                $remoteUrl = trim($processRemote->getOutput());
                
                if (str_contains($remoteUrl, 'github.com')) {
                    // Inject token into https://github.com/ url
                    $remoteUrl = preg_replace('/https:\/\/.*?github\.com\//', 'https://oauth2:' . $token . '@github.com/', $remoteUrl);
                    $processPull = Process::fromShellCommandline('git pull ' . $remoteUrl . ' main 2>&1', base_path());
                } else {
                    $processPull = Process::fromShellCommandline('git pull origin main 2>&1', base_path());
                }

                $processPull->run();
                $output = "$ git pull\n" . $processPull->getOutput();
            } else {
                $output = "Unknown action: " . $action;
            }
        } catch (\Exception $e) {
            $output = "Error executing command:\n" . $e->getMessage();
        }

        return response()->json(['output' => $output]);
    }
}
