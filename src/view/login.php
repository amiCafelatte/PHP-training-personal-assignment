<?= require_once(realpath(dirname(__DIR__) . '/View/templates/head.php')) ?>


<body>
    <header>
        <div class="header-div">
            <h1>社員管理システム</h1>
            <h2>ログイン</h2>

        </div>

        <?= require_once(realpath(dirname(__DIR__) . '/View/templates/menu.php')) ?>
    </header>
    <form method="post" action="" name="formCheck" class="form" id="app">
        <label for="email">メールアドレス</label>
        <p v-if="isInValidEmail" class="formErr">SALTOアカウントではありません</p>
        <input
            type="email"
            name="email"
            id="email"
            v-model="email" require>
        <label for="password">パスワード</label><br>
        <p v-if="isInValidPassword" class="formErr"><b>8文字以上の半角英数字</b>である必要があります</p>
        <input 
            type="password"
            name="password"
            value="adminaccount"
            id="password"
            v-model="password" require>
        <input type="submit" value="送信" onclick="return check()">
        <!-- <button type="submit" name="check" value="true" onclick="return check()">ログイン</button> -->
    </form>
    <!-- <script src="sctipt/script.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.11"></script>
    <script src="script/vue.js"></script>
</body>

</html>