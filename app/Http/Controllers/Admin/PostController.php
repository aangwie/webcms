<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'nullable|string|max:100',
            'image'    => 'nullable|image|max:500',
        ]);

        $data = $request->only('title', 'content', 'category');
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploadImage($request->file('image'), 'posts');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'nullable|string|max:100',
            'image'    => 'nullable|image|max:500',
        ]);

        $data = $request->only('title', 'content', 'category');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($post->image_path && file_exists(public_path($post->image_path))) {
                unlink(public_path($post->image_path));
            }
            $data['image_path'] = $this->uploadImage($request->file('image'), 'posts');
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->image_path && file_exists(public_path($post->image_path))) {
            unlink(public_path($post->image_path));
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Upload gambar dan konversi ke WebP (maks 500KB)
     */
    private function uploadImage($file, string $folder): string
    {
        $dir = public_path("uploads/{$folder}");
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = Str::random(20) . '.webp';
        $path = "{$dir}/{$filename}";

        // Baca gambar asli
        $mime = $file->getMimeType();
        $source = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => imagecreatefrompng($file->getRealPath()),
            'image/gif'  => imagecreatefromgif($file->getRealPath()),
            'image/webp' => imagecreatefromwebp($file->getRealPath()),
            default      => imagecreatefromjpeg($file->getRealPath()),
        };

        // Perbaiki palette image support
        imagepalettetotruecolor($source);

        // Konversi ke WebP dengan kualitas 100 (tanpa kompresi visual signifikan)
        imagewebp($source, $path, 100);
        imagedestroy($source);

        return "uploads/{$folder}/{$filename}";
    }
}
