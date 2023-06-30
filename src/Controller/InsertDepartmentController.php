<?php
/**
 * 部署新規登録
 */
class InsertDepartment{
  private $class;
  private $depId;
  private const SERVICE_CLASS = 'InsertDepartmentService';
  function __construct()
  {

  }

  public function index(){
    require_once(realpath(dirname(__DIR__) . sprintf('/Service/%s.php', self::SERVICE_CLASS)));
    if($_POST){
      $this->insertDepartment();
    }
    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));

  }
  /**
   * 部署テーブルにインサートするモデルを呼び出し、成功したら部署ページにリダイレクトする
   *
   * @return void
   */
  private function insertDepartment()
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
    if((new InsertDepartmentModel)->index())
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Dep');
    exit();
  }
}