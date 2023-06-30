<?php
require_once('../model/config/db.php');
class UserDetailsModel
{
  /**
   * @var obj $pdo DB接続
   * @var string $select  select句
   * @var string $from from句
   * @var string $where where句
   * @var int $userId 表示するユーザーIDを代入
   */

  private $pdo;
  private string $select = "SELECT user_id,first_name,last_name,kana_first_name,kana_last_name,mailaddress,password,dep_name,pos_name,User.del_flg,User.dep_id,User.pos_id ";
  private string $from = "FROM User,Post,Department ";
  private string $where = "WHERE User.pos_id=Post.pos_id AND User.dep_id=Department.dep_id AND User.del_flg=0 and user_id=:userId";
  private int $userId;
  
  public function __construct()
  {
    $this->pdo = (new Connect)->pdo();
    $this->userId = (int)$_GET['userId'];
  }
  
  /**
   * この関数はユーザ更新の時も使っている
   * @return mixed
   */
  public function index()
  {
      /**
   * @var string $sql SQL文
   * @var mixed $stmt 準備、実行
   */

    $sql = $this->select . $this->from . $this->where;
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':userId', $this->userId, PDO::PARAM_INT);
    $stmt->execute();
    $show = $stmt->fetchAll();
    return $show;
  }
}
