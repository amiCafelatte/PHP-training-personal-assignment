<?php
require_once('../model/config/db.php');
class DeleteModel
{
  /**
   * @var date $GetNowDate 現在日時
   */
  private $pdo, $GetNowDate;
  public function __construct()
  {
    date_default_timezone_set('Japan');
    $this->GetNowDate = date('Y/m/d');
    $this->pdo = (new Connect)->pdo();
  }
  public function index($userId)
  {
    try {
      $sql = "UPDATE User SET del_flg=1 WHERE user_id=:userId";
      $stmt = $this->pdo->prepare($sql);
      // $stmt->bindValue(':table', self::USER_TABLE, PDO::PARAM_STR);
      // $stmt->bindValue(':tablename', $this->userTable, PDO::PARAM_STR);
      $stmt->bindValue(':userId', (int)$userId, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "例外エラー" . $e->getMessage();
    } finally {
      // DB接続を閉じる
      $stmt = null;
    }
  }

  /**
   * 部署削除
   *
   * @param int|string $depId
   * @return void
   */
  public function dep(int|string $depId)
  {
    try {
      $sql = "UPDATE Department SET del_flg=1,update_user_id=:userId,update_date=:uDate WHERE dep_id=:depId";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':userId', (int)$_SESSION['user']['user_id'], PDO::PARAM_INT);
      $stmt->bindValue(':uDate', $this->GetNowDate, PDO::PARAM_STR);
      $stmt->bindValue(':depId', (int)$depId, PDO::PARAM_INT);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "例外エラー" . $e->getMessage();
    }
  }
}
