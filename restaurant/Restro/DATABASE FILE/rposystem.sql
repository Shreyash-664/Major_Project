SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `rposystem`
-- Table structure for table `rpos_admin`

CREATE TABLE `rpos_admin` (
  `admin_id` varchar(200) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `rpos_admin`
INSERT INTO `rpos_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
('101admin', 'System Admin', 'admin@mail.com', 'admin123');

-- Table structure for table `rpos_customers`
CREATE TABLE `rpos_customers` (
  `customer_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `rpos_orders`

CREATE TABLE `rpos_orders` (
  `order_id` varchar(200) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `prod_id` varchar(200) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_price` varchar(200) NOT NULL,
  `prod_qty` varchar(200) NOT NULL,
  `order_status` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `rpos_payments`

CREATE TABLE `rpos_payments` (
  `pay_id` varchar(200) NOT NULL,
  `pay_code` varchar(200) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `pay_amt` varchar(200) NOT NULL,
  `pay_method` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `rpos_products`

CREATE TABLE `rpos_products` (
  `prod_id` varchar(200) NOT NULL,
  `prod_code` varchar(200) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_img` varchar(200) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_price` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `rpos_products`
INSERT INTO `rpos_products` (`prod_id`, `prod_code`, `prod_name`, `prod_img`, `prod_desc`, `prod_price`, `created_at`) VALUES
('06dc36c1be', 'FCWU-5762', 'Idli Sambar', 'i.jpg', 'Idli Sambar', '30', '2023-27-03 11:02:47.738370'),
('0c4b5c0604', 'JRZN-9518', 'Medu Vada Sambar', 'm.jpg', 'Medu Vada Sambar', '40', '2023-27-03 11:03:48.610897'),
('14c7b6370e', 'QZHM-0391', 'Mysore Onion Uttapam', 'mou.jpg', 'Mysore Onion Uttapam', '70', '2023-27-03 11:04:47.738370'),
('1e0fa41eee', 'ICFU-1406', 'Masala Uttapam', 'm-u.jpg', 'Masala Uttapam', '60', '2023-27-03 11:05:47.738370'),
('2b976e49a0', 'CEWV-9438', 'Misal Pav', 'm1.jpg', 'Misal Pav', '45', '2023-27-03 11:06:47.738370'),
('2fdec9bdfb', 'UJAK-9614', 'Sabudana Vada', 'sv.jpg', 'Sabudana Vada', '40', '2023-27-03 11:07:47.738370'),
('31dfcc94cf', 'SYQP-3710', 'Masala Dosa', 'dosa.jpg', 'Masala Dosa', '50', '2023-27-03 11:08:47.738370'),
('3adfdee116', 'HIPF-5346', 'Mysore Sada Dosa', 'msd.jpg', 'Mysore Sada Dosa', '50', '2023-27-03 11:09:47.738370'),
('3d19e0bf27', 'EMBH-6714', 'Pav Bhaji', 'pb.jpg', 'Pav Bhaji', '90', '2023-27-03 11:10:47.738370'),
('4e68e0dd49', 'QLKW-0914', 'Vada Pav', 'vp.jpg', 'Vada Pav', '15', '2023-27-03 11:11:47.738370');


-- Indexes for table `rpos_admin`
ALTER TABLE `rpos_admin`
  ADD PRIMARY KEY (`admin_id`);

-- Indexes for table `rpos_orders`
ALTER TABLE `rpos_orders`
  ADD PRIMARY KEY (`order_id`);

-- Indexes for table `rpos_payments`
ALTER TABLE `rpos_payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `order` (`order_code`);

-- Indexes for table `rpos_products`
ALTER TABLE `rpos_products`
  ADD PRIMARY KEY (`prod_id`);

-- Constraints for table `rpos_orders`
ALTER TABLE `rpos_orders`
  ADD CONSTRAINT `ProductOrder` FOREIGN KEY (`prod_id`) REFERENCES `rpos_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;