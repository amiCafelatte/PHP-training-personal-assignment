<?php
/**
 * DB接続をまとめたクラスエラーが出たらエラーが表示される
 *
 * @return DB接続
 * @author 城下
 */
class Connect {
  // private const DB_NAME='EmployeeDB';
  // private const HOST='127.0.0.1';
  // private const UTF='utf8';
  // private const USER='root';
  // private const PASS='Saltoshiroshita04@';
  private const DB_NAME='EmployeeDB';
  private const HOST='127.0.0.1';
  private const UTF='utf8';
  private const USER='root';
  private const PASS='root';

  private static array $option = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.self::UTF,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
  ];
  //データベースに接続する関数
  function pdo(){
    $dsn="mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
    try{
      $pdo=new PDO($dsn,self::USER,self::PASS,self::$option);
    }catch(Exception $e){
      echo 'error' .$e->getMessage();
      die();
    }
    //エラーを表示してくれる。
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $pdo;
  }
}
//使う時
