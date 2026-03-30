<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// --- 公開ページ（ベージュデザイン） ---
Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('store');

// --- 認証が必要なページ（白デザイン） ---
Route::middleware('auth')->group(function () {

    // 管理画面トップ
    Route::get('/admin/inquiries', [ContactController::class, 'admin'])->name('admin.inquiries');

    Route::get('/admin/export', [ContactController::class, 'export'])->name('admin.export');

    // 削除用ルート
    Route::delete('/admin/inquiries/delete', [ContactController::class, 'destroy'])->name('admin.inquiries.destroy');

    // ログアウト
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    })->name('logout');
});

require __DIR__.'/auth.php';
