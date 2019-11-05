<?php
/**
*PHP easy login
*Copyright (c) 2019 せいえりく(seieric)
*This software is released under the MIT License.
*http://opensource.org/licenses/mit-license.php
*/
@session_start();

if (isset($_SESSION['user_name'])){
  header("Location: #{DEFAULT_PAGE}");
  exit;
}

require './bin/functions.php';

if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['csrf_token'])){
  $user_name = htmlspecialchars($_POST['user_name']);
  $password = htmlspecialchars($_POST['password']);
  $token = htmlspecialchars($_POST['csrf_token']);
  authorize_csrf_token($token); //CSRFトークンの認証
  authorize_user($user_name, $password);
}

include './assets/head.php';
 ?>
<body>
  <h1>ログイン</h1>
  <hr />
  <div id="form">
    <form name="login-form">
      <label for="user" >ユーザー名</label>
      <input type="text" name="user_name" class="input-text">
      <label for="password" >パスワード</label>
      <input type="password" name="password" class="input-text">
      <input type="hidden" name="csrf_token"value="<?php echo_csrf_token(); ?>" >
      <button name="login-button" value="ログイン" class="input-botton">ログイン</button>
    </form>
  </div>
  <div id="footer">
    <hr />
    <small>&copy 2019 せいえりく</small>
  </div>
</body>
</html>
