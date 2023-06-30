<?php

/**
 * パラメータからユーザIDを取得し、論理削除をするクラス
 */
class DeleteDep
{
  /**
   * @var obj $class DeleteModelのインスタンス
   * @var int|string $SetDepId 削除する部署のID
   */
  private $class, $SetDepId;

  public function __construct()
  {
    $this->SetDepId = $_GET['depId'];
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', 'Delete')));
    $this->class = new DeleteModel;
  }

  public function index(): void
  {
    if ($this->class->dep($this->SetDepId)) {
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Dep');
      exit();
    } else {
      echo '部署削除失敗';
    }
  }
}
