<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index() {
        return view('sample/index', ['msg'=>'フォームを入力：']);
    }

    public  function store(Request $request) {
        $validate_rule = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        $this->validate($request, $validate_rule);
        return view('sample/index',['msg'=>'正しく入力されました']);
    }
}
