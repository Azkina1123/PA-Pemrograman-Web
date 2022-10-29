<?php

session_start();

if (isset($_POST["login"])) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/sign-in.css?v=<?= time(); ?>">

  <title> Sign In | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper sign-in">

    <header>
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> SIGN IN </h1>
      </div>

    </header>

    <div class="main-content">

      <section class="wrapper center">

        <div class="sign-in-box center">
          <h1> Sign In as User </h1>
          <p> <a href="" class="link"> Sign In as Admin </a> </p>
          <form action="">
            <table cellspacing="20">
              <tr>
                <td> <label for="username"> Username </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="username" id="username" placeholder="Username" class="form-input"> </td>
              </tr>
              <tr>
                <td> <label for="password"> Password </label> </td>
                <td><center> : </center></td>
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input"> </td>
              </tr>
              <tr>
                <td colspan="3"> <input type="submit" value="Sign In" name="login" class="btn-block"> </td>
              </tr>
              <tr>
                <td colspan="3">
                  <a href="sign-up.php" class="link"> <center>
                  Don't have an account yet? <br> Register now
                  </center> </a>
                </td>
              </tr>
            </table>

          </form>
        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>