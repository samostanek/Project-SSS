<?php
  if(!isset($_SESSION['username'])) {
    header("Location: ../index.php?createstory=nouser");
  } else {
    header("Location: ../create.php");
  }
