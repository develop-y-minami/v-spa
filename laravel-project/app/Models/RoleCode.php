<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RoleCode
 * 役割コードを管理するためのモデルクラス
 * 
 * @package App\Models
 * @property int $id ID（主キー）
 * @property string $name 役割の名称
 * @property \Illuminate\Support\Carbon $created_at 作成日時
 * @property \Illuminate\Support\Carbon $updated_at 更新日時
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleCode whereUpdatedAt($value)
 */
class RoleCode extends Model
{
    use HasFactory;
}
