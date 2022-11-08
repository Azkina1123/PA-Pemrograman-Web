<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/contact.css?v=<?= time(); ?>">

  <title> Contact | Green Florist </title>
</head>

<body>
  <div class="page-wrapper contact">

    <header class="img" style="background-image: url('img/header-contact.jpg');">
      <?php require "nav.php"; ?>
      
      <div class="banner mini center">
        <h1> CONTACT </h1>
      </div>
    </header>

    <div class="main-content">

      <section class="wrapper">
        <!-- ISI DI SINI -->
        <h2> <center>  Alamat</center></h2>
        <p> <center> Jalan. Mawar RT. 04 No. 78 Kec. Tulip Biru Kota Anggrek Plant World</center>  </p><br>

        <h2><center>Media Sosial</center></h2>
        
        <div class="row-contact flex">

            <!-- instagram -->
            <div class="contact-col center">
              <a href="#">
                <center>
                  <div class="img" style="background-image: url('img/icons/instagram.png');"></div>
                  <h3>@Green_Feel_Florist</h3>
                </center>
              </a>
            </div>
            
            <!-- whatsapp -->
            <div class="contact-col center">
              <a href="#">
                <center>
                  <div class="img" style="background-image: url('img/icons/whatsapp.png');"></div>
                  <h3>0812-3456-7890</h3>
                </center>
              </a>
            </div>
              
              <!-- email -->
            <div class="contact-col center">
              <a href="#">
                <center>
                  <div class="img" style="background-image: url('img/icons/email.png');"></div>
                  <h3>Greenfeelflorist@gmail.com</h3>
                </center>
              </a>
            </div>
        </div>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>