<?php

/**
 * 社員詳細->社員情報の更新
 *  UserDetailsControllerから呼び出される
 */
class UpdateUser
{
  /**
 * @var obj $class モデルクラス
 * @var int $userId 情報を更新する社員のUDを代入
 */

  private $class;
  private $userId;

  function __construct()
  {
    $this->userId = $_POST['userId'];
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    $this->class = new UpdateUserModel;
  }
  /**
   * 処理の中で、UpdateUserModelクラスに飛ぶ
   *
   * @return void
   */
  public function index(): void
  {
    $link = '/UserDetails?userName=' .$_POST['first_name'] . '&userId=' . $_POST['userId'];
    if ($this->class->index($this->userId)) {
      header('Location: http://' . $_SERVER['HTTP_HOST'] . $link);
      exit();
    };
  }
}
