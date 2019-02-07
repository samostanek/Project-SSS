<?php
if (isset($_POST['submit'])) {

  require 'dbconn.inc.php';

  $username = $_POST['username'];
  $password = $_POST['pwd'];

  if (empty($username) || empty($password)) {
    header("Location: ..login.php?error=emptyfields&uid=".$username);
    exit();
  }
  else {
    $sql = "SELECT uName FROM users WHERE uName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck = 0) {
        header("Location: ../login.php?error=nouser");
        exit();
      }
      else {
        $sql = "SELECT pwd FROM users WHERE uName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../login.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultCheck = mysqli_query($conn,$sql)
          $row = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
          if (password_hash($password, PASSWORD_DEFAULT) == $row["pwd"]){
            header("Location: ../login.php?signup=success")
            exit();
          }
        }
      }
    }
  }
}
else {
  header("Location: ../index.html");
  exit();
}
