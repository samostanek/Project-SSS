<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Project-SSS-register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body class="reg">
    <div class="container-fluid">
      <form action="includes/register.inc.php" class="regf border" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="Username" class="form-control" id="username" placeholder="Enter username" name="username">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>
        <div class="form-group">
          <label for="pwdrpt">Repeat password:</label>
          <input type="password" class="form-control" id="pwdrpt" placeholder="Repeat password" name="pwdrpt">
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
        <?php
          echo $_GET['error'];
        ?>
      </form>
    </div>
  </body>
</html>
