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
  <link rel="stylesheet" href="css/cart.css?v=<?= time(); ?>">

  <title> Cart | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper user cart">

    <header class="img" style="background-image: url('img/header-cart.jpg');">

      <?php require "nav.php"; ?>

      <div class="banner mini center">
        <h1> CART </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="searching">
          <form action="">
            <input type="search" name="search" placeholder="Search" class="form-input">
            <input type="submit" value="Cari" class="btn-block">
          </form>
        </div>

        <p> Hasil pencarian: tanaman. </p>
        <br>


        <form action="">
        <div class="list-products">


            <table border="0" cellspacing="0">
              <tr>
                <th colspan="2"> Produk </th>
                <th width="20%"> Jumlah </th>
              </tr>
  
              <tr>
                <td width="5%">
                  <center> <input type="checkbox" name="" id="produk"> </center>
                </td>
  
                <td>
                  <label for="produk">
                    <a href="" class="link left product">
                    <div class="img" style="background-image: url('img/products/1.jpg');"></div>
                    
                      <div class="deskripsi">
                        <p> <b>Judul Tanaman Panjang Kali Lebar </b> </p>
                        <p> Rp 12500 </p>
                      </div>
                    </a>
                  </label>
                </td>
  
                <td>
                  <center> <input type="number" name="" id="" value="12" class="form-input jumlah"> </center>
                </td>
  
              </tr>
  
              <tr>
                <td width="5%">
                  <center> 
                    <input type="checkbox" name="" id="produk"> 
                    <span class="checkmark"></span>
                  </center>
  
                </td>
  
                <td>
                  <a href="" class="link left product">
                    <div class="img" style="background-image: url('img/products/1.jpg');"></div>
  
                    <div class="deskripsi">
                      <p> <b>Judul Tanaman Panjang Kali Lebar </b> </p>
                      <p> Rp 12500 </p>
                    </div>
                  </a>
                </td>
  
                <td>
                  <center> <input type="number" name="" id="" value="12" class="form-input jumlah"> </center>
                </td>
  
              </tr>
            </table>
            
        </div>

        
      </section>
      
      <section>
        
        <div class="wrapper total_harga">
          <button class="btn-block"> Beli Sekarang </button>
          <p>Rp 12500</p>
        </div>

      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/jquery.js?v=<?= time(); ?>"></script>
  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>