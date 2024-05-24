-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2024 at 09:35 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogkategori`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

DROP TABLE IF EXISTS `artikel`;
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori` (`kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `konten`, `tanggal`, `kategori`, `gambar`) VALUES
(3, 'Spa neden onemli', 'Spa Ã¶nemli Ã§Ã¼nkÃ¼ stres azaltÄ±r, kaslarÄ± gevÅŸetir, kan dolaÅŸÄ±mÄ±nÄ± iyileÅŸtirir, cilt saÄŸlÄ±ÄŸÄ±nÄ± destekler, detoksifikasyonu artÄ±rÄ±r, uyku kalitesini iyileÅŸtirir ve genel zihinsel ve fiziksel saÄŸlÄ±ÄŸÄ± destekler. Spa tedavileri, rahatlama ve yenilenme saÄŸlayarak genel yaÅŸam kalitesini artÄ±rabilir.', '2024-05-24', 'Gghdga', 'ss.png'),
(4, 'Masaj Faydali', 'FarklÄ± sorunlarÄ± hafifletmek, tedavi etmek, fiziksel, zihinsel ve duygusal fayda saÄŸlamak iÃ§in kullanÄ±lan masaj; salon, spa veya spor merkezindeki en popÃ¼ler seÃ§enekler arasÄ±nda yer alÄ±r. SaÄŸlÄ±k faydalarÄ±nÄ±n yanÄ± sÄ±ra masaj, Ã¶te yandan bir zevktir. Bu nedenle masaj sÄ±rasÄ±nda elinizden geldiÄŸince kendinizi serbest bÄ±rakmalÄ± ve anÄ±n tadÄ±nÄ± Ã§Ä±karmalÄ±sÄ±nÄ±z. Masaj yÃ¶ntem ve teknikleri, vÃ¼cudun doku ve organlarÄ±na maksimum oranda oksijen ulaÅŸmasÄ±nÄ± saÄŸlayarak kan akÄ±ÅŸÄ±nÄ± dÃ¼zenler. Sakin, konforlu ve huzurlu hissetmek, masajÄ±n en Ã¶nemli faydalarÄ±ndan biri olarak karÅŸÄ±mÄ±za Ã§Ä±kar. Uzman ellerde uygulanan iyi bir masaj sizi rahatlamadan Ã§ok daha Ã¶tesine taÅŸÄ±r. Kendinizi dingin hissetmenizi saÄŸlayarak beyninizdeki sisi kaldÄ±rmaya destek olabilir. Peki, tÃ¼m dÃ¼nyada bu kadar Ã§ok tercih edilen masaj nedir? FarklÄ± tÃ¼rleri var mÄ±dÄ±r? FaydalarÄ± nelerdir? Elbette, bu sorularÄ±n cevaplarÄ±nÄ± yazÄ±mÄ±zda bulabilirsiniz. VereceÄŸimiz bilgiler Ä±ÅŸÄ±ÄŸÄ±nda kendiniz iÃ§in uygun olan masaj tÃ¼rlerini belirleyebilir ve vÃ¼cudunuzdaki her kasÄ±n nazikÃ§e gevÅŸeyen hissinin o mÃ¼kemmel tadÄ±nÄ± Ã§Ä±karmaya baÅŸlayabilirsiniz.', '2024-05-24', 'adgjadgjad', 'desainMakananlogo3.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Ahaha'),
(2, 'Sui'),
(3, 'Asu'),
(4, 'Gghdga'),
(5, 'adgjadgjad');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
