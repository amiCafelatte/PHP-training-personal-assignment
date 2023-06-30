<?php
/**
 * ログアウト
 */
class Logout{
  function index(){
    unset($_SESSION['user']);
    // unset($_SESSION['user']);
    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
}