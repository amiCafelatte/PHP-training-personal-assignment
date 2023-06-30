<?php

/**
 * 社員情報新規登録
 */
class EntryService
{
  private $inputListModelDep, $inputListModelPos, $DepartmentListDisplay, $PostListDisplay;

  public function __construct()
  {
    require_once('../model/InputListModel.php');
    $ModelClass = new InputListModel;
    $this->inputListModelDep = $ModelClass->depList();
    $this->inputListModelPos = $ModelClass->posList();
  }
  public function entry()
  {
    echo <<<EOD
      <form method="post" action="/Entry" id="app">
      <label for="first_name">姓</label>
      <input type="text" id="first_name" name="first_name" require>

      <label for="last_name">名</label>
      <input type="text" id="last_name" name="last_name" require>

      <label for="first_name-kana">せい</label>
      <p v-if="isInValidFirstKana" class="formErr">全角カタカナで入力してください</p>
      <input
        type="text"
        id="first_name-kana"
        name="kana_first_name"
        v-model="seiKana" require>

      <label for="last_name-kana">めい</label>
      <p v-if="isInValidLastMei" class="formErr">全角カタカナで入力してください</p>
      <input
        type="text"
        id="last_name-kana"
        name="kana_last_name"
        v-model="meiKana" require>

      <label for="email">メールアドレス</label>
      <p v-if="isInValidEmail" class="formErr">SALTOアカウントではありません</p>
      <input
        type="email"
        id="email"
        name="mailaddress"
        v-model="email" require>

      <label for="password">パスワード</label>
      <p v-if="isInValidPassword" class="formErr"><b>8文字以上の半角英数字</b>である必要があります</p>
      <input
        type="password"
        id="password"
        name="password"
        v-model="password" require>

      <label for="dep">部署</label>
      <select id="dep" name="dep" class="round">
        <option value="false">部署を変更する場合は選択してください</option>
        {$this->depListSelectBox($this->inputListModelDep)}
      </select>
      <label for="dep">役職</label>
      <select id="dep" name="pos" class="round">
        <option value="false">役職を変更する場合は選択してください</option>
        {$this->posListSelectBox($this->inputListModelPos)}
      </select>
      <input type="submit" value="登録" name="insert">

      </form>
      <script src="https://cdn.jsdelivr.net/npm/vue@2.7.11/dist/vue.js"></script> 

      <script src="script/entry-valid.js"></script>
  
      EOD;
    return;
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
