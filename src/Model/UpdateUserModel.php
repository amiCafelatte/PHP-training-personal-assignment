<?php
require_once('../model/config/db.php');
//var_dump($dbg);
/**
 * ユーザー詳細ページから更新するときに呼び出される
 * UPDATE文あり
 */
class UpdateUserModel
{
  private $pdo,$InputOfUserDetails,$depTmp,$posTmp;

  public function __construct()
  {
    $this->pdo = (new Connect)->pdo();
    if (isset($_POST))
      $this->InputOfUserDetails = $_POST;
  }

  public function index($userId)
  /**
   * @var string $sql UPDATE文
   */
  {
    try {
      $sql = "UPDATE User SET first_name=:first_name,last_name=:last_name,kana_first_name=:kana_first_name,kana_last_name=:kana_last_name,mailaddress=:mailaddress,password=:password,dep_id=:dep_id,pos_id=:pos_id WHERE user_id=:userId";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':first_name', $this->InputOfUserDetails['first_name'], PDO::PARAM_STR);
      $stmt->bindValue(':last_name', $this->InputOfUserDetails['last_name'], PDO::PARAM_STR);
      $stmt->bindValue(':kana_first_name', $this->InputOfUserDetails['kana_first_name'], PDO::PARAM_STR);
      $stmt->bindValue(':kana_last_name', $this->InputOfUserDetails['kana_last_name'], PDO::PARAM_STR);
      $stmt->bindValue(':mailaddress', $this->InputOfUserDetails['mailaddress'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $this->InputOfUserDetails['password'], PDO::PARAM_STR);
      $stmt->bindValue(':dep_id', $this->InputOfUserDetails['dep'], PDO::PARAM_INT);
      $stmt->bindValue(':pos_id', $this->InputOfUserDetails['pos'], PDO::PARAM_INT);
      $this->depTmp = (int)$this->InputOfUserDetails['dep'];
      $this->posTmp = (int)$this->InputOfUserDetails['pos'];
      $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();
      $this->setSession($userId);
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
   * ログインユーザーが自分自身のプロフィールを更新していたらセッションも書き換える
   *
   * @param integer|string $userId
   * @return void
   */
  private function setSession(int|string $userId): void
  {
    if ($_GET['userId'] == $userId) {
      require_once realpath(dirname(__DIR__) . sprintf('/Service/%s.php', 'SessionService'));
      $data = SessionService::getInstance();
      $data->user = ['name' => $_POST['first_name'] . $_POST['last_name'], 'dep' => $this->depTmp, 'pos' => $this->posTmp];
    }
  }
}
