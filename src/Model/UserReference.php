<?php
require_once('../model/config/db.php');
/**
 * ログイン時に使うクラス
 */
class UserReference
{
    public $pdo;
    private $userTable = 'User';
    function __construct()
    {
        $this->pdo = (new Connect)->pdo();
    }


    /**
     * @param メールアドレス
     * @void メールアドレスがdbにあればtrue
     */
    function RegistrationConfirmation($mail)
    {
        $sql = "SELECT mailaddress FROM :table WHERE mailaddress = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':table', $this->userTable, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_BOTH);
        ($row) ? $result = true : $result = false;
        return $result;
    }


    /**
     * @param メールアドレス
     * @param パスワード
     * @void メールアドレスがdbにあればtrue
     */
    function RegistrationSearch($mail, $password)
    {
        try {
            $sql = "SELECT user_id,first_name,last_name,dep_id,pos_id,mailaddress,password FROM User WHERE mailaddress = :mail AND password = :passwd";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindValue(':passwd', $password, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_BOTH);
            foreach ($row as $set) {
                require_once realpath(dirname(__DIR__) . sprintf('/Service/%s.php', 'SessionService'));
                $data = SessionService::getInstance();
                $data->user = ['id' => $set['user_id'], 'name' => $set['first_name'] . $set['last_name'], 'dep' => $set['dep_id'], 'pos' => $set['pos_id']];
            }
            ($row) ? $result = true : $result = false;
            return $result;
        } catch (PDOException $e) {
            echo "例外エラー" . $e->getMessage();
        } finally {
            // DB接続を閉じる
            $stmt = null;
        }
        //PDO::FETCH_BOTH カラム名と 0 で始まるカラム番号で添字を付けた配列を返します。
    }
}
