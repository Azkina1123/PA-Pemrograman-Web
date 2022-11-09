<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">

  <title> About | Green Florist </title>

  <style>
    .wrapper .img {
      width: 30%;
      height: 200px;
      margin: 0 10px;
    }

    .wrapper .img:nth-child(1) {
      background-image: url("img/gallery-2.jpg");
    }
    .wrapper .img:nth-child(2) {
      background-image: url("img/gallery-1.jpg");
    }
    .wrapper .img:nth-child(3) {
      background-image: url("img/gallery-3.jpg");
    }

    .wrapper h2 + .wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    @media screen and (min-width: 240px) and (max-width:1024px) {
      .wrapper .img {
        margin: 0 5px;
        height: 100px;
      }
    }
 
  </style>
</head>

<body>
  <div class="page-wrapper about">

    <header class="img" style="background-image: url(img/header-about.jpg);">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> ABOUT </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper center">
        <h2>Green Feel Florist</h2>

        <div class="wrapper">
          <div class="img"></div>
          <div class="img"></div>
          <div class="img"></div>
        </div>

        <p>
          Dalam memenuhi keinginan pelanggan untuk tetap dapat mengakses toko, 
          kami menciptakan <br> website ini sehingga dapat diakses dimanapun dan kapanpun. 
        </p>
        <br>
        <p> Di sini kami menawarkan berbagai jenis tanaman yang mampu memenuhi kebutuhan akan tanaman Anda. </p>
        <p> Selamat berbelanja di toko kami! </p>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>