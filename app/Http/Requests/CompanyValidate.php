<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as LocalValidator;
use Illuminate\Validation\ValidationException;

class CompanyValidate extends FormRequest
{

    public function rules()
    {
        return [
            'company_name' => 'nullable|',//事業者名
            'company_name_kana' => 'nullable|max:30',//事業者名(カナ)
            'company_name_en' => 'nullable|max:30',//事業者名（英語）
            'company_manager_user_id' => 'nullable|max:10',//事業者管理者ID
            'dex_res_id' => 'nullable|max:9',//DEXリソースID
            'dex_login_user_id' => 'nullable|max:50',//DEXユーザーID
            'dex_login_password_id' => 'nullable|max:255',//DEXパスワード
            'zip_code' => 'nullable|max:10',//郵便番号
            'prefecture_id' => 'nullable|max:5',//都道府県ID
            'address_1' => 'nullable|max:100',//住所1(市区町村番地)
            'address_2' => 'nullable|max:100',//住所2(マンション・ビル等)
            /*'manager_user_id' => 'nullable|max:10',//管理者ID*/
            'tel_no' => 'nullable|max:20',//代表電話番号
            'fax_no' => 'nullable|max:20',//代表FAX番号
            'email' => 'nullable|max:100|email',//メールアドレス
            'url' => 'nullable|max:100',//URL
            /*'del_flg' => 'nullable|Integer',//削除フラグ*/
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'csv_file.file' => 'CSVファイルを選択してください'
        ];
    }

    public function attributes()
    {
        return [
            'csv_file' => 'CSVファイル',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException or HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $const = $this::getConst();

        // 非同期通信の場合はJSONで応答を返す
        if (FormRequest::ajax()) {
            $csv_user = response()->json(
                $this->setJsonMessage((int)$const["_PARAM_ERROR_"], $validator->errors()->toArray())
            );
            throw new HttpResponseException($csv_user);
        } // 非同期通信以外の場合
        else {
            parent::failedValidation($validator);
        }
    }

    /**
     * localValidate()
     *
     * フォーム以外の入力をバリデートする
     *
     * @param array $params
     * @return mixed
     * @throws ValidationException
     */
    public function localValidate(array $params)
    {
        return LocalValidator::make($params, $this->rules());
    }

}
