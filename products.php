<?php

session_start();

require "config.php";

$search = "all";
if (isset($_GET["search"])) {
  $search = $_GET["search"];
}

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

if ($search == "all") {
  $products = $db->query("SELECT * FROM produk");
  
} else if ($search == "tanaman hias") {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE jenis='Tanaman Hias'"
  );
} else if ($search == "tanaman buah") {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE jenis='Tanaman Buah'"
  );
} else if ($search == "benih tanaman") {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE jenis='Benih Tanaman'"
  );

} else {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE nama LIKE '%$search%'"
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
  <link rel="stylesheet" href="css/products.css?v=<?= time(); ?>">

  <title> Product | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user admin products">

    <header class="img" style="background-image: url('img/header-products.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> PRODUCTS </h1>
      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <form action="" class="searching">
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </form>

        <p> Hasil pencarian: <?= $search; ?>. </p>

        <div class="products-container">
          <ul>

            <li> 
              <a href="?search=all" class="link">
              <?= $search == "all" ? "<b> All </b>" : "All"; ?> </a> 
            </li>

            <li> 
              <a href="?search=tanaman hias" class="link">
              <?= $search == "tanaman hias" ? "<b> Tanaman Hias </b>" : "Tanaman Hias"; ?> </a> 
            </li>

            <li> 
              <a href="?search=tanaman buah" class="link">
              <?= $search == "tanaman buah" ? "<b> Tanaman Buah </b>" : "Tanaman Buah"; ?> </a> 
            </li>

            <li> 
              <a href="?search=benih tanaman" class="link">
              <?= $search == "benih tanaman" ? "<b> Benih Tanaman </b>" : "Benih Tanaman"; ?> </a> 
            </li>

          </ul>

          <div class="box-container">

            <?php while ($product = mysqli_fetch_array($products)): ?>
            <a href="#">
            <div class="box-square object">

              <div class="img" style="background-image: url('img/products/<?= $product["gambar"]; ?>');"></div>
  
              <div class="deskripsi">
                <p> <b> <?= $product["nama"]; ?> </b> </p>
                <p> Rp <?= $product["harga"]; ?> </p>
              </div>
                
            </div>
            </a>
            <?php endwhile; ?>

          </div>

        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>