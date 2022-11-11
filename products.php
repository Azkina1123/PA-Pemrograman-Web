<?php

session_start();

require "config.php";

// if (!isset($_SESSION["login"])) {
//   echo "<script>
//   alert('Harap masuk sebagai user/admin terlebih dahulu!');
//   document.location.href = 'sign-in.php?login=User';
//   </script>";
// }

$search = "all";
if (isset($_GET["search"])) {
  $search = $_GET["search"];
}

$jenis_tanaman = ["Tanaman Hias", "Tanaman Buah", "Benih Tanaman"];

// pilih semua jenis tanaman
if ($search == "all") {
  $products = $db->query("SELECT * FROM produk");

  // pilih jenis tanaman tertentu
} else if (in_array(ucwords($search), $jenis_tanaman)) {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE jenis='$search'"
  );

  // cari keyword tertentu
} else {
  $products = $db->query(
    "SELECT * FROM produk
     WHERE LOWER(nama) LIKE '%$search%'"
  );
}

// mode edit / read
$sampul = "header-products.jpg";
$judul = "PRODUCTS";
$mode = "read";
if (isset($_GET["mode"]) && $_GET["mode"] == "edit") {
  $sampul = "header-edit.jpg";
  $judul = "EDIT PRODUCT";
  $mode = "edit";
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
  <link rel="shortcut icon" href="img/icons/icon.png" type="image/x-icon">

  <title> Product | Green Florist </title>
</head>

<body>
  <div class="page-wrapper user admin products">

    <header class="img" style="background-image: url('img/<?= $sampul; ?>');">

      <?php include "nav.php"; ?>

      <div class="banner mini center">
        <h1> <?= $judul; ?> </h1>
      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <form action="" method="GET" class="searching">
          <input type="text" name="mode" value="<?= $mode; ?>" hidden>
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </form>

        <p> Hasil pencarian: <?= $search; ?>. </p>

        <div class="products-container">
          <ul>

            <li>
              <a href="?mode=<?= $mode; ?>&search=all" class="link">
                <?= $search == "all" ? "<b> All </b>" : "All"; ?> </a>
            </li>

            <!-- menu jenis tanaman -->
            <?php foreach ($jenis_tanaman as $tanaman) : ?>
              <li>
                <a href="?mode=<?= $mode; ?>&search=<?= $tanaman; ?>" class="link">
                  <?= $search == $tanaman ? "<b> $tanaman </b>" : "$tanaman"; ?> </a>
              </li>
            <?php endforeach; ?>

          </ul>

          <!-- list produk -->
          <div class="box-container">

            <!-- 1 kotak produk -->
            <?php while ($product = mysqli_fetch_array($products)) : ?>
              <a href="product.php?id=<?= $product["id"]; ?>">
                <div class="box-square object">

                  <!-- ================= mode edit ================= -->
                  <?php if ($mode == "edit" && $_SESSION["login"] == "admin") { ?>

                    <div class="mode flex">
                      <a href="add.php?mode=edit&id=<?= $product['id']; ?>">
                        <button class="edit-product-logo img"></button>
                      </a>
                      <a href="delete.php?id=<?= $product['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $product['nama']; ?>?')">
                        <button class="delete-product-logo img"></button>
                      </a>
                    </div>

                  <?php } ?>

                  <div class="product img" style="background-image: url('img/products/<?= $product["gambar"]; ?>');"></div>

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

    <?php include "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>