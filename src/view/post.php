<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>

<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>役職</h2>
        </div>
        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <main>
        <table>
            <tr>
                <th>役職名</th>
            </tr>
            <?= (new PostService)->index(); ?>
        </table>

    </main>
</body>

</html>