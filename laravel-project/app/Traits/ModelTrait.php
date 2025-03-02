<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 * ModelTrait
 * 
 * モデルに共通する処理（例えば、タイムスタンプのフォーマット）を提供します。
 */
trait ModelTrait
{
    /**
     * モデルの created_at をフォーマットして返すアクセサ
     *
     * @param string $value created_at の値
     * @return string フォーマットされた created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * モデルの updated_at をフォーマットして返すアクセサ
     *
     * @param string $value updated_at の値
     * @return string フォーマットされた updated_at
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
