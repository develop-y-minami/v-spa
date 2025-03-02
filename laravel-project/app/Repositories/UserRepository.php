<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 * ユーザーに関連するデータ操作を提供するリポジトリクラス。
 * このクラスは、Userモデルに対するデータベース操作（取得、作成、更新、削除）を実装します。
 * リポジトリパターンを使用することで、コントローラーやサービス層がデータアクセスの詳細に依存せず、
 * より柔軟でテスト可能なコードを書くことができます。
 * 
 * リポジトリは、データアクセスロジックを担当し、ビジネスロジックから分離します。
 * 各メソッドは、モデルに関連するデータの取得や操作を行います。
 *
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * コンストラクタでUserモデルのインスタンスを受け取り、リポジトリに注入します。
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 全てのユーザーを取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->user->all();
    }
    
    /**
     * ユーザーを作成
     *
     * @param array $data ユーザーのデータ
     * @return \App\Models\User 作成されたユーザーのインスタンス
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * ユーザーを削除
     *
     * @param int $id ユーザーID
     * @return bool 削除成功の場合true、失敗の場合false
     */
    public function delete(int $id): bool
    {
        $user = $this->user->find($id);

        if ($user) {
            return $user->delete();
        }

        // ユーザーが見つからない場合に '410 Gone' をスロー
        throw new \Exception('User has already been deleted', 410);
    }
}
