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

  <title> Contact | Nama Toko </title>
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
        <h2>Alamat</h2>
        <p>Jalan. Mawar RT. 04 No. 78 Kec. Tulip Biru Kota Anggrek Plant World </p><br>

        <!-- <h1 class="title-brown-bg">CONTACT</h1>
    <section class="contact">
        <div class="row-contact">
            <div class="contact-col">
                <div class="card-contact">
                    <a href=" https://www.instagram.com/mchls._"><img src="image/instagram.png"></a>
                    <h3 class="title-white-bg">Instagram</h3>
                </div>
            </div>
            <div class="contact-col">
                <div class="card-contact">
                    <a href="https://api.whatsapp.com/send/?phone=6281350502003&text&type=phone_number&app_absent=0"><img src="image/whatsapp.png"></a>
                    <h3 class="title-white-bg">WhatsApp</h3>
                </div>
            </div>
            <div class="contact-col">
                <div class="card-contact">
                    <a href="https://youtu.be/dQw4w9WgXcQ"><img src="image/youtube.png"></a>
                    <h3 class="title-white-bg">Youtube</h3>
                </div>
            </div>
        </div>
    </section> -->

        <h2>Media Sosial</h2>
        <img src ="img/icons/instagram.png" width = 100px><p>@Green_Feel_Florist</p>
        <img src ="img/icons/whatsapp.png" width = 100px> <p>0812-3456-7890</p>
        <img src ="img/icons/email.png" width = 110px> <p>Greenfeelflorist@gmail.com</p>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>