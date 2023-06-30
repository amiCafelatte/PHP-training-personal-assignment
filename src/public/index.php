<?php
try {
    $urlParams = [];
    //初期関数ネーム
    $actionName = 'index';
    //初期コントローラーネーム
    $controllerName = 'LoginController';
    require_once realpath(dirname(__DIR__) . sprintf('/Service/%s.php', 'SessionService'));
    $data = SessionService::getInstance();

    // /を取り除く
    if ('' != $requestUri = rtrim($_SERVER['REQUEST_URI'], '/')) {
        $arr = explode('/', $requestUri);
        foreach ($arr as $param) {
            if (!$param) {
                continue;
            }

            // '?'が先頭から何文字目にあるか　？がなければfalse
            if (strpos($param, '?')) {
                $urlParams[] = current(explode('?', $param));
                continue;
            }
            $urlParams[] = $param;
        }
    }


    //値が入っているか
    if (isset($urlParams[0]) && $urlParams[0]) {
        $controllerName = $urlParams[0];
        //ucfirst最初大文字
        $controllerName = sprintf('%sController', ucfirst($controllerName));
    }


    if (isset($urlParams[1]) && $urlParmas[1]) {
        $actionName = $urlParams[1];
    }
    //一度読み込まれてたらスキップされる
    //初期値のままだとcontrollerフォルダのLoginControllerファイルが呼び出される
    require_once realpath(dirname(__DIR__) . sprintf('/Controller/%s.php', $controllerName));
    //３つめの引数は検索対象
    $controllerName = str_replace('Controller', "", $controllerName);

    /**
     * インスタンス化してメソッドを呼び出してる
     * 初期値 (new Login)->index();
     */
    (new $controllerName)->$actionName();
} catch (Exception $ex) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/LoginController');
    exit();
    // var_dump($ex->__toString());
}