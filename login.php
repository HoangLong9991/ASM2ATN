<?php
session_start();
include("connect_db.php");
$dbconn = pg_connect($db_conn_string);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  $uname = $_POST['username'];
  $passwd = $_POST['password'];
  $query = "SELECT * FROM account WHERE username = '$uname' AND password = '$passwd'";
  $result = pg_query($dbconn ,$query);
  if (pg_num_rows($result) == 1){
    $user_info = pg_fetch_array($result);
    $role = $user_info["nameshop"];
    $_SESSION["role"] = $role;
    $_SESSION["refresh"] = 5;
    $_SESSION["selected_shop"] = "All_Shop";
    header('Location: Home_Page.php');
  }
  else echo "Please check your account again";
}
pg_close($dbconn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
  <div class = "shopname"><h1> ATN STORE </h1></div>
    <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label>Your Account</label>
            <div class="field_text">
                <input type="text" name="username" required>
            </div>
            <label>Password</label>
            <div class="field_text">
                <input type="password" name="password" required>
            </div>
          <div class = "flex-parent jc-center">
            <input class="green margin-right" type="submit" name="login" value="Login">
            <input class="magenta" type="submit" name="signup" value="Sign Up">

            </div>
        </form>
    </div>
</body>


</html>
