<?php

session_start();

require 'config.php';

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=Admin';
        </script>";
}

// tambahkan produk
if (isset($_POST['kirim'])) {
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $tinggi = $_POST['tinggi'];
  $berat = $_POST['berat'];
  $deskripsi = $_POST['deskripsi'];
  
  // buat id, ganti nama gambar
  $ids = $db->query("SELECT id FROM produk");
  $id_baru = mysqli_num_rows($ids)+1;
  $gambar = "product-$id_baru.png";
  
  // jika mengupload gambar, pindahkan direktori
  if ($_FILES["gambar"]["error"] !== 4) {

    // ambil ekstensi
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));

    // buat nama file
    $gambar = "product-$id_baru.$ekstensi"; // agar tidak ada nama file yang sama
    
    // pindahkan ke direktori img
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/products/".$gambar);
  
  // jika tidak mengupload gambar, set gambar default
  } else {
    copy("img/icons/product.png", "img/products/$gambar");
  }

  // simpan ke database
  $query =  "INSERT INTO produk (id, nama, jenis, harga, stok, tinggi, berat, deskripsi, gambar) 
              VALUES ('$id_baru', '$nama', '$jenis', '$harga', '$stok', '$tinggi', '$berat', '$deskripsi', '$gambar')";
  $result = $db->query($query);

  // jika berhasil disimpan ke db
  if ($result) {
    echo "
      <script>
          alert('Produk Berhasil Ditambahkan');
          document.location.href = 'index.php';
      </script>";

  // jika gagal disimpan ke db
  } else {
    echo "
      <script>
          alert('Produk Gagal Ditambahkan');
      </script>";
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

  <title> Add Product | Green Florist </title>
</head>

<body>
  <div class="page-wrapper home-page admin">

    <header class="img" style="background-image: url('img/header-add.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> ADD PRODUCT </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <form action = "" method = "post" enctype = "multipart/form-data">

          <h1><center>Add Product</center></h1>
            <hr>
              <br>
                
                <label for = "nama">NAMA TANAMAN</label><br>
                <input type = "text" name = "nama" required id="nama"><br>
                
                <label for = "jenis">JENIS TANAMAN</label><br>
                
                <input type = "radio" name = "jenis" value = "tanaman hias" id="tanaman-hias"> 
                <label for="tanaman-hias"> Tanaman Hias </label> <br>

                <input type = "radio" name = "jenis" value = "tanaman buah" id="tanaman-buah">
                <label for="tanaman-buah"> Tanaman Buah </label> <br>

                <input type = "radio" name = "jenis" value = "benih tanaman" id="benih-tanaman"> 
                <label for="benih-tanaman"> Benih Tanaman </label> <br>

                <label for = "harga">HARGA</label><br>
                <input type = "number" name = "harga" required id="harga"><br>

                <label for = "stok">STOK</label><br>
                <input type = "number" name = "stok" min="0" required id="stok"><br>

                <label for = "tinggi">TINGGI</label><br>
                <input type = "float" name = "tinggi" required min="0" id="tinggi"><br>

                <label for = "berat">BERAT</label><br>
                <input type = "float" name = "berat" required min="0" id="berat"><br>

                <label for = "deskripsi">DESKRIPSI TANAMAN</label><br>
                <textarea name = "deskripsi" required id="deskripsi"></textarea><br>

                <label for="gambar">GAMBAR MENU</label><br>
                <input type="file" name = "gambar" id="gambar"><br><br>

              <br><center><button a class = "links" name = "kirim" href = "">Submit<br></button></center>

        </form>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>