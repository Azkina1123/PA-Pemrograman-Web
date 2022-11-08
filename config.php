<?php

$db = new mysqli("localhost", "root", "", "green_florist");

if (!$db) {
  die ("Gagal terhubung! ". $db->connect_error);
}

date_default_timezone_set("Asia/Singapore");

/* ==================== PROSES HALAMAN ==================== */

// daftar akun user baru
function signing_up() {
  global $db;

  $username = $_POST["username"];
  $nama = $_POST["nama"];
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
    copy("img/icons/user.png", "img/users/$gambar");
  
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
     VALUES ('$username', '$nama', '$password', '$telepon', '$alamat', '$gambar')"
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

function delete_product() {
  global $db;

  $id = $_GET["id"];

  // hapus gambar
  $prev_img = $db->query(
    "SELECT gambar FROM produk
    WHERE id=$id"
  );
  $prev_img = mysqli_fetch_array($prev_img);
  $prev_img = $prev_img[0];
  var_dump($prev_img);

  unlink("img/products/$prev_img");

  // hapus data produk dari database
  $result = $db->query(
    "DELETE FROM produk WHERE id='$id'"
  );

  if (!$result) {
    echo "<script>
            alert('Produk gagal dihapus!');
          </script>";
    return false;
  }

  echo "<script>
            alert('Produk berhasil dihapus.');
          </script>";
  return true;
}

function add_to_cart() {
  global $db;

  $username = $_SESSION["username"];
  $id_produk = $_POST["id"];
  $jumlah = $_POST["jumlah"];
  $tanggal = date("Y-m-d h:i:s");

  $keranjang = $db->query(
    "SELECT * FROM keranjang_user
    WHERE username='$username' AND id_produk=$id_produk"
  );

  if (mysqli_num_rows($keranjang) == 0) {
    $result = $db->query(
      "INSERT INTO keranjang_user
      VALUES ('$tanggal', '$username', '$id_produk', $jumlah)"
    );

  } else {
    $result = $db->query(
      "UPDATE keranjang_user
      SET waktu='$tanggal',
          jumlah=$jumlah
      WHERE username='$username' AND id_produk=$id_produk"
    );
  }

  if (!$result) {
    echo "<script>
          alert('Gagal memasukkan produk ke keranjang!');
        </script>";
        return false;
  }
      
  echo "<script>
          alert('Produk berhasil dimasukkan ke keranjang!');
        </script>";
  return true;

}

function order_product($products) {
  global $db;

  $id_pesanan = get_id_pesanan();
  $username = $_SESSION["username"];
  $tanggal = $_POST["tanggal"];
  $total_pembayaran = $_POST["total_pembayaran"];
  $status = "Sedang Dikemas";

  // tambah pesanan
  $result = $db->query(
    "INSERT INTO pesanan
     VALUES ('$id_pesanan', '$tanggal', '$username', $total_pembayaran, '$status')"
  );

  if (!$result) {
    echo "<script>
          alert('Transaksi gagal!');
        </script>";
    return false;
  }

  // masukkan ke tabel list produk terbeli utk 1 pesanan
  foreach ($products as $product) {
    $id = $product["id_produk"];
    $jumlah = $product["jumlah"];
    $harga = $product["harga"];

    $result = $db->query(
      "INSERT INTO produk_terbeli
       VALUES ('$id_pesanan', '$id', $jumlah, $harga)"
    );

  }

  return true;
}

/* =================== FUNGSI TAMBAHAN ==================== */

function image_uploaded($value) {
  $nama = $_FILES["gambar"]["name"];
  $size = $_FILES["gambar"]["size"];

  // jika ukuran file > 200 kb
  if ($size > 200000) {
    echo "<script>
            alert('Ukuran gambar maksimal 200 KB!');
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

function get_id_pesanan() {
  global $db;

  $pesanan = $db->query(
    "SELECT id FROM pesanan"
  );

  $banyak_pesanan = mysqli_num_rows($pesanan);
  $nomor_pesanan = "$banyak_pesanan";

  $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $sub = 10 - strlen($nomor_pesanan) + 1;
  $random = substr(str_shuffle($chars), 0, $sub);

  $kode_pesanan = $random . $nomor_pesanan;
  return $kode_pesanan;
}


?>