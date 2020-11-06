<link rel="stylesheet" type="text/css" href="css/form.css">






<body>


<label>
    <input type="file" name="file">ファイルを選択
</label>
<p>選択されていません</p>



<script>
    $('input').on('change', function () {
        var file = $(this).prop('files')[0];
        $('p').text(file.name);
    });
</script>
</body>
















{{--参照URL
//https://techmemo.biz/css/input-file-name-clear/
--}}
{{--<script>
    $(function() {
        $('.js-upload-file').on('change', function () { //ファイルが選択されたら
            var file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
            $('.js-upload-filename').text(file.name); //ファイル名を出力
        });
    });
</script>



--}}{{--試作用品--}}{{--
<div>
    <input type="file" id="csv" name="file_data" style='width: 500px'/>
</div>

<label>
    <input type="file" id="csv" name="file_data" class="js-upload-file">ファイルを選択
</label>
<div class="js-upload-filename">ファイルが未選択です</div>

--}}{{--アップロードボタン--}}{{--
<button class="btn btn--orange btn--radius" onclick="upload(); return false;">アップロード</button>--}}
