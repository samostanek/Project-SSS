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
    <link rel="stylesheet" href="/css/jquery.tag-editor.css">
  </head>
  <body>
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
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="includes/logout.inc.php">Log out</a>';
            }
          ?>
        </div>
      </div>
    </nav>
    <h1 class="text-center">Create a new story</h1>
    <div class="container">
      <form action="includes/create.inc.php" method="post" id="form">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control form-control-lg" required name="name" id="name" placeholder="Name of your new story">
          <?php if (isset($_GET['error']) && $_GET['error'] == "nametaken") echo '<small class="text-danger">Name already taken</small>'; ?>
        </div>
        <div class="form-group">
          <label for="desc">Description:</label>
          <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Description of your creation"></textarea>
        </div>
        <div class="input-group my-2">
          <label for="more-tags" class="m-1">Add tags:</label>
          <input type="text" class="form-control" id="more-tags" placeholder="Add your own tag">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
      <?php echo mail('samostanek@gmail.com', 'Test', wordwrap('Just test', 70, "\r\n")); ?>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.caret.min.js"></script>
    <script src="js/jquery.tag-editor.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $('#more-tags').tagEditor({         //TODO: CSS INPUT FORM
        autocomplete: {
          delay: 0,
          position: {collision : 'flip'},
          source: <?php
            require 'includes/dbconn.inc.php';
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, 'SELECT name FROM tags')) {
              echo mysqli_error($conn);
              exit();
            } else {
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $tags = array();
              while ($tag = mysqli_fetch_assoc($result)) array_push($tags, $tag['name']);
              echo json_encode($tags);
            }
          ?>
        },
        delimeter: ', ',
        placeholder: 'Enter tags...'
      });
      $("#form").submit(function(eventObj) {
        var tagsOrig = $('*').find('.tag-editor-tag');
        console.log(tags);
        var tags = [];
        for (let i = 0; i < tagsOrig.length; i++) {
          tags.push('"' + tagsOrig[i].innerHTML + '"');
        }
        $('<input />').attr('type', 'hidden')
        .attr('name', 'tags')
        .attr('value', "[" + tags.toString() + "]")
        .appendTo('#form');
      });
    </script>
  </body>
</html>
