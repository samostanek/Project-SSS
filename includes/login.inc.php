<?php
if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['pwd'];

  require 'sqllog.inc.php';

  if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=emptyfields&uid=".$username);
    exit();
  } else {
    require 'dbconn.inc.php';
    $sql = "SELECT * FROM users WHERE uName=? OR mail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "ss", $username, $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if (!$row = mysqli_fetch_assoc($result)) {
        header("Location: ../login.php?error=nouser");
        SQLlog($conn, "login", 'User with name or mail "'.$username.'" Not Found.', NULL, NULL);
        exit();
      } else {
        $pwdCheck = password_verify($password, $row['pwd']);
        if (!$pwdCheck) {
          header("Location: ../login.php?error=wrongpwd");
          SQLlog($conn, "login", 'User "'.$row['uName'].'" entered Wrong Password.', $row['userID'], NULL);
          exit();
        } else if ($pwdCheck) {
          header("Location: ../index.php");
          $_SESSION["username"] = $row['uName'];
          $_SESSION["userID"] = $row['userID'];
          $_SESSION["loginTime"] = date('Y-m-d H:i:s');
          SQLlog($conn, "login", 'User "'.$row['uName'].'" successfully Logged In.', $row['userID'], NULL);
          exit();
        }
      }
    }
  }
} else {
  header("Location: ../index.html");
  exit();
}
