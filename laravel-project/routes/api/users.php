<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

/**
 * User APIルート設定
 * 
 * このファイルでは、ユーザーに関するAPIエンドポイントを定義します。
 * UserControllerの各メソッドに対応するルートが含まれています。
 */

Route::prefix('api')->group(function () {
    // すべてのユーザーを取得するエンドポイント
    Route::get('/users', [UserController::class, 'index']);

    // ユーザーを新規登録するエンドポイント
    Route::post('/users', [UserController::class, 'store'])->withoutMiddleware(ValidateCsrfToken::class);

    // ユーザーを削除するエンドポイント
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->withoutMiddleware(ValidateCsrfToken::class);
});
