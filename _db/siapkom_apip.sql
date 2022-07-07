-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 07 Jul 2022 pada 11.29
-- Versi server: 5.7.33
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siapkom_apip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `anggaran` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `id_peserta`, `anggaran`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '2022-07-06 15:57:25', '2022-07-06 15:57:25'),
(2, 2, '0', '2022-07-07 10:55:31', '2022-07-07 10:55:31'),
(3, 3, '0', '2022-07-07 10:59:46', '2022-07-07 10:59:46'),
(4, 4, '0', '2022-07-07 11:02:08', '2022-07-07 11:02:08'),
(5, 5, '0', '2022-07-07 11:05:55', '2022-07-07 11:05:55'),
(6, 6, '0', '2022-07-07 11:11:52', '2022-07-07 11:11:52'),
(7, 7, '0', '2022-07-07 11:15:28', '2022-07-07 11:15:28'),
(8, 8, '0', '2022-07-07 11:22:16', '2022-07-07 11:22:16'),
(9, 9, '0', '2022-07-07 11:27:42', '2022-07-07 11:27:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bezeting`
--

CREATE TABLE `bezeting` (
  `id_bezeting` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `tahun` varchar(5) DEFAULT NULL,
  `abk` int(11) DEFAULT '0',
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `id_pangkat` int(11) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `id_pangkat`, `id_golongan`, `id_jabatan`, `id_user`) VALUES
(1, 'Dr. H. Muhtarom, MM, Ak, CA', '196303241984021001', 4, 11, 1, 4),
(2, 'Dra. Nia Karmina Juliasih, M.Si', '196807131989032007', 3, 10, 2, 5),
(3, 'Dicky Hardiana, S.Sos, M.Si', '196909261990031003', 3, 10, 3, 6),
(4, 'Khairudin, ST, M.Si', '196904122001121005', 3, 10, 3, 7),
(5, 'Endad Haryanto, SE, M.Si', '197304032001121003', 2, 9, 3, 8),
(6, 'Drs. H. Kukuh Suharso, M.Si', '196602261994031001', 3, 10, 3, 9),
(7, 'Windu Iwan Nugraha, SH, MM', '197904242001121002', 8, 8, 6, 10),
(8, 'Husen Fadilah, SE, M.Ak', '197406072001121003', 2, 9, 5, 11),
(9, 'Sri Wahidatul Iip, S.Kom, M.Si', '197505052001122003', 8, 8, 4, 12),
(10, 'Drs. H. Bahrudin, M.Si', '196309111983121001', 3, 10, 16, 13),
(11, 'Dewi Kuraesin, SE, M. Ak', '196501061996032001', 3, 10, 16, 14),
(12, 'Agustia Duha, ST, M.Ak', '197008152001121005', 3, 10, 16, 15),
(13, 'Agus Haryanto, S.Sos, M.Si', '197005252001121002', 2, 9, 16, 16),
(14, 'Rohyati, SE, MM', '197007032001122002', 2, 9, 16, 17),
(15, 'R. Indra, SE', '197307182002121005', 2, 9, 16, 18),
(16, 'Dinda Sundara, S.Sos, M.Si', '198312302005021001', 8, 8, 16, 19),
(17, 'Ira Rohmayanti, S.Sos', '198204022001122001', 8, 8, 15, 20),
(18, 'Hj. Emut Mutiah, SE, M.Si', '197810282002122008', 8, 8, 15, 21),
(19, 'Mieke Kurniawati, SE', '197305122001122003', 8, 8, 15, 22),
(20, 'Pipit Puspita Gandasari, S.IP', '197607312006042016', 8, 8, 15, 23),
(21, 'Sandy Mahesa Jumhana, S.IP, M.Si', '198303022002121006', 8, 8, 15, 24),
(22, 'Ria Fariani, SE, M.Si', '197403022001122004', 8, 8, 15, 25),
(23, 'Raden Roro Enggar Yulianti, S.Kom, MM', '197307102007012010', 8, 8, 15, 26),
(24, 'Prisda Yusliana, SH, M.Si', '196903272001122003', 8, 8, 15, 27),
(25, 'Feri Suyatno, S.KM, M.Kes', '197701072001121004', 8, 8, 15, 28),
(26, 'Agus Aan Suhanda, SE', '197705062001121006', 8, 8, 15, 29),
(27, 'Nasrullah, SE, Ak', '198403052002121004', 8, 8, 15, 30),
(28, 'Yiyis Asiyah, ST, M.Si', '197411182007012008', 5, 7, 15, 31),
(29, 'Muhibbudin, S.IP', '197305182001121006', 5, 7, 15, 32),
(30, 'Boy Roni Risnandi, SE, Ak', '198212132010011007', 5, 7, 15, 33),
(31, 'Hj. Arlin Mega Yhuvita, SE, MM', '198302252001122001', 5, 7, 15, 34),
(32, 'Shauwama Kusuma Dewi, SH', '198208102006042027', 5, 7, 15, 35),
(33, 'Ade Subhan, S.Sos', '197103212001121004', 7, 6, 14, 36),
(34, 'Dadan Darmawan, SE', '197707032005011009', 7, 6, 14, 37),
(35, 'Dede Wahyudin, SE, MM', '196406022007011006', 7, 6, 14, 38),
(36, 'Litawati, SE', '197603112009022001', 7, 6, 14, 39),
(37, 'Moon Marko, S.Sos', '197803282010011001', 7, 6, 14, 40),
(38, 'Ahmad Yani, Ak', '196510071986031001', 3, 10, 12, 41),
(39, 'Drs. Slamet Haryono, MT', '196802092001121002', 3, 10, 12, 42),
(40, 'R. Sanny Maryudi, ST, MT', '196912162002121001', 2, 9, 12, 43),
(41, 'Yanrizal Adha, S.Sos, M.Si', '197406191999011001', 2, 9, 12, 44),
(42, 'Taqi Udin Ahmad, S.Kom, M.Ak', '197804032001121005', 2, 9, 12, 45),
(43, 'Sandika Jaya, ST, M.Ak', '197508212001121003', 2, 9, 12, 46),
(44, 'Meda Yulianti, SE, M.Ak, Ak', '198007242001122001', 2, 9, 12, 47),
(45, 'Muhamad Qusyairi, ST', '197304122006041003', 2, 9, 12, 48),
(46, 'Ida Jubaedah, SE, MM, Ak', '198609182009022001', 8, 8, 12, 49),
(47, 'H. Rudy Suntoro, S.Kp, M.Kes', '196707201993031006', 2, 9, 13, 50),
(48, 'Suhirman, S.Pd, M.Pd', '196808101998021005', 2, 9, 13, 51),
(49, 'Aman Ma\'ruf, S.Sos', '198207052001121002', 8, 8, 13, 52),
(50, 'Rd. Adi Lesmana, S.Sos', '198201112001121002', 8, 8, 13, 53),
(51, 'Lenni Irawani, SE, M.Si', '198105312009022001', 8, 8, 13, 54),
(52, 'Rini Agustiana, S.Sos, M.Si', '197908272001122001', 8, 8, 13, 55),
(53, 'Ade Permanik, S.AP, MM', '197710222006041007', 8, 8, 13, 56),
(54, 'Ade Supriatna, S.IP, M.Si', '196512181989111001', 8, 8, 13, 57),
(55, 'Hasbi Asidiqi, S.Kom', '197606212001121005', 8, 8, 13, 58),
(56, 'Hj. Ida Ruaida, S.Sos, M.Si', '197401172001122002', 8, 8, 13, 59),
(57, 'Dwy Astuti Siswandari, S.Sos, MM', '197803162002122003', 8, 8, 13, 60),
(58, 'Vera Nur Hayati, S.Sos, M.Si', '198202142008012006', 8, 8, 13, 61),
(59, 'Hj. Ratu Syafitri Muhayati, SE', '198001012009022001', 8, 8, 13, 62),
(60, 'Tb. Abdul Gani, SE, MM', '197112142001121003', 8, 8, 13, 63),
(61, 'Ahmad Yani, S.Sos, M.Si', '197109302002121006', 8, 8, 13, 64),
(62, 'Bahtiar Awang Zakarosa, SH, MH', '198609102006041002', 8, 8, 13, 65),
(63, 'Prayuda Eko Saputra, SE, M.Si', '197809242009021001', 5, 7, 13, 66),
(64, 'Sylvia Nurmawanti, SE', '198710312010012001', 5, 7, 13, 67),
(65, 'Noviyanto, SE', '198307162010011008', 5, 7, 13, 68),
(66, 'Yusup Fatahillah, S.Sos', '197309052001121004', 5, 7, 13, 69),
(67, 'Erik Maulana, S.Sos, M.Si', '198405312009021003', 5, 7, 13, 70),
(68, 'Gahara, S.IP', '197003112001121001', 5, 7, 13, 71),
(69, 'Iman Atqiyyadi, S.AP, M.Si', '197507232001121003', 5, 7, 13, 72),
(70, 'Akhmad Rohman, SH, M.Ak', '198604022006041002', 5, 7, 13, 73),
(71, 'Deden Wirdiana, SH', '197805102007011010', 5, 7, 13, 74),
(72, 'Yodi Ero Qodriyat, SE, M.Ak', '198601052009021003', 5, 7, 13, 75),
(73, 'Rini Oktoriani, SE', '197410192009022001', 5, 7, 13, 76),
(74, 'Agussalim, SE', '197506152009021001', 5, 7, 13, 77),
(75, 'Elda Supriatna, S.Sos, M.Si', '197306262001121003', 5, 7, 13, 78),
(76, 'Muhammad Sulchi, SP, M.Si', '197212102002121003', 5, 7, 13, 79),
(77, 'Hilmi Firdaus, S.Sos', '197307282001121002', 8, 8, 10, 80),
(78, 'Yeyet Hulyati, S.Ag', '197708142001122002', 8, 8, 10, 81),
(79, 'Irfan Kurniawan, ST, MM', '197608122002121008', 8, 8, 10, 82),
(80, 'Fatoni, SE, M.Si', '197001302005021002', 8, 8, 10, 83),
(81, 'Mohamad Iqbal, S.Sos', '197511042001121005', 5, 7, 10, 84),
(82, 'Euis Rachmawati, S.Sos, M.A.', '197609162001122001', 5, 7, 10, 85),
(83, 'Rani Maharani, SE, M.Si', '198401082002122003', 5, 7, 10, 86),
(84, 'Herman Susilo, S.Sos', '197610102001121006', 5, 7, 10, 87),
(85, 'Leli Purnama Lestari, SE, M.Si', '198604052010012004', 7, 6, 10, 88),
(86, 'Rizki, SE', '198205242010011004', 7, 6, 10, 89),
(87, 'Zakia Novitasari, SH', '197911102001122002', 7, 6, 10, 90),
(88, 'Novi Junaidi, SP', '197705142009011007', 7, 6, 10, 91),
(89, 'Mumu Muhajirin, SE', '198005012010011004', 7, 6, 10, 92),
(90, 'Ita Munawaroh, SH', '197807272001122002', 7, 6, 10, 93),
(91, 'Achmad Haelani, SE', '197904172010011008', 7, 6, 10, 94),
(92, 'Feny Setiawati, S.Pd.Ing, M.Si', '198002032001122004', 7, 6, 10, 95),
(93, 'Tita Rosita, SE', '197406162010012006', 7, 6, 10, 96),
(94, 'Lia Yulianti, SE', '197707102010012006', 7, 6, 10, 97),
(95, 'Rendra Prasetya, SE, MM', '197504212006041008', 7, 6, 10, 98),
(96, 'Farid Wazdi, SE', '197312062001121001', 7, 6, 10, 99),
(97, 'Neli Sukasari, SE', '198812202011012001', 7, 6, 10, 100),
(98, 'Nani Yuliani, SE', '197307262006042001', 7, 6, 10, 101),
(99, 'Ido Rohmanullah, SE, M.Ak', '198603242010011002', 7, 6, 10, 102),
(100, 'Nita Ratna Siti Aminah, SE', '198706232010012001', 6, 5, 10, 103),
(101, 'Achmad Muchlis, S.AP', '197507172009021001', 6, 5, 10, 104),
(102, 'Kotiah, SE', '198107052010012008', 11, 4, 10, 105),
(103, 'Oktafredi, A.Md', '197110292002121005', 7, 6, 9, 106),
(104, 'Yudi Ermanto, A.Md', '197211302001121003', 7, 6, 7, 107),
(105, 'Sunarto, S.Sos', '197109071996011001', 5, 7, 19, 108),
(106, 'Suharmanta, SH, S.IP, M.H', '196701122001121002', 7, 6, 18, 109),
(107, 'Indra Suprianto, SH, M.H', '197509242010011003', 7, 6, 18, 110),
(108, 'Iha Roihah, ST', '197403102001122008', 8, 8, 22, 111),
(109, 'Yaneu Septiani, SE, MM', '197809222009022001', 8, 8, 22, 112),
(110, 'Ika Mustika Dewi, ST., MT', '198211212009022001', 8, 8, 22, 113),
(111, 'Akhmad Yani, SE, M.Si', '197504232002121004', 5, 7, 22, 114),
(112, 'Dandi Maulandi Nurzein, SE', '198001192007011004', 5, 7, 22, 115),
(113, 'Marissa Ghina Aquarita, SE', '198502182010012018', 5, 7, 22, 116),
(114, 'Welen Kurniawan, SE, MM', '198905012015031001', 7, 6, 22, 117),
(115, 'Anggara Rukmana, SE', '198502202015031001', 7, 6, 22, 118),
(116, 'Muhammad Revki Iboyma, S.Sos', '198310172010011002', 7, 6, 22, 119),
(117, 'Aulia Fathurahman, S.Sos, MM', '198709242011011001', 7, 6, 22, 120),
(118, 'Lingga Yudhistira, S.Sos', '198710082011011001', 7, 6, 22, 121),
(119, 'Yossant Afriadi, SKM', '197912212009021001', 7, 6, 22, 122),
(120, 'Cecep Septiana', '198109042002121004', 6, 5, 22, 123),
(121, 'Abdul Aziz, SE', '198711022010011001', 6, 5, 22, 124),
(122, 'Achmad Fachrudin, A.Md', '197906152010011004', 6, 5, 22, 125),
(123, 'Syahrul Firdaus, SKM', '198605172011011001', 6, 5, 22, 126),
(124, 'Ade Hendarman', '197602272014101001', 10, 2, 22, 127),
(125, 'Tb. Fahrul Suhandinata', '198205022014091002', 10, 2, 22, 128),
(126, 'Nani Rahmawati', '198402062014092001', 10, 2, 22, 129),
(127, 'Rusdi', '197501142014101001', 1, 1, 22, 130),
(128, 'Arisandi', '198607082014101001', 1, 1, 22, 131),
(129, 'Ananda Putra Anugrah Ramadhan, A.Md, Ak.', '199610252021021001', 9, 3, 22, 132),
(130, 'Anugrah Nurhasanah, A.Md. Ak', '199709302021022001', 9, 3, 22, 133),
(131, 'Rahmawati Nur Fauziyah, A.Md.Ak.', '199807202021022001', 9, 3, 22, 134),
(132, 'Dennis Hermawan, A.Md.Ak.', '199811202021021001', 9, 3, 22, 135),
(133, 'Nadira Diasdiadara, A.Md.Ak.', '199812262021022001', 9, 3, 2, 136),
(134, 'Shafira Shaliha, A.Md.Ak.', '199902062021022001', 9, 3, 22, 137),
(135, 'Nailah Fauziyah, A.Md.Ak.', '199903272021022001', 9, 3, 22, 138),
(136, 'Nadhira Faiza Aulia, A.Md.Ak', '199911252021022001', 9, 3, 22, 139),
(137, 'Muhammad Dede Nuraen', '27328139273812', 2, 2, 18, 140);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_jenis_diklat` int(11) DEFAULT NULL,
  `id_diklat` int(11) DEFAULT NULL,
  `tahun` varchar(5) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tempat` text,
  `id_status` int(11) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_pegawai`, `id_jenis_diklat`, `id_diklat`, `tahun`, `tgl_mulai`, `tgl_selesai`, `tempat`, `id_status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 58, 2, 26, '2021', '2021-04-05', '2021-04-09', 'Ciawi', 3, 'Diklat Selesai', '2022-07-06 15:52:41', '2022-07-06 15:57:49'),
(2, 46, 2, 26, '2021', '2021-04-05', '2021-04-09', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 10:54:31', '2022-07-07 10:55:50'),
(3, 49, 2, 18, '2021', '2021-06-28', '2021-07-02', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 10:58:27', '2022-07-07 11:00:33'),
(4, 57, 2, 18, '2021', '2021-06-28', '2021-07-02', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:01:26', '2022-07-07 11:02:35'),
(5, 64, 2, 25, '2021', '2021-06-08', '2021-07-11', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:05:02', '2022-07-07 11:06:26'),
(6, 66, 2, 31, '2021', '2021-09-20', '2021-09-24', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:11:17', '2022-07-07 11:12:28'),
(7, 74, 2, 21, '2021', '2021-11-15', '2021-11-19', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:14:36', '2022-07-07 11:15:42'),
(8, 68, 2, 18, '2021', '2021-06-28', '2021-07-02', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:21:40', '2022-07-07 11:23:08'),
(9, 95, 2, 31, '2021', '2021-04-05', '2021-04-09', 'Ciawi', 3, 'Diklat Selesai', '2022-07-07 11:27:13', '2022-07-07 11:28:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `realisasi`
--

CREATE TABLE `realisasi` (
  `id_realisasi` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `no_spt` varchar(255) DEFAULT NULL,
  `file_spt` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `realisasi`
--

INSERT INTO `realisasi` (`id_realisasi`, `id_peserta`, `no_spt`, `file_spt`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-1', '1657122947.pdf', '2022-07-06 15:55:47', '2022-07-06 15:55:47'),
(2, 2, '2021-2', '1657191322.pdf', '2022-07-07 10:55:22', '2022-07-07 10:55:22'),
(3, 3, '2021-3', '1657191545.pdf', '2022-07-07 10:59:05', '2022-07-07 10:59:05'),
(4, 4, '2021-4', '1657191713.pdf', '2022-07-07 11:01:53', '2022-07-07 11:01:53'),
(5, 5, '2021-5', '1657191924.pdf', '2022-07-07 11:05:24', '2022-07-07 11:05:24'),
(6, 6, '2021-6', '1657192306.pdf', '2022-07-07 11:11:46', '2022-07-07 11:11:46'),
(7, 7, '2021-7', '1657192518.pdf', '2022-07-07 11:15:18', '2022-07-07 11:15:18'),
(8, 8, '2021-7', '1657192928.pdf', '2022-07-07 11:22:08', '2022-07-07 11:22:08'),
(9, 9, '2021-8', '1657193255.pdf', '2022-07-07 11:27:35', '2022-07-07 11:27:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_diklat`
--

CREATE TABLE `ref_diklat` (
  `id_diklat` int(11) NOT NULL,
  `id_jenis_diklat` int(11) DEFAULT NULL,
  `nama_diklat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_diklat`
--

INSERT INTO `ref_diklat` (`id_diklat`, `id_jenis_diklat`, `nama_diklat`) VALUES
(1, 2, 'DIKLAT LAINNYA'),
(2, 1, 'DIKLATPIM II'),
(3, 1, 'DIKLATPIM III / PELATIHAN KEPEMIMPINAN ADMINISTRATOR (PKA)'),
(4, 1, 'DIKLATPIM I V/ PELATIHAN KEPEMIMPINAN PENGAWAS (PKP)'),
(5, 1, 'DIKLAT PRAJABATAN / LATSAR'),
(6, 1, 'DIKLAT TINGKAT TRAMPIL'),
(7, 1, 'DIKLAT PEMBENTUKAN AUDITOR PERTAMA'),
(8, 1, 'DIKLAT PEMBENTUKAN AUDITOR MUDA'),
(9, 1, 'DIKLAT PEMBENTUKAN AUDITOR MADYA'),
(10, 1, 'DIKLAT PEMBENTUKAN AUDITOR UTAMA'),
(11, 1, 'DIKLAT PEMBENTUKAN PPUPD PERTAMA'),
(12, 1, 'DIKLAT PEMBENTUKAN PPUPD MUDA'),
(13, 1, 'DIKLAT PEMBENTUKAN PPUPD MADYA'),
(14, 1, 'DIKLAT PEMBENTUKAN PPUPD UTAMA'),
(15, 2, 'SERTIFIKASI PENGADAAN BARANG DAN JASA'),
(16, 2, 'AUDIT PENGADAAN BARANG DAN JASA'),
(17, 2, 'AUDIT BERBASIS RESIKO'),
(18, 2, 'AUDIT KINERJA PEMERINTAH DAERAH'),
(19, 2, 'AUDIT BARANG MILIK DAERAH'),
(20, 2, 'REVIU LAPORAN KEUANGAN PEMERINTAH DAERAH'),
(21, 2, 'PENILAIAN MATURITAS SPIP'),
(22, 2, 'MANAJEMEN PENGAWASAN'),
(23, 2, 'MANAJEMEN BARANG MILIK DAERAH'),
(24, 2, 'PENYUSUNAN KERTAS KERJA AUDIT'),
(25, 2, 'PENILAIAN ANGKA KREDIT JFA'),
(26, 2, 'PERENCANAAN PENGAWASAN BERBASIS RESIKO (PPBR)'),
(27, 2, 'REVIU RPJMD (P2UPD)'),
(28, 2, 'REVIU LKPD (P2UPD)'),
(29, 2, 'EKPPD PEMDA (P2UPD)'),
(30, 3, 'PKS, SEMINAR, WEBINAR, SOSIALISASI, BIMTEK, DLL'),
(31, 2, 'AUDIT INVESTIGATIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_golongan`
--

CREATE TABLE `ref_golongan` (
  `id_golongan` int(11) NOT NULL,
  `nama_golongan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_golongan`
--

INSERT INTO `ref_golongan` (`id_golongan`, `nama_golongan`) VALUES
(1, 'I/b'),
(2, 'II/b'),
(3, 'II/c'),
(4, 'II/d'),
(5, 'III/a'),
(6, 'III/b'),
(7, 'III/c'),
(8, 'III/d'),
(9, 'IV/a'),
(10, 'IV/b'),
(11, 'IV/d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jabatan`
--

CREATE TABLE `ref_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `id_jenis_jabatan` int(11) DEFAULT NULL,
  `nama_jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jabatan`
--

INSERT INTO `ref_jabatan` (`id_jabatan`, `id_jenis_jabatan`, `nama_jabatan`) VALUES
(1, 1, 'INSPEKTUR'),
(2, 1, 'SEKRETARIS'),
(3, 1, 'INSPEKTUR PEMBANTU'),
(4, 1, 'KASUBAG ADMINISTRASI UMUM DAN KEUANGAN'),
(5, 1, 'KASUBAG PERENCANAAN'),
(6, 1, 'KASUBAG ANALISIS DAN EVALUASI'),
(7, 2, 'AUDITOR PELAKSANA'),
(8, 2, 'AUDITOR PELAKSANA LANJUTAN'),
(9, 2, 'AUDITOR PENYELIA'),
(10, 2, 'AUDITOR PERTAMA'),
(11, 2, 'AUDITOR MUDA'),
(12, 2, 'AUDITOR MADYA'),
(13, 2, 'AUDITOR UTAMA'),
(14, 2, 'PENGAWAS PEMERINTAHAN PERTAMA'),
(15, 2, 'PENGAWAS PEMERINTAHAN MUDA'),
(16, 2, 'PENGAWAS PEMERINTAHAN MADYA'),
(17, 2, 'PENGAWAS PEMERINTAHAN UTAMA'),
(18, 2, 'AUDITOR KEPEGAWAIAN PERTAMA'),
(19, 2, 'AUDITOR KEPEGAWAIAN MUDA'),
(20, 2, 'AUDITOR KEPEGAWAIAN MADYA'),
(21, 3, 'PELAKSANA IRBAN I, II, III DAN IV'),
(22, 3, 'PELAKSANA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis_diklat`
--

CREATE TABLE `ref_jenis_diklat` (
  `id_jenis_diklat` int(11) NOT NULL,
  `nama_jenis_diklat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jenis_diklat`
--

INSERT INTO `ref_jenis_diklat` (`id_jenis_diklat`, `nama_jenis_diklat`) VALUES
(1, 'DIKLAT PEMBENTUKAN / PENJENJANGAN'),
(2, 'DIKLAT SUBSTANTIF / PENUNJANG'),
(3, 'PENGEMBANGAN PROFESI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis_jabatan`
--

CREATE TABLE `ref_jenis_jabatan` (
  `id_jenis_jabatan` int(11) NOT NULL,
  `nama_jenis_jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jenis_jabatan`
--

INSERT INTO `ref_jenis_jabatan` (`id_jenis_jabatan`, `nama_jenis_jabatan`) VALUES
(1, 'STRUKTURAL'),
(2, 'FUNGSIONAL'),
(3, 'FUNGSIONAL UMUM/STAFF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pangkat`
--

CREATE TABLE `ref_pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `nama_pangkat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pangkat`
--

INSERT INTO `ref_pangkat` (`id_pangkat`, `nama_pangkat`) VALUES
(1, 'Juru Muda Tk.I'),
(2, 'Pembina'),
(3, 'Pembina Tk.I'),
(4, 'Pembina Utama Madya'),
(5, 'Penata'),
(6, 'Penata Muda'),
(7, 'Penata Muda Tk.I'),
(8, 'Penata Tk.I'),
(9, 'Pengatur'),
(10, 'Pengatur Muda Tk.I'),
(11, 'Pengatur Tk.I');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status`
--

CREATE TABLE `ref_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_status`
--

INSERT INTO `ref_status` (`id_status`, `nama_status`, `color`) VALUES
(1, 'Verifikasi', 'warning'),
(2, 'Proses', 'info'),
(3, 'Selesai', 'success'),
(4, 'Tolak', 'danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id_peserta`, `file_sertifikat`, `created_at`, `updated_at`) VALUES
(1, 1, '1657123059.pdf', '2022-07-06 15:57:39', '2022-07-06 15:57:39'),
(2, 2, '1657191344.pdf', '2022-07-07 10:55:44', '2022-07-07 10:55:44'),
(3, 3, '1657191597.pdf', '2022-07-07 10:59:57', '2022-07-07 10:59:57'),
(4, 4, '1657191744.pdf', '2022-07-07 11:02:24', '2022-07-07 11:02:24'),
(5, 5, '1657191973.pdf', '2022-07-07 11:06:13', '2022-07-07 11:06:13'),
(6, 6, '1657192339.pdf', '2022-07-07 11:12:19', '2022-07-07 11:12:19'),
(7, 7, '1657192536.pdf', '2022-07-07 11:15:36', '2022-07-07 11:15:36'),
(8, 8, '1657192974.pdf', '2022-07-07 11:22:54', '2022-07-07 11:22:54'),
(9, 9, '1657193285.pdf', '2022-07-07 11:28:05', '2022-07-07 11:28:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `id_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Administrator', 1, 'OjeZXEZ8JnhhaM3qyX7gCWyuw8pwvykdkgeyx77eLuB1TXb2djfRnK93qtsc', NULL, NULL),
(2, 'operator1', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Operator 1', 2, NULL, NULL, NULL),
(3, 'operator2', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Operator 2', 2, NULL, NULL, NULL),
(4, '196303241984021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dr. H. Muhtarom, MM, Ak, CA', 3, NULL, NULL, NULL),
(5, '196807131989032007', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dra. Nia Karmina Juliasih, M.Si', 3, NULL, NULL, NULL),
(6, '196909261990031003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dicky Hardiana, S.Sos, M.Si', 3, NULL, NULL, NULL),
(7, '196904122001121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Khairudin, ST, M.Si', 3, NULL, NULL, NULL),
(8, '197304032001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Endad Haryanto, SE, M.Si', 3, NULL, NULL, NULL),
(9, '196602261994031001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Drs. H. Kukuh Suharso, M.Si', 3, NULL, NULL, NULL),
(10, '197904242001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Windu Iwan Nugraha, SH, MM', 3, NULL, NULL, NULL),
(11, '197406072001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Husen Fadilah, SE, M.Ak', 3, NULL, NULL, NULL),
(12, '197505052001122003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Sri Wahidatul Iip, S.Kom, M.Si', 3, NULL, NULL, NULL),
(13, '196309111983121001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Drs. H. Bahrudin, M.Si', 3, NULL, NULL, NULL),
(14, '196501061996032001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dewi Kuraesin, SE, M. Ak', 3, NULL, NULL, NULL),
(15, '197008152001121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Agustia Duha, ST, M.Ak', 3, NULL, NULL, NULL),
(16, '197005252001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Agus Haryanto, S.Sos, M.Si', 3, NULL, NULL, NULL),
(17, '197007032001122002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rohyati, SE, MM', 3, NULL, NULL, NULL),
(18, '197307182002121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'R. Indra, SE', 3, NULL, NULL, NULL),
(19, '198312302005021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dinda Sundara, S.Sos, M.Si', 3, NULL, NULL, NULL),
(20, '198204022001122001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ira Rohmayanti, S.Sos', 3, NULL, NULL, NULL),
(21, '197810282002122008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hj. Emut Mutiah, SE, M.Si', 3, NULL, NULL, NULL),
(22, '197305122001122003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Mieke Kurniawati, SE', 3, NULL, NULL, NULL),
(23, '197607312006042016', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Pipit Puspita Gandasari, S.IP', 3, NULL, NULL, NULL),
(24, '198303022002121006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Sandy Mahesa Jumhana, S.IP, M.Si', 3, NULL, NULL, NULL),
(25, '197403022001122004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ria Fariani, SE, M.Si', 3, NULL, NULL, NULL),
(26, '197307102007012010', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Raden Roro Enggar Yulianti, S.Kom, MM', 3, NULL, NULL, NULL),
(27, '196903272001122003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Prisda Yusliana, SH, M.Si', 3, NULL, NULL, NULL),
(28, '197701072001121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Feri Suyatno, S.KM, M.Kes', 3, NULL, NULL, NULL),
(29, '197705062001121006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Agus Aan Suhanda, SE', 3, NULL, NULL, NULL),
(30, '198403052002121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nasrullah, SE, Ak', 3, NULL, NULL, NULL),
(31, '197411182007012008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yiyis Asiyah, ST, M.Si', 3, NULL, NULL, NULL),
(32, '197305182001121006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Muhibbudin, S.IP', 3, NULL, NULL, NULL),
(33, '198212132010011007', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Boy Roni Risnandi, SE, Ak', 3, NULL, NULL, NULL),
(34, '198302252001122001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hj. Arlin Mega Yhuvita, SE, MM', 3, NULL, NULL, NULL),
(35, '198208102006042027', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Shauwama Kusuma Dewi, SH', 3, NULL, NULL, NULL),
(36, '197103212001121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ade Subhan, S.Sos', 3, NULL, NULL, NULL),
(37, '197707032005011009', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dadan Darmawan, SE', 3, NULL, NULL, NULL),
(38, '196406022007011006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dede Wahyudin, SE, MM', 3, NULL, NULL, NULL),
(39, '197603112009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Litawati, SE', 3, NULL, NULL, NULL),
(40, '197803282010011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Moon Marko, S.Sos', 3, NULL, NULL, NULL),
(41, '196510071986031001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ahmad Yani, Ak', 3, NULL, NULL, NULL),
(42, '196802092001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Drs. Slamet Haryono, MT', 3, NULL, NULL, NULL),
(43, '196912162002121001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'R. Sanny Maryudi, ST, MT', 3, NULL, NULL, NULL),
(44, '197406191999011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yanrizal Adha, S.Sos, M.Si', 3, NULL, NULL, NULL),
(45, '197804032001121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Taqi Udin Ahmad, S.Kom, M.Ak', 3, NULL, NULL, NULL),
(46, '197508212001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Sandika Jaya, ST, M.Ak', 3, NULL, NULL, NULL),
(47, '198007242001122001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Meda Yulianti, SE, M.Ak, Ak', 3, NULL, NULL, NULL),
(48, '197304122006041003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Muhamad Qusyairi, ST', 3, NULL, NULL, NULL),
(49, '198609182009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ida Jubaedah, SE, MM, Ak', 3, NULL, NULL, NULL),
(50, '196707201993031006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'H. Rudy Suntoro, S.Kp, M.Kes', 3, NULL, NULL, NULL),
(51, '196808101998021005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Suhirman, S.Pd, M.Pd', 3, NULL, NULL, NULL),
(52, '198207052001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Aman Ma\'ruf, S.Sos', 3, NULL, NULL, NULL),
(53, '198201112001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rd. Adi Lesmana, S.Sos', 3, NULL, NULL, NULL),
(54, '198105312009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Lenni Irawani, SE, M.Si', 3, NULL, NULL, NULL),
(55, '197908272001122001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rini Agustiana, S.Sos, M.Si', 3, NULL, NULL, NULL),
(56, '197710222006041007', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ade Permanik, S.AP, MM', 3, NULL, NULL, NULL),
(57, '196512181989111001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ade Supriatna, S.IP, M.Si', 3, NULL, NULL, NULL),
(58, '197606212001121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hasbi Asidiqi, S.Kom', 3, NULL, NULL, NULL),
(59, '197401172001122002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hj. Ida Ruaida, S.Sos, M.Si', 3, NULL, NULL, NULL),
(60, '197803162002122003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dwy Astuti Siswandari, S.Sos, MM', 3, NULL, NULL, NULL),
(61, '198202142008012006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Vera Nur Hayati, S.Sos, M.Si', 3, NULL, NULL, NULL),
(62, '198001012009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hj. Ratu Syafitri Muhayati, SE', 3, NULL, NULL, NULL),
(63, '197112142001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Tb. Abdul Gani, SE, MM', 3, NULL, NULL, NULL),
(64, '197109302002121006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ahmad Yani, S.Sos, M.Si', 3, NULL, NULL, NULL),
(65, '198609102006041002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Bahtiar Awang Zakarosa, SH, MH', 3, NULL, NULL, NULL),
(66, '197809242009021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Prayuda Eko Saputra, SE, M.Si', 3, NULL, NULL, NULL),
(67, '198710312010012001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Sylvia Nurmawanti, SE', 3, NULL, NULL, NULL),
(68, '198307162010011008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Noviyanto, SE', 3, NULL, NULL, NULL),
(69, '197309052001121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yusup Fatahillah, S.Sos', 3, NULL, NULL, NULL),
(70, '198405312009021003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Erik Maulana, S.Sos, M.Si', 3, NULL, NULL, NULL),
(71, '197003112001121001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Gahara, S.IP', 3, NULL, NULL, NULL),
(72, '197507232001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Iman Atqiyyadi, S.AP, M.Si', 3, NULL, NULL, NULL),
(73, '198604022006041002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Akhmad Rohman, SH, M.Ak', 3, NULL, NULL, NULL),
(74, '197805102007011010', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Deden Wirdiana, SH', 3, NULL, NULL, NULL),
(75, '198601052009021003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yodi Ero Qodriyat, SE, M.Ak', 3, NULL, NULL, NULL),
(76, '197410192009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rini Oktoriani, SE', 3, NULL, NULL, NULL),
(77, '197506152009021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Agussalim, SE', 3, NULL, NULL, NULL),
(78, '197306262001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Elda Supriatna, S.Sos, M.Si', 3, NULL, NULL, NULL),
(79, '197212102002121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Muhammad Sulchi, SP, M.Si', 3, NULL, NULL, NULL),
(80, '197307282001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Hilmi Firdaus, S.Sos', 3, NULL, NULL, NULL),
(81, '197708142001122002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yeyet Hulyati, S.Ag', 3, NULL, NULL, NULL),
(82, '197608122002121008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Irfan Kurniawan, ST, MM', 3, NULL, NULL, NULL),
(83, '197001302005021002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Fatoni, SE, M.Si', 3, NULL, NULL, NULL),
(84, '197511042001121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Mohamad Iqbal, S.Sos', 3, NULL, NULL, NULL),
(85, '197609162001122001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Euis Rachmawati, S.Sos, M.A.', 3, NULL, NULL, NULL),
(86, '198401082002122003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rani Maharani, SE, M.Si', 3, NULL, NULL, NULL),
(87, '197610102001121006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Herman Susilo, S.Sos', 3, NULL, NULL, NULL),
(88, '198604052010012004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Leli Purnama Lestari, SE, M.Si', 3, NULL, NULL, NULL),
(89, '198205242010011004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rizki, SE', 3, NULL, NULL, NULL),
(90, '197911102001122002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Zakia Novitasari, SH', 3, NULL, NULL, NULL),
(91, '197705142009011007', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Novi Junaidi, SP', 3, NULL, NULL, NULL),
(92, '198005012010011004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Mumu Muhajirin, SE', 3, NULL, NULL, NULL),
(93, '197807272001122002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ita Munawaroh, SH', 3, NULL, NULL, NULL),
(94, '197904172010011008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Achmad Haelani, SE', 3, 'AhC2ZtgctYs78OOSrAIlpyZSjwJmdF0ubK8FHDiyV0viqFroocPFAlcXCA7q', NULL, NULL),
(95, '198002032001122004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Feny Setiawati, S.Pd.Ing, M.Si', 3, NULL, NULL, NULL),
(96, '197406162010012006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Tita Rosita, SE', 3, NULL, NULL, NULL),
(97, '197707102010012006', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Lia Yulianti, SE', 3, NULL, NULL, NULL),
(98, '197504212006041008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rendra Prasetya, SE, MM', 3, NULL, NULL, NULL),
(99, '197312062001121001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Farid Wazdi, SE', 3, NULL, NULL, NULL),
(100, '198812202011012001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Neli Sukasari, SE', 3, NULL, NULL, NULL),
(101, '197307262006042001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nani Yuliani, SE', 3, NULL, NULL, NULL),
(102, '198603242010011002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ido Rohmanullah, SE, M.Ak', 3, NULL, NULL, NULL),
(103, '198706232010012001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nita Ratna Siti Aminah, SE', 3, NULL, NULL, NULL),
(104, '197507172009021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Achmad Muchlis, S.AP', 3, NULL, NULL, NULL),
(105, '198107052010012008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Kotiah, SE', 3, NULL, NULL, NULL),
(106, '197110292002121005', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Oktafredi, A.Md', 3, NULL, NULL, NULL),
(107, '197211302001121003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yudi Ermanto, A.Md', 3, NULL, NULL, NULL),
(108, '197109071996011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Sunarto, S.Sos', 3, NULL, NULL, NULL),
(109, '196701122001121002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Suharmanta, SH, S.IP, M.H', 3, NULL, NULL, NULL),
(110, '197509242010011003', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Indra Suprianto, SH, M.H', 3, NULL, NULL, NULL),
(111, '197403102001122008', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Iha Roihah, ST', 3, NULL, NULL, NULL),
(112, '197809222009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yaneu Septiani, SE, MM', 3, NULL, NULL, NULL),
(113, '198211212009022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ika Mustika Dewi, ST., MT', 3, NULL, NULL, NULL),
(114, '197504232002121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Akhmad Yani, SE, M.Si', 3, NULL, NULL, NULL),
(115, '198001192007011004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dandi Maulandi Nurzein, SE', 3, NULL, NULL, NULL),
(116, '198502182010012018', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Marissa Ghina Aquarita, SE', 3, NULL, NULL, NULL),
(117, '198905012015031001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Welen Kurniawan, SE, MM', 3, NULL, NULL, NULL),
(118, '198502202015031001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Anggara Rukmana, SE', 3, NULL, NULL, NULL),
(119, '198310172010011002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Muhammad Revki Iboyma, S.Sos', 3, NULL, NULL, NULL),
(120, '198709242011011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Aulia Fathurahman, S.Sos, MM', 3, NULL, NULL, NULL),
(121, '198710082011011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Lingga Yudhistira, S.Sos', 3, NULL, NULL, NULL),
(122, '197912212009021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Yossant Afriadi, SKM', 3, NULL, NULL, NULL),
(123, '198109042002121004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Cecep Septiana', 3, NULL, NULL, NULL),
(124, '198711022010011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Abdul Aziz, SE', 3, NULL, NULL, NULL),
(125, '197906152010011004', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Achmad Fachrudin, A.Md', 3, NULL, NULL, NULL),
(126, '198605172011011001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Syahrul Firdaus, SKM', 3, NULL, NULL, NULL),
(127, '197602272014101001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ade Hendarman', 3, NULL, NULL, NULL),
(128, '198205022014091002', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Tb. Fahrul Suhandinata', 3, NULL, NULL, NULL),
(129, '198402062014092001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nani Rahmawati', 3, NULL, NULL, NULL),
(130, '197501142014101001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rusdi', 3, NULL, NULL, NULL),
(131, '198607082014101001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Arisandi', 3, NULL, NULL, NULL),
(132, '199610252021021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Ananda Putra Anugrah Ramadhan, A.Md, Ak.', 3, NULL, NULL, NULL),
(133, '199709302021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Anugrah Nurhasanah, A.Md. Ak', 3, NULL, NULL, NULL),
(134, '199807202021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Rahmawati Nur Fauziyah, A.Md.Ak.', 3, NULL, NULL, NULL),
(135, '199811202021021001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Dennis Hermawan, A.Md.Ak.', 3, NULL, NULL, NULL),
(136, '199812262021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nadira Diasdiadara, A.Md.Ak.', 3, NULL, NULL, NULL),
(137, '199902062021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Shafira Shaliha, A.Md.Ak.', 3, NULL, NULL, NULL),
(138, '199903272021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nailah Fauziyah, A.Md.Ak.', 3, NULL, NULL, NULL),
(139, '199911252021022001', '$2y$10$wpAHcGIoMLRplJQmck9vKeg2X9NzftXIyrEccptC7V6EFg34zonN2', 'Nadhira Faiza Aulia, A.Md.Ak', 3, NULL, NULL, NULL),
(140, '27328139273812', '$2y$10$pgVBo02CD.RAMEuzqQs69.9/XnvCfp1x2yGhH95thYHQ/apHWB4Hq', 'Muhammad Dede Nuraen', 3, NULL, '2022-06-20 09:33:02', '2022-06-20 09:36:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `bezeting`
--
ALTER TABLE `bezeting`
  ADD PRIMARY KEY (`id_bezeting`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_golongan` (`id_golongan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_jenis_diklat` (`id_jenis_diklat`),
  ADD KEY `id_diklat` (`id_diklat`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`id_realisasi`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `ref_diklat`
--
ALTER TABLE `ref_diklat`
  ADD PRIMARY KEY (`id_diklat`),
  ADD KEY `id_jenis_diklat` (`id_jenis_diklat`);

--
-- Indeks untuk tabel `ref_golongan`
--
ALTER TABLE `ref_golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indeks untuk tabel `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_kategori_jabatan` (`id_jenis_jabatan`);

--
-- Indeks untuk tabel `ref_jenis_diklat`
--
ALTER TABLE `ref_jenis_diklat`
  ADD PRIMARY KEY (`id_jenis_diklat`);

--
-- Indeks untuk tabel `ref_jenis_jabatan`
--
ALTER TABLE `ref_jenis_jabatan`
  ADD PRIMARY KEY (`id_jenis_jabatan`);

--
-- Indeks untuk tabel `ref_pangkat`
--
ALTER TABLE `ref_pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indeks untuk tabel `ref_status`
--
ALTER TABLE `ref_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `bezeting`
--
ALTER TABLE `bezeting`
  MODIFY `id_bezeting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id_realisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ref_diklat`
--
ALTER TABLE `ref_diklat`
  MODIFY `id_diklat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `ref_golongan`
--
ALTER TABLE `ref_golongan`
  MODIFY `id_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `ref_jenis_diklat`
--
ALTER TABLE `ref_jenis_diklat`
  MODIFY `id_jenis_diklat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ref_jenis_jabatan`
--
ALTER TABLE `ref_jenis_jabatan`
  MODIFY `id_jenis_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ref_pangkat`
--
ALTER TABLE `ref_pangkat`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `ref_status`
--
ALTER TABLE `ref_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD CONSTRAINT `anggaran_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bezeting`
--
ALTER TABLE `bezeting`
  ADD CONSTRAINT `bez_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `ref_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_golongan` FOREIGN KEY (`id_golongan`) REFERENCES `ref_golongan` (`id_golongan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `pegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `ref_jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `pegawai_pangkat` FOREIGN KEY (`id_pangkat`) REFERENCES `ref_pangkat` (`id_pangkat`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `pegawai_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_diklat` FOREIGN KEY (`id_diklat`) REFERENCES `ref_diklat` (`id_diklat`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `peserta_jenis_diklat` FOREIGN KEY (`id_jenis_diklat`) REFERENCES `ref_jenis_diklat` (`id_jenis_diklat`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `peserta_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `peserta_status` FOREIGN KEY (`id_status`) REFERENCES `ref_status` (`id_status`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `realisasi`
--
ALTER TABLE `realisasi`
  ADD CONSTRAINT `realisasi_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ref_diklat`
--
ALTER TABLE `ref_diklat`
  ADD CONSTRAINT `jenis_diklat` FOREIGN KEY (`id_jenis_diklat`) REFERENCES `ref_jenis_diklat` (`id_jenis_diklat`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD CONSTRAINT `jabatan_jenis` FOREIGN KEY (`id_jenis_jabatan`) REFERENCES `ref_jenis_jabatan` (`id_jenis_jabatan`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user+role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
