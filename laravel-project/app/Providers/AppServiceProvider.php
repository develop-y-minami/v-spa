<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RoleCodeServiceInterface;
use App\Services\RoleCodeService;

/**
 * アプリケーションサービスプロバイダー
 * 
 * このクラスは、アプリケーション全体で利用するサービスを登録します。
 * サービスコンテナに依存関係をバインドし、必要なサービスをインジェクションすることで
 * アプリケーションの動作を管理します。例えば、サービス層やリポジトリをバインドする処理を行います。
 * 
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのサービスを登録します。
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(RoleCodeServiceInterface::class, RoleCodeService::class);
    }

    /**
     * アプリケーションのサービスをブートします。
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
