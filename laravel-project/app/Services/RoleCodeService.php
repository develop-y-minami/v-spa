<?php

namespace App\Services;

use App\Repositories\RoleCodeRepositoryInterface;

/**
 * RoleCodeサービスクラス
 * 
 * このクラスは、役割コードに関連するビジネスロジックを提供し、リポジトリを通じてデータの取得や操作を行います。
 */
class RoleCodeService implements RoleCodeServiceInterface
{
    /**
     * @var \App\Repositories\RoleCodeRepositoryInterface
     */
    protected $roleCodeRepository;

    /**
     * コンストラクタでRoleCodeRepositoryを依存注入
     * 
     * @param RoleCodeRepositoryInterface $roleCodeRepository
     */
    public function __construct(RoleCodeRepositoryInterface $roleCodeRepository)
    {
        $this->roleCodeRepository = $roleCodeRepository;
    }

    /**
     * すべての役割コードを取得する
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoleCodes()
    {
        return $this->roleCodeRepository->getAll();
    }

    /**
     * 指定したIDの役割コードを取得する
     *
     * @param int $id 役割コードID
     * @return \App\Models\RoleCode|null
     */
    public function getRoleCodeById($id)
    {
        return $this->roleCodeRepository->getById($id);
    }
}
