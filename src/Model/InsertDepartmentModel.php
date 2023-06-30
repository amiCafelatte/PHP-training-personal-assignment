<?php
require_once('../model/config/db.php');

/**
 * 部署登録
 */
class InsertDepartmentModel
{
  /**
   * Undocumented variable
   *
   * @var array $RegisterAnArrayOfDepartments
   * @var date nowDate
   */
  private $pdo,$RegisterAnArrayOfDepartments,$nowDate;

  public function __construct()
  {
    $this->setNowDate();
    $this->pdo = (new Connect)->pdo();
    if (isset($_POST))
      $this->RegisterAnArrayOfDepartments = $_POST;
  }

  /**
   * 部署テーブルに新規部署をインサートする
   * インサートに成功したらtrueを返す
   *
   * @return bool
   */
  public function index()
  {
    try {
      $sql = "INSERT INTO Department(dep_name,create_user_id,create_date,update_user_id,update_date) VALUES(:name,:userId,:create_date,:update_user_id,:uDate)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':name', $this->RegisterAnArrayOfDepartments['dep_name'], PDO::PARAM_STR);
      $stmt->bindValue(':userId', (int)$_SESSION['user']['id'], PDO::PARAM_INT);
      $stmt->bindValue(':create_date', $this->nowDate, PDO::PARAM_STR);
      $stmt->bindValue(':update_user_id', (int)$_SESSION['user']['id'], PDO::PARAM_INT);
      $stmt->bindValue(':uDate', $this->nowDate, PDO::PARAM_STR);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "例外エラー" . $e->getMessage();
      exit();
    } finally {
      // DB接続を閉じる
      $stmt = null;
    }
  }
  /**
   * 時間をプロパティ変数にセット
   *
   * @return void
   */
  private function setNowDate()
  {
    date_default_timezone_set('Japan');
    $this->nowDate = date('Y-m-d');
  }
}
