<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * 
 */
trait LogTrait
{
    /**
     * 入力パラメターログを出力する
     *
     * @param $functionName メソッド名
     * @param $data ログ対象情報
     * @param $message ログ対象メッセージ
     */
    public function infoLog(string $functionName, string $message = '', array $data = [])
    {
        Log::info($this->getLogMessage($functionName, $message, $data));
    }

    /**
     * 情報確認ログを出力する
     *
     * @param $functionName メソッド名
     * @param $data ログ対象情報
     *  @param $message ログ対象メッセージ
     */
    public function debugLog(string $functionName, string $message = '', array $data = [])
    {
        if (env('LOG_STATUS')) {
            Log::debug($this->getLogMessage($functionName, $message, $data));
        }
    }

    /**
     * エラーログを出力する
     *
     * @param $functionName メソッド名
     * @param $data ログ対象情報
     * @param $message ログ対象メッセージ
     */
    public function errorLog(string $functionName, string $message = '', array $data = [])
    {
        Log::error($this->getLogMessage($functionName, $message, $data));
    }

    /**
     * 警告ログを出力する
     *
     * @param $functionName メソッド名
     * @param $data ログ対象情報
     * @param $message ログ対象メッセージ
     */
    public function warningLog(string $functionName, string $message = '', array $data = [])
    {
        Log::warning($this->getLogMessage($functionName, $message, $data));
    }

    /**
     * ログメッセージ作成する
     *
     * @param $functionName メソッド名
     * @param $data ログ対象情報
     * @param $message ログ対象メッセージ
     * @return string ログメッセージ
     */
    private function getLogMessage(string $functionName, string $message, array $data = []): string
    {
        return __CLASS__.'::'.$functionName.' '.$message.json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
