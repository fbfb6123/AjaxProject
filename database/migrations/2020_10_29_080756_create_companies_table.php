<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            // 事業者ID
            $table->id('id')
                ->comment('事業者ID');

            // 事業者名
            $table->string('company_name',30)
                ->nullable()
                ->comment('事業者名');

            // 事業者名(カナ)
            $table->string('company_name_kana', 30)
                ->nullable()
                ->comment('事業者名(カナ)');

            // 事業者名(英語)
            $table->string('company_name_en',50)
                ->nullable()
                ->comment('事業者名(英語)');

            // 事業者管理者ID
            $table->bigInteger('company_manager_user_id', false, true)
                ->nullable()
                ->comment('事業者管理者ID');

            // DEXリソースID
            $table->string('dex_res_id',9)
                ->nullable()
                ->comment('DEXリソースID');

            // DEXユーザーID
            $table->string('dex_login_user_id',50)
                ->nullable()
                ->comment('DEXユーザーID');

            // DEXパスワード
            $table->string('dex_login_password_id', 50)
                ->nullable()
                ->comment('DEXパスワード');

            // 郵便番号
            $table->string('zip_code',10)
                ->nullable()
                ->comment('郵便番号');

            // 住所1(市区町村番地)
            $table->string('address_1', 100)
                ->nullable()
                ->comment('住所1(市区町村番地)');

            // 住所2(マンション・ビル等)
            $table->string('address_2', 100)
                ->nullable()
                ->comment('住所2(マンション・ビル等)');

            // 管理者ID
            $table->bigInteger('manager_user_id', false, true)
                ->nullable()
                ->comment('管理者ID');

            // 代表電話番号
            $table->string('tel_no', 20)
                ->nullable()
                ->comment('代表電話番号');

            // 代表FAX番号
            $table->string('fax_no', 20)
                ->nullable()
                ->comment('代表FAX番号');

            // メールアドレス
            $table->string('mailaddress', 100)
                ->nullable()
                ->comment('メールアドレス');

            // URL
            $table->string('url', 100)
                ->nullable()
                ->comment('URL');

            // 削除フラグ
            $table->char('del_flag', 1)
                ->comment('削除フラグ');

            // 作成ユーザーID
            $table->biginteger('created_by', false, true)
                ->comment('作成ユーザーID');

            // 作成日時
            $table->dateTime('created_at')
                ->comment('作成日時');

            //作成機能ID
            $table->string('create_function_id',5)
                ->comment('作成機能ID');

            // 更新ユーザーID
            $table->bigInteger('updated_by', false, true)
                ->nullable()
                ->comment('更新ユーザーID');

            // 更新日時
            $table->dateTime('updated_at')
                ->nullable()
                ->comment('更新日時');

            // 更新機能ID
            $table->string('update_function_id',5)
                ->nullable()
                ->comment('更新機能ID');

        });

        // テーブルにコメントを設定
        DB::statement("ALTER TABLE companies COMMENT '事業者マスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
