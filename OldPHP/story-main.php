<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Project-SSS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <?php if (isset($_GET['createstory']) && $_GET['createstory'] == "nouser") echo '<div class="alert alert-warning alert-dismissible fade show m-0 py-2" id="alertnouser" role="alert">
      <strong>You are not logged in!</strong> Log in firstly for do this action.
        <button type="button" class="close p-2" style="padding-top: 0.32rem !important" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex py-0">
      <a class="navbar-brand" href="index.php">SSS</a>

      <a class="navbar-brand" href="includes/create.init.inc.php">
        <img class="d-inline-block align-top" src="resources/add-story-plus.png" alt="Add story" width="30">
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
              <p class="dropdown-header text-muted py-0">'.$_SESSION["loginTime"].'</p>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="includes/logout.inc.php">Log out</a>';
            }
          ?>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 mt-1">
          <div class="d-flex p-1 bd-highlight">
            <h3 class="mb-0">Name of the story</h3>
            <div class="ranking ml-auto mt-1">
              <span class="font-italic">Ranking:</span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
            </div>
          </div>
          <span class="text-muted ml-1">Author Name</span>
          <div class="d-flex flex-row story-tags m-1">
            <span class="font-italic badge badge-primary ml-0">Epic</span>
            <span class="font-italic badge badge-primary">Novel</span>
            <span class="font-italic badge badge-primary">Prose</span>
          </div>
        </div>
        <div class="col-md-4 border-left">

        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
