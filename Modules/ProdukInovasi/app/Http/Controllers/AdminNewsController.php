<?php

namespace Modules\ProdukInovasi\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\ProdukInovasi\app\Models\News;
use Modules\ProdukInovasi\app\Models\NewsCategory;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $news = News::query()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhereHas('category', fn($cq) => $cq->where('nama', 'like', "%{$search}%"));
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return view('produkinovasi::admin.news.table', compact('news'));
        }

        return view('produkinovasi::admin.news.index', compact('news', 'search'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('nama')->get();

        return view('produkinovasi::admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'news_category_id' => 'required|exists:news_categories,id',
            'ringkasan' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'gambar_sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('gambar_sampul')) {
            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('news', 'public');
        }

        $data['created_by'] = auth()->id();

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $news = News::findOrFail($id);

        $categories = NewsCategory::orderBy('nama')->get();

        return view('produkinovasi::admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'news_category_id' => 'required|exists:news_categories,id',
            'ringkasan' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'gambar_sampul' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('gambar_sampul')) {
            if ($news->gambar_sampul && Storage::disk('public')->exists($news->gambar_sampul)) {
                Storage::disk('public')->delete($news->gambar_sampul);
            }
            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if ($news->gambar_sampul && Storage::disk('public')->exists($news->gambar_sampul)) {
            Storage::disk('public')->delete($news->gambar_sampul);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}