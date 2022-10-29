<?php

session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap masuk sebagai user/admin terlebih dahulu!');
          document.location.href = 'sign-in.php?login=User';
        </script>";
}

session_unset();
session_destroy();

echo "<script>
        alert('Terima kasih telah menggunakan website.');
        document.location.href = 'index.php';
      </script>";

?>