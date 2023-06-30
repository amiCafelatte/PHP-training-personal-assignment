<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>部署</h2>
        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <a class="btn" href="/InsertDepartment">新規部署を登録する</a>
        <table>
            <tr>
                <th>部署名</th>
                <th class="null-th"></th>
            </tr>
            <?= (new $this->modelClass)->DepDisp(); ?>
        </table>

    </main>
</body>

</html>