<?php
if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwdrpt'];

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../register.php?error=emptyfields&uid=".$username."&email=".$email);
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmailuid");
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmail&uid=".$username);
    exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmail&email=".$email);
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../register.php?error=invalidrpt&uid=".$username."&email=".$email);
  }
  else {
    require 'dbconn.inc.php';
    require 'sqllog.inc.php';
    $sql = "SELECT uName FROM users WHERE uName=? OR mail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $username, $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../register.php?error=usertaken&mail=".$email);
        SQLlog($conn, "register", 'User with username"'.$username.'" or email "'.$email.'" Already Taken.', NULL, NULL);
        exit();
      }
      else {
        $sql = "INSERT INTO users (uName, mail, pwd, registered) VALUES (?, ?, ?, now())";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../login.php?error=sqlerror");
          exit();
        }
        else {
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);

          require 'sqllog.inc.php';
          SQLlog($conn, "register", 'User "'.$username.'" successfully Registered.', mysqli_insert_id($conn), NULL);
          header("Location: ../register.php?signup=success");
          exit();
        }
      }
    }

  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../index.html");
  exit();
}