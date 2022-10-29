<?php

$db = new mysqli("localhost", "root", "", "green_florist");

if (!$db) {
  die ("Gagal terhubung! ". $db->connect_error);
}

/* ==================== PROSES HALAMAN ==================== */

// daftar akun user baru
function signing_up() {
  global $db;

  $username = $_POST["username"];
  $password = $_POST["password"];
  $konfirmasi = $_POST["konfirmasi"];
  $telepon = $_POST["telepon"];
  $alamat = $_POST["alamat"];
  $gambar = "$username.png";
  
  // cek apakah username sudah digunakan
  $result = $db->query(
    "SELECT username FROM users
     WHERE username='$username'"
  );
  
  // jika username sudah ada
  if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Username telah digunakan!');
          </script>";
    return false;
  }

  // jika password != konfirmasi
  if ($password != $konfirmasi) {
    echo "<script>
            alert('Konfirmasi password salah!');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // jika tidak ada upload gambar
  if ($_FILES["gambar"]["error"] === 4) {

    // pakai gambar default
    copy("img/plugins/user.png", "img/users/$gambar");
  
  // jika upload gambar
  } else {
    $gambar = image_uploaded($username);

    // jika gagal upload gambar
    if (!$gambar) {
      return false;
    }
  
    // pindahkan gambar ke direktori baru
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "img/users/$gambar");
  }

  // tambahkan akun baru ke database
  $result = $db->query(
    "INSERT INTO users
     VALUES ('', '$username', '$password', '$telepon', '$alamat', '$gambar')"
  );

  // jika gagal masuk ke database
  if (!$result) {
    echo "<script>
      alert('Proses registrasi gagal!');
    </script>";
    return false;
  }

  // jika berhasil masuk ke database
  echo "<script>
          alert('Proses registrasi berhasil!');
        </script>";
  return true;
}

// masuk akun user
function signing_in() {
  global $db;

  $username = $_POST["username"];
  $password = $_POST["password"];

  // cari akun di database
  $result = $db->query(
    "SELECT * FROM users
     WHERE username='$username'"
  );

  // jika akun tidak ditemukan
  if (mysqli_num_rows($result) == 0) {
    echo "<script>
            alert('Username tidak terdaftar!');
          </script>";
    return false;
  }
  
  $akun = mysqli_fetch_array($result);
  
  // jika password salah
  if (!password_verify($password, $akun["psw"])) {
    echo "<script>
            alert('Password yang Anda masukkan salah!');
          </script>";
    return false;
  }

  echo "<script>
          alert('Proses masuk berhasil!');
        </script>";
  return true;

}

/* =================== FUNGSI TAMBAHAN ==================== */

function image_uploaded($value) {
  $nama = $_FILES["gambar"]["name"];
  $size = $_FILES["gambar"]["size"];

  // jika ukuran file > 200 kb
  if ($size > 200000) {
    echo "<script>
            alert('Ukuran gambar maksimal 500 KB!');
         </script>";
    return false;
  }

  // pisahkan ekstensi file
  $pisah_titik = explode(".", $nama);
  $ekstensi = end($pisah_titik);

  // buat nama baru
  $nama = "$value.$ekstensi";

  return $nama;
}



?>