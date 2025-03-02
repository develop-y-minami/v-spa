<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 *
 * ユーザー情報のレスポンスデータを整形するためのリソースクラス。
 * APIレスポンスに含めるデータを制御し、統一した形式で提供する。
 *
 * @package App\Http\Resources
 */
class UserResource extends JsonResource
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
            'id'       => $this->id,
            'username' => $this->username,
            'name'     => $this->name,
            'email'    => $this->email,
            'role_code_id' => $this->role_code_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
