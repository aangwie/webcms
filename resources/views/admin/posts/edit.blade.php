@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('header', 'Edit Berita')

@section('content')
<div class="w-full lg:w-3/5 mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border dark:border-slate-700 p-6">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $post->category) }}" placeholder="contoh: Pengumuman" class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 border dark:placeholder-slate-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Konten <span class="text-red-500">*</span></label>
                <textarea name="content" id="content-textarea" class="hidden">{{ old('content', $post->content) }}</textarea>
                <div class="bg-white dark:bg-slate-700 dark:text-white rounded-lg border-gray-300 dark:border-slate-600 shadow-sm border overflow-hidden">
                    <div id="editor" class="min-h-[300px]"></div>
                </div>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Gambar <span class="text-gray-400 dark:text-slate-500 text-xs">(maks 500KB, otomatis dikonversi ke WebP)</span></label>
                @if($post->image_path)
                    <div class="mb-2">
                        <img src="{{ asset($post->image_path) }}" class="h-32 rounded-lg object-cover" alt="">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-600 dark:file:text-indigo-400 file:font-medium hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 file:cursor-pointer">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ $post->is_published ? 'checked' : '' }} class="rounded border-gray-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
                <label for="is_published" class="ml-2 text-sm text-gray-700 dark:text-slate-300">Publish</label>
            </div>

            <div class="flex items-center space-x-3 pt-2">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Perbarui</button>
                <a href="{{ route('admin.posts.index') }}" class="px-5 py-2 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-slate-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'align': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote', 'code-block', 'link'],
                ['image', 'video', 'formula'],
                ['clean']
            ]
        }
    });

    const contentTextarea = document.getElementById('content-textarea');
    quill.root.innerHTML = contentTextarea.value;

    const form = contentTextarea.closest('form');
    form.addEventListener('submit', function() {
        if (quill.getText().trim().length === 0 && !quill.root.innerHTML.includes('<img')) {
            contentTextarea.value = '';
        } else {
            contentTextarea.value = quill.root.innerHTML;
        }
    });
</script>
<style>
.dark .ql-toolbar { background-color: #1e293b; border-color: #475569; }
.dark .ql-container { border-color: #475569; }
.dark .ql-snow .ql-stroke { stroke: #cbd5e1; }
.dark .ql-snow .ql-fill { fill: #cbd5e1; }
.dark .ql-snow .ql-picker { color: #cbd5e1; }
.dark .ql-snow .ql-picker-options { background-color: #1e293b; border-color: #475569; }
.dark .ql-editor.ql-blank::before { color: #64748b; }
.ql-editor { min-height: 300px; font-family: 'Inter', sans-serif; font-size: 1rem; }
</style>
@endsection
