<?php
session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

$id = $_GET["id"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="css/order.css?v=<?= time(); ?>">

  <title> Order | Green Florist </title>
</head>

<body>
  <div class="page-wrapper user order">
    <header>
      <?php include "nav.php"; ?>
    </header>

    <div class="main-content flex">

      <section class="wrapper">

      </section>

    </div>

    <?php include "footer.php"; ?>
  </div>
</body>

</html>