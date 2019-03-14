<?php
function SQLlog($con, $sys, $msg, $userID, $storyID) {
  $stmt2 = mysqli_stmt_init($con);
  if (!mysqli_stmt_prepare($stmt2, "INSERT INTO log (time, sys, message, userID, storyID) VALUES (now(), ?, ?, ?, ?)")) {
    header("Location: ../login.php?error=sqlerrorf");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt2, "ssii", $sys, $msg, $userID, $storyID);
    mysqli_stmt_execute($stmt2);
  }
}
