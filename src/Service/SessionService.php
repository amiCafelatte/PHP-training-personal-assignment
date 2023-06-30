<?php


class SessionService
{
  const SESSION_STARTED = TRUE;
  const SESSION_NOT_STARTED = FALSE;

  // セッションの状態を代入
  private $sessionState = self::SESSION_NOT_STARTED;

  // クラス唯一のインスタンス
  private static $instance;


  private function __construct()
  {
  }


  /**
   *    「セッション」のインスタンスを返します。
   *   セッションが初期化されていない場合、セッションは自動的に初期化されます。
   *    @return    object
   **/

  public static function getInstance()
  {
    //インスタンスがなければインスタンス化される
    if (!isset(self::$instance)) {
      self::$instance = new self;
    }

    self::$instance->startSession();

    return self::$instance;
  }


  /**
   *    セッション再開
   *    
   *    @return    bool    セッションが初期化されている場合は TRUE、それ以外の場合は FALSE。
   **/

  public function startSession()
  {
    if ($this->sessionState == self::SESSION_NOT_STARTED) {
      $this->sessionState = session_start();
    }

    return $this->sessionState;
  }


  /**
   *    セッション内のデータを書き込みます。
   *    Example: $instance->foo = 'bar';
   *
   *    @param    name    Name of the datas.
   *    @param    value    Your datas.
   *    @return    void
   **/

  public function __set($name, $value)
  {
    //セッションに値入れたい時はここに入れる
    $_SESSION[$name] = $value;
  }


  /**
   *    セッションからデータを取得します。
   *    Example: echo $instance->foo;
   *    
   *    @param    name    Name of the datas to get.
   *    @return    mixed    Datas stored in session.
   **/

  public function __get($name)
  {
    if (isset($_SESSION[$name])) {
      return $_SESSION[$name];
    }
  }


  /**
   * issetかemptyを実行しようとした時
   *
   * @return boolean
   */
  public function __isset($name)
  {
    return isset($_SESSION[$name]);
  }

  /**
   * unsetを実行しようとした時
   *
   */
  public function __unset($name)
  {
    unset($_SESSION[$name]);
  }


  /**
   *    現在のセッションを破棄します。
   *    @return    bool    セッションが削除された場合は TRUE、それ以外の場合は FALSE。
   **/

  public function destroy()
  {
    if ($this->sessionState == self::SESSION_STARTED) {
      $this->sessionState = !session_destroy();
      unset($_SESSION);

      return !$this->sessionState;
    }

    return FALSE;
  }
}

