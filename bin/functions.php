<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/

function echo_csrf_token(){
  return hash('sha256', session_id());
}

function echo_title(){

}

function authorize_user($user_name, $password){
    if(!isset($user_name) || !isset($password)){
      header("Location: login.php?e=no-input");
      exit;
    }else{
      require './db.php';

      if(select_user_by_password($user_name, $password)){
        $_SESSION['user_name'] = $user_name;
        $_SESSION['start_time'] = time();
        header("Location: #{AUTHORIZED_TOP_PAGE}");
        exit;
      }
    }
}
 ?>
