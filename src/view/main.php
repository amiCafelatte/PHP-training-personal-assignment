<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>


<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>社員一覧</h2>

        </div>

        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <table>
            <tr>
                <th>姓</th>
                <th>名</th>
                <th>所属部署名</th>
                <th>役職名</th>
                <th></th>
            </tr>
            <tr>
                <?= (new $this->serviceClass)->index($showUserList);?>
            </tr>
        </table>
    </main>
</body>

</html>