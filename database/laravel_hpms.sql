-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2025 at 04:28 PM
-- Server version: 8.0.41-0ubuntu0.22.04.1
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_hpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` bigint UNSIGNED NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `session_id`, `username`, `email`, `password`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Jl24JqXIdmMvXjt6ioZdD6otCjqXQxVAgOx96kk0', 'admin', 'admin@gmail.com', '$2a$12$bn.gJ49Q3hMCNEo7k8h.hOVWOGZd0XZtiOr9lJ4tnwX2WLfaaTdam', '8238938615', '2025-02-20 06:44:56', '2025-02-27 05:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `pid` int NOT NULL,
  `did` int NOT NULL,
  `aptid` varchar(255) NOT NULL,
  `patname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `docname` varchar(50) NOT NULL,
  `docFees` varchar(10) NOT NULL,
  `spec` varchar(30) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int NOT NULL,
  `doctorStatus` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`pid`, `did`, `aptid`, `patname`, `email`, `contact`, `docname`, `docFees`, `spec`, `appdate`, `apptime`, `userStatus`, `doctorStatus`, `created_at`, `updated_at`) VALUES
(9, 15, '1787058213', 'Fahad Siddqui', 'fahad@gmail.com', '7987968748', 'Lakhan Miyani', '250', 'General', '2025-02-25', '10:00:00', 1, 0, '2025-02-24 07:08:19', '2025-02-24 07:08:19'),
(9, 8, '6357593623', 'Fahad Siddqui', 'fahad@gmail.com', '7987968748', 'Dhruv Desai', '2100', 'Dermatologist', '2025-02-27', '12:00:00', 1, 0, '2025-02-24 07:08:38', '2025-02-24 07:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `doctreg`
--

CREATE TABLE `doctreg` (
  `did` bigint UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spec` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `docFees` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctreg`
--

INSERT INTO `doctreg` (`did`, `session_id`, `docname`, `email`, `contact`, `password`, `spec`, `docFees`, `created_at`, `updated_at`) VALUES
(1, 'kL6450hF00VojeUV5FM2bZ0SHpWIAe25vt2WFAZt', 'Jay Goyani', 'jay@elitecare.com', '8238938615', '$2a$12$2DPGZZBBQj8LjLxOaKP3yuVMdyL1JmmsayTcADpYcbtAu48GDOKhm', 'Cardiologist', '25000', '2025-02-24 06:41:32', '2025-02-27 05:15:29'),
(2, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Hasti Shihora', 'hasti@elitecare.com', '9797978987', '$2a$12$o8YAaIivN6.7mS1xf4p1IOQqZIBSYnvx/VugdkD5TTq0ZKE9C14n6', 'Cardiologist', '25500', '2025-02-24 06:42:15', '2025-02-24 06:42:15'),
(3, 'WT3cCN8H7toac87w3Qf9S30VlXHX1ks3PY6kzJ9I', 'Darshil Desai', 'darshil@elitecare.com', '9877789587', '$2a$12$o/PzOxLDSLCGLjoq71JCCerAGOyUVL2uqdmT6WM4tfZ8vkbsYEJKy', 'Urologist', '15000', '2025-02-24 06:43:15', '2025-02-27 05:14:43'),
(4, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Mitali Jivani', 'mitali@elitecare.com', '8974569826', '$2a$12$H00ZozEWrDL3ERFG5JYQ/OU/yr9CsvCPHdtUbfYqufOVmNX8ZIGTi', 'Surgeon', '21000', '2025-02-24 06:44:23', '2025-02-24 06:44:23'),
(5, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Hitarth Lakkad', 'hitarth@elitecare.com', '9987487985', '$2a$12$s5SkEVgDCOpRO6XrevFbauNtWRjvWBUQiNb7HBYUOOfSkwMVMveWm', 'Surgeon', '20000', '2025-02-24 06:45:10', '2025-02-24 06:45:10'),
(6, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Deep Patel', 'deep@elitecare.com', '7478974589', '$2a$12$OnFVwf7scgz2zpg3cWLGfueeH3YvEGq2H6h2xRP8PtuKFkl/vLJLS', 'Urologist', '18500', '2025-02-24 06:46:11', '2025-02-24 06:46:11'),
(7, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Bhavya Hihoriya', 'bhavya@elitecare.com', '8974896874', '$2a$12$dYCoygLMl1otpfej/DjsbeAhMJsB4JDoQOimAy3iClW4TSILHEUZW', 'Dermatologist', '1400', '2025-02-24 06:47:01', '2025-02-24 06:47:01'),
(8, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Dhruv Desai', 'dhruv@elitecare.com', '8796541789', '$2a$12$gdRSHlgUfe8JE9Wwh8tLSuG6HPAw1qo41QWkJ9CUrjkwDej5SBhda', 'Dermatologist', '2100', '2025-02-24 06:47:43', '2025-02-24 06:47:43'),
(9, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Aniket Kakkad', 'aniket@elitecare.com', '7895487968', '$2a$12$Ezdkc7zBug8dmDDwq3TJo.KAqvdzVDqMvFTVoZq60peu09A9GLali', 'Urologist', '3000', '2025-02-24 06:48:30', '2025-02-24 06:48:30'),
(10, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Pankaj Patel', 'pankaj@elitecare.com', '7748968725', '$2a$12$2A2RakgWWMpmKfm9bDGnv.n6QQ4kfdTUHfZkCqGFbXfafV7mf/kBu', 'Urologist', '1800', '2025-02-24 06:49:10', '2025-02-24 06:49:10'),
(11, 'ej3OtGG2rWx1HM2zmvhcnikjqgTer2K9qFbnCFQB', 'Hetvi Mangukiya', 'hetvi@elitecare.com', '9696874589', '$2a$12$eIc3TNg/UL65yp27wzCHE.rNqFeywT4aZrfv4.auaOcfTw5QQllOa', 'Radiologist', '7000', '2025-02-24 06:49:55', '2025-02-27 05:20:01'),
(12, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Himani Borda', 'himani@elitecare.com', '8789587458', '$2a$12$8IOQzd1ie2sMSkgvC9Lq/uoeiSmgIrtdtUbwbHsL27VSuKn9VEIJG', 'Radiologist', '6500', '2025-02-24 06:50:35', '2025-02-24 06:50:35'),
(13, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Feni Moradiya', 'feni@elitecare.com', '7895874896', '$2a$12$nsPi6.QzUnzTE4Gzvyf2XeQOkT0UaazQQ4j8qXcvAjN6QJCZfzFcO', 'Radiologist', '6000', '2025-02-24 06:51:28', '2025-02-24 06:51:28'),
(14, 'aNyN3DUvMssvOBsTYR3kITgfKgyOEnIwJuoQqXbe', 'Rajesh Patel', 'rajeshpatel@elitecare.com', '9965289749', '$2a$12$LitTiN0SwZSvrT7TBobGG.Hk.Sd8b2kc7tVOZl1/kDp8V8BuMSWVa', 'General', '300', '2025-02-24 06:52:17', '2025-02-24 06:52:17'),
(15, 'OQuq9QKN4fJYHEk2zRKAjSdBMMZBsQX7C7kM3WB8', 'Lakhan Miyani', 'lakhan@elitecare.com', '9796874896', '$2a$12$cerOxGksRm5Ukc9eq4Din.df6T9uHH.TAQyIEgKaCkFe6HzifDnEW', 'General', '250', '2025-02-24 06:52:58', '2025-02-24 07:42:24'),
(16, 'peb6o7kKXiv3Khxm72qZwFSoBRS5VYBQm9UqEwWG', 'john miss', 'johnmiss@gmail.com', '8569789745', '$2a$12$lnJC5lM60AWdmH9H96DGG.Q.zLezpRC1KkR1xk9s6UbmGOeQaePo6', 'Pediatrician', '799', '2025-02-27 04:46:36', '2025-02-27 04:46:36'),
(17, 'xADezZGFSVLCBfRRUWc3UxGsrJ7wFetQIffFaSCg', 'sushant', 'sushant@gmail.com', '9898987656', '$2a$12$3Bw4Fv8pZwzNaj39/6zrOeiewJAmta5ow1opM14GUBDXii6cumUKe', 'Ophthalmologist', '300', '2025-02-27 04:49:02', '2025-02-27 04:49:02'),
(18, '4EJSaGSC0oQHPfhajhPAMByAxF9BVNEulpgXzrbb', 'mia', 'mia@gmail.com', '7878458759', '$2y$10$cvZkbs9dCBMzvKr2MimB0uoR4.wPAt.vj65si7CS5DsKLARg/av0.', 'Urologist', '500', '2025-02-27 04:54:57', '2025-02-27 04:55:09'),
(19, 'Dbwhs7tl1VxVnc1fJohzScsZ8KC0lLLhC3bhaNvg', 'jill mill', 'jillmill@gmail.com', '8745874589', '$2y$10$XccMj/ASlmPAWf7Yij8u3edsQLy7zNDliwQhrDDmQNeIwyyoC4M32', 'General', '400', '2025-02-27 05:12:39', '2025-02-27 05:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(15, '2018_08_08_100000_create_telescope_entries_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2025_02_10_063956_create_patreg_table', 1),
(18, '2025_02_10_104959_create_doctreg_table', 1),
(19, '2025_02_10_105137_create_admin_table', 1),
(20, '2025_02_12_072848_create_sessions_table', 1),
(21, '2025_02_13_115907_create_appointments_table', 1),
(22, '2025_02_20_043834_create_prestb_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` bigint UNSIGNED NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `session_id`, `username`, `email`, `password`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Jaydeep Vaghela', 'jaydeep@gmail.com', '$2a$12$yILn3.4Nk/GC9vrhda8VMOy/DG9kQokPjhkhsWJMe9E/LZ.MtttXS', '8569856974', '2025-02-24 06:55:29', '2025-02-24 06:55:29'),
(2, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Suhani Mandaviya', 'suhani@gmail.com', '$2a$12$3eEbqXsb35Av5kh8fzA9D.kLsyu6LrWcZj2s5jwsPk5eiU2zjRmGC', '7489657458', '2025-02-24 06:56:01', '2025-02-24 06:56:01'),
(3, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Dhrupesh Shingala', 'sdpatel@gmail.com', '$2a$12$d2sIbrh/mhTp7uEDbKdVJutNLSrvFhu/OI1j.UKCIqYDgvWN4813u', '7463247895', '2025-02-24 06:56:32', '2025-02-24 06:56:32'),
(4, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Dhruv Parvadiya', 'dhruv@gmail.com', '$2a$12$uzwXgJQT3calr7RdyvOSH.bFOmDlVYwIaQz2V.s/bB4PcuhI7olDC', '8897458967', '2025-02-24 06:57:11', '2025-02-24 06:57:11'),
(5, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Priyanshi Chauhan', 'priyanshi@gmail.com', '$2a$12$xlqNvfyOD3VnlcUQu7g6ROoG7t1zKy5t.Sg4KKt21eE9dNLOSGLAu', '9878968598', '2025-02-24 06:57:52', '2025-02-24 06:57:52'),
(6, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Shivangi Patel', 'shivangi@gmail.com', '$2a$12$3oLZ3AbIayh9P6yWPiF6B.Rr8dHCINkEAwwR9orfj0R4hAyWv2ZAK', '8857496872', '2025-02-24 06:58:29', '2025-02-24 06:58:29'),
(7, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Mukti Patel', 'muktipatel@gmail.com', '$2a$12$fveZt8YnK3kok27Tim5.OeMdJJxe3vLf3xpiFUlQEOQ9kpe1q6tc.', '8569745896', '2025-02-24 06:59:16', '2025-02-24 06:59:16'),
(8, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Dhruv Patel', 'dhruvpatel@gmail.com', '$2a$12$NKPteONrPzbP/y2nXlU.8eRk6CKPD2vtrCwxQnyoD9sIqyVTH0Y.G', '8857487578', '2025-02-24 06:59:52', '2025-02-24 06:59:52'),
(9, 'bnYg28ZaDFIEhXJFLma6dXkw5gwVBU0cUD3j7yTh', 'Fahad Siddqui', 'fahad@gmail.com', '$2a$12$CFOGX6wwTyNPjJYbVw8v5um7FHQ8w0Yy3qujxrcH/O2e6B2sJJ2ai', '7987968748', '2025-02-24 07:00:19', '2025-02-27 05:07:41'),
(10, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Yash Sutariya', 'yashsutariya@gmail.com', '$2a$12$/Q9EeVYwTtUdTIas7Aix8OePhlk9FhI5S60NkcQ/f4qM2r5N.5SXO', '7777895745', '2025-02-24 07:00:58', '2025-02-24 07:00:58'),
(11, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Kaushal Vasoya', 'kaushal@gmail.com', '$2a$12$5pEYXZ/ouWbynOAntEsXqOkD07dAvSTEhM1hDs0MwFXDSuqFXnkRe', '8968745898', '2025-02-24 07:01:43', '2025-02-24 07:01:43'),
(12, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Avadh Gajera', 'avadhg@gmail.com', '$2a$12$sd8MPsss5ckrqh9SLV9AX.drRy6dqYTvbtpvcEYasSZpcdtzvWHx.', '8574698758', '2025-02-24 07:02:16', '2025-02-24 07:02:16'),
(13, 'Z5LfxiPiA8KXqAZ10g6p1wfrcDjhAIvaCX1nOpRP', 'Rushabh Savaliya', 'rushabhmaggie@gmail.com', '$2a$12$C4Q4MH.jxlSwKtVBivves.rGsTaopb30QkSUXdamXCYfp4TrMcT2O', '8756412839', '2025-02-24 07:02:49', '2025-02-24 07:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `docname` varchar(50) NOT NULL,
  `did` int NOT NULL,
  `pid` int NOT NULL,
  `aptid` bigint NOT NULL,
  `patname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(100) NOT NULL,
  `allergies` varchar(100) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `is_paid` int DEFAULT '0',
  `payment_method` varchar(25) DEFAULT NULL,
  `payment_details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`docname`, `did`, `pid`, `aptid`, `patname`, `appdate`, `apptime`, `disease`, `allergies`, `prescription`, `is_paid`, `payment_method`, `payment_details`, `created_at`, `updated_at`) VALUES
('Lakhan Miyani', 15, 9, 1787058213, 'Fahad Siddqui', '2025-02-25', '10:00:00', 'Cold', 'perfume inhale allergies', 'Nothing serious but avoid to inhale and use perfume', 0, NULL, NULL, '2025-02-24 07:26:07', '2025-02-24 07:26:07'),
('Lakhan Miyani', 15, 9, 1787058213, 'Fahad Siddqui', '2025-02-25', '10:00:00', 'Cold', 'NA', 'take some rest', 0, NULL, NULL, '2025-02-24 07:29:23', '2025-02-24 07:29:23'),
('Lakhan Miyani', 15, 9, 1787058213, 'Fahad Siddqui', '2025-02-25', '10:00:00', 'Cold', 'Perfume chemical reaction', 'Nothing serious but avoid to use perfume', 0, NULL, NULL, '2025-02-24 07:35:48', '2025-02-24 07:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ej3OtGG2rWx1HM2zmvhcnikjqgTer2K9qFbnCFQB', 11, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiME9FVzNTdnRvSGxlQmJVdTBhQURxVmtvYTJFbVZZZGNJOGczZlNNdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb2N0b3IvYXBwb2ludG1lbnRzIjt9czo1MzoibG9naW5fZG9jdG9yXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czo0OiJyb2xlIjtzOjY6ImRvY3RvciI7fQ==', 1740653825);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`aptid`);

--
-- Indexes for table `doctreg`
--
ALTER TABLE `doctreg`
  ADD PRIMARY KEY (`did`),
  ADD UNIQUE KEY `doctreg_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `patreg_email_unique` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctreg`
--
ALTER TABLE `doctreg`
  MODIFY `did` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;