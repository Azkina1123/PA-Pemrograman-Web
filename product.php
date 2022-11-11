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
$username = $_SESSION["username"];

// produk yang ditampilkan
$result = $db->query(
  "SELECT *
  FROM produk
  WHERE id=$id"
);

// $result = $db->query(
//   "SELECT *
//   FROM produk
//   LEFT JOIN keranjang_user
//   ON (produk.id = keranjang_user.id_produk)
//   WHERE id=$id AND username='$username'"
// );

// if (mysqli_num_rows($result) == 0) {
//   $result = $db->query(
//     "SELECT * FROM produk"
//   );
// }

$product = mysqli_fetch_array($result);

// masukkan produk ke keranjang
if (isset($_POST["keranjang"]) && add_to_cart()) {
  echo "<script>
          document.location.href = 'cart.php';
        </script>";
}


// beli produk
if (isset($_POST["beli"])) {
  $jumlah = $_POST["jumlah"];

  add_to_cart();

  // select produk yg dipilih
  $result = $db->query(
    "UPDATE keranjang_user
    SET selected=1, jumlah=$jumlah
    WHERE id_produk=$id AND username='$username'"
  );

  echo "<script>
          document.location.href = 'pembayaran.php?beli=true';
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
  <link rel="stylesheet" href="css/product.css?v=<?= time(); ?>">
  <link rel="shortcut icon" href="img/icons/icon.png" type="image/x-icon">

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

          <div class="description center">

            <table cellspacing="0">
              <tr>
                <td> Nama </td>
                <td> <center>:</center></td>
                <td> <?= $product["nama"] ?> </td>
              </tr>
              <tr>
                <td> Jenis </td>
                <td> <center>:</center></td>
                <td> <?= ucfirst($product["jenis"]) ?> </td>
              </tr>
              <tr>
                <td> Harga </td>
                <td> <center>:</center></td>
                <td> Rp <?= $product["harga"] ?> </td>
              </tr>
              <tr>
                <td> Tinggi </td>
                <td> <center>:</center></td>
                <td> <?= $product["tinggi"] ?> m </td>
              </tr>
              <tr>
                <td> Berat </td>
                <td> <center>:</center></td>
                <td> <?= $product["berat"] ?> kg </td>
              </tr>
              <tr>
                <td> Deskripsi </td>
                <td> <center>:</center></td>
                <td> <?= $product["deskripsi"] ?> </td>
              </tr>
              <tr>
                <td> Stok </td>
                <td> <center>:</center></td>
                <td> <?= $product["stok"] ?> </td>
              </tr>
            </table>

            <?php if ($_SESSION["login"] != "admin") { ?>
              <div class="btn-container flex">
                <form action="" method="POST">
                  <button class="btn-block object" name="beli"> Beli Sekarang </button>
                  <button type="submit" class="btn-block object" name="keranjang"> Keranjang </button>

                  <?php
                  $id = $product["id"];
                  $jumlah = $db->query(
                    "SELECT jumlah FROM keranjang_user
                    WHERE id_produk=$id AND username='$username'"
                  );
                  $jumlah = mysqli_fetch_array($jumlah);
                  ?>
                  <!-- jumlah barang ke keranjang -->
                  <input type="number" name="jumlah" class="form-input jumlah object" value="<?= isset($jumlah["jumlah"]) ? $jumlah["jumlah"] : 1 ?>" onkeyup="updateJumlahBarang(this)" min="1" max="<?= $product["stok"]; ?>">

                  <!-- hidden -->
                  <input type="text" name="id" value="<?= $id; ?>" hidden>
                </form>
              </div>
            <?php } ?>

          </div>

        </div>
      </section>
    </div>

    <?php include "footer.php"; ?>

  </div>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>