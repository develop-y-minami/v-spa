<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleCodeController;

/**
 * RoleCode APIルート設定
 * 
 * このファイルでは、役割コードに関するAPIエンドポイントを定義します。
 * RoleCodeControllerの各メソッドに対応するルートが含まれています。
 */

Route::prefix('api')->group(function () {
    // すべての役割コードを取得するエンドポイント
    Route::get('/role-codes', [RoleCodeController::class, 'index']);

    // 指定したIDの役割コードを取得するエンドポイント
    Route::get('/role-codes/{id}', [RoleCodeController::class, 'show']);
});
