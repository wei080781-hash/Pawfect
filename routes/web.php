<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
// 【新增】引入會員商品 Controller，使用別名避免名稱衝突
use App\Http\Controllers\Member\ProductController as MemberProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 會員商品管理路由
Route::prefix('my-products')->name('my-products.')->group(function () {
        // 【新增】我的商品列表
        Route::get('/', [MemberProductController::class, 'index'])->name('index');
        // 【新增】新增商品頁面
        Route::get('/create', [MemberProductController::class, 'create'])->name('create');
        // 【新增】儲存新商品
        Route::post('/', [MemberProductController::class, 'store'])->name('store');
        // 【新增】編輯商品頁面
        Route::get('/{product}/edit', [MemberProductController::class, 'edit'])->name('edit');
        // 【新增】更新商品
        Route::patch('/{product}', [MemberProductController::class, 'update'])->name('update');
        //
        Route::delete('/{product}', [MemberProductController::class, 'destroy'])->name('destroy');

        // 回收筒功能
        Route::get('/trashed', [MemberProductController::class, 'trashed'])->name('trashed');
        Route::patch('/{product}/restore', [MemberProductController::class, 'restore'])->name('restore');
        Route::delete('/{product}/force-delete', [MemberProductController::class, 'forceDelete'])->name('force-delete');

        // 切換上架/下架
        Route::patch('/{product}/toggle-status', [MemberProductController::class, 'toggleStatus'])->name('toggle-status');
     });
});





Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

require __DIR__.'/auth.php';
