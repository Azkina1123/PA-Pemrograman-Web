<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=Admin';
        </script>";
}

$id = $_GET['id'];

$result = mysqli_query(
  $db,
  "SELECT * FROM produk WHERE id='$id'"
);
$row = mysqli_fetch_array($result);

// jika sudah mengedit
if (isset($_POST['kirim'])) {
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
              document.location.href = 'products.php?mode=edit';
          </script>";
  
  // jika gagal update
  } else {
      echo "<script>
                alert('Produk Gagal Diperbarui');
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

  <title> Edit Product | Green Florist </title>
</head>

<body>
  <div class="page-wrapper home-page user">

    <header class="img" style="background-image: url('img/header-edit.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> EDIT PRODUCT </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="add">

          <form action="" method="post" enctype="multipart/form-data">
            <h1>
              <center>Edit Product</center>
            </h1>
            <hr>
            <br>

            <label for="">NAMA TANAMAN</label><br>
            <input type="text" name="nama" value="<?= $row["nama"]; ?>"><br>

            <label for="">JENIS TANAMAN</label><br>
            <input type="radio" name="jenis" value="tanaman hias" 
            <?= $row['jenis'] == "tanaman hias" ? "checked" : "" ?> id="tanaman-hias">
            <label for="tanaman-hias"> Tanaman Hias </label>

            <input type="radio" name="jenis" value="tanaman buah" id="tanaman-buah" 
            <?= $row['jenis'] == "tanaman buah" ? "checked" : "" ?>> 
            <label for="tanaman-buah"> Tanaman Buah </label>

            <input type="radio" name="jenis" value="benih tanaman" id="benih-tanaman"
            <?= $row['jenis'] == "benih tanaman" ? "checked" : "" ?>> 
            <label for="benih-tanaman"> Benih Tanaman </label> <br>
            
            <label for="">HARGA</label><br>
            
            <input type="number" name="harga" value=<?= $row['harga'] ?>><br>
            <label for="">STOK</label><br>
            <input type="number" name="stok" value=<?= $row['stok'] ?>><br>
            <label for="">TINGGI</label><br>
            <input type="float" name="tinggi" value=<?= $row['tinggi'] ?>><br>
            <label for="">BERAT</label><br>
            <input type="float" name="berat" value=<?= $row['berat'] ?>><br>

            <label for="">DESKRIPSI TANAMAN</label><br>
            <textarea name="deskripsi" ><?= $row['deskripsi'] ?></textarea><br>

            <label for="">GAMBAR MENU</label><br>
            <input type="file" name="gambar"><br>
            <input type="text" name="gambar_lama" value="<?= $row["gambar"]; ?>" hidden>
            <br>
            <center><button a class="links" name="kirim" href="">Submit<br></button></center>
          </form>
        </div>

      </section>

    </div>

    </section>

  </div>

  <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>