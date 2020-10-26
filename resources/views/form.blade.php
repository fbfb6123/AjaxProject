@if(Session::has('message'))
    メッセージ：{{ session('message') }}
@endif

@if (is_array($errors))
    <div class="flushComment">
        ・CSVインポートエラーが発生しました。以下の内容を確認してください。<br>
        @if (count($errors['registration_errors']) > 0)
            [対象のデータ：新規登録]
            <ul>
                @foreach ($errors['registration_errors'] as $line => $columns)
                    @foreach ($columns as $error)
                        <li>{{ $line }}行目：{{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        @endif
        @if (count($errors['update_errors']) > 0)
            [対象のデータ：編集登録]<br>
            <ul>
                @foreach ($errors['update_errors'] as $line => $columns)
                    @foreach ($columns as $error)
                        <li>{{ $line }}行目：{{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        @endif
    </div>
@endif

<form action="/form" method="post" enctype="multipart/form-data" id="csvUpload">
    <input type="file" value="ファイルを選択" name="csv_file">
    {{ csrf_field() }}
    <button type="submit">インポート</button>
</form>
