<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 以下、APIルート設定を追加
// 'roleCodes.php' で定義されたAPIルートを読み込みます
require base_path('routes/api/roleCodes.php');
// 'users.php' で定義されたAPIルートを読み込みます
require base_path('routes/api/users.php');