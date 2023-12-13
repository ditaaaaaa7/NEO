-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2023 pada 19.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_detail`
--

CREATE TABLE `item_detail` (
  `detail_id` int(30) NOT NULL,
  `id_po` int(30) DEFAULT NULL,
  `item` int(15) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item_detail`
--

INSERT INTO `item_detail` (`detail_id`, `id_po`, `item`, `qty`, `unit`, `cost`, `total_price`) VALUES
(26, 16, 6, 30, 'kg', 32000.00, 960000.00),
(27, 16, 7, 30, 'kg', 28000.00, 840000.00),
(28, 17, 8, 5, 'pack', 50000.00, 250000.00),
(29, 17, 9, 5, 'pack', 75000.00, 375000.00),
(30, 17, 10, 5, 'pack', 55000.00, 275000.00),
(31, 17, 11, 5, 'pack', 55000.00, 275000.00),
(32, 18, 44, 5, 'pcs', 6500.00, 32500.00),
(33, 18, 45, 5, 'pcs', 6500.00, 32500.00),
(34, 18, 46, 24, 'pcs', 9000.00, 216000.00),
(35, 18, 47, 18, 'pcs', 7500.00, 135000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_list`
--

CREATE TABLE `item_list` (
  `item_id` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `item_list`
--

INSERT INTO `item_list` (`item_id`, `name`, `unit`, `type`, `cost`) VALUES
(1, 'baking powder kupu kupu', 'pcs', 'food', 7000),
(2, 'Soap NEO @250 pcs', 'pack', 'aminities', 200000),
(3, 'lada bubuk kupu-kupu', 'pcs', 'food', 8500),
(5, 'vanilla cap kupu kupu', 'pcs', 'food', 10000),
(6, 'Ayam Broiler', 'kg', 'food', 32000),
(7, 'Telur Ayam', 'kg', 'food', 28000),
(8, 'NEO Sugar Stick @250 pcs', 'pack', 'aminities', 50000),
(9, 'NEO Sugar Brown Stick @250 pcs', 'pack', 'aminities', 75000),
(10, 'NEO Creamer Stick @250 pcs', 'pack', 'aminities', 55000),
(11, 'NEO Sweetener Stick @250 pcs', 'pack', 'aminities', 55000),
(12, 'Dental Kit NEO @250 pcs', 'pack', 'aminities', 200000),
(13, 'Shower Cap NEO @250 pcs', 'pack', 'aminities', 100000),
(14, 'Cotton Bud @250 pcs', 'pack', 'aminities', 100000),
(15, 'LIVI EVO Napkin @72 pcs', 'pack', 'aminities', 310000),
(16, 'LIVI EVO Toilet @100 pcs', 'pack', 'aminities', 190000),
(17, 'LIVI EVO Multifold @24 pcs', 'pack', 'aminities', 160000),
(18, 'Boneless Dada Ayam', 'kg', 'food', 45000),
(19, 'Dinner Napkin NEO @100 pcs', 'pack', 'aminities', 400000),
(20, 'Teh Celup Sosro Black Tea', 'pcs', 'baverage', 19500),
(21, 'Nescafe Classic @60 pcs', 'pack', 'baverage', 35000),
(22, 'Kopi Tubruk Robusta', 'pcs', 'baverage', 85000),
(23, 'Bubuk Avocado Milk', 'pcs', 'baverage', 75000),
(24, 'Bubuk Buble Gum', 'pcs', 'baverage', 75000),
(25, 'Bubuk Green Milk Tea', 'pcs', 'baverage', 75000),
(26, 'Bubuk Thai Milk Tea', 'pcs', 'baverage', 75000),
(27, 'Bubuk Red Velvet Latte', 'pcs', 'baverage', 75000),
(28, 'Bubuk Taro Latte', 'pcs', 'baverage', 75000),
(29, 'Caramel Syrup', 'pcs', 'baverage', 110000),
(30, 'Lychee Syrup', 'pcs', 'baverage', 110000),
(31, 'Gula Aren Syrup', 'pcs', 'baverage', 110000),
(32, 'SKM Cap Enak', 'can', 'baverage', 11500),
(33, 'Permen Kopiko', 'pcs', 'food', 8500),
(34, 'Permen Mentos', 'pcs', 'food', 7000),
(35, 'Buavita Mango', 'pcs', 'baverage', 9000),
(36, 'Buavita Orange', 'pcs', 'baverage', 9000),
(37, 'Air Mineral Galon @18 ltr', 'pcs', 'baverage', 10000),
(38, 'Air Mineral @600 ml isi 24 pcs', 'pack', 'baverage', 40000),
(39, 'Air Mineral @1,5 ltr isi 12 pcs', 'pcs', 'baverage', 50000),
(40, 'Sendok Makan Plastik @25 pcs', 'pack', 'aminities', 5000),
(41, 'Garpu Makan Plastik @25 pcs', 'pack', 'aminities', 5000),
(42, 'Paper Tray uk M @100 pcs', 'pack', 'aminities', 75000),
(43, 'Paper Cup OZ 04 @100 Pcs', 'pack', 'aminities', 40000),
(44, 'Spidol Non Permanen Hitam', 'pcs', 'stationery', 6500),
(45, 'Spidol Non Permanen Biru', 'pcs', 'stationery', 6500),
(46, 'Baterai Alkaline A2', 'pcs', 'stationery', 9000),
(47, 'Baterai Alkaline A3', 'pcs', 'stationery', 7500),
(48, 'Plastik Sampah @10 Pcs', 'pack', 'aminities', 11000),
(49, 'Laundry Form', 'pcs', 'stationery', 25000),
(50, 'Tepung Segitiga Biru', 'pcs', 'food', 14500),
(51, 'Tepung Cakra Kembar', 'pcs', 'food', 13000),
(52, 'Garam @1 kg', 'pcs', 'food', 10000),
(53, 'Santan Kara @1 ltr', 'pcs', 'food', 33500),
(54, 'Ajinomoto @1 kg', 'pcs', 'food', 46000),
(55, 'Kecap Bango @5,7 kg', 'pcs', 'food', 170000),
(56, 'Saus Sambal ABC @5,7 kg', 'pcs', 'food', 120000),
(57, 'Saus Tomat ABC @5,7 kg', 'pcs', 'food', 87000),
(58, 'Kecap Asin ABC @620 ml', 'pcs', 'food', 15000),
(59, 'Kellogg\'s Corn Flake', 'pcs', 'food', 28000),
(60, 'Kellogg\'s Froot Loops', 'pcs', 'food', 36000),
(61, 'Mie Telor Atom', 'pcs', 'food', 6000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pr_po_list`
--

CREATE TABLE `pr_po_list` (
  `id` int(30) NOT NULL,
  `po_code` varchar(30) NOT NULL,
  `supplier` int(15) NOT NULL,
  `date_created` date NOT NULL,
  `department` varchar(20) NOT NULL,
  `discount_perc` decimal(10,0) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `tax_perc` decimal(10,0) NOT NULL,
  `tax_amount` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `remarks` text NOT NULL,
  `status` enum('Pending','Process','Partially Receive','Receive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pr_po_list`
--

INSERT INTO `pr_po_list` (`id`, `po_code`, `supplier`, `date_created`, `department`, `discount_perc`, `discount_amount`, `tax_perc`, `tax_amount`, `total`, `remarks`, `status`) VALUES
(16, 'PO-0001', 6, '2023-12-04', 'F&B Product', 0, 0, 0, 0, 1800000, 'Kebutuhan Kitchen', 'Receive'),
(17, 'PO-0002', 3, '2023-12-05', 'Housekeeping', 0, 0, 11, 129250, 1304250, 'Kebutuhan Kamar', 'Process'),
(18, 'PR-0003', 7, '2023-12-06', 'F&B Service', 2, 8320, 11, 45760, 453440, 'Kebutuhan Service', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_list`
--

CREATE TABLE `supplier_list` (
  `supplier_id` int(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `cperson` varchar(20) NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier_list`
--

INSERT INTO `supplier_list` (`supplier_id`, `name`, `address`, `cperson`, `contact`) VALUES
(2, 'Suara Hati', 'Bogor', 'Pak Cakra', '089876543210'),
(3, 'sumber prima', 'Jakarta', 'Pak Sultan', '081234567890'),
(4, 'Rumah Protein', 'Jakarta', 'Pak Beki', '081209348756'),
(6, 'Ummah Sari Buana', 'Bogor Barat, Bogor', 'Pak Fahri', '085716118587'),
(7, 'Jaya Berkat Stationery', 'Jakarta', 'Pak Farhan', '081209384756'),
(8, 'Kincha Pastry Bakery', 'Bogor', 'Pak Jasen', '08213649580'),
(9, 'APJ Meat Shop', 'Bogor', 'Pak Hendra', '082817305846'),
(10, 'Cookiesku', 'Jakarta Selatan', 'Pak Dio', '082182810103'),
(11, 'Kemakmuran', 'Depok', 'Pak Rivan', '0816773385'),
(12, 'Kebun Wira', 'Bogor Tengah', 'Pak Doni', '089825175472'),
(13, 'Sukanda Jaya', 'Jakarta', 'Pak Angga', '082195876403'),
(14, 'Amalia Artho', 'Jakarta', 'Pak Yudha', '081577304968'),
(15, 'Architama Catu Nusa', 'Sepok', 'Pak Nanda', '089624051673'),
(16, 'Victory', 'Bogor', 'Pak Jonathan', '085649208176'),
(17, 'Bursa Selaras Bersama', 'Jakarta Barat', 'Pak Nizar', '081368338274');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` enum('Admin','Super Admin','Manager') NOT NULL,
  `avatar` text NOT NULL,
  `last_login` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_list`
--

INSERT INTO `user_list` (`user_id`, `username`, `password`, `type`, `avatar`, `last_login`) VALUES
(1, 'purchasing', '68053af2923e00204c3ca7c6a3150cf7', 'Admin', 'Screenshot 2022-12-29 202547.png', ''),
(2, 'receiving', '250cf8b51c773f3f8dc8b4be867a9a02', 'Admin', 'logo.png', ''),
(3, 'engineering', '250cf8b51c773f3f8dc8b4be867a9a02', 'Manager', '', ''),
(4, 'housekeeping', '698d51a19d8a121ce581499d7b701668', 'Manager', '', ''),
(5, 'front office', 'fae0b27c451c728867a567e8c1bb4e53', 'Manager', 'logo.png', ''),
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', '', ''),
(8, 'human resource', 'f1c1592588411002af340cbaedd6fc33', 'Manager', 'Screenshot 2022-12-29 202547.png', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `item_detail`
--
ALTER TABLE `item_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `po_id` (`id_po`),
  ADD KEY `item` (`item`);

--
-- Indeks untuk tabel `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`item_id`);

--
-- Indeks untuk tabel `pr_po_list`
--
ALTER TABLE `pr_po_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier` (`supplier`);

--
-- Indeks untuk tabel `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `item_detail`
--
ALTER TABLE `item_detail`
  MODIFY `detail_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `item_list`
--
ALTER TABLE `item_list`
  MODIFY `item_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `pr_po_list`
--
ALTER TABLE `pr_po_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_detail`
--
ALTER TABLE `item_detail`
  ADD CONSTRAINT `item_detail_ibfk_2` FOREIGN KEY (`item`) REFERENCES `item_list` (`item_id`);

--
-- Ketidakleluasaan untuk tabel `pr_po_list`
--
ALTER TABLE `pr_po_list`
  ADD CONSTRAINT `pr_po_list_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier_list` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
