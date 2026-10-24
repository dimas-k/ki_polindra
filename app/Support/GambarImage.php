<?php

namespace App\Support;

use Illuminate\Http\Request;

class GambarImage
{
    public const MAX_KB = 2048; // 2 MB
    public const RULE = 'nullable|mimes:jpg,jpeg,png|max:2048';

    /**
     * Simpan file gambar (jpg/jpeg/png, maks 2 MB) dan kembalikan path relatif disk public.
     */
    public static function store(Request $request, string $field = 'gambar_img'): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

        return $file->storeAs('gambar-ki', $filename, 'public');
    }
}
