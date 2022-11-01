<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">

  <title> About | Nama Toko </title>
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

      <section class="wrapper">
        <!-- ISI DI SINI -->
        <h2>Green Feel Florist</h2><br>
        <p>Website ini dibuat untuk memenuhi kebutuhan para pelanggan sehingga dapat mengakses toko kami dari jarak jauh.</p>
        <p>Kami menawarkan </p>
        <p>Pelanggan dapat melihat semua produk yang tersedia dan membeli tanaman meski dari rumah.</p>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>