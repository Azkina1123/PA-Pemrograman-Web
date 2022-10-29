<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">

  <title> Edit Product | Nama Toko </title>
</head>

<body>
  <div class="page-wrapper home-page user">

    <header class="img" style="background-image: url('img/header-edit.jpg');">

      <?php require "nav-admin.php"; ?>

      <div class="banner mini center">
        <h1> EDIT PRODUCT </h1>

      </div>

    </header>

    <div class="main-content">

      <section class="wrapper">

        <div class="searching">
          <input type="search" name="search" placeholder="Search" class="form-input">
          <input type="submit" value="Cari" class="btn-block">
        </div>

        <p> Hasil pencarian: tanaman. </p>


      </section>

    </div>

    <?php require "footer.php"; ?>

  </div>

  <script src="js/style.js?v=<?= time(); ?>"></script>

</body>

</html>