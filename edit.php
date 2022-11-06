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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $result = mysqli_query($db, 
        "SELECT * FROM produk WHERE id='$id'");
    $row = mysqli_fetch_array($result);

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
            $query =    "UPDATE produk SET 
                            nama='$nama',
                            jenis='$jenis',
                            harga='$harga', 
                            stok='$stok', 
                            tinggi='$tinggi',
                            berat='$berat',
                            deskripsi='$deskripsi',
                            gambar='$gambar_baru'
                        WHERE id='$id'";
            $result = $db->query($query);
    
            if($result)
            {
                echo "
                    <script>
                        alert('Produk Berhasil Diperbarui');
                        document.location.href = 'index.php';
                    </script>
                ";
            }else
            {
                echo "
                    <script>
                        alert('Produk Gagal Diperbarui');
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

          <form action = "" method = "post" enctype = "multipart/form-data">
            <h1><center>Edit Product</center></h1>
              <hr>
                <br>

                  <label for = "">NAMA TANAMAN</label><br>
                  <input type = "text" name = "nama" value=<?=$row['nama']?>><br>
                  <label for = "">JENIS TANAMAN</label><br>
                  <input type = "radio" name = "jenis" value="Tanaman Hias"<?=$row['jenis']?>> Tanaman Hias
                  <input type = "radio" name = "jenis" value="Tanaman Buah"<?=$row['jenis']?>> Tanaman Buah
                  <input type = "radio" name = "jenis" value="Benih Tanaman"<?=$row['jenis']?>> Benih Tanaman<br>
                  <label for = "">HARGA</label><br>
                  <input type = "number" name = "harga" value=<?=$row['harga']?>><br>
                  <label for = "">STOK</label><br>
                  <input type = "number" name = "stok" value=<?=$row['stok']?>><br>
                  <label for = "">TINGGI</label><br>
                  <input type = "float" name = "tinggi" value=<?=$row['tinggi']?>><br>
                  <label for = "">BERAT</label><br>
                  <input type = "float" name = "berat" value=<?=$row['berat']?>><br>
                  <label for = "">DESKRIPSI TANAMAN</label><br>
                  <input type = "text" name = "deskripsi" value=<?=$row['deskripsi']?>><br>
                  <label for="">GAMBAR MENU</label><br>
                  <input type = "file" name = "gambar" value=<?=$row['gambar']?>><br>

                <br><center><button a class = "links" name = "kirim" href = "">Submit<br></button></center>
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