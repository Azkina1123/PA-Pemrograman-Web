<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$ids = [];

$products = $db->query(
  "SELECT * FROM keranjang_user"
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/pembayaran.css?v=<?= time(); ?>">

  <title> Formulir Pembayaran | Green Florist </title>
</head>

<body>

  <div class="page-wrapper user pembayaran">
    <header>
      <?php include "nav.php"; ?>
    </header>

    <div class="main-content flex">
      <section class="wrapper">

        <table border="1" cellspacing="0">
          <!-- nama pembeli -->
          <tr>
            <td> Penerima </td>
            <td> <center>:</center> </td>
            <td> Nama </td>
          </tr>

          <!-- alamat pembeli -->
          <tr>
            <td> Alamat Penerima </td>
            <td> <center>:</center> </td>
            <td> alamat panjang kali lebar </td>
          </tr>

          <!-- list produk -->
          <tr>
            <td> Produk Dibeli </td>
            <td> <center>:</center> </td>
            <td>
              <?php ?>

            </td>
          </tr>

        </table>

      </section>

      <section class="wrapper">
        <h1> Total Pembayaran </h1>

      </section>

    </div>



    <?php include "footer.php"; ?>
  </div>

</body>

</html>