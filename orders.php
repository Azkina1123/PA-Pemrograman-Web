<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$login = "user";

// jika di akun user
if ($_SESSION["login"] == "user") {
  $login = "user";
  $username = $_SESSION["username"];
  $orders = $db->query(
    "SELECT * FROM pesanan
    WHERE username='$username'
    ORDER BY tanggal"
  );
}

// jika di akun admin
if ($_SESSION["login"] == "admin") {
  $login = "admin";
  $orders = $db->query(
    "SELECT * FROM pesanan
    ORDER BY tanggal"
  );
}

// jika ubah status order
if (isset($_POST["submit"])) {
  $status = $_POST["status"];
  $id_pesanan = $_POST["id_pesanan"];
  $result = $db->query(
    "UPDATE pesanan
    SET status_pesanan='$status'
    WHERE id='$id_pesanan'"
  );

  echo "<script>
        alert('Status pesanan $id_pesanan telah berhasil diubah!');
      </script>";

  header("Refresh:0");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/orders.css?v=<?= time(); ?>">

  <title> Order | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user orders">

    <header class="img" style="background-image: url('img/header-order.jpg');">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> ORDER </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper list-orders">

        <table cellspacing="0" border="0">

        <!-- header table -->
          <tr>
            <th> Tanggal </th>
            <th> Detail Pesanan </th>
            <th> Status </th>
          </tr>

          <!--  list pesanan -->
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
              <!-- tanggal -->
              <td> <?= date("d-m-Y h:i", strtotime($order["tanggal"])) ?> </td>

              <!-- detail pesanan -->
              <td class="detail-pesanan flex">
                <div class="img" style="background-image: url('img/products/<?= $products["gambar"]; ?>');"></div>
                <div class="deskripsi">
                  <a href="order.php?id=<?= $order["id"]; ?>" class="link">
                    <h3> <?= $products["nama"]; ?>
                      <?= $jumlah_produk > 1 ? "dan " . $jumlah_produk - 1 . " lainnya" : ""; ?>
                    </h3>

                    <p> Rp <?= $order["total_pembayaran"]; ?> </p>
                    <p> Kode pesanan: <?= $id_pesanan; ?> </p>

                  </a>
                </div>
              </td>
              <td>
                <?= $login == "user" ? $order["status_pesanan"] : ""; ?>
                
                <?php if ($login == "admin") { ?>
                <form action="" method="POST" class="option flex">
                  <input type="text" name="id_pesanan" value="<?= $order["id"]; ?>" hidden>
                  
                  <select name="status" id="" class="form-input">
                    <option value="Sedang Dikemas" <?= $order["status_pesanan"] == "Sedang Dikemas" ? "selected" : "" ?>> Sedang Dikemas </option>
                    <option value="Telah Dikirim"  <?= $order["status_pesanan"] == "Telah Dikirim" ? "selected" : "" ?>> Telah Dikirim </option>
                  </select>
                  
                  <button type="submit" name="submit" class="btn-block center"> OK </button>
                </form>

                <?php } ?>
              </td>
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