<?php

session_start();

require "config.php";

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=Admin';
        </script>";
}

if (delete_product()) {
  echo "<script>document.location.href = 'products.php?mode=edit'</script>";
}

die;

?>