<?php

namespace App\Repositories;

use App\Models\User;

/**
 * ユーザーに関連するデータ操作を提供するリポジトリインターフェース
 * 
 * このインターフェースは、ユーザーに関連するデータの取得、作成、更新、削除に関するメソッドを定義します。
 * リポジトリパターンを使用することで、データアクセスの詳細を隠蔽し、ビジネスロジックを柔軟でテスト可能なコードにします。
 */
interface UserRepositoryInterface
{
    /**
     * 全てのユーザーを取得する
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * ユーザーを作成
     *
     * @param array $data ユーザーのデータ
     * @return \App\Models\User 作成されたユーザー
     */
    public function create(array $data): User;

    /**
     * ユーザーを削除
     *
     * @param int $id ユーザーID
     * @return bool 削除成功の場合true、失敗の場合false
     */
    public function delete(int $id): bool;
}
