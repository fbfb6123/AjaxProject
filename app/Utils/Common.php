<?php

namespace App\Utils;

use App\Utils\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Ramsey\Uuid\Builder\UuidBuilderInterface;

trait Common
{
    use Constant;

    /**
     * setJsonMessage()
     *
     * JoinView用にJSONパッケージング
     *
     * @param int $status ステータスコード
     * @param array $data 返り値
     * @return array
     */
    public function setJsonMessage(int $status = 0, array $data = [])
    {
        return [
            'status' => $status,
            'message' => $this->getMessage($status),
            'data' => $data,
        ];
    }

    /**
     * setJson4Tabulator()
     *
     * Tabulator用の配列にパッケージングする
     *
     * @param array $data パッケージング対象の配列
     * @param int $lastPage ページングの最終ページ
     * @param int $count 件数
     * @return array パッケージング後の配列
     */
    public function setJson4Tabulator(array $data = [], int $lastPage = 1, int $count = 0)
    {
        return [
            'last_page' => $lastPage,
            'count' => $count,
            'data' => $data,
        ];
    }

    /**
     * getCode()
     *
     * 定数からシステムコードを返す
     *
     * @param string $name 定数
     * @return string システムコード
     */
    public function getCode(string $name)
    {
        return !empty($this->getConstKey($name)) ? $this->getConstKey($name) : $this->getConstKey('SYSTEM_ERROR');
    }

    /**
     * outputErrorLog()
     *
     * ログにエラーを出力する
     *
     * @param Exception $ex Exception
     * @param string $method エラーが発生したメソッド名
     */
    public function outputErrorLog(\Exception $ex, $method = __METHOD__)
    {
        Log::error($method . "()=\n" . $ex->getMessage());
        Log::error($method . "()=\n" . $ex->getTraceAsString());
    }

    /**
     * getMessage()
     *
     * システムコードから対応するメッセージを返す
     *
     * @param string $name システムコード
     * @return string システムメッセージ
     */
    public function getMessage(string $name)
    {
        return $this->getConstKey($name) ?? '';
    }

    /**
     * ランダム文字列生成 (英数字)
     * パスワード生成で使用
     * $length: 生成する文字数
     */
    public function makeRandStr($length)
    {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
}
