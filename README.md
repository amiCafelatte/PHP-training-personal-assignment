# 先輩に聞きたい謎

## カンマとドット

### コード
これはいけるのに
```php
  $dispName =isset($_SESSION['user']) ? $_SESSION['user']['name'].'さんがログイン中' : 'ログインしてください';
```

これはエラーが出る
```php
    $dispName =isset($_SESSION['user']) ? $_SESSION['user']['name'],'さんがログイン中' : 'ログインしてください';
```
### エラー内容

> Fatal error: Uncaught TypeError: Unsupported operand types: string + string in /Applications/MAMP/htdocs/kadai05/src/View/templates/menu.php:2 Stack trace: #0 /Applications/MAMP/htdocs/kadai05/src/View/Post.php(9): require_once() #1 /Applications/MAMP/htdocs/kadai05/src/Controller/PostController.php(17): require_once('/Applications/M...') #2 /Applications/MAMP/htdocs/kadai05/src/public/index.php(57): Post->index() #3 {main} thrown in /Applications/MAMP/htdocs/kadai05/src/View/templates/menu.php on line 2

---

## マジックメソッド

`__unset()` を使い倒したかったのにできない

---
## 結局適切なフォルダの分け方分からずごっちゃになった

---

# やりたいこと
- DTOフォルダ使いたかった
- 徹底的なバリデ
- ログインしていなかったらログインページに戻るようにする
- 管理者画面
