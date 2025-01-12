-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2025 at 05:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_royal`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id` int NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `product_id` int NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_awal` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `total_harga_awal` decimal(10,2) DEFAULT NULL,
  `total_harga_jual` decimal(10,2) DEFAULT NULL,
  `laba` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` enum('pending','confirmed','batal') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `alamat`, `metode_pembayaran`, `status`) VALUES
(102, 19, '2025-01-11 10:07:06', 'kowang', 'transfer', 'batal');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(123, 102, 117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodact`
--

CREATE TABLE `prodact` (
  `id` int NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `harga_awal` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` enum('Makanan','Minuman') NOT NULL,
  `stok` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prodact`
--

INSERT INTO `prodact` (`id`, `nama_barang`, `harga`, `harga_awal`, `gambar`, `deskripsi`, `kategori`, `stok`) VALUES
(114, 'Ayam Geprek', 10000, 9000, 'ayamgeprek.png', 'nasi dan ayam yang dikasih sambal pedas', 'Makanan', 50),
(116, 'Ayam Asam Manis', 12000, 10000, 'ayamasamanis.jpg', 'Ayam yang diberikan bumbu dengan rasa asam manis', 'Makanan', 20),
(117, 'Ayam Bakar', 12000, 10000, 'ayambakar.jpg', 'Ayam yang dipanggang diatas bara api dengan tumpahan sedikit kecap manis  ', 'Makanan', 20),
(118, 'Ayam Goreng', 12000, 11000, 'ayamgoreng.jpg', 'Ayam yang digoreng kering nan renyah', 'Makanan', 15),
(119, 'Ayam Mozarella', 15000, 13000, 'ayammozarella.jpg', 'Ayam dengan taburan krim', 'Makanan', 10),
(120, 'Balungan', 10000, 9000, 'balungan.jpg', 'Berisi tulang-tulang ayam dengan bumbu pedas', 'Makanan', 5),
(121, 'Ayam Crispy', 10000, 9000, 'bg-ayamcrispy.jpg', 'Ayam yang digoreng dengan tepung terigu ', 'Makanan', 10),
(122, 'Drum Stick', 12000, 10000, 'drumstick.jpg', 'Ayam digoreng dengan tepung terigu ', 'Makanan', 20),
(123, 'Pedesan Bakso', 15000, 10000, 'pedesanbakso.jpg', 'Baso yang diberikan bumbu extra pedas', 'Makanan', 20),
(124, 'Otak-Otak', 10000, 8000, 'otakotak.jpg', 'Makanan khas pribumi', 'Makanan', 50),
(125, 'Pedesan Ceker', 10000, 9000, 'pedesanceker.jpg', 'Ceker ayam yang dibaluri bumbu pedas', 'Makanan', 10),
(126, 'Seblak', 15000, 10000, 'seblak.jpg', 'Seblak parasman ', 'Makanan', 100),
(127, 'Air Mineral', 3000, 2500, 'pristine.jpg', 'Air putih asli', 'Minuman', 50),
(128, 'Pop Ice', 5000, 2000, 'popice.jpg', 'Minuman saset yang ditambahkan beberapa toping', 'Minuman', 100),
(129, 'Kopi Good Day', 5000, 2500, 'goodday.jpg', 'Minuman kopi', 'Minuman', 20),
(130, 'Es Teh', 3000, 2000, 'es teh.jpg', 'Minuman es teh manis', 'Minuman', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int NOT NULL,
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reply_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `alamat`, `nomor_hp`) VALUES
(1, 'Admin', 'admin', '$2y$10$wmZNRURKR1n5HXmTMdyai.3rKQVKK9wnXlNgIGJ4dQKisXJP4qHSS', 'admin', 'Surabaya, Jawa Timur', '085806429735'),
(17, 'Dimas Prasetyo', 'Dimas', '$2y$10$hmGLRZfaQX4qJukK2YP/HeEQJvnqhATqpXqRoPxoBAVYfhz9/UrlW', 'customer', 'Subang, Jawa Barat', '086789878765'),
(18, 'adji', 'aji', '$2y$10$Lv/57xuFJDxV2TOYgL1fcuachw/PAPJTbMDXLAPv1m63k.L3caHBq', 'customer', 'kedawung', '089678456'),
(19, 'adji', 'adji', '$2y$10$I8cUNiFjLzSrRkiTV8X7EurNx0vdmbTsjnDNkHJ7Kp6DVA4GFGxma', 'customer', 'kowang', '084549857332'),
(20, 'ester', 'edy', '$2y$10$Ks.AYMPTE0O.TO7Sfj4SQOSOCrRYAiWdAaCUeIH0zKE14SkMyLBsi', 'customer', 'Subang, Jawa Barat', '08098575447');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_details_ibfk_2` (`product_id`);

--
-- Indexes for table `prodact`
--
ALTER TABLE `prodact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_komen` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `prodact`
--
ALTER TABLE `prodact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `prodact` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `prodact` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `ulasan` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `fk_komen` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
