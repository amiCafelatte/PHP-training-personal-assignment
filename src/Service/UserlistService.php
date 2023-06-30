<?php
class MainService
{
  public function index($showUserList)
  {
    //var_dump($showUserList);
    foreach ($showUserList as $row) {
      echo <<<EOD
      <tr>
        <td><a href="/Userdetails?userName={$row['first_name']}&userId={$row['user_id']}"><ruby>{$row['first_name']}<rt>{$row['kana_first_name']}</rt></ruby></a></td>
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
}
