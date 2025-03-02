<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Http\Resources\UserResource;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreUserRequest;

/**
 * User APIコントローラー
 * 
 * このコントローラーは、ユーザーに関連するAPIリクエストを処理します。
 * サービス層を通じてデータの取得や操作を行い、JSONレスポンスで結果を返します。
 * 
 * メソッド例:
 * - `index` : すべてのユーザーを取得
 * - `show` : 指定したIDのユーザーを取得
 * - `store` : 新しいユーザーを登録
 * 
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    protected $userService;

    /**
     * コンストラクタでUserServiceを依存注入
     * 
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * すべてのユーザーを取得
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();
            return ApiResponse::success(UserResource::collection($users));
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * 新しいユーザーを登録
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request->validated());
            return ApiResponse::success(new UserResource($user), 201);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * ユーザーを削除
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $result = $this->userService->deleteUser($id);
            if ($result) {
                return ApiResponse::success(null, 204);
            }
            return ApiResponse::error('ユーザーの削除に失敗しました。', 500);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('ユーザーが見つかりません。', 404);
        } catch (\Exception $e) {
            if ($e->getCode() === 410) {
                return ApiResponse::error('ユーザーは既に削除されています。', 410);
            }
            
            return $this->handleException($e);
        }
    }
}
