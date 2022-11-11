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

// mode edit
if (isset($_GET["mode"]) && $_GET["mode"] == "edit") {
  $mode = "edit";

}

// edit profile
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];
  $telepon = $_POST['telepon'];
  $alamat = $_POST['alamat'];
  $gambar = $_POST["gambar_lama"];

  // jika konfirmasi salah, gagal edit
  if ($password != $konfirmasi) {
    echo "<script>
              alert('Konfirmasi password salah!');
              document.location.href = '?mode=edit'
            </script>";
  }

  // jika mengupload gambar baru
  if ($_FILES["gambar"]["error"] !== 4) {
    // hapus gambar lama
    unlink("img/users/$gambar");

    // ambil ekstensi
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));

    // buat nama gambar baru
    $gambar = "$username.$ekstensi";

    // pindahkan ke direktori  img/users
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "img/users/" . $gambar);
  }

  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "UPDATE users 
              SET nama='$nama',
                  psw='$password',
                  telepon='$telepon',
                  alamat='$alamat',
                  gambar='$gambar'
              WHERE username = '$username'";
  $profile = $db->query($query);

  // jika berhasil edit
  if ($profile) {
    echo "
        <script>
            alert('Profile Berhasil Diperbarui');
            document.location.href = 'index.php';
        </script>
        ";
  // jika gagal edit
  } else {
    echo "
        <script>
            alert('Profile Gagal Diperbarui');
        </script>
        ";
  }
}

// hapus profile
if (isset($_POST['hapus'])){
  $profile = mysqli_query($db, "DELETE FROM users WHERE username = '$username'");
    
  if ($profile){
    echo"
      <script>
      alert('Akun Telah Dihapus. Terimakasih atas partisipasinya!)');
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

      <section class="wrapper <?= $mode=='read' ? "read" : ""?>" style="">

        <!-- mode baca -->
        <?php if ($mode == "read") {?>
        <h1> Profile </h1>

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
            <td colspan="3">
                <a href="?mode=edit">
                  <button class="btn-block" type="submit"> Edit Profile </button>
                </a>
            </td>
          </tr>
        </table>

        <!-- mode edit -->
        <?php } else if ($mode == "edit") { ?>
        
          <h1> Edit Profile </h1>

          <form action="" method="POST" enctype="multipart/form-data" class="form-edit">
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
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input" autocomplete="off" required value=""> </td>
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
                <td> 
                  <input type="file" name="gambar" id="gambar" accept="image/*" class="form-input"> 
                  <input type="text" name="gambar_lama" value="<?=$row['gambar']?>" hidden>
                </td>
              </tr>

              <!-- submit -->
              <tr>
                <td colspan="3">
                  <center>
                    <input type="submit" value="Update Profile" name="submit" class="btn-block">
                    <input type="submit" value="Hapus Profile" name="hapus" class="btn-block"> 
                  </center>
              </td>
              </tr>

            </table>
          </form>

      </section>
      <?php } ?>
    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>