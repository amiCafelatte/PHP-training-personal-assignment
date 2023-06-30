<?php

/**
 * 役職表示
 */
class Post
{
  /**
   * @var array $serviceClass serviceクラス
   */
  private $serviceClass;
  function __construct()
  {
  }
  function index(): void
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Service/%sService.php', get_class($this))));

    require_once(realpath(dirname(__DIR__) . sprintf('/View/%s.php', get_class($this))));
  }
}
