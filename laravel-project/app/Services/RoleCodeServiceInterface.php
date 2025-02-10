<?php

namespace App\Services;

/**
 * RoleCodeサービスインターフェース
 * 
 * このインターフェースは、役割コードに関連するビジネスロジックメソッドを定義します。
 */
interface RoleCodeServiceInterface
{
    /**
     * すべての役割コードを取得する
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoleCodes();

    /**
     * 指定したIDの役割コードを取得
     *
     * @param int $id 役割コードID
     * @return \App\Models\RoleCode|null
     */
    public function getRoleCodeById($id);
}
