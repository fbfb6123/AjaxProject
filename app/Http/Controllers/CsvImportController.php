<?php

namespace App\Http\Controllers;

use App\Models\CsvUser;
use App\Models\Company;
use App\Models\Test;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use App\Http\Requests\CompanyValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CsvImportController extends Controller
{
    public function practice2()
    {
        return view('form');
    }


    public function upload_regist(Request $rq)
    {
        if ($rq->hasFile('csv') && $rq->file('csv')->isValid()) {
            // CSV ファイル保存
            $tmpname = uniqid("CSVUP_") . "." . $rq->file('csv')->guessExtension(); //TMPファイル名
            $rq->file('csv')->move(public_path() . "/csv/tmp", $tmpname);
            $tmppath = public_path() . "/csv/tmp/" . $tmpname;

            // Goodby CSVの設定
            $config_in = new LexerConfig();
            $config_in
                ->setFromCharset("SJIS-win")
                ->setToCharset("UTF-8") // CharasetをUTF-8に変換
                ->setIgnoreHeaderLine(true) //CSVのヘッダーを無視
            ;
            $lexer_in = new Lexer($config_in);

            $datalist = array();

            $interpreter = new Interpreter();
            $interpreter->addObserver(function (array $row) use (&$datalist) {
                // 各列のデータを取得
                $datalist[] = $row;
            });

            // CSVデータをパース
            $lexer_in->parse($tmppath, $interpreter);

            // TMPファイル削除
            unlink($tmppath);

            // 処理
            foreach ($datalist as $row) {
                // 各データ取り出し
                $csv_user = $this->get_csv_user($row);

                // DBへの登録
                $this->regist_user_csv($csv_user);
            }
            return response()->json($csv_user);
        }
        return redirect('/csv/practice2')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
    }



    private function get_csv_user($row)
    {
        $user = array(

            //CSVuser用
            'name' => $row[0],
            'email' => $row[1],
            'tel' => $row[2],


            //Company用の配列作成
            /*'company_name' => $row[0],
            'company_name_kana' => $row[1],
            'company_name_en' => $row[2],
            'company_manager_user_id' => $row[3],
            'dex_res_id' => $row[4],
            'dex_login_user_id' => $row[5],
            'dex_login_password_id' => $row[6],
            'zip_code' => $row[7],
            'address_1' => $row[8],
            'address_2' => $row[9],
            'manager_user_id' => $row[10],
            'tel_no' => $row[11],
            'fax_no' => $row[12],
            'mailaddress' => $row[13],
            'url' => $row[14],
            'del_flag' => $row[15],
            'created_by' => $row[16],
            'created_at' => $row[17],
            'create_function_id' => $row[18],
            'updated_by' => $row[19],
            'updated_at' => $row[20],
            'update_function_id' => $row[21],*/


        );

        return $user;
    }

    private function regist_user_csv($user)
    {
        info($user);
        //ここに$userをチェックするバリデーションをかける？
        //参考URL　https://laracasts.com/discuss/channels/general-discussion/class-apphttpcontrollersvalidator-not-found
        //https://readouble.com/laravel/5.5/ja/validation.html#automatic-redirection
        //https://qiita.com/ryo-futebol/items/e2b801675d76613c8fad


        //今回は配列をバリデーションチェックしたいためmakeメソッドで新しいインスタンスを作成しバリデーションしている
        $validator = Validator::make($user, [
            'name' => 'string',//integerだとはじかれる  stringだと通ります
            'email' => 'required',
            'tel' => 'required',
        ])->validate();

        /*$validate_rule = [
            array(
                'name' => 'required',
                'email' => 'email',
                'tel' => 'required',
            )];

        $this->validate($user, $validate_rule);*/

        /*   $validator = Validator::make($user->all(), [
               'name' => 'required',
               'email' => 'email',
               'tel' => 'required',
           ]);*/

        /*        $validator = Validator::make($user->all(), [
                    'name' => 'required',
                    'email' => 'email',
                    'tel' => 'required',
                ]);*/


        $newuser = new CsvUser;
        foreach ($user as $key => $value) {
            $newuser->$key = $value;
        }
        $newuser->save();
    }
}

