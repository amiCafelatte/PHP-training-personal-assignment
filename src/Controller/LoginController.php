<?php
class Login
{
    /**
     * ログインページで呼び出される
     * @var array $showMsg エラーを出力する時に使う
     * @var modelName
     * @var string $email formで入力されたメールアドレスを代入
     * @var string $password formで入力されたパスワードを代入
     * @var string $modelClass LoginModel require_onceで呼び出しているlogin.phpで利用
     * @var string $class モデルクラスを呼び出すときに利用
     */

    public $showMsg = [];
    private $modelName,$email,$password,$modelClass,$class;

    public function __construct()
    {
        $this->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->password = isset($_POST['password']) ? $_POST['password'] : '';
        //$this->modelName = sprintf('%sModel.php', get_class($this));
        $this->modelClass = sprintf('%sModel', get_class($this));
    }
    /**
     * ログインモデルを呼び出し、ログインページを出力する
     * 
     * @return void
     */
    public function index(): void
    {
        if (isset($this->email) || isset($this->password)) {
            //どっちも入力されていたら
            if ($this->email && $this->password) {
                require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
                $this->class = new LoginModel;

                if ($this->class->index($this->email, $this->password)) {
                    //echo 'ログイン成功';
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/main');
                    exit();
                } else {
                    $this->showMsg['err'] = $this->class->errMsg();
                }
            } else {
                $this->showMsg['err'] = 'メールアドレスまたはパスワードが未入力です。';
            }
        }

        /**
         * クラス名が入ったviewフォルダの[クラス名].phpが呼び出される
         */
        require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
    }
}
