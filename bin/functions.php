<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/

function set_title($title){
  global $page_title;
  $page_title = $title;
}

function require_logined(){
  @session_start();
  if(!isset($_SESSION['user_name'])){
    header('Location: login.php');
    exit;
  }
}

function require_unlogined(){
  @session_start();
  if(isset($_SESSION['user_name'])){
    header('Location: /');
    exit;
  }
}

function echo_csrf_token(){
  echo generate_csrf_token();
}

function generate_csrf_token(){
  return hash('sha256', session_id());
}

function echo_title(){
  echo $page_title;
}

function authorize_csrf_token($token){
  if ($token == generate_csrf_token()){
    return true;
  }else{
    header("Location: login.php?e=wrong-token");
    exit;
  }
}

function authorize_user($user_name, $password){
  require __DIR__ '/db.php';

  connect();
  $sql = 'SELECT * FROM user WHERE name ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array($user_name));

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($result['password'] == $password){
    $_SESSION['user_name'] = $user_name;
    header('Location: /');
    exit;
  } else {
    header('Location: /login.php?e=auth-failed')
  }

}
 ?>
