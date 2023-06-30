<?php

/**
 * 社員一覧を表示する
 */
class Main
{
    /**
     * 
     *
     * @var obj $modelCLass MainModelのインスタンス
     * @var string $serviceClass サービスクラス名　Main.phpで利用
     */
    private $modelClass, $serviceClass = 'MainService';


    function __construct()
    {
    }
    public function index(): void
    {
        require_once(realpath(dirname(__DIR__) . sprintf('/Model/%sModel.php', get_class($this))));
        $this->modelClass = new MainModel;
        $showUserList = $this->modelClass->index();
        require_once(realpath(dirname(__DIR__) . sprintf('/Service/%sService.php', get_class($this))));

        require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
    }
}
