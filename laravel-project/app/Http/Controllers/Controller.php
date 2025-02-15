<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Responses\ApiResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Exception;

class Controller extends BaseController
{
    /**
     * 例外をキャッチして、統一されたエラーレスポンスを返す
     *
     * @param Exception $exception 発生した例外
     * @return \Illuminate\Http\JsonResponse 統一されたエラーレスポンス
     */
    public function handleException(Exception $exception)
    {
        // 404エラー: リソースが見つからない場合
        if ($exception instanceof NotFoundHttpException) {
            return ApiResponse::error('Resource not found', 404);
        }

        // 505エラー: HTTPバージョン非対応
        if ($exception instanceof HttpException && $exception->getStatusCode() === 505) {
            return ApiResponse::error('HTTP Version Not Supported', 505);
        }

        // その他の例外: 一般的なエラー
        return ApiResponse::error('An unexpected error occurred', 500);
    }
}