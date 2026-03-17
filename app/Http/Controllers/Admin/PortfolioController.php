<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'client'          => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'image'           => 'nullable|image|max:500',
        ]);

        $data = $request->only('title', 'description', 'client', 'completion_date');
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploadImage($request->file('image'), 'portfolios');
        }

        Portfolio::create($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'client'          => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'image'           => 'nullable|image|max:500',
        ]);

        $data = $request->only('title', 'description', 'client', 'completion_date');

        if ($request->hasFile('image')) {
            if ($portfolio->image_path && file_exists(public_path($portfolio->image_path))) {
                unlink(public_path($portfolio->image_path));
            }
            $data['image_path'] = $this->uploadImage($request->file('image'), 'portfolios');
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image_path && file_exists(public_path($portfolio->image_path))) {
            unlink(public_path($portfolio->image_path));
        }
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil dihapus.');
    }

    private function uploadImage($file, string $folder): string
    {
        $dir = public_path("uploads/{$folder}");
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::random(20) . '.webp';
        $path = "{$dir}/{$filename}";

        $mime = $file->getMimeType();
        $source = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => imagecreatefrompng($file->getRealPath()),
            'image/gif'  => imagecreatefromgif($file->getRealPath()),
            'image/webp' => imagecreatefromwebp($file->getRealPath()),
            default      => imagecreatefromjpeg($file->getRealPath()),
        };

        imagewebp($source, $path, 80);
        imagedestroy($source);

        return "uploads/{$folder}/{$filename}";
    }
}
