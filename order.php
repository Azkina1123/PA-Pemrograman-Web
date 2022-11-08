<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}
$username = $_SESSION["username"];
$orders = $db->query(
  "SELECT * FROM pesanan
  WHERE username='$username'
  ORDER BY tanggal"
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/order.css?v=<?= time(); ?>">

  <title> Order | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user order">

    <header class="img" style="background-image: url('img/header-order.jpg');">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> ORDER </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper">

        <table cellspacing="0" border="0">
          <tr>
            <th> Tanggal </th>
            <th> Detail Pesanan </th>
            <th> Status </th>
          </tr>

          <?php while ($order = mysqli_fetch_array($orders)) { ?>

            <?php
            $id_pesanan = $order["id"];

            $result = $db->query(
              "SELECT nama, gambar FROM produk
              LEFT JOIN produk_terbeli
              ON (produk.id = produk_terbeli.id_produk)
              WHERE id_pesanan='$id_pesanan'"
            );
            $products = mysqli_fetch_array($result);
            $jumlah_produk = mysqli_num_rows($result);
            ?>

            <tr>
              <td> <?= date("d-m-Y h:i", strtotime($order["tanggal"])) ?> </td>
              <td class="detail-pesanan flex">
                <div class="img" style="background-image: url('img/products/<?= $products["gambar"]; ?>');"></div>
                <div class="deskripsi">
                  <a href="" class="link">
                    <h3> <?= $products["nama"]; ?>
                      <?= $jumlah_produk > 1 ? "dan " . $jumlah_produk - 1 . " lainnya" : ""; ?>
                    </h3>

                    <p> Rp <?= $order["total_pembayaran"]; ?> </p>
                    <p> Kode pesanan: <?= $id_pesanan; ?> </p>

                  </a>
                </div>
              </td>
              <td> <?= $order["status"]; ?> </td>
            </tr>
          <?php } ?>
        </table>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>