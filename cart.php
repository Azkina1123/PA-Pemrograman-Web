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

  <title> Cart | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper home-page user">

    <header class="img" style="background-image: url('img/header-cart.jpg');">

      <?php require "nav-user.php"; ?>

      <div class="banner mini center">
        <h1> CART </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="searching">
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </div>

        <p> Hasil pencarian: tanaman. </p>


      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>