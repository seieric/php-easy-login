<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/
class DB extends PDO{
  require __DIR__ . '/config.php';

  function __construct(){
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    try{
      parent::__construct($dsn, DB_USER, DB_PASSWD, array(PDO::ATTR_PERSISTENT => true));
    }catch(PDOException $e){
      $this->write_log($e->getMessage());
    }
  }

  public function get_user($user_name){
    try{
      $sql = 'SELECT * FROM users WHERE name = ?';
      $stmt = $this->prepare($sql)
      $stmt->execute(array($user_name));
      $result = $stmt->fetch(parent::FETCH_ASSOC);

      $stmt = null;
      return $result;
    }catch(PDOException $e){
      $this-> write_log($e->getMessage());
      exit;
    }
  }

  public function generate_hash($text, $algo = "sha256"){
    return hash($algo, $text);
  }

  private function write_log($message, $path = __DIR__ . "/logs/db-error.log"){
    $log = fopen($path, "a");
    fwrite($log, date("Y-m-d H:i:s") . $message);
    fclose($log);
  }
}
 ?>
