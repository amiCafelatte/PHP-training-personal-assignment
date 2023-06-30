<?php

/**
 *　社員詳細
 */
class UserDetails
{
  /**
   * @var int|string $userId 社員一覧から社員詳細に遷移した時に、表示するユーザIDを保持する
   */
  private $class, $userId, $modelClass;
  private $serviceClass = 'UserDetailsService';

  public function __construct()
  {
    $this->userId = $_GET['userId'];
    $this->getModelClass();
  }

  public function index():void
  {
    if (isset($_POST['update']) && $_POST['update']) {
      require_once(realpath(dirname(__DIR__) . '/Controller/UpdateUserController.php'));
      (new UpdateUser)->index();
    } else {
      $showUserList = $this->modelClass->index();
      require_once(realpath(dirname(__DIR__) . sprintf('/Service/%sService.php', get_class($this))));
      require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
    }
  }

  private function getModelClass(): void
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    $class =  sprintf('%sModel', get_class($this));
    $this->modelClass = new $class;
  }
}
