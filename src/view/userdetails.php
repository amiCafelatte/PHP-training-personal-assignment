<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2><?= $_GET['userName'] ?> さんの詳細ページ</h2>

        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <details>
            <summary>編集する</summary>
            <?= (new $this->serviceClass)->edit($showUserList); ?>
        </details>
        <table>
            <tr>
                <th>姓</th>
                <th>名</th>
                <th rowspan="2">メールアドレス</th>
                <th rowspan="2">パスワード</th>
                <th rowspan="2">所属部署名</th>
                <th rowspan="2">役職名</th>
                <th class="null-th"></th>
            </tr>
            <tr>
                <?= (new $this->serviceClass)->index($showUserList); ?>
            </tr>
        </table>
    </main>
</body>

</html>