-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 11:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `green_florist`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_user`
--

CREATE TABLE `keranjang_user` (
  `waktu` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `selected` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang_user`
--

INSERT INTO `keranjang_user` (`waktu`, `username`, `id_produk`, `jumlah`, `selected`) VALUES
('2022-11-11 03:46:46', 'soobin', 10, 1, 0),
('2022-11-11 03:46:49', 'soobin', 4, 1, 0),
('2022-11-11 03:46:54', 'soobin', 9, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `status_pesanan` varchar(50) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `telepon_penerima` varchar(15) NOT NULL,
  `alamat_penerima` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal`, `username`, `total_pembayaran`, `status_pesanan`, `nama_penerima`, `telepon_penerima`, `alamat_penerima`) VALUES
('1ROE3GHZMS0', '2022-11-11 03:40:45', 'pokemon', 96000, 'telah dikirim', 'Pokemon', '08187654321', 'Jl. Pokemon Kuning Blok A1 Samarinda Utara '),
('7B3NTWEISO1', '2022-11-11 03:42:36', 'merlin', 122000, 'telah dikirim', 'Merlin', '08129384756', 'Jl. Melati Biru Gg. 8B Samarinda Ilir '),
('AQK9JXP8DN3', '2022-11-11 03:44:10', 'soobin', 127400, 'sedang dikemas', 'Choi Soobin', '081243564487', 'Jl. Korea Selatan Barat Blok C Kompleks 7x7 '),
('FVU4WHYSNP4', '2022-11-11 03:46:24', 'soobin', 8000, 'sedang dikemas', 'Choi Soobin', '081243564487', 'Jl. Korea Selatan Barat Blok C Kompleks 7x7 '),
('ZPQWMUAT302', '2022-11-11 03:43:25', 'merlin', 67500, 'sedang dikemas', 'Merlin', '08129384756', 'Jl. Melati Biru Gg. 8B Samarinda Ilir ');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tinggi` float NOT NULL,
  `berat` float NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `tanggal_rilis`, `nama`, `jenis`, `harga`, `stok`, `tinggi`, `berat`, `deskripsi`, `gambar`) VALUES
(1, '2022-11-06', 'Bibit Mangga Manalagi', 'tanaman buah', 15000, 32, 1, 8.4, 'Bibit mangga jenis manalagi berkualitas tinggi. Sudah terjamin akan menghasilkan buah mangga manis.', '1.jpg'),
(2, '2022-11-06', 'Benih Cabe Rawit', 'benih tanaman', 5500, 45, 0, 0.3, 'Benih cabe rawit yang menghasilkan cabe pedas. Memerlukan perawatan yang teratur agar dapat tumbuh d', '2.jpg'),
(3, '2022-11-06', 'Benih Bayam Unggul Benua', 'benih tanaman', 36000, 21, 0, 0.5, 'Bentuk daun bulat dengan warna hijau muda. Tidak mudah keluar bunga. Dapat dipanen pada umur 25 hari', '3.jpg'),
(4, '2022-11-07', 'Bibit Tanaman Anggrek', 'tanaman hias', 13500, 11, 0.7, 0.2, 'Bibit anggrek asli dendrobium yang berkualitas. Perawatan cukup mudah.', '4.jpg'),
(5, '2022-11-07', 'Bibit Tanaman Alpukat', 'tanaman buah', 30000, 27, 1.2, 0.5, 'Bibit merupakan hasil okulasi. Dijamin bibit super unggul.', '5.jpg'),
(6, '2022-11-07', 'Bibit Tanaman Pisang', 'tanaman buah', 32000, 21, 0.5, 1.5, 'Bibit tanaman pisang raja asli. Cepat tumbuh bila dirawat dengan teratur. Perawatan tidak sulit. Pas', '6.jpg'),
(7, '2022-11-07', 'Lumut Ambon', 'tanaman hias', 20000, 28, 0.4, 0.2, 'Tanaman hias lumut ambon. Cocok sebagai tanaman indoor maupun outdoor. Tidak perlu perawatan yang ke', '7.jpg'),
(8, '2022-11-07', 'Flumosa Cluster', 'tanaman hias', 200000, 54, 0.12, 0.8, 'Tanaman cocok di media pot dan memiliki bentuk unik berwarna putih. Sangat cocok di tempat panas.', '8.jpg'),
(9, '2022-11-08', 'Benih Buah Naga', 'benih tanaman', 15000, 44, 0.4, 0.2, 'Benih tanaman buah naga yang dijamin menghasilkan buah naga berkualitas tinggi.', '9.jpg'),
(10, '2022-11-08', 'Bibit Jambu Kristal', 'tanaman buah', 73900, 30, 0.5, 3, 'Bibit hasil cangkok dan sebagian okulasi. Produksi buah dalam sekali berbuah dapat menghasilkan 15-3', '10.png'),
(11, '2022-11-08', 'Benih Jagung BISI 18 Hibrida', 'benih tanaman', 115000, 29, 0, 1, 'Benih jagung kemasan BISI 18 Hibrida Cap Kapal Terbang asli. Lebih murah dari toko lainnya.', '11.jpg'),
(12, '2022-11-08', 'Lili Varighata', 'tanaman hias', 2500, 36, 0.2, 0.2, 'Tanaman hias ini bisa untuk hiasan di aquarium karena bisa di tanam di air. Cocok untuk tanaman indo', '12.jpg'),
(13, '2022-11-11', 'Ararea', 'tanaman hias', 3000, 37, 0.13, 1.3, 'Tanaman hias ararea dalam keadaan sehat, segar dan aman. Tanaman hias yang dikirim sesuai dengan fot', 'product-13.webp'),
(14, '2022-11-11', 'Helikornia', 'tanaman hias', 28000, 49, 0.7, 0.5, 'Tanaman hias yang cocok untuk tanaman outdoor rumah Anda.', 'product-14.jpg'),
(15, '2022-11-11', 'Bibit Buah Markisa', 'tanaman buah', 10500, 43, 0.6, 1.2, 'Tempatkan pada tempat yang teduh/terlindungi dari sinar matahari selama seminggu.', 'product-15.webp'),
(16, '2022-11-11', 'Benih Selada', 'benih tanaman', 4000, 63, 0, 0.1, 'Dapat tumbuh di dataran rendah maupun dataran tinggi. Bisa ditanam hidroponik maupun di tanah.', 'product-16.png');

-- --------------------------------------------------------

--
-- Table structure for table `produk_terbeli`
--

CREATE TABLE `produk_terbeli` (
  `id_pesanan` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_terbeli`
--

INSERT INTO `produk_terbeli` (`id_pesanan`, `id_produk`, `jumlah`, `harga`) VALUES
('1ROE3GHZMS0', 6, 3, 32000),
('7B3NTWEISO1', 5, 1, 30000),
('7B3NTWEISO1', 14, 3, 28000),
('7B3NTWEISO1', 16, 2, 4000),
('ZPQWMUAT302', 2, 3, 5500),
('ZPQWMUAT302', 3, 1, 36000),
('ZPQWMUAT302', 9, 1, 15000),
('AQK9JXP8DN3', 10, 1, 73900),
('AQK9JXP8DN3', 4, 1, 13500),
('AQK9JXP8DN3', 7, 2, 20000),
('FVU4WHYSNP4', 16, 2, 4000);

--
-- Triggers `produk_terbeli`
--
DELIMITER $$
CREATE TRIGGER `user_beli` AFTER INSERT ON `produk_terbeli` FOR EACH ROW UPDATE produk SET 
   produk.stok  = produk.stok - NEW.jumlah
   WHERE produk.id = NEW.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama`, `psw`, `telepon`, `alamat`, `gambar`) VALUES
('merlin', 'Merlin', '$2y$10$0KEtkAfzO59mWjW3feXB5ODw7idozojo5v3fJoTc0pPVLZcziAGYK', '08129384756', 'Jl. Melati Biru Gg. 8B Samarinda Ilir', 'merlin.jpg'),
('pokemon', 'Pokemon', '$2y$10$j2I3HeyKLeuE2eaz/45/Z.GL9SrvqJIyCRt0CeKQMARdw1cq8l7J6', '08187654321', 'Jl. Pokemon Kuning Blok A1 Samarinda Utara', 'pokemon.jpg'),
('soobin', 'Choi Soobin', '$2y$10$aFVOZQRKGZoqxdrD7TnjM.6cLadC85Kyi6pUCjWuuT3hpnvbDIc1m', '081243564487', 'Jl. Korea Selatan Barat Blok C Kompleks 7x7', 'soobin.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang_user`
--
ALTER TABLE `keranjang_user`
  ADD KEY `keranjang_user_ibfk_1` (`username`),
  ADD KEY `keranjang_user` (`id_produk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_terbeli`
--
ALTER TABLE `produk_terbeli`
  ADD KEY `produk_terbeli_ibfk_1` (`id_produk`),
  ADD KEY `produk_terbeli_ibfk_2` (`id_pesanan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang_user`
--
ALTER TABLE `keranjang_user`
  ADD CONSTRAINT `keranjang_user` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `produk_terbeli`
--
ALTER TABLE `produk_terbeli`
  ADD CONSTRAINT `produk_terbeli_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_terbeli_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
