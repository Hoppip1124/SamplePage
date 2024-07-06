<?php
session_start();

$error = [];
$post = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, $_POST);

    if (!isset($post['name']) || $post['name'] === '') {
        $error['name'] = 'blank';
    }

    if (!isset($post['email']) || $post['email'] === '') {
        $error['email'] = 'blank';
    } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }

    if (!isset($post['contact']) || $post['contact'] === '') {
        $error['contact'] = 'blank';
    }

    if (count($error) === 0) {
        // エラーがないので確認画面に移動
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>

    <!-- CSS -->
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <!-- 固定ヘッダー -->
    <nav>
        <div class="logo">
            <a href="./index.html"><h4>Sample</h4></a>
        </div>
        <ul class="nav_links">
            <li><a href="./index.html">ホーム</a></li>
            <li><a href="./about_page.html">本サイトについて</a></li>
            <li><a href="./about_me.html">私について</a></li>
            <li><a href="./contact.php">お問い合わせ</a></li>
        </ul>

        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>

    <!-- お問合せフォーム画面 -->
    <section>
        <div class="container d-flex justify-content-center my-5">
            <h1 class="page-title fs-1">お問い合わせ</h1>
        </div>
    </section>

    <div class="container">
        <!-- action=""でこのページを読み込む -->
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="text" spellcheck="false" name="name" id="inputName" class="form-control" value="<?php echo isset($post['name']) ? htmlspecialchars($post['name']) : ''; ?>" required autofocus>
                        <?php if (isset($error['name']) && $error['name'] === 'blank'): ?>
                            <p class="error_msg">※お名前をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="email" name="email" id="inputEmail" class="form-control" value="<?php echo isset($post['email']) ? htmlspecialchars($post['email']) : ''; ?>" required>
                        <?php if (isset($error['email']) && $error['email'] === 'blank'): ?>
                            <p class="error_msg">※メールアドレスをご記入下さい</p>
                        <?php endif; ?>
                        <?php if (isset($error['email']) && $error['email'] === 'email'): ?>
                            <p class="error_msg">※メールアドレス形式でご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <!-- textareaタグの間を改行するとスペースが入力欄の空判定に影響を及ぼすので改行なし -->
                        <textarea name="contact" id="inputContent" rows="10" class="form-control" required><?php echo isset($post['contact']) ? htmlspecialchars($post['contact']) : ''; ?></textarea>
                        <?php if (isset($error['contact']) && $error['contact'] === 'blank'): ?>
                            <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-4">
                    <button type="submit">確認画面へ</button>
                </div>
            </div>
        </form>
    </div>

    <script src="./js/script.js"></script>
    <script>
        // navの高さを取得
        var navHeight = document.querySelector('nav').offsetHeight;

        console.log(navHeight);

        // sectionにnavの高さ分のパディングを設定(元のスタイルによるパディング不足分を+10で補う)
        document.querySelector('.container').style.paddingTop = navHeight + 10 + 'px';
    </script>
</body>
</html>