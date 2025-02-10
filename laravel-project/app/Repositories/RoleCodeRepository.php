<?php

namespace App\Repositories;

use App\Models\RoleCode;

/**
 * Class RoleCodeRepository
 *
 * 役割コードに関連するデータ操作を提供するリポジトリクラス。
 * このクラスは、RoleCodeモデルに対するデータベース操作（取得）を実装します。
 * リポジトリパターンを使用することで、コントローラーやサービス層がデータアクセスの詳細に依存せず、
 * より柔軟でテスト可能なコードを書くことができます。
 * 
 * リポジトリは、データアクセスロジックを担当し、ビジネスロジックから分離します。
 * 各メソッドは、モデルに関連するデータの取得を行います。
 *
 * @package App\Repositories
 */
class RoleCodeRepository implements RoleCodeRepositoryInterface
{
    /**
     * @var \App\Models\RoleCode
     */
    protected $roleCode;

    /**
     * RoleCodeRepository constructor.
     *
     * コンストラクタでRoleCodeモデルのインスタンスを受け取り、リポジトリに注入します。
     *
     * @param \App\Models\RoleCode $roleCode
     */
    public function __construct(RoleCode $roleCode)
    {
        $this->roleCode = $roleCode;
    }

    /**
     * 全ての役割コードを取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->roleCode->all();
    }

    /**
     * IDで役割コードを取得
     *
     * @param int $id 役割コードのID
     * @return \App\Models\RoleCode
     */
    public function getById($id)
    {
        return $this->roleCode->findOrFail($id);
    }
}
