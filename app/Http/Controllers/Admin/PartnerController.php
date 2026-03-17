<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('order_index')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|max:500',
            'order_index' => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        $partner = Partner::create([
            'name'        => $request->name,
            'is_active'   => $request->has('is_active'),
            'order_index' => $request->order_index ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $partner->image_path = $this->uploadImage($request->file('image'), $request->name);
            $partner->save();
        }

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:500',
            'order_index' => 'nullable|integer',
            'is_active'   => 'nullable',
        ]);

        $partner->update([
            'name'        => $request->name,
            'is_active'   => $request->has('is_active'),
            'order_index' => $request->order_index ?? 0,
        ]);

        if ($request->hasFile('image')) {
            if ($partner->image_path && file_exists(public_path($partner->image_path))) {
                unlink(public_path($partner->image_path));
            }
            $partner->image_path = $this->uploadImage($request->file('image'), $request->name);
            $partner->save();
        }

        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->image_path && file_exists(public_path($partner->image_path))) {
            unlink(public_path($partner->image_path));
        }
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Mitra berhasil dihapus.');
    }

    private function uploadImage($file, $name)
    {
        $dir = public_path('uploads/partners');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::slug($name) . '.webp';
        $path = "{$dir}/{$filename}";

        // If file exists already, add random string
        if (file_exists($path)) {
            $filename = Str::slug($name) . '_' . Str::random(5) . '.webp';
            $path = "{$dir}/{$filename}";
        }

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

        return "uploads/partners/{$filename}";
    }
}
