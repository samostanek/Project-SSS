<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Create a story</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex py-0">
      <a class="navbar-brand" href="#">SSS</a>

      <a class="navbar-brand" href="#">
        <img class="d-inline-block align-top" src="resources/add-story-plus.png" alt="Add story" width="30" href="create.php">
      </a>

      <span class="badge badge-primary ml-auto mr-3">0</span>
      <div class="dropdown">
        <a class="dropdown-togglecaret-off" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">
          <img class="d-inline-block align-top" src="resources/user-not-logged.png" alt="Add story" width="30">
        </a>
        <div class="dropdown-menu dropdown-menu-right float-right">
          <h6 class="dropdown-header py-1">Profile</h6>
          <?php
            if (!isset($_SESSION['username'])) {
              echo '
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="login.php">Log In</a>
              <a class="dropdown-item" href="register.php">Register</a>';
            } else {
              echo '
              <p class="dropdown-header text-muted py-0">'.$_SESSION["username"].'</p>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="includes/logout.inc.php">Log out</a>';
            }
          ?>
        </div>
      </div>
    </nav>
  </body>
</html>
