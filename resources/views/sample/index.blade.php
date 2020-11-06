<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ファイルアップロード</title>
    <style>
        label > input {
            display:none; /* アップロードボタンのスタイルを無効にする */
        }
        label {
            color: #AAAAAA; /* ラベルテキストの色を指定する */
            background-color: #006DD9;/* ラベルの背景色を指定する */
            padding: 10px; /* ラベルとテキスト間の余白を指定する */
            border: double 4px #AAAAAA;/* ラベルのボーダーを指定する */
        }
    </style>
</head>
<body>
<h1>input type="file"のデザインを変更する</h1>
<label for="file_upload">
    ファイルを選択して下さい
    <input type="file" id="file_upload">
</label>
</body>
</html>
