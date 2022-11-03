<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$id = $_GET["id"];
$result = $db->query(
  "SELECT * FROM produk
  WHERE id=$id"
);
$product = mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/product.css?v=<?= time(); ?>">

  <title> <?= $product["nama"]; ?> | Green Florist </title>
</head>

<body>

  <div class="page-wrapper user admin product">
    <header class="img" style="background-image: url('img/header-product.jpg');">
      <?php include "nav.php"; ?>

      <div class="banner mini center">
        <h1> PRODUCT </h1>
      </div>
    </header>

    <div class="main-content">
      <section class="wrapper center">
        <h1> <?= $product["nama"]; ?> </h1>

        <div class="product-container flex">
          <div style="background-image: url('img/products/<?= $product["gambar"]; ?>');" class="img"></div>
  
          <table cellspacing="0" border="1">
            <tr>
              <td> Nama </td>
              <td> <center>:</center> </td>
              <td> <?= $product["nama"] ?> </td>
            </tr>
            <tr>
              <td> Harga </td>
              <td> <center>:</center> </td>
              <td> <?= $product["harga"] ?> </td>
            </tr>
            <tr>
              <td> Tinggi </td>
              <td> <center>:</center> </td>
              <td> <?= $product["tinggi"] ?> </td>
            </tr>
            <tr>
              <td> Berat </td>
              <td> <center>:</center> </td>
              <td> <?= $product["berat"] ?> </td>
            </tr>
            <tr>
              <td> Deskripsi </td>
              <td> <center>:</center> </td>
              <td> <?= $product["deskripsi"] ?> </td>
            </tr>
            <tr>
              <td> Stok </td>
              <td> <center>:</center> </td>
              <td> <?= $product["stok"] ?> </td>
            </tr>
            <tr>
              <td colspan="3">
                <div>
                  <button class="btn-block"> Keranjang</button>
                  <button class="btn-block"> Beli Sekarang</button>
                </div>
              </td>
            </tr>
  
          </table>
        </div>
      </section>
    </div>

    <?php include "footer.php"; ?>

  </div>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>