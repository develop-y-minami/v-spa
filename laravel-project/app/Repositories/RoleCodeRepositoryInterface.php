<?php

namespace App\Repositories;

/**
 * Interface RoleCodeRepositoryInterface
 *
 * 役割コードに関するデータ操作を定義したインターフェイス。
 * このインターフェイスは、役割コードデータに関するリポジトリの操作メソッドを提供します。
 * 実装クラスである `RoleCodeRepository` では、データベース操作やその他のデータソースに対する
 * 実際の操作が定義されます。
 * 
 * @package App\Repositories
 */
interface RoleCodeRepositoryInterface
{
    /**
     * 全ての役割コードを取得する
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * IDで役割コードを取得する
     *
     * @param int $id 役割コードID
     * @return \App\Models\RoleCode
     */
    public function getById($id);
}