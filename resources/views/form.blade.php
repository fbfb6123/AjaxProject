
    <h1>Laravel で CSV インポート 演習</h1>

    <link rel="stylesheet" type="text/css" href="css/app.css">


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
                    console.log('成功');
                })
                .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log('失敗だ');
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
            <div class="col-11">
                <div class="custom-file">
                    <label><input type="file" id="csv" name="file_data" class="custom-file-input">ファイルを選択</label>
                    <p>選択されていません</p>
                </div>
            </div>
        </div>
        <button class="btn btn--orange btn--radius" onclick="upload(); return false;">アップロード</button>
    </form>

    <html>
    <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

    <script>

        // ファイルを選択すると、コントロール部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })

        $('input').on('change', function () {
            var file = $(this).prop('files')[0];
            $('p').text(file.name);
        });
    </script>
    </body>
    </html>

