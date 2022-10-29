<?php

session_start();

require "config.php";

// login default
$login = "User";

// switch mode login
if (isset($_GET["login"])) {
  $login = $_GET["login"];
}

if (isset($_POST["sign_in"])) {

  $username = $_POST["username"];

  // jika berhasil login
  if (signing_in()) {
    $_SESSION["login"] = "user";
    $_SESSION["username"] = $username;

    echo "<script>
            document.location.href = 'index.php';
          </script>";
  }
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

    <header class="img" style="background-image: url('img/header-sign-in.jpg');">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> SIGN IN </h1>
      </div>

    </header>

    <div class="main-content">

      <section class="wrapper center">

        <div class="sign-in-box center">
          <h1> Sign In as <?= $login; ?> </h1>

          <!-- jika dalam mode login user -->
          <?php if ($login == "User") { ?>
          <p> <a href="sign-in.php?login=Admin" class="link"> Sign In as Admin </a> </p>
          
          <!-- jika dalam mode login admin -->
          <?php } else if ($login == "Admin") { ?>
          <p> <a href="sign-in.php?login=User" class="link"> Sign In as User </a> </p>
          <?php } ?>

          <form action="" method="POST">
            <table cellspacing="20">

              <!-- username -->
              <tr>
                <td> <label for="username"> Username </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="username" id="username" placeholder="Username" class="form-input" required> </td>
              </tr>

              <!-- password -->
              <tr>
                <td> <label for="password"> Password </label> </td>
                <td><center> : </center></td>
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input" required> </td>
              </tr>

              <!-- submit -->
              <tr>
                <td colspan="3"> 
                  <input type="submit" value="Sign In" name="sign_in" class="btn-block"> 
                </td>
              </tr>

              <!-- sign up -->
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