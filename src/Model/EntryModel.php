<?php
require_once('../model/config/db.php');

/**
 * 社員情報登録の時に呼び出されるモデル
 * INSERT文あり
 */
class EntryModel
{
  /**
   * @var date $GetNowDate DBにインサートする際の現在日時
   */
  private $pdo,$sql,$InputOfUserDetails=null,$depTmp,$posTmp,$serviceClass,$GetNowDate;
  public function __construct()
  {
    $this->pdo = (new Connect)->pdo();
    date_default_timezone_set('Japan');
    $this->GetNowDate = date('Y/m/d');

  }
  public function index():bool|array
  {
    /**
     * @var array $ErrArr [0]デバッグ用　[1]ユーザー画面表示用
     */
      if(isset($_POST['insert'])){
        $this->InputOfUserDetails = $_POST;
      try {
        $sql = $this->SqlStatement();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':first_name', $this->InputOfUserDetails['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->InputOfUserDetails['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':kana_first_name', $this->InputOfUserDetails['kana_first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':kana_last_name', $this->InputOfUserDetails['kana_last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':mailaddress', $this->InputOfUserDetails['mailaddress'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->InputOfUserDetails['password'], PDO::PARAM_STR);
        $stmt->bindValue(':dep_id', $this->InputOfUserDetails['dep'], PDO::PARAM_INT);
        $stmt->bindValue(':pos_id', $this->InputOfUserDetails['pos'], PDO::PARAM_INT);
        $stmt->bindValue(':create_date',$this->GetNowDate,PDO::PARAM_STR);
        $stmt->bindValue(':create_user_id',$_SESSION['user']['id']);
        $stmt->bindValue(':update_date',$this->GetNowDate,PDO::PARAM_STR);
        $stmt->bindValue(':update_user_id',$_SESSION['user']['id']);

        $this->depTmp = (int)$this->InputOfUserDetails['dep'];
        $this->posTmp = (int)$this->InputOfUserDetails['pos'];
        $stmt->execute();
        // $stmt->debugDumpParams(); //デバッグ用
        return true;
      } catch (PDOException $e) {
        $ErrArr=["例外エラー" . $e->getMessage(),false];
        return $ErrArr;
      } finally {
        // DB接続を閉じる
        $stmt = null;
    }
  }else{
    return false;
  }
  }

  /**
   * SQL文作成
   *
   * @return string
   */
  private function SqlStatement():string
  {
    /**
     * @var string $insert INSERT句
     * @var string $values VALUE句
     */
    $insert="INSERT INTO User(first_name,last_name,kana_first_name,kana_last_name,mailaddress,password,dep_id,pos_id,create_user_id,create_date,update_user_id,update_date) ";
    $values="VALUES(:first_name,:last_name,:kana_first_name,:kana_last_name,:mailaddress,:password,:dep_id,:pos_id,:create_user_id,:create_date,:update_user_id,:update_date)";
    $sql=$insert.$values;
    return $sql;
  }

  /**
   * @param メールアドレス
   * @void メールアドレスがdbにあればtrue
   */
  function RegistrationConfirmation($mail):bool
  {
    $sql = "SELECT mailaddress FROM User WHERE mailaddress = :mail";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_BOTH);
    ($row) ? $result = false : $result = true;
    return $result;
  }
}
