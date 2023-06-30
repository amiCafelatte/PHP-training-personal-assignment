<?= header('Refresh: 3; URL=http://localhost/Login'); ?>
<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>ログアウト</h2>
        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <p>ログアウトしました</p>
        <p>3秒後にログインページに戻ります。</p>
    </main>
</body>

</html>