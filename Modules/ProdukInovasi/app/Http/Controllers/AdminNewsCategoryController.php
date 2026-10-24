<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\QueryException;
use Modules\ProdukInovasi\app\Models\NewsCategory;

class AdminNewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = NewsCategory::withCount('news')
            ->when($search, fn($q) => $q->where('nama', 'like', "%{$search}%"))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return view('produkinovasi::admin.news-category.table', compact('categories'));
        }

        return view('produkinovasi::admin.news-category.index', compact('categories', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:news_categories,nama',
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Kategori ini sudah ada',
        ]);

        NewsCategory::create($data);

        return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $category = NewsCategory::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:news_categories,nama,' . $category->id,
        ], [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Kategori ini sudah ada',
        ]);

        $category->update($data);

        return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        try {
            $category = NewsCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('admin.news-category.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih dipakai di berita. Ganti dulu kategori berita yang memakainya.');
        }
    }
}
