<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'image'   => 'nullable|image|max:500',
        ]);

        $about = About::first();
        $about->content = $request->input('content');

        // Upload image
        if ($request->hasFile('image')) {
            // Delete old image
            if ($about->image_path && file_exists(public_path($about->image_path))) {
                unlink(public_path($about->image_path));
            }

            $file = $request->file('image');
            $dir = public_path('uploads/about');
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $filename = 'about_' . Str::random(10) . '.webp';
            $path = "{$dir}/{$filename}";

            $mime = $file->getMimeType();
            $source = match ($mime) {
                'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
                'image/png'  => imagecreatefrompng($file->getRealPath()),
                'image/gif'  => imagecreatefromgif($file->getRealPath()),
                'image/webp' => imagecreatefromwebp($file->getRealPath()),
                default      => imagecreatefromjpeg($file->getRealPath()),
            };

            imagewebp($source, $path, 90);
            imagedestroy($source);

            $about->image_path = "uploads/about/{$filename}";
        }

        $about->save();

        return redirect()->route('admin.about.edit')->with('success', 'Halaman Tentang berhasil diperbarui.');
    }
}
