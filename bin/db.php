<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/
require __DIR__ '/config.php'

//Functions
function connect(){
  $dsn = "mysql:dbname=#{DB_NAME};host=#{DB_HOST}";
  $user_name = DB_USER;
  $password = DB_PASSWD;

  try{
    $pdo = new PDO($dsn, $user_name, $password));
  } catch (PDOException $e){
    $fp = $fopen("./logs/db-error.log", "a");
    fwrite($fp, $e->getMessage());
    fclose($fp);
    exit;
  }
}
 ?>
