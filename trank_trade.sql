-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 10:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trank_trade`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_sell_trades`
--

CREATE TABLE `buy_sell_trades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `scrip_id` int(198) DEFAULT NULL,
  `bidprice` varchar(255) DEFAULT NULL,
  `lot` int(123) NOT NULL,
  `action` varchar(10) DEFAULT NULL,
  `status` enum('active','pending','closed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sell_ip` varchar(255) DEFAULT NULL,
  `buy_ip` varchar(145) DEFAULT NULL,
  `sell_at` timestamp NULL DEFAULT NULL,
  `bought_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy_sell_trades`
--

INSERT INTO `buy_sell_trades` (`id`, `user_id`, `company_id`, `scrip_id`, `bidprice`, `lot`, `action`, `status`, `created_at`, `sell_ip`, `buy_ip`, `sell_at`, `bought_at`) VALUES
(48, 106, NULL, 4, NULL, 1, 'buy', 'closed', '2023-06-01 08:09:35', '::1', '', NULL, NULL),
(49, 106, NULL, 2, NULL, 2, 'buy', 'closed', '2023-06-01 08:17:28', '::1', '', NULL, NULL),
(50, 106, NULL, 9, NULL, 1, 'sell', 'closed', '2023-06-01 08:17:38', '::1', '', NULL, NULL),
(51, 106, NULL, 13, NULL, 1, 'buy', 'closed', '2023-06-01 08:17:46', '::1', '', NULL, NULL),
(52, 106, NULL, 11, NULL, 1, 'sell', 'closed', '2023-06-01 08:18:04', '::1', '', NULL, NULL),
(53, 106, NULL, 2, NULL, 1, 'sell', 'closed', '2023-06-01 11:49:09', '::1', '', NULL, NULL),
(54, 106, NULL, 2, NULL, 1, 'buy', 'closed', '2023-06-01 11:49:12', '', '', NULL, NULL),
(55, 118, NULL, 1, NULL, 1, 'sell', 'pending', '2023-06-01 11:55:03', '', '', NULL, NULL),
(56, 118, NULL, 1, NULL, 1, 'buy', 'pending', '2023-06-01 11:55:06', '', '', NULL, NULL),
(57, 118, NULL, 3, NULL, 1, 'buy', 'pending', '2023-06-01 11:55:22', '::1', '', NULL, '2023-06-01 09:56:00'),
(58, 118, NULL, 3, NULL, 1, 'buy', 'pending', '2023-06-01 11:55:24', '', '', NULL, '2023-06-01 09:56:00'),
(59, 118, NULL, 2, NULL, 1, 'buy', 'pending', '2023-06-01 11:56:03', '', '', NULL, '2023-06-01 09:56:00'),
(60, 118, NULL, 2, NULL, 1, 'buy', 'pending', '2023-06-01 12:05:53', '', '', NULL, '2023-06-01 09:56:00'),
(61, 118, NULL, 1, NULL, 1, 'sell', 'pending', '2023-06-01 12:42:05', '', '', NULL, '2023-06-01 09:56:00'),
(62, 118, NULL, 1, NULL, 1, 'buy', 'pending', '2023-06-01 13:26:00', NULL, '::1', NULL, '2023-06-01 09:56:00'),
(63, 106, NULL, 1, NULL, 1, 'buy', 'closed', '2023-06-03 08:18:06', NULL, '::1', NULL, '2023-06-03 04:48:06'),
(64, 106, NULL, 1, NULL, 1, 'buy', 'closed', '2023-06-03 20:30:04', NULL, '::1', NULL, '2023-06-03 17:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `application_status` varchar(123) NOT NULL DEFAULT 'on',
  `config_active` varchar(255) DEFAULT 'off',
  `config_notifty` varchar(255) DEFAULT 'off',
  `profit_loss` varchar(255) DEFAULT 'off',
  `brokerage_share` varchar(255) DEFAULT 'off',
  `trading_clients` varchar(255) DEFAULT 'off',
  `sub_broker` varchar(255) DEFAULT 'off',
  `demo_account` varchar(255) DEFAULT 'off',
  `fresh_entry` varchar(255) DEFAULT 'off',
  `orders_between` varchar(255) DEFAULT NULL,
  `trade_equity` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT 'on',
  `auto_close_trades_condition_met` varchar(198) DEFAULT NULL,
  `aut_close_all_active` varchar(255) DEFAULT NULL,
  `notify_client_Ledger_balance` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `user_id`, `application_status`, `config_active`, `config_notifty`, `profit_loss`, `brokerage_share`, `trading_clients`, `sub_broker`, `demo_account`, `fresh_entry`, `orders_between`, `trade_equity`, `account_status`, `auto_close_trades_condition_met`, `aut_close_all_active`, `notify_client_Ledger_balance`) VALUES
(1, 3, 'on', '234', '234', '234', '', '', '', 'off', '', 'off', NULL, 'off', '0', NULL, NULL),
(3, 93, 'on', '234', '234', '234', '', '', '', 'off', NULL, 'off', NULL, 'off', '0', NULL, NULL),
(4, 94, 'on', '234', '234', '234', '', '', '', 'off', NULL, 'off', NULL, 'off', '0', NULL, NULL),
(9, 106, 'off', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', 'on', 'on', NULL, '', 45),
(21, 118, 'off', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(24, 125, 'off', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(25, 126, 'off', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(26, 127, 'off', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(27, 128, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(28, 129, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(29, 130, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, 'on', NULL, '90', 70),
(30, 132, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, '', NULL, '90', 70),
(31, 133, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, '', NULL, '90', 70),
(32, 134, 'on', 'off', 'off', 'off', 'off', 'off', 'off', NULL, 'on', 'on', NULL, '', NULL, '90', 70);

-- --------------------------------------------------------

--
-- Table structure for table `create_trades`
--

CREATE TABLE `create_trades` (
  `id` int(11) NOT NULL,
  `scrip` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `lots_units` varchar(255) NOT NULL,
  `buy_rate` varchar(255) NOT NULL,
  `sell_rate` varchar(255) NOT NULL,
  `transaction_password` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `create_trades`
--

INSERT INTO `create_trades` (`id`, `scrip`, `userid`, `lots_units`, `buy_rate`, `sell_rate`, `transaction_password`, `deleted_at`, `created_at`, `modified_at`) VALUES
(1, '2', '118', '1', '33', '21', '22243', NULL, '2023-06-02 13:00:11', '2023-06-02 13:00:11'),
(2, '13', '120', '23', '23', '223', '22243', NULL, '2023-06-02 13:00:31', '2023-06-02 13:00:31'),
(3, '2', '118', '1', '2', '12', '22243', NULL, '2023-06-02 13:01:15', '2023-06-02 13:01:15'),
(4, '3', '106', '12', '23', '21', '22243', NULL, '2023-06-02 13:03:40', '2023-06-02 13:03:40'),
(5, '3', '106', '34', '34', '34', '22243', NULL, '2023-06-02 13:04:13', '2023-06-02 13:04:13'),
(6, '2', '119', '234', '34', '2', '22243', NULL, '2023-06-02 13:04:29', '2023-06-02 13:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `equity_features`
--

CREATE TABLE `equity_features` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `equity_trading` varchar(255) DEFAULT NULL,
  `equity_brokerage` varchar(255) DEFAULT NULL,
  `intraday_exposure` varchar(255) DEFAULT NULL,
  `holding_exposure` varchar(255) DEFAULT NULL,
  `transaction_password` varchar(255) DEFAULT NULL,
  `min_lot_size_equity` int(255) DEFAULT NULL,
  `max_lot_size_equity` int(255) DEFAULT NULL,
  `min_lot_size_equity_index` int(255) DEFAULT NULL,
  `max_lot_size_equity_index` int(255) DEFAULT NULL,
  `max_lot_size_active_equity` int(255) DEFAULT NULL,
  `max_size_all_equity` int(255) DEFAULT NULL,
  `max_size_all_index` int(255) DEFAULT NULL,
  `intraday_exposure_equity` int(255) DEFAULT NULL,
  `holding_exposure_equity` int(255) DEFAULT NULL,
  `order_away_percentage` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equity_features`
--

INSERT INTO `equity_features` (`id`, `user_id`, `equity_trading`, `equity_brokerage`, `intraday_exposure`, `holding_exposure`, `transaction_password`, `min_lot_size_equity`, `max_lot_size_equity`, `min_lot_size_equity_index`, `max_lot_size_equity_index`, `max_lot_size_active_equity`, `max_size_all_equity`, `max_size_all_index`, `intraday_exposure_equity`, `holding_exposure_equity`, `order_away_percentage`) VALUES
(1, 102, 'on', '800', '34', '32', '22243', 800, 50, 0, 20, 100, 0, 0, 0, 0, 0),
(2, 103, NULL, '800', '', '', '22243', 800, 50, 0, 20, 100, 0, 0, 0, 0, 0),
(3, 104, NULL, '800', '', '', '22243', 800, 50, 0, 20, 100, 0, 0, 0, 0, 0),
(4, 105, NULL, '800', '', '', '22243', 800, 50, 0, 20, 100, 0, 0, 0, 0, 0),
(5, 106, 'on', '800', '12', '42', '22243', 800, 50, 0, 20, 100, 200, 200, 0, 200, 0),
(6, 108, NULL, '', '34', '32', '22243', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 109, NULL, '', '34', '32', '22243', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 110, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 34),
(9, 111, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(10, 112, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(11, 113, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(12, 114, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(13, 115, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(14, 116, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(15, 117, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(16, 118, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 34),
(17, 119, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(18, 120, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(19, 125, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(20, 126, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(21, 127, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(22, 128, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(23, 129, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(24, 130, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(25, 132, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(26, 133, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(27, 134, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(28, 136, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0),
(29, 137, 'on', '800', '500', '100', '22243', 0, 50, 0, 20, 100, 200, 200, 5, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `explore_trade_table`
--

CREATE TABLE `explore_trade_table` (
  `company_id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `market_price` decimal(10,2) NOT NULL,
  `close_price` decimal(10,2) NOT NULL,
  `market_cap` int(11) NOT NULL,
  `trade_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `explore_trade_table`
--

INSERT INTO `explore_trade_table` (`company_id`, `user_id`, `company_name`, `market_price`, `close_price`, `market_cap`, `trade_date`) VALUES
(3, 106, 'Reliance', '2.00', '2.00', 190000, '2023-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` int(11) NOT NULL,
  `user_id` varchar(156) NOT NULL,
  `amount` varchar(156) NOT NULL,
  `withdraw_amount` int(198) DEFAULT NULL,
  `total_amount` int(198) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `transaction_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `amount`, `withdraw_amount`, `total_amount`, `notes`, `created_at`, `transaction_date`) VALUES
(1, '102', '400', NULL, 0, '', '2023-05-25 10:46:04', '2023-05-27 19:53:13'),
(2, '118', '9796', NULL, 0, '', '2023-05-29 12:05:29', '2023-06-01 17:25:18'),
(3, '106', '1290.53', NULL, 0, '', '2023-05-31 07:18:51', '2023-06-04 01:59:51'),
(6, '3', '38', NULL, 0, 'cb', '2023-06-02 20:02:05', '2023-06-03 01:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `mcx_features`
--

CREATE TABLE `mcx_features` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `mcx_trading` varchar(255) DEFAULT NULL,
  `mcx_brokerage_type` varchar(255) DEFAULT NULL,
  `mcx_brokerage` varchar(255) DEFAULT NULL,
  `exposure_mcx_type` varchar(255) DEFAULT NULL,
  `intraday_exposure` varchar(255) DEFAULT NULL,
  `holding_exposure` varchar(255) DEFAULT NULL,
  `application_status` varchar(255) DEFAULT NULL,
  `minimum_lot` int(255) DEFAULT NULL,
  `maximum_lot_per_single` int(255) DEFAULT NULL,
  `maximum_lot_per_script` int(255) DEFAULT NULL,
  `max_size` int(255) DEFAULT NULL,
  `goldM` int(255) DEFAULT NULL,
  `silverM` int(255) DEFAULT NULL,
  `bulldex` int(255) DEFAULT NULL,
  `gold` int(255) DEFAULT NULL,
  `silver` int(255) DEFAULT NULL,
  `crudeoil` int(255) DEFAULT NULL,
  `cooper` int(255) DEFAULT NULL,
  `nickel` int(255) DEFAULT NULL,
  `zinc` int(255) DEFAULT NULL,
  `lead` int(255) DEFAULT NULL,
  `naturalgas` int(255) DEFAULT NULL,
  `naturalgas_mini` int(255) DEFAULT NULL,
  `aluminium` int(255) DEFAULT NULL,
  `methanoil` int(255) DEFAULT NULL,
  `cotton` int(255) DEFAULT NULL,
  `silvermic` int(255) DEFAULT NULL,
  `zincmini` int(255) DEFAULT NULL,
  `alumini` int(255) DEFAULT NULL,
  `lead_mini` int(255) DEFAULT NULL,
  `crudeoil_mini` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mcx_features`
--

INSERT INTO `mcx_features` (`id`, `user_id`, `mcx_trading`, `mcx_brokerage_type`, `mcx_brokerage`, `exposure_mcx_type`, `intraday_exposure`, `holding_exposure`, `application_status`, `minimum_lot`, `maximum_lot_per_single`, `maximum_lot_per_script`, `max_size`, `goldM`, `silverM`, `bulldex`, `gold`, `silver`, `crudeoil`, `cooper`, `nickel`, `zinc`, `lead`, `naturalgas`, `naturalgas_mini`, `aluminium`, `methanoil`, `cotton`, `silvermic`, `zincmini`, `alumini`, `lead_mini`, `crudeoil_mini`) VALUES
(5, '106', 'on', 'Select brokerage calculation type', '23', 'Select margin/exposure calculation type', '12', '42', NULL, 324, 3232, 0, 12, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 90, 0, 213, 0, 123, 23, 0, 0),
(6, '107', 'on', 'per_lot_basis', '55', 'Select margin/exposure calculation type', '34', '32', NULL, 23, 32, 0, 34, 32, 234, 34, 34, 32, 34, 34, 34, 23, 0, 2, 3223, 0, 0, 0, 0, 0, 0, 0, 0),
(18, '118', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, '125', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, '126', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '127', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, '128', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, '129', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, '130', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, '132', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, '133', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, '134', 'on', 'Select brokerage calculation type', '800', 'Select margin/exposure calculation type', '500', '100', NULL, 20, 0, NULL, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `message`, `created_at`) VALUES
(1, 'hello', 'sdfgsdg', '2023-05-16 13:05:03'),
(2, 'hii', 'fgh', '2023-05-16 13:05:03'),
(5, 'hello this is rohit', 'hello', '2023-05-18 11:10:43'),
(6, 'creation trades', 'hello', '2023-05-19 13:25:48'),
(7, 'lk\'jn\'ljl', 'test', '2023-06-01 14:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `option_config`
--

CREATE TABLE `option_config` (
  `id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `options_trading` int(255) DEFAULT NULL,
  `options_brokerage_type` int(255) DEFAULT NULL,
  `options_brokerage` int(255) DEFAULT NULL,
  `options_min_bid_price` int(255) DEFAULT NULL,
  `options_short_selling` int(198) DEFAULT NULL,
  `min_lot_size_equity_options` int(255) DEFAULT NULL,
  `max_lot_size_equity_options` int(255) DEFAULT NULL,
  `min_lot_size_index_options` int(255) DEFAULT NULL,
  `max_lot_size_index_options` int(255) DEFAULT NULL,
  `max_lot_size_active_equity_index` int(255) NOT NULL,
  `max_size_all_equity` int(255) DEFAULT NULL,
  `max_size_all_index` int(255) DEFAULT NULL,
  `intraday_exposure_equity` int(255) DEFAULT NULL,
  `holding_exposure_equity` int(255) DEFAULT NULL,
  `order_away_percentage` int(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option_config`
--

INSERT INTO `option_config` (`id`, `user_id`, `options_trading`, `options_brokerage_type`, `options_brokerage`, `options_min_bid_price`, `options_short_selling`, `min_lot_size_equity_options`, `max_lot_size_equity_options`, `min_lot_size_index_options`, `max_lot_size_index_options`, `max_lot_size_active_equity_index`, `max_size_all_equity`, `max_size_all_index`, `intraday_exposure_equity`, `holding_exposure_equity`, `order_away_percentage`, `created_at`, `modified_at`) VALUES
(20, 102, 0, 0, 23, 32, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-25 07:52:51', '2023-05-25 07:52:51'),
(21, 103, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-25 07:56:29', '2023-05-25 07:56:29'),
(22, 104, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-25 08:06:53', '2023-05-25 08:06:53'),
(23, 105, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-25 08:07:34', '2023-05-25 08:07:34'),
(24, 106, NULL, 0, 8, 89, NULL, 76, 8776, 76, 0, 200, 200, 200, 0, 200, 0, '2023-05-26 06:52:42', '2023-05-26 06:52:42'),
(25, 108, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-26 10:30:44', '2023-05-26 10:30:44'),
(26, 109, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-05-26 11:39:33', '2023-05-26 11:39:33'),
(27, 110, 0, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 34, '2023-05-26 11:41:49', '2023-05-26 11:41:49'),
(28, 111, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:43:46', '2023-05-26 11:43:46'),
(29, 112, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:46:57', '2023-05-26 11:46:57'),
(30, 113, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:47:58', '2023-05-26 11:47:58'),
(31, 114, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:49:54', '2023-05-26 11:49:54'),
(32, 115, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:53:57', '2023-05-26 11:53:57'),
(33, 116, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:54:18', '2023-05-26 11:54:18'),
(34, 117, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-26 11:55:15', '2023-05-26 11:55:15'),
(35, 118, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 34, '2023-05-29 05:21:35', '2023-05-29 05:21:35'),
(36, 119, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-29 09:23:19', '2023-05-29 09:23:19'),
(37, 120, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-05-29 09:23:58', '2023-05-29 09:23:58'),
(38, 125, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:29:37', '2023-06-04 20:29:37'),
(39, 126, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:32:38', '2023-06-04 20:32:38'),
(40, 127, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:34:47', '2023-06-04 20:34:47'),
(41, 128, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:36:15', '2023-06-04 20:36:15'),
(42, 129, NULL, 0, 20, 0, NULL, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:38:00', '2023-06-04 20:38:00'),
(43, 130, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:40:52', '2023-06-04 20:40:52'),
(44, 132, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:44:22', '2023-06-04 20:44:22'),
(45, 133, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:45:25', '2023-06-04 20:45:25'),
(46, 134, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:46:33', '2023-06-04 20:46:33'),
(47, 136, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:49:05', '2023-06-04 20:49:05'),
(48, 137, 0, 0, 20, 0, 0, 0, 50, 0, 50, 200, 200, 200, 5, 2, 0, '2023-06-04 20:49:30', '2023-06-04 20:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `broker` varchar(255) DEFAULT NULL,
  `transaction_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `user_id`, `notes`, `broker`, `transaction_password`, `created_at`, `modified_at`) VALUES
(5, 106, 'hello', '3', '22243', '2023-05-26 06:52:42', '2023-05-26 06:52:42'),
(6, 107, 'hello', '3', '22243', '2023-05-26 06:52:42', '2023-05-26 06:52:42'),
(17, 118, 'hello', '3', '22243', '2023-05-29 05:21:35', '2023-05-29 05:21:35'),
(20, 125, '', '', '22243', '2023-06-04 20:29:37', '2023-06-04 20:29:37'),
(21, 126, '', '3', '22243', '2023-06-04 20:32:38', '2023-06-04 20:32:38'),
(22, 127, '', '3', '22243', '2023-06-04 20:34:47', '2023-06-04 20:34:47'),
(23, 128, '', '3', '22243', '2023-06-04 20:36:15', '2023-06-04 20:36:15'),
(24, 129, '', '3', '22243', '2023-06-04 20:38:00', '2023-06-04 20:38:00'),
(25, 130, '', '3', '22243', '2023-06-04 20:40:52', '2023-06-04 20:40:52'),
(26, 132, '', '', '22243', '2023-06-04 20:44:22', '2023-06-04 20:44:22'),
(27, 133, '', '3', '22243', '2023-06-04 20:45:25', '2023-06-04 20:45:25'),
(28, 134, '', '3', '22243', '2023-06-04 20:46:33', '2023-06-04 20:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `scrip_id` varchar(255) DEFAULT NULL,
  `lots_units` varchar(255) DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `transaction_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`id`, `user_id`, `scrip_id`, `lots_units`, `price`, `order_type`, `transaction_password`, `created_at`) VALUES
(3, 106, '9', '1', 2000, 'Sell', '22243', '2023-06-03 20:16:52'),
(4, 106, '3', '1', 2000, 'Buy', '22243', '2023-06-03 20:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `sub_broker_actions` varchar(255) DEFAULT NULL,
  `payinAllowed` varchar(255) DEFAULT NULL,
  `payoutAllowed` varchar(255) DEFAULT NULL,
  `createClientsAllowed` varchar(255) DEFAULT NULL,
  `clientTasksAllowed` varchar(255) DEFAULT NULL,
  `tradeActivityAllowed` varchar(255) DEFAULT NULL,
  `notificationsAllowed` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_tasks`
--

CREATE TABLE `scheduled_tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `next_execution` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheduled_tasks`
--

INSERT INTO `scheduled_tasks` (`id`, `task_name`, `next_execution`, `user_id`) VALUES
(1, 'send_loss_notifications', '1685910877', '125'),
(2, 'send_loss_notifications', '1685911058', '126'),
(3, 'send_loss_notifications', '1685911187', '127'),
(4, 'send_loss_notifications', '1685911275', '128'),
(5, 'send_loss_notifications', '1685911380', '129'),
(6, 'send_loss_notifications', '1685911552', '130'),
(7, 'send_loss_notifications', '1685911762', '132'),
(8, 'send_loss_notifications', '1685911825', '133'),
(9, 'send_loss_notifications', '1685911893', '134'),
(10, 'send_loss_notifications', '1685912045', '136'),
(11, 'send_loss_notifications', '1685912070', '137');

-- --------------------------------------------------------

--
-- Table structure for table `trader_funds`
--

CREATE TABLE `trader_funds` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `fund` varchar(255) NOT NULL,
  `transaction_password` varchar(255) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trader_funds`
--

INSERT INTO `trader_funds` (`id`, `userid`, `notes`, `fund`, `transaction_password`, `deleted_at`, `created_at`, `modified_at`) VALUES
(5, '107', 'ertge', '24', '22243', '2023-05-24 11:36:28', '2023-05-24 11:36:28', '2023-05-24 11:36:28'),
(6, '102', 'opening balance', '2300', '22243', '2023-05-29 08:02:11', '2023-05-29 08:02:11', '2023-05-29 08:02:11'),
(7, '102', 'opening balance', '2323', '22243', '2023-05-29 08:04:58', '2023-05-29 08:04:58', '2023-05-29 08:04:58'),
(8, '102', 'current balance', '4565', '22243', '2023-05-29 08:05:29', '2023-05-29 08:05:29', '2023-05-29 08:05:29'),
(9, '102', 'opening balance', '4352', '22243', '2023-05-29 08:06:04', '2023-05-29 08:06:04', '2023-05-29 08:06:04'),
(10, '118', 'gfhnfgh', '234', '22243', '2023-05-29 08:24:53', '2023-05-29 08:24:53', '2023-05-29 08:24:53'),
(11, '106', '56767', '34', '22243', '2023-05-29 09:24:18', '2023-05-29 09:24:18', '2023-05-29 09:24:18'),
(12, '106', '5674', '4353', '22243', '2023-05-29 09:24:32', '2023-05-29 09:24:32', '2023-05-29 09:24:32'),
(13, '106', 'reger', '234', '22243', '2023-05-29 09:27:05', '2023-05-29 09:27:05', '2023-05-29 09:27:05'),
(14, '106', '6456', '23423', '22243', '2023-05-29 09:30:34', '2023-05-29 09:30:34', '2023-05-29 09:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `trading_table`
--

CREATE TABLE `trading_table` (
  `scrip_id` int(11) NOT NULL,
  `scrip_name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `bid` decimal(10,2) DEFAULT NULL,
  `ask` decimal(10,2) DEFAULT NULL,
  `last` decimal(10,2) DEFAULT NULL,
  `high` decimal(10,2) DEFAULT NULL,
  `low` decimal(10,2) DEFAULT NULL,
  `change` decimal(10,2) DEFAULT NULL,
  `open` decimal(10,2) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `last_traded_qty` int(11) DEFAULT NULL,
  `atp` decimal(10,2) DEFAULT NULL,
  `lot_size` int(11) DEFAULT NULL,
  `open_interest` int(11) DEFAULT NULL,
  `bid_qty` int(11) DEFAULT NULL,
  `ask_qty` int(11) DEFAULT NULL,
  `prev_close` decimal(10,2) DEFAULT NULL,
  `upper_circuit` decimal(10,2) DEFAULT NULL,
  `lower_circuit` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trading_table`
--

INSERT INTO `trading_table` (`scrip_id`, `scrip_name`, `type`, `bid`, `ask`, `last`, `high`, `low`, `change`, `open`, `volume`, `last_traded_qty`, `atp`, `lot_size`, `open_interest`, `bid_qty`, `ask_qty`, `prev_close`, `upper_circuit`, `lower_circuit`, `created_at`) VALUES
(1, 'ALLUMINIUM', 'MCX', '708.70', '710.45', '710.00', '711.40', '708.00', '3.55', '708.60', 8, 1, '709.51', 2500, 126, 10, 8, '706.45', '734.70', '678.20', '2023-05-30 05:03:21'),
(2, 'CRUDEOIL', 'MCX', '708.70', '710.45', '710.00', '711.40', '708.00', '3.55', '708.60', 8, 1, '709.51', 2500, 126, 10, 8, '706.45', '734.70', '678.20', '2023-05-30 05:03:21'),
(3, 'GOLD', 'MCX', '1800.50', '1802.20', '1801.00', '1810.00', '1798.00', '2.20', '1799.50', 15, 2, '1800.10', 50, 30, 5, 3, '1798.80', '1820.00', '1780.00', '2023-05-30 05:03:21'),
(4, 'SILVER', 'NSE', '25.35', '25.40', '25.38', '25.50', '25.25', '0.08', '25.32', 200, 10, '25.36', 1000, 50, 15, 12, '25.30', '25.80', '25.00', '2023-05-30 05:03:21'),
(6, 'COPPER', 'OPTIONS', '4.25', '4.26', '4.27', '4.28', '4.24', '0.03', '4.26', 1000, 50, '4.25', 2000, 150, 20, 18, '4.24', '4.32', '4.20', '2023-05-30 05:03:21'),
(7, 'PLATINUM', 'NSE', '1100.10', '1102.00', '1100.50', '1105.00', '1099.50', '1.20', '1100.00', 10, 1, '1101.00', 10, 5, 2, 3, '1099.80', '1110.00', '1095.00', '2023-05-30 05:03:21'),
(9, 'LEAD', 'MCX', '1800.50', '1802.20', '1801.00', '1810.00', '1798.00', '2.20', '1799.50', 15, 2, '1800.10', 50, 30, 5, 3, '1798.80', '1820.00', '1780.00', '2023-05-30 05:03:21'),
(11, 'PARLE', 'NSE', '3.05', '3.06', '3.07', '3.08', '3.04', '0.02', '3.06', 500, 25, '3.05', 5000, 200, 50, 40, '3.04', '3.12', '3.00', '2023-05-30 05:03:21'),
(12, 'RELIENCE', 'NSE', '4.25', '4.26', '4.27', '4.28', '4.24', '0.03', '4.26', 1000, 50, '4.25', 2000, 150, 20, 18, '4.24', '4.32', '4.20', '2023-05-30 05:03:21'),
(13, 'TATASTEEL', 'NSE', '1100.10', '1102.00', '1100.50', '1105.00', '1099.50', '1.20', '1100.00', 10, 1, '1101.00', 10, 5, 2, 3, '1099.80', '1110.00', '1095.00', '2023-05-30 05:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `amount` int(155) NOT NULL,
  `type` varchar(255) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `user_id`, `amount`, `type`, `transaction_date`) VALUES
(21, 106, 1, 'withdraw', '2023-06-01 18:30:00'),
(22, 106, 1, 'withdraw', '2023-06-01 18:30:00'),
(23, 106, 33836, 'withdraw', '2023-06-02 18:30:00'),
(24, 108, 33836, 'withdraw', '2023-08-02 18:30:00'),
(25, 106, 2000, 'add', '2023-06-03 20:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(123) DEFAULT NULL,
  `user_role` enum('admin','superadmin','user') DEFAULT 'user',
  `username` varchar(123) DEFAULT NULL,
  `password` varchar(123) DEFAULT NULL,
  `transaction_password` varchar(123) DEFAULT NULL,
  `type` varchar(123) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `initial_funds` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `user_role`, `username`, `password`, `transaction_password`, `type`, `name`, `mobile`, `initial_funds`, `city`, `created_at`, `modified_at`) VALUES
(3, 'Rohit', 'Singh', 'superadmin', 'rohit@7723', 'superadmin', '22243', NULL, '', '0', NULL, NULL, '2023-05-26 08:15:36', '2023-05-26 08:15:36'),
(106, NULL, NULL, 'user', 'RK45', '1234', NULL, 'user', 'Rohit Vishwakarmaa', '7723996397', '0', 'delhi', '2023-05-31 06:38:15', '2023-05-31 06:38:15'),
(118, NULL, NULL, 'user', 'TR30', '12345', NULL, 'user', 'Tarun', 'q', '12', 'gurgaon', '2023-05-29 12:05:05', '2023-05-29 12:05:05'),
(126, NULL, NULL, 'user', 'rk21', '', NULL, 'user', 'Rohit', '54435', 'ssd', 'satna', '2023-06-04 20:33:06', '2023-06-04 20:33:06'),
(127, NULL, NULL, 'user', 'RS32', '12345', NULL, 'user', 'Rahul Soni', '987987655', 'eqew', 'gurgaon', '2023-06-04 20:34:47', '2023-06-04 20:34:47'),
(128, NULL, NULL, 'user', 'KR87', '', NULL, 'user', 'Kadir Khan', '675674534', '23', 'Gurgaon', '2023-06-04 20:36:51', '2023-06-04 20:36:51'),
(129, NULL, NULL, 'user', 'LK24', '12345', NULL, 'user', 'Ram ', '87654645', '23', 'satna', '2023-06-04 20:54:55', '2023-06-04 20:54:55'),
(130, NULL, NULL, 'user', 'RD45', '12345', NULL, 'user', 'Radhe', '6754376543', '432', 'gurgaon', '2023-06-04 20:40:52', '2023-06-04 20:40:52'),
(133, NULL, NULL, 'user', 'sefw324', '2342', NULL, 'user', 'Rohit', '543', '4423', 'rfwer', '2023-06-04 20:45:25', '2023-06-04 20:45:25'),
(134, NULL, NULL, 'user', 'RW234', '4234234', NULL, 'user', 'ERYTER', '4324552', '123', 'SATNAQ', '2023-06-04 20:46:33', '2023-06-04 20:46:33'),
(135, NULL, NULL, 'user', 'DFWEF', '', NULL, 'user', 'GER', '53453453', '', '', '2023-06-04 20:47:26', '2023-06-04 20:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_funds`
--

CREATE TABLE `withdrawal_funds` (
  `id` int(11) NOT NULL,
  `user_id` varchar(156) NOT NULL,
  `withdrawal_amount` varchar(156) DEFAULT NULL,
  `total_amount` int(198) NOT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawal_funds`
--

INSERT INTO `withdrawal_funds` (`id`, `user_id`, `withdrawal_amount`, `total_amount`, `transaction_date`, `created_at`) VALUES
(1, '102', '57', 0, '2023-05-27', '2023-05-27 14:23:19'),
(2, '106', '9000', 0, '2023-05-31', '2023-05-31 13:06:17'),
(3, '106', '879', 0, '2023-05-31', '2023-05-31 13:06:29'),
(4, '106', '67867', 0, '2023-05-31', '2023-05-31 13:06:34'),
(5, '106', '15000', 0, '2023-05-31', '2023-05-31 13:06:42'),
(6, '106', '150000', 0, '2023-05-31', '2023-05-31 13:06:47'),
(7, '106', '1', 0, '2023-05-31', '2023-05-31 13:06:52'),
(8, '106', '9000', 0, '2023-05-31', '2023-05-31 13:06:58'),
(9, '106', '78989', 0, '2023-05-31', '2023-05-31 13:07:13'),
(10, '106', '69640', 0, '2023-06-01', '2023-06-01 05:53:25'),
(11, '106', '4000', 0, '2023-06-01', '2023-06-01 07:51:29'),
(12, '106', '64986', 0, '2023-06-01', '2023-06-01 07:51:46'),
(13, '106', '1', 0, '2023-06-02', '2023-06-02 19:17:09'),
(14, '106', '1', 0, '2023-06-02', '2023-06-02 19:18:14'),
(15, '106', '1', 0, '2023-06-02', '2023-06-02 19:18:39'),
(16, '106', '1', 0, '2023-06-02', '2023-06-02 19:18:53'),
(17, '106', '1', 0, '2023-06-02', '2023-06-02 19:19:44'),
(18, '106', '4', 0, '2023-06-02', '2023-06-02 19:19:56'),
(19, '106', '4', 0, '2023-06-02', '2023-06-02 19:20:37'),
(20, '106', '4', 0, '2023-06-02', '2023-06-02 19:21:37'),
(21, '106', '1', 0, '2023-06-02', '2023-06-02 19:21:51'),
(22, '106', '1', 0, '2023-06-02', '2023-06-02 20:28:01'),
(23, '106', '1', 0, '2023-06-02', '2023-06-02 20:28:28'),
(24, '106', '1', 0, '2023-06-02', '2023-06-02 20:28:46'),
(25, '106', '1', 0, '2023-06-02', '2023-06-02 20:29:20'),
(26, '106', '33836', 0, '2023-06-03', '2023-06-03 08:18:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_sell_trades`
--
ALTER TABLE `buy_sell_trades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_trades`
--
ALTER TABLE `create_trades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equity_features`
--
ALTER TABLE `equity_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explore_trade_table`
--
ALTER TABLE `explore_trade_table`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcx_features`
--
ALTER TABLE `mcx_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_config`
--
ALTER TABLE `option_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trader_funds`
--
ALTER TABLE `trader_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trading_table`
--
ALTER TABLE `trading_table`
  ADD PRIMARY KEY (`scrip_id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_funds`
--
ALTER TABLE `withdrawal_funds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_sell_trades`
--
ALTER TABLE `buy_sell_trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `create_trades`
--
ALTER TABLE `create_trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equity_features`
--
ALTER TABLE `equity_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `explore_trade_table`
--
ALTER TABLE `explore_trade_table`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mcx_features`
--
ALTER TABLE `mcx_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `option_config`
--
ALTER TABLE `option_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trader_funds`
--
ALTER TABLE `trader_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trading_table`
--
ALTER TABLE `trading_table`
  MODIFY `scrip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `withdrawal_funds`
--
ALTER TABLE `withdrawal_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `explore_trade_table`
--
ALTER TABLE `explore_trade_table`
  ADD CONSTRAINT `explore_trade_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
