<?php
require_once('../model/config/db.php');
/**
 * 部署情報更新
 */
class UpdateDepartment{
  /**
   * Undocumented variable
   *
   * @var array $InputOfDepartmentDetails 部署一覧の保持
   * @var date $now
   */
  private $pdo,$InputOfDepartmentDetails,$now;
  public function __construct()
  {
    date_default_timezone_set('Japan');
    $this->now = date('Y/m/d');
    $this->pdo = (new Connect)->pdo();
    if (isset($_POST))
      $this->InputOfDepartmentDetails = $_POST;
  }
  public function index()
  {

    try {
      $sql = "UPDATE Department SET dep_name=:depName,update_user_id=:userId,update_date=:dateNow WHERE dep_id=:depId";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':depName', $this->InputOfDepartmentDetails['dep_name'], PDO::PARAM_STR);
      $stmt->bindValue(':userId', (int)$_SESSION['user']['id'], PDO::PARAM_INT);
      $stmt->bindValue(':dateNow', $this->now , PDO::PARAM_STR);
      $stmt->bindValue(':depId', (int)$this->InputOfDepartmentDetails['dep_id'], PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "例外エラー" . $e->getMessage();
    }
  }
}