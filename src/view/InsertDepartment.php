<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>部署登録</h2>
        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <?= (new InputDepartmentService)->entry(); ?>

    </main>
</body>

</html>