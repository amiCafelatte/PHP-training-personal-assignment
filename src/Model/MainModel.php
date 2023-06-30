<?php
require_once('../model/config/db.php');
/**
 * 社員一覧を表示するクラス
 */
class MainModel
{
  /**
   * @var obj $pdo DB接続
   * @var string $select  select句
   * @var string $from from句
   * @var string $where where句
   */
  private $pdo;
  private string $select = "SELECT user_id,first_name,last_name,kana_first_name,kana_last_name,mailaddress,password,dep_name,pos_name,User.del_flg ";
  private string $from = "FROM User,Post,Department ";
  private string $where = "WHERE User.pos_id=Post.pos_id AND User.dep_id=Department.dep_id AND User.del_flg=0";

  public function __construct()
  {
    $this->pdo = (new Connect)->pdo();
  }
  /**
   * @var string $sql SQL文
   * @var mixed $stmt 準備、実行
   * @return mixed
   */
  public function index()
  {
    $sql = $this->select . $this->from . $this->where;
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $show = $stmt->fetchAll();
    return $show;
  }
}
