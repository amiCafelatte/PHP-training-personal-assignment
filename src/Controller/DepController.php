<?php

/**
 * 部署一覧を表示する
 */
class Dep
{

  private $modelClass = 'DepModel';


  function __construct()
  {
  }
  public function index(): void
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
  public function updateDep()
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', 'UpdateDepartment')));
    if ((new UpdateDepartment)->index()) {
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Dep');
      exit();
    } else {
      $errMsg = "失敗";
    }
  }
}
