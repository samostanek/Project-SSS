<?php

$name = $_POST['name'];
$desc = $_POST['desc'];
// $tags = $_POST['tags'];

if (isset($_POST['submit'])) {
  require 'dbconn.inc.php';
  $stmt = mysqli_stmt_init($conn);
  if (empty($name)) {
    header("Location: ../create.php?error=emptyfields&desc=".$desc);
    exit();
  } else if (!mysqli_stmt_prepare($stmt, 'SELECT title FROM stories WHERE title=?')) {
    mysqli_error($conn);
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
      header("Location: ../create.php?error=nametaken&name=".$name."&desc=".$desc);
      exit();
    } else {
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, 'INSERT INTO stories (AID, title, description, tags, follwID, continuations, finished) VALUES ('.$_SESSION["userID"].', ?, ?, ?, "[]", "[]", false)')) {
        echo mysqli_error($conn);
        exit();
      } else {
        $tags = array();
        if (isset($_POST['tags'])) {
          foreach ($_POST['tags'] as $tag) {
            if ($tag == true) array_push($tags, $tag);
          }
        }
        mysqli_stmt_bind_param($stmt, "sss", $name, $desc, json_encode($tags));
        mysqli_stmt_execute($stmt);
        header("Location: ../create.php?storyadd=success");
        exit();
      }
    }
  }
} else {
  header("Location: ../create.php");
  exit();
}
