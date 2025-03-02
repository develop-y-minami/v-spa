<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Userサービスクラス
 * 
 * このクラスは、ユーザーに関連するビジネスロジックを提供し、リポジトリを通じてユーザーのデータ取得や操作を行います。
 */
class UserService implements UserServiceInterface
{
    /**
     * @var \App\Repositories\UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * コンストラクタでUserRepositoryを依存注入
     * 
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * すべてのユーザーを取得する
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    /**
     * 新しいユーザーを作成する
     *
     * @param array $validatedData ユーザー作成に必要なバリデーション済みデータ
     * @return User 作成されたユーザー
     */
    public function createUser(array $validatedData): User
    {
        // パスワードのハッシュ化
        $validatedData['password'] = Hash::make($validatedData['password']);

        // ユーザーを作成
        $user = $this->userRepository->create($validatedData);

        return $user;
    }

    /**
     * ユーザーを削除する
     * 
     * @param int $id ユーザーID
     * @return bool 削除が成功したかどうか
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
