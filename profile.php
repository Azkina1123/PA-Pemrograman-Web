<?php

session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">

  <title> Contact | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user profile">

    <header class="img" style="background-image: url('img/header-profile.jpg');">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> PROFILE </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper">

        ISI DI SINI
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>