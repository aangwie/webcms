<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order_index')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'image'       => 'required|image|max:800',
            'order_index' => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $imagePath = $this->uploadImage($request->file('image'));

        Slider::create([
            'title'       => $request->title,
            'image_path'  => $imagePath,
            'order_index' => $request->order_index ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:800',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old
            if ($slider->image_path && file_exists(public_path($slider->image_path))) {
                unlink(public_path($slider->image_path));
            }
            $slider->image_path = $this->uploadImage($request->file('image'));
        }

        $slider->title       = $request->title;
        $slider->order_index = $request->order_index ?? 0;
        $slider->is_active   = $request->has('is_active');
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image_path && file_exists(public_path($slider->image_path))) {
            unlink(public_path($slider->image_path));
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil dihapus.');
    }

    private function uploadImage($file): string
    {
        $dir = public_path('uploads/sliders');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = 'slider_' . Str::random(10) . '.webp';
        $path = "{$dir}/{$filename}";

        $mime = $file->getMimeType();
        $source = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => imagecreatefrompng($file->getRealPath()),
            'image/gif'  => imagecreatefromgif($file->getRealPath()),
            'image/webp' => imagecreatefromwebp($file->getRealPath()),
            default      => imagecreatefromjpeg($file->getRealPath()),
        };

        // Fix logic for Palette image not supported by webp
        imagepalettetotruecolor($source);

        // Try quality 85 first, reduce if over 800KB
        $quality = 85;
        imagewebp($source, $path, $quality);

        while (filesize($path) > 800 * 1024 && $quality > 20) {
            $quality -= 10;
            imagewebp($source, $path, $quality);
        }

        imagedestroy($source);

        return "uploads/sliders/{$filename}";
    }
}
