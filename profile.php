<?php

session_start();

require 'config.php';
if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$username = $_SESSION["username"];
$mode = "read";

$profile = $db->query("SELECT * FROM users WHERE username='$username'");
$row = mysqli_fetch_array($profile);

if (isset($_GET["mode"]) && $_GET["mode"] == "edit") {
  $mode = "edit";
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
  
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
  
    $ekstensi = strtolower(end($x));
    $gambar_baru = "$username.$ekstensi";
  
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/users/" . $gambar_baru);
  
    $query = "UPDATE users 
              SET nama='$nama',
                  psw='$password',
                  telepon='$telepon',
                  alamat='$alamat',
                  gambar='$gambar'
              WHERE username = '$username'";
    $profile = $db->query($query);

    if ($password != $konfirmasi) {
      echo "<script>
              alert('Konfirmasi password salah!');
            </script>";
      return false;
    }
  
    $password = password_hash($password, PASSWORD_DEFAULT);

    if ($profile) {
      echo "
        <script>
            alert('Profile Berhasil Diperbarui');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
      echo "
        <script>
            alert('Profile Gagal Diperbarui');
        </script>
        ";
    }
  }
}

if(isset($_POST['hapus'])){
$profile = mysqli_query($db, "DELETE FROM users WHERE username = '$username'");
    
  if($profile){
    echo"
      <script>
      alert('Akun Telah Dihapus. Terimakasih atas partisipasinya;)');
      document.location.href = 'logout.php';
      </script>
    ";
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
  <link rel="stylesheet" href="css/profile.css?v=<?= time(); ?>">

  <title> Profile | Green Florist </title>
</head>

<body>
  <div class="page-wrapper user profile">

    <header class="img" style="background-image: url('img/header-profile.jpg');">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> PROFILE </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper">

        <?php if ($mode == "read") {?>

        <div class="img" 
          style="background-image: url('img/users/<?= $row["gambar"]; ?>');">
        </div>

          <table>
            <tr>
              <td> Username </td>
              <td> <center>:</center> </td>
              <td> <?= $row["username"]; ?> </td> 
            </tr>
            
            <tr>
              <td> Nama Lengkap </td>
              <td> <center>:</center> </td>
              <td> <?= $row["nama"]; ?> </td> 
            </tr>

            <tr>
              <td> No. Telepon </td>
              <td> <center>:</center> </td>
              <td> <?= $row["telepon"]; ?> </td> 
            </tr>

            <tr>
              <td> Alamat </td>
              <td> <center>:</center> </td>
              <td> <?= $row["alamat"]; ?> </td> 
            </tr>

            <tr>
              <td>
                <a href="?mode=edit">
                  <button class="btn-block" type="submit"> Edit Profile </button>
                </a>
              </td>
            </tr>
          </table>

        <?php } else if ($mode == "edit") { ?>
        
        <div class="form-edit">
          <form action="" method="POST" enctype="multipart/form-data">
            <table>
              <!-- username -->
              <tr>
                <td> <label for="username"> Username* </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="username" id="username" placeholder="Username" class="form-input" autocomplete="off" required value=<?=$row['username']?>> </td>
              </tr>

              <!-- nama lengkap -->
              <tr>
                <td> <label for="nama"> Nama Lengkap* </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="form-input" autocomplete="off" required value="<?=$row['nama']?>"> </td>
              </tr>

              <!-- password -->
              <tr>
                <td> <label for="password"> Password* </label> </td>
                <td><center> : </center></td>
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input" autocomplete="off" required value="<?=$row['psw']?>"> </td>
              </tr>

              <!-- konfirmasi password -->
              <tr>
                <td> <label for="konfirmasi"> Konfirmasi Password* </label> </td>
                <td><center> : </center></td>
                <td> <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" class="form-input" autocomplete="off" required> </td>
              </tr>
              
              <!-- telepon -->
              <tr>
                <td> <label for="telepon"> No. Telepon* </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="telepon" id="telepon" placeholder="No. Telepon" class="form-input" autocomplete="off" required onkeypress="return numOnly(event)" maxlength="15" value="<?=$row['telepon']?>"> </td>
              </tr>
              
              <!-- alamat -->
              <tr>
                <td> <label for="alamat"> Alamat* </label> </td>
                <td><center> : </center></td>
                <td> <textarea name="alamat" id="alamat" cols="25" rows="5" placeholder="Alamat" class="form-input" autocomplete="off" required maxlength="100"><?=$row['alamat']?></textarea> </td>
              </tr>

              <!-- gambar -->
              <tr>
                <td> <label for="gambar"> Foto Profil </label> </td>
                <td><center> : </center></td>
                <td> <input type="file" name="gambar" id="gambar" accept="image/*" class="form-input" value="img/plugins/user.png"> </td>
                <input type="text" name="gambar_lama" value="<?=$row['gambar']?>" hidden>
              </tr>

              <!-- submit -->
              <tr>
                <td colspan="3"><input type="submit" value="Update Profile" name="submit" class="btn-block"> </td>
                <td colspan="3"><input type="submit" value="Hapus Profile" name="hapus" class="btn-block"> </td>
              </tr>

            </table>
          </form>
        </div>
      </section>
      <?php } ?>
    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>