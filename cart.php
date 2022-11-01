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
  
$products = $db->query(
  "SELECT *
   FROM keranjang_user LEFT JOIN produk
   ON (keranjang_user.id_produk = produk.id)"
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/cart.css?v=<?= time(); ?>">

  <title> Cart | Nama Toko </title>
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

        <div class="searching">
        <form action="" class="searching">
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </form>

        </div>

        <p> Hasil pencarian: tanaman. </p>
        <br>


        <form action="">
        <div class="list-products">

          <table border="0" cellspacing="0">
            <tr>
              <th colspan="2"> Produk </th>
              <th width="20%"> Jumlah </th>
            </tr>
  
            <?php while($product = mysqli_fetch_array($products)) { ?>
            <tr>
              <td width="5%">
                <center> <input type="checkbox" name="" id="<?= $product["id_produk"]; ?>"> </center>
              </td>
  
              <td>
                <label for="<?= $product["id_produk"]; ?>" class="left product">
                  <div class="img" style="background-image: url('img/products/<?= $product["gambar"]; ?>');"></div>
                  
                  <div class="deskripsi">
                    <a href="" class="link">
                      <p> <b><?= $product["nama"]; ?> </b> </p>
                      <p class="harga"> Rp <?= $product["harga"] ?> </p>
                    </a>
                  </div>
                </label>
              </td>
  
              <td>
                <center> <input type="number" name="" id="" value="<?= $product["jumlah"]; ?>" class="form-input jumlah"> </center>
              </td>
  
            </tr>
            <?php } ?>
  
          </table>
            
        </div>

        
      </section>
      
      <section class="pembayaran">
        
        <div class="wrapper">
          <p class="object"> Total pembayaran: <span class="total-harga"> Rp 12500 </span> </p>
          <button class="btn-block object"> Beli Sekarang </button>
        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/jquery.js?v=<?= time(); ?>"></script>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>