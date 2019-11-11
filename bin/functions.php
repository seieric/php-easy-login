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
    return false;
  }
}

function authorize_user($user_name, $password){
  include __DIR__ . '/db.php';
  $db = new DB;

  $user_data = $db->get_user($user_name);
  $hash = $db->generate_hash($password);

  if($password == $user_data['password']){
    return true;
  }else{
    return false;
  }
}
 ?>
