<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RoleCodeRepository;
use App\Repositories\RoleCodeRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;

/**
 * リポジトリサービスプロバイダー
 * 
 * このクラスは、リポジトリインターフェースとその実装をサービスコンテナにバインドします。
 * これにより、リポジトリインターフェースを利用するサービスやコントローラーで依存性注入ができるようになります。
 * 具体的には、リポジトリの実装クラスをインターフェースと紐づける処理を行います。
 * 
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * サービスプロバイダの登録
     *
     * このメソッドでは、アプリケーションのリポジトリ依存関係をバインドします。
     * インターフェースと実装クラスを関連付けることで、依存性注入を通じてリポジトリを利用可能にします。
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleCodeRepositoryInterface::class, RoleCodeRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * サービスプロバイダの起動
     *
     * アプリケーション起動時に実行する処理を記述します。
     * ここではリポジトリの依存関係の登録のみ行います。
     *
     * @return void
     */
    public function boot()
    {
        // 起動処理はここに記述します（必要があれば）。
    }
}