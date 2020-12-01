<?php


namespace App\Utils;

use Illuminate\Support\Facades\DB;

/**
 * Trait Broadcaster
 *
 * 放送局マスタ用共通関数
 *
 */
trait Broadcaster
{
    // DB取り出しメソッド
    public static function getBroadcasterDB()
    {
        return $Broadcaster = DB::table('broadcasters')
            ->orderBy('id', 'asc')// ID順でとる
            //->select('○○')// ○○のみを取り出し
            ->get();//
    }
}
