<?php

/**
 * 部署一覧を表示する
 */
class UpdateDep
{

  private $modelClass = 'DepModel';


  function __construct()
  {
  }
  public function index(): void
  {
    if (isset($_POST['dep_id']) && $_POST['dep_id']) {
      require_once(realpath(dirname(__DIR__) . sprintf('/Model/%s.php', 'UpdateDepartment')));
      if ((new UpdateDepartment)->index()) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Dep');
        exit();
      }
    }
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%s.php', $this->modelClass)));

    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
}
