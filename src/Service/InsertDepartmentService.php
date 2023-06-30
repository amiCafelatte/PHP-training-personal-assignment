<?php

/**
 * 部署登録のHTMLタグ
 */
class InputDepartmentService
{
  private $inputListModelDep;
  private $inputListModelPos;

  private $DepartmentListDisplay;
  private $PostListDisplay;

  public function __construct()
  {
  }
  public function entry()
  {
    //var_dump($showUserList);
      echo <<<EOD
      <form method="post" action="/InsertDepartment">
        <label for="dep_name">部署名</label>
        <input type="text" id="dep_name" name="dep_name">
        <input type="submit" value="登録" name="update">
      </form>
      EOD;
    return;
  }
}
