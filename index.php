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

    <div class="jumbotron jumbotron-fluid pt-2 shadow" style="padding-bottom: 0">
      <h3 class="h3" style="margin-bottom: .8rem; margin-left: 1rem;">Recomended</h3>
      <div class="row flex-row flex-nowrap no-radius" style="overflow: auto; margin: 0">
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
        <button type="button" class="btn btn-light">
          <div class="card" style="width: 18rem;">
            <h2></h2>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </button>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row" id="main-2col">
        <div class="col-md-7">
          <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex">
            <h5 class="navbar-brand my-0 font-weight-light">Sort:</h5>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-secondary active">
                <input type="radio" name="options" id="sort-recent" autocomplete="off" checked> Recent
              </label>
              <label class="btn btn-secondary">
                <input type="radio" name="options" id="sort-pop" autocomplete="off"> Popular
              </label>
              <label class="btn btn-secondary">
                <input type="radio" name="options" id="sort-len" autocomplete="off"> Length
              </label>
            </div>
          </nav>

          <div class="card story m-2">
            <div class="card-header py-2 mb-1">
              <h3 class="story-header mb-1" style="float: left">Name of the story <p class="text-muted" style="display: inline">Author Name</p></h3>
              <div class="ranking float-md-right">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
            <div class="d-flex flex-row story-tags">
              <span class="font-italic badge badge-primary">Epic</span>
              <span class="font-italic badge badge-primary">Novel</span>
              <span class="font-italic badge badge-primary">Prose</span>
            </div>
            <p class="m-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <div class="card-footer text-muted mt-1 story-edited">
              2 days ago
            </div>
          </div>
          <div class="card story m-2">
            <div class="card-header py-2 mb-1">
              <h3 class="story-header mb-1" style="float: left">Name of the story <p class="text-muted" style="display: inline">Author Name</p></h3>
              <div class="ranking float-md-right">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
            <div class="d-flex flex-row story-tags">
              <span class="font-italic badge badge-primary">Epic</span>
              <span class="font-italic badge badge-primary">Novel</span>
              <span class="font-italic badge badge-primary">Prose</span>
            </div>
            <p class="m-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <div class="card-footer text-muted mt-1 story-edited">
              2 days ago
            </div>
          </div>
          <div class="card story m-2">
            <div class="card-header py-2 mb-1">
              <h3 class="story-header mb-1" style="float: left">Name of the story <p class="text-muted" style="display: inline">Author Name</p></h3>
              <div class="ranking float-md-right">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
            <div class="d-flex flex-row story-tags">
              <span class="font-italic badge badge-primary">Epic</span>
              <span class="font-italic badge badge-primary">Novel</span>
              <span class="font-italic badge badge-primary">Prose</span>
            </div>
            <p class="m-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <div class="card-footer text-muted mt-1 story-edited">
              2 days ago
            </div>
          </div>
          <div class="card story m-2">
            <div class="card-header py-2 mb-1">
              <h3 class="story-header mb-1" style="float: left">Name of the story <p class="text-muted" style="display: inline">Author Name</p></h3>
              <div class="ranking float-md-right">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
            <div class="d-flex flex-row story-tags">
              <span class="font-italic badge badge-primary">Epic</span>
              <span class="font-italic badge badge-primary">Novel</span>
              <span class="font-italic badge badge-primary">Prose</span>
            </div>
            <p class="m-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <div class="card-footer text-muted mt-1 story-edited">
              2 days ago
            </div>
          </div>
        </div>
        <div class="col-md-5 border-left">
          <h3 style="text-align: center">Subscribed</h3>
        </div>
      </div>
      <div class="row" id="bar-bottom">

      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
