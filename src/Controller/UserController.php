<?php
class User
{
  public function index()
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
}
