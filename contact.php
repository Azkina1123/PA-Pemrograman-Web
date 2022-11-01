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
        <p>Jalan. Mawar no. 12</p><br>

        <h2>Media Sosial</h2>
        <h3>Instagram</h3> <p>@Green_Feel_Florist</p>
        <h3>Whatsapp</h3> <p>0812-3456-7890</p>
        <h3>Email</h3> <p>Greenfeelflorist@gmail.com</p>
      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>
</body>

</html>