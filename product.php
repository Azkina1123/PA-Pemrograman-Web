<?php

session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
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

  <title> Product | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user admin product">

    <header class="img" style="background-image: url('img/header-products.jpg');">
      <?php require "nav-user.php"; ?>
      <div class="banner mini center">
        <h1> PRODUCT </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="searching">
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </div>

        <p> Hasil pencarian: tanaman. </p>

        <div class="products">
          <ul>
            <li> <a href="" class="link"> All </a> </li>
            <li> <a href="" class="link"> Tanaman Hias </a> </li>
            <li> <a href="" class="link"> Tanaman Buah </a> </li>
            <li> <a href="" class="link"> Benih Tanaman </a> </li>
          </ul>

          <div class="box-container">
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
            <div class="box-square object">
            </div>
          </div>

        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>