<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
// 【新增】引入會員商品 Controller，使用別名避免名稱衝突
use App\Http\Controllers\Member\ProductController as MemberProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']) ->name('home');

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 購物車功能
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // 結帳入口
    Route::get('/checkout', [CheckoutController::class, 'index'])
           ->name('checkout.index');
    
    Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');
    
    // 訂單功能
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
        

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
        // 刪除商品
        Route::delete('/{product}', [MemberProductController::class, 'destroy'])->name('destroy');

        

        // 回收筒功能
        Route::get('/trashed', [MemberProductController::class, 'trashed'])->name('trashed');
        Route::patch('/{product}/restore', [MemberProductController::class, 'restore'])->name('restore');
        Route::delete('/{product}/force-delete', [MemberProductController::class, 'forceDelete'])->name('force-delete');

        // 切換上架/下架
        Route::patch('/{product}/toggle-status', [MemberProductController::class, 'toggleStatus'])->name('toggle-status');
     });
});

        // 公開商品展示（訪客可看）
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        // 【新增】商品詳情頁
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


        require __DIR__.'/auth.php';
