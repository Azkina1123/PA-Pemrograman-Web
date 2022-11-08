<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$username = $_SESSION["username"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/pemberitahuan.css?v=<?= time(); ?>">

  <title> Formulir Pembayaran | Green Florist </title>
</head>

<body>

  <div class="page-wrapper user pemberitahuan">
    <header>
      <?php include "nav.php"; ?>
    </header>

    <form action="" method="POST">
      <div class="main-content flex">

        <section class="wrapper center">
          <div class="img" style="background-image: url('img/icons/success.png');"></div>
          <br>
          <h1 class="object"> Transaksi Berhasil! </h1>
          <p class="object"> 
            Pesanan Anda akan segera diproses oleh pihak kami. <br>
            Pantau pesanan Anda di halaman ORDER hingga pesanan diterima.
          </p>

          <br>
          <a href="orders.php" class="object btn-transparent"> Pergi ke ORDER </a>
        </section>

      </div>
    </form>

    <?php include "footer.php"; ?>
  </div>

  <script src="js/jquery.js?v=<?= time(); ?>"></script>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>