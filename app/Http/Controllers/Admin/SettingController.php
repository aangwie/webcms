<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name'    => Setting::get('site_name', ''),
            'site_tagline' => Setting::get('site_tagline', ''),
            'site_logo'    => Setting::get('site_logo', ''),
            'site_favicon' => Setting::get('site_favicon', ''),
            'address'      => Setting::get('address', ''),
            'phone'        => Setting::get('phone', ''),
            'email'        => Setting::get('email', ''),
            'whatsapp'     => Setting::get('whatsapp', ''),
            'facebook'     => Setting::get('facebook', ''),
            'instagram'    => Setting::get('instagram', ''),
            'youtube'      => Setting::get('youtube', ''),
        ];

        // Get logo dimensions
        $logoDimensions = null;
        if ($settings['site_logo'] && file_exists(public_path($settings['site_logo']))) {
            $size = getimagesize(public_path($settings['site_logo']));
            if ($size) {
                $logoDimensions = $size[0] . ' × ' . $size[1] . ' px';
            }
        }

        // Get favicon dimensions
        $faviconDimensions = null;
        if ($settings['site_favicon'] && file_exists(public_path($settings['site_favicon']))) {
            $size = getimagesize(public_path($settings['site_favicon']));
            if ($size) {
                $faviconDimensions = $size[0] . ' × ' . $size[1] . ' px';
            }
        }

        return view('admin.settings.index', compact('settings', 'logoDimensions', 'faviconDimensions'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_logo'    => 'nullable|image|max:500',
            'site_favicon' => 'nullable|image|max:500',
            'address'      => 'nullable|string',
            'phone'        => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
            'whatsapp'     => 'nullable|string|max:50',
            'facebook'     => 'nullable|string|max:255',
            'instagram'    => 'nullable|string|max:255',
            'youtube'      => 'nullable|string|max:255',
        ]);

        $keys = ['site_name', 'site_tagline', 'address', 'phone', 'email', 'whatsapp', 'facebook', 'instagram', 'youtube'];
        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        // Upload logo
        if ($request->hasFile('site_logo')) {
            $this->uploadImage($request->file('site_logo'), 'site_logo', 'uploads/logo', 'logo');
        }

        // Upload favicon
        if ($request->hasFile('site_favicon')) {
            $this->uploadImage($request->file('site_favicon'), 'site_favicon', 'uploads/favicon', 'favicon');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.settings.index')->with('success', 'Profil akun berhasil diperbarui.');
    }

    private function uploadImage($file, $settingKey, $dirPath, $prefix)
    {
        // Delete old file
        $old = Setting::get($settingKey);
        if ($old && file_exists(public_path($old))) {
            unlink(public_path($old));
        }

        $dir = public_path($dirPath);
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = "{$prefix}_" . Str::random(10) . '.webp';
        $path = "{$dir}/{$filename}";

        $mime = $file->getMimeType();
        $source = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => imagecreatefrompng($file->getRealPath()),
            'image/gif'  => imagecreatefromgif($file->getRealPath()),
            'image/webp' => imagecreatefromwebp($file->getRealPath()),
            default      => imagecreatefromjpeg($file->getRealPath()),
        };

        imagepalettetotruecolor($source);
        imagewebp($source, $path, 90);
        imagedestroy($source);

        Setting::set($settingKey, "{$dirPath}/{$filename}");
    }
}
