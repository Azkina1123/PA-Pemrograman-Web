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
  <div class="page-wrapper sign-up">

    <header class="img" style="background-image: url('img/header-sign-up.jpg'); ">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> SIGN UP </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper center">

        <div class="sign-in-box">
          <h1> Sign Up as User </h1>
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
                <td> <label for="telepon"> Phone </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="telepon" id="telepon" placeholder="Phone" class="form-input"> </td>
              </tr>
              <tr>
                <td colspan="3"> <input type="submit" value="Sign Up Now" name="signup" class="btn-block"> </td>
              </tr>
              <tr>
                <td colspan="3">
                  <a href="sign-in.php" class="link"> 
                    <center> Already have an account? <br> Sign In now </center>
                  </a>
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