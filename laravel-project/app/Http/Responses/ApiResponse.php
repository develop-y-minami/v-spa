<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

/**
 * APIレスポンスヘルパークラス
 * 
 * このクラスは、APIレスポンスを標準化するためのヘルパー機能を提供します。
 * 成功時とエラー時のレスポンスを統一的な形式で返し、アプリケーションのAPIの一貫性を保ちます。
 * 
 * @package App\Http\Responses
 */
class ApiResponse
{
    /**
     * 成功レスポンスを生成
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public static function success($data, $message = 'Request was successful'): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * エラーレスポンスを生成
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public static function error($message, $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
