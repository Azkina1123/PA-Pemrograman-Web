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

// ambil keranjang yang sesuai dengan akun
$products = $db->query(
  "SELECT *
   FROM keranjang_user LEFT JOIN produk
   ON (keranjang_user.id_produk = produk.id)
   WHERE username='$username'"
);

// hapus produk dari keranjang
if (isset($_GET["delete"])) {
  $id = $_GET["id"];

  $result = $db->query(
    "DELETE FROM keranjang_user
    WHERE id_produk='$id'"
  );
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/cart.css?v=<?= time(); ?>">

  <title> Cart | Green Florist </title>
</head>

<body>
  <div class="page-wrapper user cart">

    <header class="img" style="background-image: url('img/header-cart.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> CART </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="list-products">

          <table border="0" cellspacing="0">
            <tr>
              <th colspan="2"> Produk </th>
              <th width="10%"> Jumlah </th>
              <th> Delete </th>
            </tr>

            <!-- tampilkan tabel keranjang -->
            <?php while ($product = mysqli_fetch_array($products)) { ?>

              <!-- checkbox -->
              <tr>
                <td width="5%">
                  <center> <input type="checkbox" name="" id="<?= $product["id"]; ?>" class="check-input" onchange="selectProductCart(<?= $product['id'] ?>)"> </center>
                </td>

                <!-- pilih produk -->
                <td>
                  <label for="<?= $product["id"]; ?>" class="left">
                    <div class="product img" style="background-image: url('img/products/<?= $product["gambar"]; ?>');"></div>

                    <div class="deskripsi">
                      <a href="product.php?id=<?= $product["id"]; ?>" class="link">
                        <p> <b><?= $product["nama"]; ?> </b> </p>
                        <p class="harga"> Rp <?= $product["harga"] ?> </p>
                      </a>
                    </div>
                  </label>
                </td>

                <!-- ubah jumlah barang -->
                <td class="barang">
                  <center>
                    <input type="number" name="" class="form-input jumlah" value="<?= $product["jumlah"]; ?>"
                    onkeyup="updateJumlahBarang(this, <?= $product['id']; ?>, <?= $product['stok']; ?>, <?= $product['harga']; ?>); 
                            updateTotalHarga();" min="1" max="<?= $product['stok']; ?>">

                    <input type="number" name="" id="<?= $product['id']; ?>"  
                    class="<?= $product["id"]; ?>" value="<?= $product["jumlah"] * $product["harga"]; ?>" hidden>
                  </center>

                </td>

                <!-- hapus dari keranjang -->
                <td width="5%">
                  <center>
                    <a href="?delete=1&id=<?= $product["id"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $product['nama']; ?> dari keranjang?')" 
                    class="delete-cart-logo img" name="delete"></a>
                  </center>
                </td>

              </tr>
            <?php } ?>

          </table>

        </div>


      </section>

      <!-- total pembayaran -->
      <section class="pembayaran">

        <div class="wrapper">
          <p class="object"> Total pembayaran: Rp <span class="total-harga"> 0 </span> </p>

          <input type="number" class="total-harga" name="total_pembayaran" hidden>
          <a href="pembayaran.php" class="link-pembayaran"><button class="btn-block object"> Beli Sekarang </button></a>
        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>
  <script src="js/jquery.js?v=<?= time(); ?>"></script>
  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>