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

// ambil produk
$result = $db->query(
  "SELECT id_produk, nama, harga, gambar, jumlah, selected
  FROM keranjang_user
  LEFT JOIN produk
  ON (keranjang_user.id_produk = produk.id)
  WHERE selected=1 AND username='$username'"
);

// konversi ke array
$products = [];
while ($product = mysqli_fetch_array($result)) {
  $products[] = $product;
}

// ambil akun
$akun = $db->query(
  "SELECT nama, telepon, alamat
  FROM users
  WHERE username='$username'"
);
$akun = mysqli_fetch_array($akun);

// jika beli
if (isset($_POST["beli"])) {
  if (order_product($products)) {
    header("Location: pemberitahuan.php");
  }
}

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

    <form action="" method="POST">
    <div class="main-content flex">
      
      <section class="wrapper">

        <table border="0" cellspacing="0">

          <input type="datetime" name="tanggal" value="<?= date("Y-m-d h:i:s"); ?>" hidden>

          <!-- nama pembeli -->
          <tr>
            <td> <label for="nama"> Nama Penerima </label> </td>
            <td> <center>:</center> </td>
            <td> <input type="text" name="nama" id="nama" class="form-input" value="<?= $akun["nama"]; ?>" required> </td>
          </tr>

          <!-- nomor telepon -->
          <tr>
            <td> <label for="telepon"> No. Telepon </label> </td>
            <td> <center>:</center> </td>
            <td> <input type="text" name="telepon" id="telepon" required
                class="form-input" value="<?= $akun["telepon"]; ?>" 
                onkeypress="return numOnly(event)"> </td>
          </tr>

          <!-- alamat pembeli -->
          <tr>
            <td> <label for="alamat"> Alamat Penerima </label> </td>
            <td> <center>:</center> </td>
            <td> 
              <textarea name="alamat" id="alamat" required class="form-input"><?= $akun["alamat"]; ?></textarea>
            </td>
          </tr>

          <!-- metode pembayaran -->
          <tr>
            <td> Metode Pembayaran </td>
            <td> <center>:</center> </td>
            <td> 
              COD (Bayar di tempat)
            </td>
          </tr>

          <!-- list produk -->
          <tr>
            <td> Produk Dibeli </td>
            <td> <center>:</center> </td>
            <td>
              <?php foreach ($products as $product) { ?>
              
              <div class="product flex">
                <div class="img" style="background-image: url('img/products/<?= $product["gambar"]; ?>');"></div>
                <div class="deskripsi">
                  <h3> <?= $product["nama"]; ?> </h3>
                  <p> Rp <?= $product["harga"]; ?> x <?= $product["jumlah"]; ?> </p>
                </div>
              </div>

              <?php } ?> <!-- endwhile -->
            </td>
          </tr>

        </table>

      </section>

      <section class="wrapper">
        <?php
        $total_pembayaran = 0;
        foreach ($products as $product) {
          $total_pembayaran += $product["jumlah"] * $product["harga"];
        }
        ?>

        <h1> Total Pembayaran </h1>
        <p> Rp <?= $total_pembayaran; ?> </p>
        <p class="note form-input"> Harap siapkan nominal sebanyak Rp <?= $total_pembayaran ?>  ketika hendak menerima pesanan. </p>
        <input type="number" name="total_pembayaran" value="<?= $total_pembayaran; ?>" hidden>
        <input type="submit" value="Beli Sekarang" name="beli" class="btn-block">
      </section>
    </div>
    </form>

    <?php include "footer.php"; ?>
  </div>

  <script src="js/jquery.js?v=<?= time(); ?>"></script>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>