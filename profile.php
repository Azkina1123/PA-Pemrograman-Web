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

$profile = $db->query(
  "SELECT * FROM users
  WHERE username='$username'"
);
$profile = mysqli_fetch_array($profile);

if (isset($_GET["mode"]) && $_GET["mode"] == "edit") {
  $mode = "edit";
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
  
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
  
    $ekstensi = strtolower(end($x));
    $gambar_baru = "$username.$ekstensi";
  
    $tmp = $_FILES['gambar']['tmp_name'];
  
    if (move_uploaded_file($tmp, "gambar/" . $gambar_baru)) {
      $query = "INSERT INTO users(username, password, telepon, alamat, gambar) 
                      VALUES ('$username', '$password', '$telepon', '$alamat', '$gambar_baru')";
      $result = $db->query($query);
  
      if ($result) {
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
          style="background-image: url('img/users/<?= $profile["gambar"]; ?>');"></div>

          <table>
            <tr>
              <td> Username </td>
              <td> <center>:</center> </td>
              <td> <?= $profile["username"]; ?> </td> 
            </tr>
            
            <tr>
              <td> Nama Lengkap </td>
              <td> <center>:</center> </td>
              <td> <?= $profile["nama"]; ?> </td> 
            </tr>

            <tr>
              <td> No. Telepon </td>
              <td> <center>:</center> </td>
              <td> <?= $profile["telepon"]; ?> </td> 
            </tr>

            <tr>
              <td> Alamat </td>
              <td> <center>:</center> </td>
              <td> <?= $profile["alamat"]; ?> </td> 
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
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table>

              <!-- username -->
              <tr>
                <td> <label for="username"> Username* </label> </td>
                <td><center> : </center></td>
                <td> <input type="text" name="username" id="username" placeholder="Username" class="form-input" autocomplete="off" required> </td>
              </tr>

              <!-- password -->
              <tr>
                <td> <label for="password"> Password* </label> </td>
                <td><center> : </center></td>
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input" autocomplete="off" required> </td>
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
                <td> <input type="text" name="telepon" id="telepon" placeholder="No. Telepon" class="form-input" autocomplete="off" required onkeypress="return numOnly(event)" maxlength="15"> </td>
              </tr>
              
              <!-- alamat -->
              <tr>
                <td> <label for="alamat"> Alamat* </label> </td>
                <td><center> : </center></td>
                <td> <textarea name="alamat" id="alamat" cols="25" rows="5" placeholder="Alamat" class="form-input" autocomplete="off" required maxlength="100"></textarea> </td>
              </tr>

              <!-- gambar -->
              <tr>
                <td> <label for="gambar"> Foto Profil </label> </td>
                <td><center> : </center></td>
                <td> <input type="file" name="gambar" id="gambar" accept="image/*" class="form-input" value="img/plugins/user.png"> </td>
              </tr>

              <!-- submit -->
              <tr>
                <td colspan="3"> <input type="submit" value="Update Profile" name="sign_up" class="btn-block"> </td>
                <td colspan="3"> <input type="submit" value="Hapus Profile" name="sign_up" class="btn-block"> </td>
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