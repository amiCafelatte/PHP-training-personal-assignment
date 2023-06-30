<?php
/**
 * 役職のデータを持ってきたり表示する
 */
class PostService
{
  /**
   * @var string $modelClass 役職一覧をDBから持ってくるクラス名
   * @var array $posArray InputListModelでもらった役職一覧を保持
   */
  private $modelClass,$posArray;

  function __construct()
  {
    $this->modelClass = "InputListModel";
  }

  function index(){
    $this->setPostList();
    $this->ViewPostlist();
  }
  /**
   * 役職一覧をセット
   *
   * @return void
   */
  private function setPostList():void
  {
    require_once(realpath(dirname(__DIR__) . sprintf('/Model/%s.php', $this->modelClass)));
    $this->posArray = new InputListModel;
    $this->posArray = (new $this->modelClass)->posList();
  }
  /**
   * 役職一覧を表示するHTML部品
   *
   * @return void
   */
  private function ViewPostlist():void
  {
    foreach ($this->posArray as $row) {
      echo <<<EOD
        <tr>
          <td><a href="/user">{$row['pos_name']}</a></td>
        </tr>
        EOD;
    }
  }
}
