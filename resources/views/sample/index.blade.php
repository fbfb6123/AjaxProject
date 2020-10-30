<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./base.js"></script>
</head>
<body>
<h1>お問い合わせ（サンプル）</h1>
<p>
    サンプルのお問い合わせフォームです。個人情報などの入力はご遠慮ください。
</p>
<form action="" method="post">
    <div class="form_field">
        <p>名前</p>
        <input class="name" type="text" />
    </div>
    <div class="form_field">
        <p>メールアドレス</p>
        <input class="email" type="email" />
    </div>
    <div class="form_field">
        <p>電話番号</p>
        <input class="tel" type="tel" />
    </div>
    <div class="form_field">
        <p>問い合わせ内容</p>
        <textarea class="message" rows="15" cols="40"></textarea>
    </div>
    <div class="button_field">
        <button type="submit">送信</button>
    </div>
</form>
</body>
</html>
