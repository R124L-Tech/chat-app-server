-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2021 pada 09.13
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teq_chat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`id`, `sender`, `receiver`, `message`, `send_time`) VALUES
(2, '+6281243626272', '+6282233999510', 'Hello too', '2021-09-01 05:22:09'),
(3, '+6282233999510', '+6285215910225', 'Pyu...', '2021-09-02 03:14:09'),
(4, '+6285215910225', '+6282233999510', 'Yup, kenapa?', '2021-09-02 03:27:12'),
(5, '+6285215910225', '+6282233999510', 'Adakah?', '2021-09-02 07:44:19'),
(6, '+6282233999510', '+6285215910225', 'Tidak ada', '2021-09-02 07:44:43'),
(7, '+6282233999510', '+6281243626272', 'How are you today?', '2021-09-02 07:45:59'),
(8, '+6281243626272', '+6282233999510', 'I\'m fine, thankyou', '2021-09-02 07:46:28'),
(9, '+6281243626272', '+6282233999510', 'How abaut you?', '2021-09-02 07:46:47'),
(10, '+6285215910225', '+6281243626272', 'Halo mom', '2021-09-02 07:55:39'),
(11, '+6281243626272', '+6285215910225', 'Halo Roya, kenapa?', '2021-09-02 07:56:52'),
(12, '+6285215910225', '+6281243626272', 'Cuma test mom', '2021-09-02 07:56:52'),
(13, '+6285215910225', '+6281243626272', 'Lagi bikin apa mom?', '2021-09-04 02:52:44'),
(14, '+6281243626272', '+6285215910225', 'Lagi di kebun Roya', '2021-09-04 02:53:08'),
(15, '+6285215910225', '+6281243626272', 'Oh, oke mami', '2021-09-04 02:53:32'),
(16, '+6285215910225', '+6282233999510', 'Ada mubawa laptop k?', '2021-09-04 02:54:08'),
(17, '+6285215910225', '+6282233999510', 'Iya saya pake dlu kerja tugas', '2021-09-04 02:54:30'),
(18, '+6282233999510', '+6285215910225', 'Bah, salah kirim terus hhh', '2021-09-04 02:55:15'),
(19, '+6285215910225', '+6282150888174', 'Halo Elon!', '2021-09-04 02:59:47'),
(20, '+6282150888174', '+6285215910225', 'Halo juga Royanti', '2021-09-04 03:00:12'),
(21, '+6282150888174', '+6282233999510', 'Halo Rizal, apa kabar?', '2021-09-04 03:02:33'),
(24, '+6282233999510', '+6281243626272', 'Hola Mami', '2021-09-04 03:48:26'),
(38, '+6282233999510', '+6281243626272', 'Selamat sing, Ada Yang bisa saya Bantu?', '2021-09-04 04:39:12'),
(39, '+6282233999510', '+6281243626272', 'Sudah sangat baik', '2021-09-04 04:44:30'),
(40, '+6282233999510', '+6282150888174', 'Baik bro', '2021-09-04 04:45:06'),
(41, '+6282233999510', '+6285215910225', 'Mantp', '2021-09-04 04:49:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `phone_number` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_image` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`phone_number`, `uid`, `username`, `profile_image`) VALUES
('+6281243626272', 'jW88n4ApfBUp4GoRxLPFy0soqH43', 'Mami', 'no-image'),
('+6282150888174', 'gFWXx3v10xMmu0aBtUAaWrBimts2', 'Elon Musk', '20210409050154975616.jpg'),
('+6282233999510', 'CVgyfEUUAgg0siHx5rfVdP5gCuZ2', 'Rizal Iswandy', '20210409071243883624.jpg'),
('+6285215910225', 'PxS0fQgh0MbZsUX9IvOUYOVjSPg1', 'Roya', '2021020909545021767a.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_fk0` (`sender`),
  ADD KEY `message_fk1` (`receiver`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`phone_number`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_fk0` FOREIGN KEY (`sender`) REFERENCES `user` (`phone_number`),
  ADD CONSTRAINT `message_fk1` FOREIGN KEY (`receiver`) REFERENCES `user` (`phone_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
