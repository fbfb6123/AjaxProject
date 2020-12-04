<?php

namespace App\Http\Controllers;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyValidate;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;


/**
 * Class BroadcasterController
 *
 * ユーザーコントローラー(以下説明文)
 *
 * @package App\Http\Controllers
 * @author  未定<メールアドレス>
 * @since 1.0
 */
class CsvImportController extends Controller
{



    public function index()
    {
        return view('/form');
    }

    public function apiList(Request $request)
    {
        Log::info($request);
        $data = $this->search(new Company(), $request->input())->get()->toArray();

        Log::debug($data);
        return response()->json($this->setJson4Tabulator($data));
    }



    public function apiCsvUpload(Request $request)
    {
        if ($request->hasFile('csv') && $request->file('csv')->isValid()) {
            // CSV ファイル保存
            $tmpname = uniqid("CSVUP_") . "." . $request->file('csv')->guessExtension(); //TMPファイル名
            $request->file('csv')->move(public_path() . "/csv/tmp", $tmpname);
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
            $interpreter->addObserver(
                function (array $row) use (&$datalist) {
                    // 各列のデータを取得
                    $datalist[] = $row;
                }
            );

            // CSVデータをパース
            $lexer_in->parse($tmppath, $interpreter);

            // TMPファイル削除
            unlink($tmppath);

            /*$valid = new CompanyValidate();*/

            // 処理
            foreach ($datalist as $row) {
                // 各データ取り出し
                $csv_company = $this->getCsvUser($row);

                $this->registUserCsv($csv_company/* ,$valid->rules()*/, new CompanyValidate()); //, new CompanyValidate()追記
            }
            return response()->json($csv_company);
        }
        return redirect('/csv/practice2')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
    }


    private function getCsvUser($row)
    {
        $company = [

            //Company用の配列作成
            //$company[company_name] = $row[0]と同じ
            'company_name' => $row[0],
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
            'email' => $row[13],
            'url' => $row[14],
            /*'del_flg' => $row[15],*/
            'created_by' => $row[15],
            /*'created_at' => $row[17],*/
            'create_function_id' => $row[16],
            'updated_by' => $row[17],
            /*'updated_at' => $row[20],*/
            'update_function_id' => $row[18],

        ];

        return $company;
    }

    /*private function registUserCsv(array $company,array $rules)
    {
        //放送局用
        if ($validator = Validator::make($company, $rules)->validate()) {
            Log::debug($company);
            $newcompany = new Company;
            foreach ($company as $key => $value) {
                $newcompany->$key = $value;
            }

            $newcompany->save();
        }
    }*/

    /**
     * insert()
     *
     * 指定されたモデルの連続登録処理
     *
     * @param array $keys
     * @param array $values
     * @param mixed $obj 登録対象モデル
     * @param mixed $valid 登録対象バリデータ
     * @param boolean $flag エラーの出力制御フラグ
     *
     * @return array|null $errors エラー一覧
     */
    public function registUserCsv(array $company, $valid, $flag=false)
    {
        // モデル登録用の連想配列
        $params = [];

        // エラー配列の初期化
        $errors = [];

        $keys =array_keys($company);
        Log::debug($keys);

        $values =array_values($company);
        Log::debug($values);

        $newcompany = new Company;

        // データの登録処理
        foreach ($values as $line => $val) {
            // エラー文字列の初期化
            $error = '';

            // バリデーション用の連想配列を作成
            foreach ($keys as $idx => $key) {
                $params[$key] = $val[$idx] ?? null;
            }
            Log::info($params);

            // バリデートの実行
            $validator = $valid->localValidate($params);

            // バリデーションにエラーが発生した場合はエラー配列に内容を書込み
            if ($validator->fails()) {
                $error .= "\n" . $line . "行目のデータにエラーがあります\n";
                foreach ($validator->errors()->all() as $error) {
                    $error .= "・" . $error . "\n";
                }
                $errors[] = $error;
            } else {
                // 新規登録

                foreach ($company as $key => $value) {
                    $newcompany->$key = $value;
                }
                /*Log::info($newcompany);*/
                $newcompany->save();
            }
        }

        // エラーがある場合は出力
        if (is_countable($errors) && count($errors) > 0 && $flag) {
            foreach ($errors as $error) {
                echo $error;
            }
            echo "\n";
        }

        return $errors;
    }



    /**
     * insert()
     *保存動作確認済み
     */
    /*public function registUserCsv(array $row, $valid, $flag=false)
    {



        $keys = [
            "company_name",
            "company_name_kana",
            "company_name_en",
            "company_manager_user_id",
            "dex_res_id",
            "dex_login_user_id",
            "dex_login_password_id",
            "zip_code",
            "address_1",
            "address_2",
            "manager_user_id",
            "tel_no",
            "fax_no",
            "email",
            "url",
        ];

        $values = [$row];



        // モデル登録用の連想配列
        $params = [];

        // エラー配列の初期化
        $errors = $row;

        /*$values = $row;
        Log::info($values);*/

        /*$company = new Company();

        // データの登録処理
        foreach ($values as $line => $val) {
            // エラー文字列の初期化
            $error = '';

            // バリデーション用の連想配列を作成
            foreach ($keys as $idx => $key) {
                $params[$key] = $val[$idx] ?? null;
            }
            Log::info($params);


            // バリデートの実行
            $validator = $valid->localValidate($params);

            // バリデーションにエラーが発生した場合はエラー配列に内容を書込み
            if ($validator->fails()) {
                $error .= "\n" . $line . "行目のデータにエラーがあります\n";
                foreach ($validator->errors()->all() as $error) {
                    $error .= "・" . $error . "\n";
                }
                $errors[] = $error;
            } else {
                // 新規登録
                $company->create($params);
            }
        }*/

        // エラーがある場合は出力
        /*if (is_countable($errors) && count($errors) > 0 && $flag) {
            foreach ($errors as $error) {
                echo $error;
            }
            echo "\n";
        }

        return $errors;
    }*/
}

