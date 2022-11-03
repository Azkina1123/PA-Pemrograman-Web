<?php

session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/pembayaran.css?v=<?= time(); ?>">

  <title> Formulir Pembayaran | Green Florist </title>
</head>
<body>

  <div class="page-wrapper user pembayaran">
    <header>
      <?php include "nav.php"; ?>
    </header>

    <div class="main-content">
      <section class="wrapper">

        <form action="" method="POST">
          <table border="1" cellspacing="0">
            <tr>
              <td> Penerima </td>
              <td> <center>:</center> </td>
              <td> Nama </td>
            </tr>
            <tr>
              <td> Alamat Penerima </td>
              <td> <center>:</center> </td>
              <td> alamat panjang kali lebar </td>
            </tr>
            <tr>
              <td> Produk </td>
              <td> <center>:</center> </td>
              <td>
                <ol>
                  <li> Ayam Geprek </li>
                  <li> AHAHAH </li>
                </ol>
              </td>
            </tr>
          </table>

        </form>

      </section>

    </div>


    
    <?php include "footer.php"; ?>
  </div>
  
</body>
</html>