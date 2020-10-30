<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Config;


class CsvImportController extends Controller
{
    // 定数
    public static $const;
    // 部分一致検索対象
    public static $model;
    // 認証済みユーザ情報
    public static $user;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * constructor.
     */
    public function __construct()
    {
        static::$const = Config('const');
    }

    public function index(Request $request)
    {
        return view('stub/index');
    }

    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                // ファイル保管
                // 参考URL:https://readouble.com/laravel/8.x/ja/filesystem.html
                $uploadFile = $request->file("image");
                Log::debug('★アップロードファイル名：' . $uploadFile->getClientOriginalName());
                if ($uploadFile->isValid()) {
                    // Case1.別名で保存
                    $savePath = Storage::putFileAs(
                        'public/uploads',
                        $uploadFile,
                        date('YmdHis') . '.' . $uploadFile->extension()
                    );
                    // Case2.laravel自動命名ファイル名で保存
                    // $savePath = $uploadFile->store('public/uploads');
                    Log::debug('★保管パス：/storage/app/' . $savePath);
                } else {
                    Log::error('★アップロード失敗みたいよ★');
                    $ret = $this->setJsonMessage((int) $this->getCode('_FAILURE_'), (array) []);
                    $ret = [
                        'status'  => 9,
                        'message' => 'ファイルのアップロードに失敗したよ',
                    ];
                    return response()->json($ret);
                }
            } else {
                Log::debug('★アップロードファイルないよ★');
            }

            $ret = [
                'status'  => 0,
                'massage' => $savePath,
            ];
            Log::debug($ret);
        } catch (\Exception $ex) {
            $ret = [
                'status'  => 9,
                'message' => $ex->getMessage(),
            ];
            Log::error($ex);
        }

        return response()->json($ret);
    }


    /**
     * @return
     * @author  koutaro_ikeda <koutaro_ikeda@s-cubed.co.jp>
     * CSVファイルAjaxインポート
     */
    public function practice2()
    {
        return view('form');
    }


    public function upload_regist(Request $request)
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
        return redirect('form')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
    }



    private function get_csv_user($row)
    {
        $user = array(

            //CSVuser用
            /*'name' => $row[0],
            'email' => $row[1],
            'tel' => $row[2],*/


            //Company用の配列作成
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
            'mailaddress' => $row[13],
            'url' => $row[14],
            'del_flag' => $row[15],
            'created_by' => $row[16],
            'created_at' => $row[17],
            'create_function_id' => $row[18],
            'updated_by' => $row[19],
            'updated_at' => $row[20],
            'update_function_id' => $row[21],


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
        /*CSV用*/
        /*$validator = Validator::make($user, [
            'name' => 'integer',//integerだとはじかれる  stringだと通ります
            'email' => 'required',
            'tel' => 'required',
        ])->validate();*/


        /*事業者用*/
        $validator = Validator::make($user, [
            'company_name' => 'string',
            'company_name_kana' => 'integer',
            'company_name_en' => 'integer',
            'company_manager_user_id' => 'integer',
            'dex_res_id' => 'string',
            'dex_login_user_id' => 'string',
            'dex_login_password_id' => 'string',
            'zip_code' => 'string',
            'address_1' => 'string',
            'address_2' => 'string',
            'manager_user_id' => 'integer',
            'tel_no' => 'string',
            'fax_no' => 'string',
            'mailaddress' => 'string',
            'url' => 'string',
            'del_flag' => 'integer',
            'created_by' => 'required',
            'created_at' => 'required',
            'create_function_id' => 'string',
            'updated_by' => 'integer',
            'updated_at' => 'required',
            'update_function_id' => 'string',
        ])->validate();




        Log::debug($user);

        $newuser = new Company;
        foreach ($user as $key => $value) {
            $newuser->$key = $value;
        }
        $newuser->save();
    }
}
