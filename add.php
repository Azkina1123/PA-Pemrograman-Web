<?php

session_start();

require 'config.php';

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=Admin';
        </script>";
}

$mode = "add";

// jika mode edit produk
if (isset($_GET["mode"]) && $_GET["mode"] == "edit") {
  $mode = "edit";
  $id = $_GET['id'];

  $result = mysqli_query(
    $db,
    "SELECT * FROM produk WHERE id='$id'"
  );
  $row = mysqli_fetch_array($result);
}

// tambahkan produk
if (isset($_POST['tambah'])) {
  $tanggal = $_POST["tanggal"];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $tinggi = $_POST['tinggi'];
  $berat = $_POST['berat'];
  $deskripsi = $_POST['deskripsi'];

  // buat id, ganti nama gambar
  $id_baru = get_id_produk();
  $gambar = "product-$id_baru.png";

  // jika mengupload gambar, pindahkan direktori
  if ($_FILES["gambar"]["error"] !== 4) {

    // jika ukuran lebih dari 200 KB
    if ($_FILES["gambar"]["size"] > 200000) {
      echo "<script>
              alert('Ukuran gambar maksimal 200 KB!');
          </script>";

      goto failed;
    }


    // ambil ekstensi
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));

    // buat nama file
    $gambar = "product-$id_baru.$ekstensi"; // agar tidak ada nama file yang sama

    // pindahkan ke direktori img/products
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/products/" . $gambar);

    // jika tidak mengupload gambar, set gambar default
  } else {
    copy("img/icons/product.png", "img/products/$gambar");
  }

  // simpan ke database
  $query =  "INSERT INTO produk (id, tanggal_rilis, nama, jenis, harga, stok, tinggi, berat, deskripsi, gambar) 
              VALUES ('$id_baru', '$tanggal', '$nama', '$jenis', '$harga', '$stok', '$tinggi', '$berat', '$deskripsi', '$gambar')";
  $result = $db->query($query);

  // jika berhasil disimpan ke db
  if ($result) {
    echo "
      <script>
          alert('Produk Berhasil Ditambahkan');
          document.location.href = 'products.php';
      </script>";

    // jika gagal disimpan ke db
  } else {
    echo "
      <script>
          alert('Produk Gagal Ditambahkan');
      </script>";

    goto failed;
  }
}

// edit produk
if (isset($_POST["edit"])) {

  // jika sudah mengedit
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $tinggi = $_POST['tinggi'];
  $berat = $_POST['berat'];
  $deskripsi = $_POST['deskripsi'];
  $gambar = $_POST["gambar_lama"];

  // jika mengupload gambar baru
  if ($_FILES["gambar"]["error"] !== 4) {

    if ($_FILES["gambar"]["size"] > 200000) {
      echo "<script>
              alert('Ukuran gambar maksimal 200 KB!');
          </script>";
      goto failed;
    }

    // hapus gambar lama
    unlink("img/products/$gambar");

    // ambil ekstensi
    $gambar = $_FILES["gambar"]["name"];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));

    // buat nama file
    $gambar = "product-$id.$ekstensi";

    // pindahkan ke direktori img/products
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/products/" . $gambar);
  }

  // update database
  $query =    "UPDATE produk SET 
                      nama='$nama',
                      jenis='$jenis',
                      harga='$harga', 
                      stok='$stok', 
                      tinggi='$tinggi',
                      berat='$berat',
                      deskripsi='$deskripsi',
                      gambar='$gambar'
                WHERE id='$id'";
  $result = $db->query($query);

  // jika berhasil update
  if ($result) {
    echo "<script>
              alert('Produk Berhasil Diperbarui');
              document.location.href = 'product.php?id=$id';
          </script>";

    // jika gagal update
  } else {
    echo "<script>
                alert('Produk Gagal Diperbarui');
            </script>";
    goto failed;
  }
}

failed:

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/add.css?v=<?= time(); ?>">
  <link rel="shortcut icon" href="img/icons/icon.png" type="image/x-icon">

  <title> <?= $mode == "add" ? "Add Product" : "Edit Product" ?> | Green Florist </title>
</head>

<body>
  <div class="page-wrapper home-page admin add">

    <header class="img" style="background-image: url('img/header-<?= $mode; ?>.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> <?= $mode == "add" ? "ADD PRODUCT" : "EDIT PRODUCT"; ?> </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <form action="" method="post" enctype="multipart/form-data" class="center">

          <h1>
            <center> <?= $mode == "add" ? "Tambahkan Produk Baru" : $row["nama"]; ?> </center>
          </h1>
          <hr>

          <table>
            <!-- tanggal -->
            <tr>
              <td><label for="tanggal"> TANGGAL RILIS* </label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="date" name="tanggal" class="form-input" required id="tanggal" value="<?= $mode == "add" ? date("Y-m-d") : $row["tanggal_rilis"]; ?>" readonly></td>
            </tr>

            <!-- nama tanaman -->
            <tr>
              <td><label for="nama">NAMA TANAMAN*</label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="text" name="nama" class="form-input" required id="nama" value="<?= $mode == "add" ? "" : $row["nama"]; ?>" placeholder="Nama Tanaman"></td>
            </tr>

            <!-- jenis tanaman -->
            <tr>
              <td> <label for="jenis">JENIS TANAMAN*</label> </td>
              <td>
                <center>:</center>
              </td>

              <td>
                <input type="radio" name="jenis" value="tanaman hias" id="tanaman-hias" <?= $mode == "edit" && ($row['jenis'] == "tanaman hias") ? "checked" : "" ?> <?= $mode == "add" ? "checked" : "" ?>>
                <label for="tanaman-hias"> Tanaman Hias </label> <br>

                <input type="radio" name="jenis" value="tanaman buah" id="tanaman-buah" <?= $mode == "edit" && ($row['jenis'] == "tanaman buah") ? "checked" : "" ?>>
                <label for="tanaman-buah"> Tanaman Buah </label> <br>

                <input type="radio" name="jenis" value="benih tanaman" id="benih-tanaman" <?= $mode == "edit" && ($row['jenis'] == "benih tanaman") ? "checked" : "" ?>>
                <label for="benih-tanaman"> Benih Tanaman </label> <br>
              </td>
            </tr>

            <!-- harga -->
            <tr>
              <td><label for="harga">HARGA (Rp)* </label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="number" name="harga" class="form-input" required id="harga" value="<?= $mode == "add" ? "" : $row["harga"]; ?>" placeholder="Rp Harga"></td>
            </tr>

            <!-- stok -->
            <tr>
              <td><label for="stok">STOK*</label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="number" name="stok" class="form-input" min="0" required id="stok" value="<?= $mode == "add" ? "" : $row["stok"]; ?>" placeholder="Stok"></td>
            </tr>

            <!-- tinggi -->
            <tr>
              <td><label for="tinggi">TINGGI (m)*</label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="number" step="0.01" name="tinggi" class="form-input" required min="0" id="tinggi" value="<?= $mode == "add" ? "" : $row["tinggi"]; ?>" placeholder="Tinggi m"></td>
            </tr>

            <!-- berat -->
            <tr>
              <td><label for="berat">BERAT (kg)*</label></td>
              <td>
                <center>:</center>
              </td>
              <td><input type="number" step="0.01" name="berat" class="form-input" required min="0" id="berat" value="<?= $mode == "add" ? "" : $row["berat"]; ?>" placeholder="Berat kg"></td>
            </tr>

            <!-- deskripsi -->
            <tr>
              <td><label for="deskripsi">DESKRIPSI TANAMAN*</label></td>
              <td>
                <center>:</center>
              </td>
              <td><textarea name="deskripsi" class="form-input" required id="deskripsi" placeholder="Deskripsi" maxlength="100"><?= $mode == "add" ? "" : $row["deskripsi"]; ?></textarea></td>
            </tr>

            <!-- upload gambar -->
            <tr>
              <td><label for="gambar">GAMBAR TANAMAN</label></td>
              <td>
                <center>:</center>
              </td>
              <td>
                <?php if ($mode == "edit") { ?>
                  <img src="img/products/<?= $row["gambar"]; ?>" alt="" height="200"> <br>
                <?php } ?>
                <input type="file" name="gambar" class="form-input" id="gambar"> <br>
                Max size: 200 KB
                <input type="text" name="gambar_lama" value="<?= $row["gambar"]; ?>" hidden>
              </td>
            </tr>

            <tr>
              <td colspan="3">
                <center><button type="submit" class="btn-block" name="<?= $mode == "add" ? "tambah" : "edit"; ?>">Submit</button></center>
              </td>
            </tr>

          </table>

        </form>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>