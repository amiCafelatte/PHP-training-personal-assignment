<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>部署 編集中</h2>

        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
            <div>
                <?= (new $this->modelClass)->edit(); ?>

            </div>
            <details>
                <summary>現在の部署一覧</summary>
                <table>
                    <tr>
                        <th>部署名</th>
                        <th class="null-th"></th>
                    </tr>
                    <?= (new $this->modelClass)->DepDisp(); ?>
                </table>

            </details>
    </main>
</body>

</html>