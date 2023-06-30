<?php

/**
 * 社員情報の更新
 * @todo ヘッダー関数の中身どうにかしないと
 */
class Entry
{
  /**
   * @var obj $class モデルクラスのインスタンス
   * @var int $userId 情報を更新する社員のUDを代入
   * @var string $serviceClass viewのentry.phpで利用
   */
  private $class,$userId,$serviceClass = 'EntryService',$errMsg;

  function __construct()
  {
    //エントリーモデル呼び出し
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    $this->class = new EntryModel;
  }
  /**
   * 処理の中で、EntryModelクラスに飛ぶ
   *
   * @return void
   */
  public function index(): void
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Service/%sService.php', get_class($this))));
    if (isset($_POST['insert']) && $_POST['insert']) {
      if ($this->class->index()==true){
              // $link = '/main';
      // header('Location: http://' . $_SERVER['HTTP_HOST'] . $link);
      // exit();
        echo '成功';
      }else{
        echo '登録失敗';
      }
    }

    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
}
