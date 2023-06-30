<?php
  $dispName =isset($_SESSION['user']) ? $_SESSION['user']['name'].'さんがログイン中' : 'ログインしてください';
?>
<div>
  <p><?= $dispName ?></p>
</div>
<nav>
  <a href="/Logout">ログアウト</a>
  <a href="/Main">社員</a>
  <a href="/Dep">部署</a>
  <a href="/Post">役職</a>
  <a href="/Entry">登録</a>
  <div class="animation start-home"></div>
</nav>