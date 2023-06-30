<?php
require_once realpath(dirname(__DIR__) . sprintf('/Model/%s.php', 'InputListModel'));
/**
 */
class DepModel
{
  /**
   * @var object $DepArray DBから持ってきた部署一覧を保持
   */
  private object $DepArray;
  function __construct()
  {
    $this->DepArray = new InputListModel;
  }
  function edit(): void
  {
    foreach ($this->DepArray->depList1row() as $row) {
      echo <<<EOD
          <h2>{$row['dep_name']} 編集中</h2>
          <form method="post" action="/UpdateDep">
            <label for="dep_name">部署名</label>
            <input type="text" id="dep_name" name="dep_name" value="{$row['dep_name']}">
            <input type="hidden" name="dep_id" value="{$row['dep_id']}">
            <input type="submit" value="更新" name="update">
          </form>
        EOD;
    }
  }
  function DepDisp(): void
  {
    foreach ($this->DepArray->depList() as $row) {
      echo <<<EOD
        <tr>
          <td><a href="/user">{$row['dep_name']}</a></td>
          <td><a class="deleteBtn" href="/updateDep?depId={$row['dep_id']}">編集</a></td>
          <td><a class="deleteBtn" href="/deleteDep?depId={$row['dep_id']}">削除</a></td>
        </tr>
        EOD;
    }
  }
}
