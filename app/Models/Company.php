<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Company
 *
 * 事業者モデル
 *
 * @package App\Models
 * @author  katsumi_wakamatsu <katsumi_wakamatsu@s-cubed.co.jp>
 *
 */
class Company extends Model
{

    // 事業者マスタ用共通関数（ビジネスロジック）

    protected $table = 'companies'; // 物理テーブル名
    protected $guarded = ['id']; // 操作不可カラム名の配列

    /**
     * Method materials
     *
     * 事業者が所有する素材情報を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sozais()
    {
        return $this->hasMany('App\Models\Sozai', 'company_id');
    }

    /**
     * Method distributions
     *
     * 事業者が実行した配信履歴情報を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributions()
    {
        return $this->hasMany('App\Models\Distribution', 'company_id');
    }

    /**
     * Method users
     *
     * 事業者が実行したユーザー情報を取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 返り値はオブジェクトの配列
     */
    // リレーション：1対多
    public function users()
    {
        return $this->hasMany('app\Models\User', 'company_id');
    }


    /**
     * Method prefecture
     *
     * 事業者の所在地の都道府県を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefecture()
    {
        return $this->belongsTo('App\Models\Prefecture', 'prefecture_id');
    }

    /**
     * Method boot
     *
     * レコードを削除する場合に子要素を事前に削除する
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // 素材情報を削除
        static::deleting(function ($model) {
            foreach ($model->sozais()->get() as $sozai) {
                $sozai->delete();
            }
        });

        // 配信履歴情報を削除
        static::deleting(function ($model) {
            foreach ($model->distributions()->get() as $distribution) {
                $distribution->delete();
            }
        });

        // ユーザー情報を削除
        static::deleting(function ($model) {
            foreach ($model->users()->get() as $user) {
                $user->delete();
            }

        });
    }
}
