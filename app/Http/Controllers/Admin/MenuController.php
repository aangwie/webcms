<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order_index')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        Menu::create([
            'name'        => $request->name,
            'url'         => $request->url,
            'order_index' => $request->order_index ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url'  => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
        ]);

        $menu->update([
            'name'        => $request->name,
            'url'         => $request->url,
            'order_index' => $request->order_index ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
