{{--参考URL
https://remotestance.com/blog/2701/--}}
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

<p class="messageBar" style="margin-top: 20px; border: 1px solid transparent; padding: 0.3em;">
    下のボタンを押してください。
</p>
<div>
    <button id="warn">警告</button>
    <button id="error">エラー</button>
</div>

</body>

<script>

    $(function() {
        $("#warn").click(function() {
            displayWarning("「警告」が押されたので ui-state-highlight で表示します。jQuery UI のテーマによりデザインは違います。");
            return false;
        });

        $("#error").click(function() {
            displayError("「エラー」が押されたので ui-state-error で表示します。jQuery UI のテーマによりデザインは違います。");
            return false;
        });
    });

    // エラー表示
    function displayError(str) {
        var msg = $(".messageBar");

        msg
            .text(str)
            .addClass("ui-state-error");
        setTimeout(function() {
            msg.removeClass("ui-state-error", 1500);
        }, 500);
    }

    // 警告表示
    function displayWarning(str) {
        var msg = $(".messageBar");

        msg
            .text(str)
            .addClass("ui-state-highlight");
        setTimeout(function() {
            msg.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
</script>
</html>


