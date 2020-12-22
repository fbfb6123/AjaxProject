<?php

namespace App\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as LocalValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;


class CompanyValidate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'nullable|string|max:30',//事業者名
            'company_name_kana' => 'nullable|string|max:30',//事業者名(カナ)
            'company_name_en' => 'nullable|string|max:30',//事業者名（英語）
            'company_manager_user_id' => 'nullable|integer',//事業者管理者ID
            'dex_res_id' => 'nullable|string|max:9',//DEXリソースID
            'dex_login_user_id' => 'nullable|string|max:50',//DEXユーザーID
            'dex_login_password_id' => 'nullable|string|max:255',//DEXパスワード
            'zip_code' => 'nullable|string|max:10',//郵便番号
            'prefecture_id' => 'nullable|integer',//都道府県ID
            'address_1' => 'nullable|string|max:100',//住所1(市区町村番地)
            'address_2' => 'nullable|string|max:100',//住所2(マンション・ビル等)
            'manager_user_id' => 'nullable|integer',//管理者ID
            'tel_no' => 'nullable|string|max:20',//代表電話番号
            'fax_no' => 'nullable|string|max:20',//代表FAX番号
            'email' => 'nullable|string|max:100|email',//メールアドレス
            'url' => 'nullable|string|max:100|url',//URL
            'del_flg' => 'required|string|max:1',//削除フラグ
            'create_function_id' => 'nullable|string|max:5',//作成機能ID
            'update_function_id' => 'nullable|string|max:5',//更新機能ID
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
            'url' => 'URL',
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

}
