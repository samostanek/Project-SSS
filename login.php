<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Project-SSS-login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body class="reg">
    <div class="container-fluid">
      <form action="includes/login.inc.php" class="regf border" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input <?php if (isset($_GET['uid'])) echo "value='".$_GET['uid']."'"?> required type="Username" class="form-control" id="username" placeholder="Enter username or e-mail" name="username">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" required class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
        <?php if (isset($_GET['error'])) echo "<span class='text-danger float-right mr-3'>".$_GET['error']."</span>";?>
      </form>
    </div>
  </body>
</html>
