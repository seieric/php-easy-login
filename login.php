<?php
/**
*PHP easy login
*Copyright (c) 2019 seieric
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/
require_once __DIR__ . '/bin/functions.php';
require_unlogined();

if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['csrf_token'])){
  $user_name = htmlspecialchars($_POST['user_name']);
  $password = htmlspecialchars($_POST['password']);
  $token = htmlspecialchars($_POST['csrf_token']);
  authorize_csrf_token($token);
  authorize_user($user_name, $password);
}

set_title("ログイン");
include_once __DIR__ . '/assets/head.php';
 ?>
<body>
  <h1>ログイン</h1>
  <div id="form">
    <form mehod="post" action="#" name="loginform">
      <label for="user" >ユーザー名</label>
      <input type="text" name="user_name" class="input-text">
      <label for="password" >パスワード</label>
      <input type="password" name="password" class="input-text">
      <input type="hidden" name="csrf_token"value="<?php echo_csrf_token(); ?>" >
      <input type="submit" id="submit" name="login-button" value="ログイン" class="input-botton">ログイン</button>
    </form>
  </div>
  <div id="footer">
    <hr />
    <small>&copy 2019 seieric</small>
  </div>
</body>
</html>
