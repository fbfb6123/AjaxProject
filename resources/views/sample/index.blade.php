<link rel="stylesheet" type="text/css" href="css/app.css">

{{--参照URL
//https://techmemo.biz/css/input-file-name-clear/
--}}

<label>
    <input type="file" name="file" class="js-upload-file">ファイルを選択
</label>
<div class="js-upload-filename">ファイルが未選択です</div>
<div class="fileclear js-upload-fileclear">選択ファイルをクリア</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.js-upload-file').on('change', function () { //ファイルが選択されたら
            var file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
            $('.js-upload-filename').text(file.name); //ファイル名を出力
        });
    });
</script>
