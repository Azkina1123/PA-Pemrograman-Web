<?php

session_start();

require "config.php";



// jika sudah melakukan login
if (isset($_SESSION["login"])) {

  // jika mode admin

  // jika mode user

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/index.css?v=<?= time(); ?>">

  <title> Home | Green Florist </title>
</head>

<body>
  <div class="page-wrapper home">

    <header class="img" style="background-image: url('img/header-index.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner large center">

        <div class="object">
          <p> Toko Tanaman </p>
          <h1> GREEN FLORIST </h1>
        </div>

        <p class="object">
          Toko tanaman yang telah berdiri selama puluhan tahun dan menghasilkan <br>
          bibit berkualitas tinggi dengan hasil yang memuaskan.
        </p>

        <a href="<?= isset($_SESSION["login"]) ? "products.php" : "sign-in.php" ?>" class="object">
          <button class="btn-transparent"> EXPLORE NOW </button>
        </a>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper center">

        <div class="object">
          <h2> JENIS TANAMAN </h2>
          <p> Tersedia 3 jenis produk di toko kami dengan kualitas terjamin. </p>
        </div>

        <div class="box-container object">

          <?php
          $kategori = [
            ["Tanaman Hias", "tanaman-hias.jpg"],
            ["Tanaman Buah", "tanaman-buah.jpg"],
            ["Benih Tanaman", "benih-tanaman.jpg"]
          ]
          ?>

          <?php foreach ($kategori as $section) : ?>

            <div class="object">
              <a href="<?= isset($_SESSION["login"]) ? "products.php?search=". $section[0] : "sign-in.php" ?>">
                <div class="box-rectangle img center" style="background-image: url('img/<?= $section[1]; ?>');">
                  <h3 class="center"> VIEW ALL </h3>
                </div>
                <p> <?= $section[0]; ?> </p>
              </a>
            </div>

          <?php endforeach; ?>

        </div>

        <div class="object">
          <a href="<?= isset($_SESSION["login"]) ? "products.php" : "sign-in.php" ?>" class="link-hover"> SHOW MORE PRODUCTS </a>
        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>