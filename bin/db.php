<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/
require './config.php'

//Functions
function connect(){
  try{
    $pdo = new PDO("mysql:host=#{DB_HOST};dbname=#{DB_NAME};charset=#{DB_CHARSET}", DB_USER, DB_PASSWORD));
  } catch (PDOException $e){
    $fp = $fopen("./logs/db-error.log", "a");
    fwrite($fp, $e->getMessage());
    fclose($fp);
    exit;
  }
}

function select_user_by_password($user_name, $password){
    $sql = "SELECT "
}
 ?>
