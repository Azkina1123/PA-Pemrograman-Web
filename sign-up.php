<?php

require "config.php";

if (isset($_POST["sign_up"])) {

  // jika berhasil registrasi
  if (signing_up()) {
    echo "<script>
            document.location.href = 'sign-in.php';
          </script>";
  }

  // jika gagal registrasi
  header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/sign-in.css?v=<?= time(); ?>">
  <link rel="shortcut icon" href="img/icons/icon.png" type="image/x-icon">

  <title> Daftar Akun | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper sign-up">

    <header class="img" style="background-image: url('img/header-sign-up.jpg'); ">
      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> SIGN UP </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper center">

        <div class="sign-in-box">
          <h1> Daftar Akun sebagai User </h1>

          <form action="" method="POST" enctype="multipart/form-data">
            <table cellspacing="20">

              <!-- username -->
              <tr>
                <td> <label for="username"> Username* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="text" name="username" id="username" placeholder="Username" class="form-input" autocomplete="off" required> </td>
              </tr>

              <!-- nama lengkap -->
              <tr>
                <td> <label for="nama"> Nama Lengkap* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="form-input" autocomplete="off" required> </td>
              </tr>

              <!-- password -->
              <tr>
                <td> <label for="password"> Password* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="password" name="password" id="password" placeholder="Password" class="form-input" autocomplete="off" required> </td>
              </tr>
              <!-- konfirmasi password -->
              <tr>
                <td> <label for="konfirmasi"> Konfirmasi Password* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" class="form-input" autocomplete="off" required> </td>
              </tr>

              <!-- telepon -->
              <tr>
                <td> <label for="telepon"> No. Telepon* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="text" name="telepon" id="telepon" placeholder="No. Telepon" class="form-input" autocomplete="off" required onkeypress="return numOnly(event)" maxlength="15"> </td>
              </tr>

              <!-- alamat -->
              <tr>
                <td> <label for="alamat"> Alamat* </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <textarea name="alamat" id="alamat" cols="25" rows="5" placeholder="Alamat" class="form-input" autocomplete="off" required maxlength="100"></textarea> </td>
              </tr>

              <!-- gambar -->
              <tr>
                <td> <label for="gambar"> Foto Profil </label> </td>
                <td>
                  <center> : </center>
                </td>
                <td> <input type="file" name="gambar" id="gambar" accept="image/*" class="form-input" value="img/plugins/user.png"> <br> Max size: 200 KB</td>
              </tr>

              <!-- submit -->
              <tr>
                <td colspan="3"> <input type="submit" value="Daftarkan Akun" name="sign_up" class="btn-block"> </td>
              </tr>

              <!-- sign in -->
              <tr>
                <td colspan="3">
                  <a href="sign-in.php" class="link">
                    <center> Sudah punya akun? <br> Masuk sekarang! </center>
                  </a>
                </td>
              </tr>

            </table>

          </form>

        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>