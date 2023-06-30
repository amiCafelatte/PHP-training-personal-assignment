<?php

/**
 * 社員情報一覧出力
 */
class MainService
{
  public function index($showUserList)
  {
    foreach ($showUserList as $row) {
      echo <<<EOD
      <tr>
      <td><a title="編集します" href="/UserDetails?userName={$row['first_name']}&userId={$row['user_id']}"><ruby>{$row['first_name']}<rt>{$row['kana_first_name']}</rt></ruby></a></td>
      <td><a title="編集します" href="/UserDetails?userName={$row['first_name']}&userId={$row['user_id']}"><ruby>{$row['last_name']}<rt>{$row['kana_last_name']}</rt></ruby></a></td>
      <td><a title="編集します" href="/UserDetails?userName={$row['first_name']}&userId={$row['user_id']}">{$row['dep_name']}</a></td>
      <td><a title="編集します" href="/UserDetails?userName={$row['first_name']}&userId={$row['user_id']}">{$row['pos_name']}</a></td>
      <td><a title="削除します" class="deleteBtn" href="/delete?userId={$row['user_id']}">削除</a></td>

      </tr>
      EOD;
    }

    return;
  }
}
