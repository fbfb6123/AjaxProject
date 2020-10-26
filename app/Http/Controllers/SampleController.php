<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index() {
        return view('sample/index', ['msg'=>'フォームを入力：']);
    }

    public  function post(Request $request) {
        $validate_rure = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        $this->validate($request, $validate_rule);
        return view('hello.index',['msg'=>'正しく入力されました']);
    }
}
