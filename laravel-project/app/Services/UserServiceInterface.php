<?php

namespace App\Services;

use App\Models\User;

/**
 * Userサービスインターフェース
 *
 * このインターフェースは、ユーザーに関連するビジネスロジックのメソッドを定義します。
 */
interface UserServiceInterface
{
    /**
     * すべてのユーザーを取得する
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers();

    /**
     * 新しいユーザーを作成する
     *
     * @param array $validatedData ユーザー作成に必要なバリデーション済みデータ
     * @return User 作成されたユーザー
     */
    public function createUser(array $validatedData): User;

    /**
     * ユーザーを削除する
     * 
     * @param int $id ユーザーID
     * @return bool 削除が成功したかどうか
     */
    public function deleteUser(int $id): bool;
}
