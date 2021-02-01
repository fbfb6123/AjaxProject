<?php

namespace App\Http\Controllers;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Requests\PersonValidate;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CsvImportController extends Controller
{

    public function index()
    {
        return view('/form');
    }

    public function apiCsvUpload(Request $request)
    {
        if ($request->hasFile('csv') && $request->file('csv')->isValid()) {
            $tmpname = uniqid("CSVUP_") . "." . $request->file('csv')->guessExtension(); 
            $request->file('csv')->move(public_path() . "/csv/tmp", $tmpname);
            $tmppath = public_path() . "/csv/tmp/" . $tmpname;

            $config_in = new LexerConfig();
            $config_in
                ->setFromCharset("SJIS-win")
                ->setIgnoreHeaderLine(true) 
            ;
            $lexer_in = new Lexer($config_in);

            $datalist = array();

            $interpreter = new Interpreter();
            $interpreter->addObserver(
                function (array $row) use (&$datalist) {
                    $datalist[] = $row;
                }
            );

            $lexer_in->parse($tmppath, $interpreter);

            unlink($tmppath);

            $valid = new PersonValidate();

            foreach ($datalist as $row) {
                $csv_person = $this->getCsvPerson($row);

                $this->registPersonCsv($csv_person, $valid->rules());
            }
            return response()->json($csv_person);
        }
        return redirect('/form')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
    }


    private function getCsvPerson($row)
    {
        return [

            'name' => $row[0],
            'email' => $row[1],
            'tel' => $row[2],

        ];
    }

    private function registPersonCsv(array $person, array $rules)
    {
        if ($validator = Validator::make($person, $rules)->validate()) {

            $newperson = new Person;
            foreach ($person as $key => $value) {
                $newperson->$key = $value;
            }

            $newperson->save();
        }
    }
}