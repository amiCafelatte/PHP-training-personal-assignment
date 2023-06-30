<?php
require_once realpath(dirname(__DIR__) . '/model/UserReference.php');
/**
 * ログイン判定するクラス
 */
class LoginModel
{
    private $mail,$pass,$userReference,$result;
    public $msg = [];
    
    function __construct()
    {
        $this->userReference = new UserReference;
    }
    /**
     * @param string \src\Controller\LoginController $email メルアド
     * @param string $password パスワード
     * @return bool
     */
    function index(string $email, string $password)
    {
        $this->mail = isset($email) ? $email : '';
        $this->pass = isset($password) ? $password : '';

        //メールがDBにあるか
        if ($this->mail || $this->userReference->RegistrationConfirmation($this->mail)) {
            if ($this->userReference->RegistrationSearch($this->mail, $this->pass)) {
                // $this->result = true;
            } else {
                $this->msg['err'] = 'パスワードが間違っています';
                return false;
            }
        } else {
            $this->result = false;
            $this->msg['err'] = $this->mail . 'は登録されていません。新規登録をする必要があります。';
            return false;
        }
        return true;
    }
    public function errMsg()
    {
        return $this->msg['err'];
    }
}
