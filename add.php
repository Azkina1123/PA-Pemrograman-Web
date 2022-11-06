<?php

session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=Admin';
        </script>";
}

?>

<?php
    
    require 'config.php';

    if(isset($_POST['kirim']))
    {
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $tinggi = $_POST['tinggi'];
        $berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];

        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        
        $ekstensi = strtolower(end($x));
        $gambar_baru = "$nama.$ekstensi";

        $tmp = $_FILES['gambar']['tmp_name'];
        
        if(move_uploaded_file($tmp, "gambar/".$gambar_baru))
        {
            $query =  "INSERT INTO produk (nama, jenis, harga, stok, tinggi, berat, deskripsi, gambar) 
                       VALUES ('$nama', '$jenis', '$harga', '$stok', '$tinggi', '$berat', '$deskripsi', '$gambar_baru')";
            $result = $db->query($query);

            if($result){
                echo "
                    <script>
                        alert('Data Berhasil Diinput');
                        document.location.href = 'admin.php';
                    </script>
                ";
            }else {
                echo "
                    <script>
                        alert('Data Gagal Diinput');
                    </script>
                ";
            }
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
          <h1>Input Menu</h1>
            <hr>
              <br>

                <label for = "">NAMA TANAMAN</label><br>
                <input type = "text" name = "nama"><br>
                <label for = "">JENIS TANAMAN</label>
                <input type = "radio" name = "jenis" value = "Tanaman Hias"> Tanaman Hias <br>
                <input type = "radio" name = "jenis" value = "Tanaman Buah"> Tanaman Buah <br>
                <input type = "radio" name = "jenis" value = "Benih Tanaman"> Benih Tanaman <br>
                <label for = "">HARGA</label>
                <input type = "number" name = "harga"><br>
                <label for = "">STOK</label>
                <input type = "number" name = "stok"><br>
                <label for = "">TINGGI</label>
                <input type = "number" name = "tinggi"><br>
                <label for = "">BERAT</label>
                <input type = "number" name = "berat"><br>
                <label for = "">DESKRIPSI TANAMAN</label>
                <input type = "text" name = "tinggi"><br>
                <label for="">GAMBAR MENU</label>
                <input type="file" name = "gambar"><br><br>

               <br><input type="submit" name="kirim">
        </form>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>