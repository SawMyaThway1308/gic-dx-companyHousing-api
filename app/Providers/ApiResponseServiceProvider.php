<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * macroでのカスタムレスポンス
     *
     * @return void
     */
    public function boot()
    {
        // 成功
        Response::macro('success', function ($data = [], $extraData = []) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'extra' => $extraData,
            ]);
        });

        // メッセージでの成功
        Response::macro('successWithMsg', function ($msg = '', $data = [], $extraData = []) {
            return response()->json([
                'success' => true,
                'msg' => $msg,
                'data' => $data,
                'extra' => $extraData,
            ]);
        });

        // エラー（画面側でエラー表示させる）
        Response::macro('error', function ($errorMessage = '', array $errors = []) {
            return response()->json([
                'success' => false,
                'errorMessage' => $errorMessage,
                'errors' => $errors,
                'extra' => [],
            ]);
        });

        // フェイタルエラー
        Response::macro('fatalError', function ($errMsg, array $errors = [], $status = ResponseStatus::HTTP_INTERNAL_SERVER_ERROR) {
            return response()->json([
                'success' => false,
                'status' => $status,
                'errMsg' => $errMsg,
                'errors' => $errors,
                'extra' => [],
            ], $status);
        });
    }
}
