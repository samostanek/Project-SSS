<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- strom je zeleny
    brano sa smeje
    ja radsej pojdem
    lebo ma zjebe
    plusatanrubidny
    pekny prvok je
    len clovek zaludny
    o nom vsak vie
    takto sa zelena
    v branovom vlase
    brano sa uskrna
    znova a zase -->
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
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="includes/logout.inc.php">Log out</a>';
            }
          ?>
        </div>
      </div>
    </nav>
    <h1 class="text-center">Create a new story</h1>
    <div class="container">
      <form action="includes/create.inc.php" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control form-control-lg" required name="name" id="name" placeholder="Name of your new story">
          <?php if (isset($_GET['error']) && $_GET['error'] == "nametaken") echo '<small class="text-danger">Name already taken</small>'; ?>
        </div>
        <div class="form-group">
          <label for="desc">Description:</label>
          <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Description of your creation"></textarea>
        </div>
        <h5>Tags:</h5>
        <div class="form-row ml-4">
          <div class="col">
            <input class="form-check-input" name="tags[]" type="checkbox" value="epic" id="epic">
            <label class="form-check-label" for="epic">Epic</label>
          </div>
          <div class="col">
          <input class="form-check-input" name="tags[]" type="checkbox" value="lyric" id="lyric">
            <label class="form-check-label" for="lyric">Lyric</label>
          </div>
          <div class="col">
            <input class="form-check-input" name="tags[]" type="checkbox" value="prose" id="prose">
            <label class="form-check-label" for="prose">Prose</label>
          </div>
          <div class="col">
            <input class="form-check-input" name="tags[]" type="checkbox" value="poetry" id="poetry">
            <label class="form-check-label" for="poetry">Poetry</label>
          </div>
        </div>
        <div class="input-group my-2">
          <label for="more-tags" class="m-1">Custom tag:</label>
          <input type="text" class="form-control" id="more-tags" placeholder="Add your own tag">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Button</button>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
