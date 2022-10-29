<?php

session_start();
session_unset();
session_destroy();

echo "<script>
        alert('Terima kasih.');
      </script>";
header("Location: index.php");

?>