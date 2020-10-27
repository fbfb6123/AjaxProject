
    <h1>Laravel で CSV インポート 演習</h1>
    <p>CSVファイルを csv_users テーブルに登録します。</p>

    <script type="text/javascript" src="../js/plugins/jquery.min.js"></script>


    <script type="text/javascript">
        upload = function()
        {
            //ajaxでのcsrfトークン送信
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // 送信フォーム
            var form = new FormData();
            form.append( "csv", $("#csv").prop("files")[0]);

            $.ajax({
                type:'POST',
                url:'/api/csv/upload_regist',
                data: form,
                processData : false,
                contentType : false,
            })
                .done(function(data){
                    // data = JSON.parse(data);
                    console.log(data);
                })
                .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                });
        };
    </script>

    <!--エラーメッセージ-->
    <!--ファイルを選択してください-->
    @if(Session::has('message'))
        メッセージ：{{ session('message') }}
    @endif


    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    @foreach($val as $msg)
                        <li>{{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="post" enctype="multipart/form-data" id="imgForm">
        {{ csrf_field() }}
        <div class="row">
            <label class="col-1 text-right" for="form-file-1">File:</label>
            <div class="col-11">
                <div class="custom-file">
                    <input type="file" id="csv" name="file_data" class="custom-file-input">
                    <label class="custom-file-label" for="customFile" data-browse="参照">ファイル選択...</label>
                </div>
            </div>
        </div>
        <button style="margin-top: 10px;" onclick="upload(); return false;">送信</button>
    </form>

    <html>
    <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

    <script>

        // ファイルを選択すると、コントロール部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
    </script>
    </body>
    </html>

