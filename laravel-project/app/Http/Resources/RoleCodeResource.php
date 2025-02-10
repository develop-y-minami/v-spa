<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleCodeResource
 *
 * 役割コードのレスポンスデータを整形するためのリソースクラス。
 * APIレスポンスに含めるデータを制御し、統一した形式で提供する。
 *
 * @package App\Http\Resources
 */
class RoleCodeResource extends JsonResource
{
    /**
     * レスポンスデータを配列として整形
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
