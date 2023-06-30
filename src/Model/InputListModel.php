<?php
require_once('../model/config/db.php');

/**
 * 部署リストと役所リストを取得する
 */
class InputListModel
{
  public $pdo;
  public array $depArray;
  private const SELECT = "SELECT * ";
  function __construct()
  {
    $this->pdo = (new Connect)->pdo();
  }
  /**
   * @return array $depListDisplayArray
   */
  public function depList(): array|false
  {
    $from = "FROM Department ";
    $where = "WHERE del_flg=0";
    $sql = self::SELECT . $from . $where;
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $depListDisplayArray = $stmt->fetchAll();

    return $depListDisplayArray;
  }
  public function posList(): array|false
  {
    $from = "FROM Post ";
    $sql = self::SELECT . $from;
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $posListDisplayArray = $stmt->fetchAll();

    return $posListDisplayArray;
  }
  /**
   * 指定された部署を表示
   *
   * @return void
   */
  public function depList1row(): array|false
  {
    $depId = (int)$_GET['depId'];
    // $depId=$_GET['depId'];
    $from = "FROM Department ";
    $where = "WHERE dep_id=:depId";
    $sql = self::SELECT . $from . $where;
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':depId', $depId, PDO::PARAM_INT);
    $stmt->execute();
    $posListDisplay1row = $stmt->fetchAll();

    return $posListDisplay1row;
  }
}
