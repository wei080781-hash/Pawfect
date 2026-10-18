<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * 顯示輪播圖管理列表。
     */
    public function index()
    {
        $banners = Banner::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * 顯示新增輪播圖表單。
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * 儲存新輪播圖。
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'link_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'link_url' => $validated['link_url'] ?? null,
            'sort_order' => $validated['sort_order'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', '輪播圖新增成功。');
    }

    /**
     * 顯示編輯輪播圖表單。
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * 更新輪播圖資料。
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'link_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'link_url' => $validated['link_url'] ?? null,
            'sort_order' => $validated['sort_order'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('banners', 'public');

            $data['image_path'] = $newImagePath;
        }

        $oldImagePath = $banner->image_path;

        $banner->update($data);

        if (isset($newImagePath) && $oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()
            ->route('admin.banners.index')
            ->with('success', '輪播圖更新成功。');
    }

    /**
     * 刪除輪播圖及其圖片檔案。
     */
    public function destroy(Banner $banner)
    {
        $imagePath = $banner->image_path;

        $banner->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('admin.banners.index')
            ->with('success', '輪播圖刪除成功。');
    }
}
