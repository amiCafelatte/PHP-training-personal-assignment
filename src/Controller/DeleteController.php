<?php

/**
 * パラメータからユーザIDを取得し、論理削除をするクラス
 * @param void
 */
class Delete
{
  private $class, $userId;

  public function __construct()
  {
    $this->userId = $_GET['userId'];
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    $this->class = new DeleteModel;
  }

  public function index(): void
  {
    if ($this->class->index($this->userId)) {
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/main');
      exit();
    };
  }
}
