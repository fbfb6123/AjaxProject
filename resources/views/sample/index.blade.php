<link rel="stylesheet" type="text/css" href="css/app.css">

{{--参照URL
//https://techmemo.biz/css/input-file-name-clear/
--}}

<label>
    <input type="file" name="file" class="js-upload-file">ファイルを選択
</label>
<div class="js-upload-filename">ファイルが未選択です</div>
<div class="fileclear js-upload-fileclear">選択ファイルをクリア</div>

<script>
    $(function() {
        $('.js-upload-file').on('change', function () { //ファイルが選択されたら
            var file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
            $('.js-upload-filename').text(file.name); //ファイル名を出力
        });
    });
</script>



{{--試作用品--}}
<div>
    <input type="file" id="csv" name="file_data" style='width: 500px'/>
</div>

<label>
    <input type="file" id="csv" name="file_data" class="js-upload-file">ファイルを選択
</label>
<div class="js-upload-filename">ファイルが未選択です</div>
<div class="fileclear js-upload-fileclear">選択ファイルをクリア</div>

{{--アップロードボタン--}}
<button class="btn btn--orange btn--radius" onclick="upload(); return false;">アップロード</button>
