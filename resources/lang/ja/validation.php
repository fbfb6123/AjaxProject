<?php

return [


    'accepted'             => ':attribute が未承認です',
    'active_url'           => ':attribute は有効なURLではありません',
    'after'                => ':attribute は :date より後の日付にしてください',
    'after_or_equal'       => ':attribute は :date 以降の日付にしてください',
    'alpha'                => ':attribute は英字で入力してください',
    'alpha_dash'           => ':attribute は「英字」「数字」「-(ダッシュ)」「_(下線)」で入力してください',
    'alpha_num'            => ':attribute は「英字」「数字」で入力してください',
    'array'                => ':attribute は配列で入力してください',
    'before'               => ':attribute は :date より前の日付にしてください',
    'before_or_equal'      => ':attribute は :date 以前の日付にしてください',
    'between'              => [
        'numeric' => ':attribute は :min ～ :max の数値で入力してください',
        'file'    => ':attribute は :min ～ :max キロバイトまで有効です',
        'string'  => ':attribute は :min ～ :max 文字で入力してください',
        'array'   => ':attribute は :min ～ :max 個で入力してください',
    ],
    'boolean'              => ':attribute の値は true もしくは false で入力してください',
    'confirmed'            => ':attribute を確認用と一致させてください',
    'date'                 => ':attribute を有効な日付形式にしてください',
    'date_format'          => ':attribute を :format 書式と一致させてください',
    'different'            => ':attribute を :other と違うものにしてください',
    'digits'               => ':attribute は :digits 桁で入力してください',
    'digits_between'       => ':attribute は :min ～ :max 桁で入力してください',
    'dimensions'           => ':attribute ルールに合致する画像サイズで入力してください',
    'distinct'             => ':attribute に重複している値があります',
    'email'                => ':attribute メールアドレスの書式で入力してください',
    'exists'               => ':attribute 無効な値です',
    'file'                 => ':attribute アップロード出来ないファイルです',
    'filled'               => ':attribute 値を入力してください',
    'gt'                   => [
        'numeric' => ':attribute は :value より大きい必要があります。',
        'file'    => ':attributeは :value キロバイトより大きい必要があります。',
        'string'  => ':attribute は :value 文字より多い必要があります。',
        'array'   => ':attribute には :value 個より多くの項目が必要です。',
    ],
    'gte'                  => [
        'numeric' => ':attribute は :value 以上である必要があります。',
        'file'    => ':attribute は :value キロバイト以上である必要があります。',
        'string'  => ':attribute は :value 文字以上である必要があります。',
        'array'   => ':attribute には value 個以上の項目が必要です。',
    ],
    'image'                => ':attribute 画像は「jpg」「png」「bmp」「gif」「svg」で入力してください',
    'in'                   => ':attribute 無効な値です',
    'in_array'             => ':attribute は :other と一致する必要があります',
    'integer'              => ':attribute は整数で入力してください',
    'ip'                   => ':attribute IPアドレスの書式で入力してください',
    'ipv4'                 => ':attribute IPアドレス(IPv4)の書式で入力してください',
    'ipv6'                 => ':attribute IPアドレス(IPv6)の書式で入力してください',
    'json'                 => ':attribute 正しいJSON文字列で入力してください',
    'lt'                   => [
        'numeric' => ':attribute は :value 未満である必要があります。',
        'file'    => ':attribute は :value キロバイト未満である必要があります。',
        'string'  => ':attribute は :value 文字未満である必要があります。',
        'array'   => ':attribute は :value 未満の項目を持つ必要があります。',
    ],
    'lte'                  => [
        'numeric' => ':attribute は :value 以下である必要があります。',
        'file'    => ':attribute は :value キロバイト以下である必要があります。',
        'string'  => ':attribute は :value 文字以下である必要があります。',
        'array'   => ':attribute は :value 以上の項目を持つ必要があります。',
    ],
    'max'                  => [
        'numeric' => ':attribute は :max 以下で入力してください',
        'file'    => ':attribute は :max KB以下のファイルを入力してください',
        'string'  => ':attribute は :max 文字以下で入力してください',
        'array'   => ':attribute は :max 個以下で入力してください',
    ],
    'mimes'                => ':attribute は :values で入力してください',
    'mimetypes'            => ':attribute は :values で入力してください',
    'min'                  => [
        'numeric' => ':attribute は :min 以上で入力してください',
        'file'    => ':attribute は :min KB以上のファイルを入力してください',
        'string'  => ':attribute は :min 文字以上で入力してください',
        'array'   => ':attribute は :min 個以上で入力してください',
    ],
    'not_in'               => ':attribute 無効な値です',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => ':attribute は数字で入力してください',
    'present'              => ':attribute が存在しません',
    'regex'                => ':attribute 無効な値です',
    'required'             => ':attribute は必須です',
    'required_if'          => ':attribute は :other が :value には必須です',
    'required_unless'      => ':attribute は :other が :values でなければ必須です',
    'required_with'        => ':attribute は :values が入力されている場合は必須です',
    'required_with_all'    => ':attribute は :values が入力されている場合は必須です',
    'required_without'     => ':attribute は :values が入力されていない場合は必須です',
    'required_without_all' => ':attribute は :values が入力されていない場合は必須です',
    'same'                 => ':attribute は :other と同じ場合で入力してください',
    'size'                 => [
        'numeric' => ':attribute は :size で入力してください',
        'file'    => ':attribute は :size KBで入力してください',
        'string'  => ':attribute は :size 文字で入力してください',
        'array'   => ':attribute は :size 個で入力してください',
    ],
    'string'               => ':attribute は文字列で入力してください',
    'timezone'             => ':attribute 正しいタイムゾーンで入力してください',
    'unique'               => ':attribute は既に存在します',
    'uploaded'             => ':attribute アップロードに失敗しました',
    'url'                  => ':attribute は正しいURL書式で入力してください',


    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],


    'attributes' => [
    // 共通項目
        'company_id' => '事業者ID',
        'broadcaster_id' => '局ID',

    // テーブル共通項目
        'del_flag' => '削除フラグ',
        'created_by' => '作成ユーザーID',
        'created_at' => '作成日時',
        'create_function_id' => '作成機能ID',
        'updated_by' => '更新ユーザーID',
        'updated_at' => '更新日時',
        'update_function_id' => '更新機能ID',

        'batch_update_datetime' => 'バッチ更新日時',
        'batch_update_function_id' => 'バッチ更新機能ID',


        'id' => 'ID',
        'email' => 'メールアドレス',
        'user_name' => 'ユーザー名',
        'user_kbn' => 'ユーザー区分',
        'system_manager_flg' => 'システム管理者フラグ',
        'valid_flg' => '有効フラグ',
        'password' => 'パスワード',
        'password_unmatch_init_datetime' => 'パスワード不一致初回日時',
        'password_unmatch_count' => 'パスワード不一致回数',
        'account_lock_datetime' => 'アカウントロック日時',

    ],
];
