<?php

/**
 * 社員情報詳細出力
 */
class UserDetailsService
{
  /**
   * @var array $inputListModelDep InputListModelで得た役職一覧を代入
   * @var array $inputListModelPos PosInputListModelで得た部署一覧を代入
   */
  private $inputListModelDep,$inputListModelPos,$DepartmentListDisplay,$PostListDisplay;

  public function __construct()
  {
    require_once('../model/InputListModel.php');
    $ModelClass = new InputListModel;
    $this->inputListModelDep = $ModelClass->depList();
    $this->inputListModelPos = $ModelClass->posList();
  }
  public function index(array $showUserList)
  {
    //var_dump($showUserList);
    foreach ($showUserList as $row) {
      echo <<<EOD
      <tr>
      <td><a href="/UserDetails?userName={$row['first_name']}&userId={$row['user_id']}"><ruby>{$row['first_name']}<rt>{$row['kana_first_name']}</rt></ruby></a></td>
      <td><a href="/user"><ruby>{$row['last_name']}<rt>{$row['kana_last_name']}</rt></ruby></a></td>
        <td><a href="/user">{$row['mailaddress']}</a></td>
        <td><a href="/user">{$row['password']}</a></td>
        <td><a href="/user">{$row['dep_name']}</a></td>
        <td><a href="/user">{$row['pos_name']}</a></td>
        <td><a class="deleteBtn" href="/delete?userId={$row['user_id']}">削除</a></td>

      </tr>
      EOD;
    }

    return;
  }
  public function edit($showUserList)
  {
    //var_dump($showUserList);
    foreach ($showUserList as $row) {
      // echo '<pre>';
      // var_dump($row);
      echo <<<EOD
      <form method="post" action="/UpdateUser">
      <input type="hidden" name="userId" value="{$row['user_id']}">
        <label for="first_name">姓</label>
        <input type="text" id="first_name" name="first_name" value="{$row['first_name']}">

        <label for="last_name">名</label>
        <input type="text" id="last_name" name="last_name" value="{$row['last_name']}">
        <label for="first_name-kana">せい</label>
        <input type="text" id="first_name-kana" name="kana_first_name" value="{$row['kana_first_name']}">

        <label for="last_name-kana">めい</label>
        <input type="text" id="last_name-kana" name="kana_last_name" value="{$row['kana_last_name']}">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="mailaddress" value="{$row['mailaddress']}">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" value="{$row['password']}">

        <label for="dep">部署</label>
        <select id="dep" name="dep" class="round">
          <option value="{$row['dep_id']}">部署を変更する場合は選択してください</option>
          {$this->depListSelectBox($this->inputListModelDep)}
        </select>

        <label for="dep">役職</label>
        <select id="dep" name="pos" class="round">
          <option value="{$row['pos_id']}">役職を変更する場合は選択してください</option>
          {$this->posListSelectBox($this->inputListModelPos)}
        </select>

        <input type="submit" value="更新" name="update">

      </form>
EOD;
    }

    return;
  }
  // これ無駄かもs
  public function entry()
  {
    echo <<<EOD
      <form method="post" action="/EntryUser">
        <label for="first_name">姓</label>
        <input type="text" id="first_name" name="first_name">

        <label for="last_name">名</label>
        <input type="text" id="last_name" name="last_name">
        <label for="first_name-kana">せい</label>
        <input type="text" id="first_name-kana" name="kana_first_name">

        <label for="last_name-kana">めい</label>
        <input type="text" id="last_name-kana" name="kana_last_name">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="mailaddress">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password">

        <label for="dep">部署</label>
        <select id="dep" name="dep" class="round">
          <option value="false">部署選択してください</option>
          {$this->depListSelectBox($this->inputListModelDep)}
        </select>
        <label for="dep">役職</label>
        <select id="dep" name="pos" class="round">
          <option value="false">役職を選択してください</option>
          {$this->posListSelectBox($this->inputListModelPos)}
        </select>
        <input type="submit" value="登録" name="update">
      </form>
    EOD;
  }
  /**
   * 部署一覧参照結果を呼び出し、HTMLタグに格納
   *
   * @param array $depListDisplayArray
   * @return void
   */
  private function depListSelectBox(array $depListDisplayArray)
  {
    foreach ($depListDisplayArray as $row) {
      $this->DepartmentListDisplay .= <<<EOD
      <option value="{$row['dep_id']}">{$row['dep_name']}</option>
      EOD;
    }
    // var_dump($this->DepartmentListDisplay);
    return $this->DepartmentListDisplay;
  }
  /**
   * 役職一覧参照結果を呼び出しHTMLタグに格納
   *
   * @param array $posListDisplayArray
   * @return void
   */
  private function posListSelectBox(array $posListDisplayArray)
  {
    foreach ($posListDisplayArray as $row) {
      $this->PostListDisplay .= <<<EOD
      <option value="{$row['pos_id']}">{$row['pos_name']}{$row['pos_id']}</option>
      EOD;
    }
    return $this->PostListDisplay;
  }
}
