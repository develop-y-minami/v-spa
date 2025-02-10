<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Http\Resources\RoleCodeResource;
use App\Services\RoleCodeServiceInterface;
use Illuminate\Http\JsonResponse;

/**
 * RoleCode APIコントローラー
 * 
 * このコントローラーは、役割コードに関連するAPIリクエストを処理します。
 * サービス層を通じてデータの取得や操作を行い、JSONレスポンスで結果を返します。
 * 
 * メソッド例:
 * - `index` : すべての役割コードを取得
 * - `show` : 指定したIDの役割コードを取得
 * 
 * @package App\Http\Controllers\Api
 */
class RoleCodeController extends Controller
{
    protected $roleCodeService;

    /**
     * コンストラクタでRoleCodeServiceを依存注入
     * 
     * @param RoleCodeServiceInterface $roleCodeService
     */
    public function __construct(RoleCodeServiceInterface $roleCodeService)
    {
        $this->roleCodeService = $roleCodeService;
    }

    /**
     * すべての役割コードを取得
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $roleCodes = $this->roleCodeService->getAllRoleCodes();
        return ApiResponse::success(RoleCodeResource::collection($roleCodes));
    }

    /**
     * 指定したIDの役割コードを取得
     *
     * @param int $id 役割コードID
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $roleCode = $this->roleCodeService->getRoleCodeById($id);

        if ($roleCode) {
            return ApiResponse::success(new RoleCodeResource($roleCode));
        }

        return ApiResponse::error('Role code not found', 404);
    }
}
