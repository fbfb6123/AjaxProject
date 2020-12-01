<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;

/**
 * Trait Company
 *
 * 事業者マスタ用共通関数
 *
 */
trait Company
{
    // DB取り出しメソッド
    public static function getCompanyDB()
    {
        return $Company = DB::table('companies')
            ->orderBy('id', 'asc')// ID順でとる
            //->select('○○')// ○○のみを取り出し
            ->get();//
    }
}
