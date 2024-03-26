-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2024 at 09:46 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish_r_us`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_ID` int NOT NULL AUTO_INCREMENT,
  `Surname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Forename` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Role_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Surname`, `Forename`, `Address`, `Username`, `Password`, `Role_ID`) VALUES
(1, 'Jackson', 'Hendrickson', 'Marky cir', 'Taylor09', '$2y$10$I/88jzoXxDyIW.uXIPizZOC79v2Zl4JolhJRqPP1OBb3kT0xYKJie', '2'),
(2, 'Jane', 'Smith', '456 Elm St', 'jane_smith', 'password2', '2'),
(3, 'Michael', 'Johnson', '789 Oak St', 'michael_johnson', 'password3', '2'),
(4, 'Emily', 'Brown', '101 Maple St', 'emily_brown', 'password4', '2'),
(5, 'Christopher', 'Wilson', '202 Pine St', 'chris_wilson', 'password5', '2'),
(6, 'Jessica', 'Lee', '303 Cedar St', 'jessica_lee', 'password6', '2'),
(8, 'Jennifer', 'Garcia', '505 Walnut St', 'jennifer_garcia', 'password8', '2'),
(9, 'Daniel', 'Lopez', '606 Spruce St', 'daniel_lopez', 'password9', '2'),
(10, 'Sarah', 'Hernandez', '707 Ash St', 'sarah_hernandez', 'password10', '2'),
(11, 'Matthew', 'Gonzalez', '808 Cedar St', 'matthew_gonzalez', 'password11', '2'),
(12, 'Lauren', 'Perez', '909 Elm St', 'lauren_perez', 'password12', '2'),
(13, 'Andrew', 'Sanchez', '1010 Maple St', 'andrew_sanchez', 'password13', '2'),
(14, 'Megan', 'Torres', '1111 Oak St', 'megan_torres', 'password14', '2'),
(15, 'James', 'Rivera', '1212 Pine St', 'james_rivera', 'password15', '2'),
(16, 'Amanda', 'Nguyen', '1313 Cedar St', 'amanda_nguyen', 'password16', '2'),
(17, 'Ryan', 'Kim', '1414 Birch St', 'ryan_kim', 'password17', '2'),
(18, 'Nicole', 'Patel', '1515 Walnut St', 'nicole_patel', 'password18', '2'),
(19, 'Justin', 'Wong', '1616 Spruce St', 'justin_wong', 'password19', '2'),
(21, 'Billy', 'Madison', '8328 S Plum Creek Cir', 'mark87', '$2y$10$04SeztQOSWFzEHccBT9stuTT.xg544qG1qtBbEqVu/XqmIbcuWp4y', '2'),
(22, 'Taylor', 'Hendrickson', 'Marky cir', 'Taylor03', '$2y$10$gAoxcVa.NHPSWtOWEG7yu.I8fcl2TmXNRq/6zEZN/RJSbzqG05YsO', '2'),
(24, 'Billy', 'Madison', '8328 S Plum Creek Cir', 'Cameron', '$2y$10$R.xW.cKnfjt5q.1ja2hBiOuTA0IG5M.Zq8UxGVn9X78oB1X3LMEvO', '2'),
(25, 'Mason', 'Allred', '1298398123', 'Mason1', '$2y$10$fVGTPa208DNP6Jw9FGNnIOczarZNqm7fDKBmhqeCVljqkVjLGK13q', '2'),
(26, 'Mewtwo', 'Bowser', 'Marky cir', 'pjones', '$2y$10$zFrCb1MeJIMW/nVlR7n2leNNZ.PvSQGlW4ehn2pODhnWFqd8PBVJ6', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `Employee_ID` int NOT NULL AUTO_INCREMENT,
  `Surname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Forename` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Role_ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Employee_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Surname`, `Forename`, `Username`, `Password`, `Role_ID`) VALUES
(23, 'Bob', 'Minion', 'Bob', '$2y$10$wAS.9cHmiNbTmgXtWM8AU.i2HaTRD8eq.OdXsxLJtrmqbcs7umCTy', '1'),
(22, 'Mason', 'Allred', 'mark87', '$2y$10$D6Cl0axxS4Hmu8Er5AV20uaxisq55hmXjZXSWwV8J0WSGf5Pzg2vK', '1'),
(5, 'David', 'Mark', 'yolo_23', 'passworddef', '1'),
(6, 'Jessica', 'Martinez', 'jessica_martinez', 'passwordghi', '1'),
(7, 'Daniel', 'Anderson', 'daniel_anderson', 'passwordjkl', '1'),
(8, 'Sarah', 'Taylor', 'sarah_taylor', 'passwordmno', '1'),
(9, 'Chris', 'Thomas', 'christopher_thomas', 'passwordpqr', '1'),
(27, 'Markiplier', 'Doe', 'Bmad', '$2y$10$k99K8oLQ5y3u1PbA5CTsnuIUHncyUG/f2FXVi2.DOuS3gGLtjr0.i', ''),
(11, 'Matthew', 'Rodriguez', 'matthew_rodriguez', 'passwordvwx', '1'),
(12, 'Amanda', 'Lopez', 'amanda_lopez', 'passwordyz', '1'),
(13, 'James', 'Hernandez', 'james_hernandez', 'password1234', '1'),
(14, 'Jennifer', 'Hill', 'jennifer_hill', 'password5678', '1'),
(15, 'Robert', 'Young', 'robert_young', 'passwordabcd', '1'),
(16, 'Jessica', 'King', 'jessica_king', 'passwordefgh', '1'),
(17, 'John', 'Scott', 'john_scott', 'passwordijkl', '1'),
(18, 'Andrew', 'Green', 'andrew_green', 'passwordmnop', '1'),
(19, 'Elizabeth', 'Adams', 'elizabeth_adams', 'passwordqrst', '1'),
(20, 'Joshua', 'Baker', 'joshua_baker', 'passworduvwx', '1'),
(21, 'Billy', 'Madison', 'Sandler87', '$2y$10$V8MRI2K3ChHMMp1B1XoO9.YbF2Pvh40.cZNQhEF3VFxEJBD3MYtHS', '1'),
(26, 'Billy', 'Madison', 'bsmith', '$2y$10$9a.smYDdWfLxrV69ZF1gv.Qeu/hh1L4xf/IEVf/U8nvFDGlQaUwE.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `Inventory_ID` int NOT NULL AUTO_INCREMENT,
  `Product_ID` int NOT NULL,
  `Vendor_ID` int NOT NULL,
  `Store_ID` int NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int NOT NULL,
  `Cost` float NOT NULL,
  PRIMARY KEY (`Inventory_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Inventory_ID`, `Product_ID`, `Vendor_ID`, `Store_ID`, `Date`, `Quantity`, `Cost`) VALUES
(1, 1, 101, 201, '2024-03-25', 20, 5.99),
(2, 2, 102, 202, '2024-03-25', 14, 8.49),
(3, 3, 103, 203, '2024-03-25', 20, 12.99),
(4, 4, 104, 204, '2024-03-25', 10, 4.75),
(5, 5, 105, 205, '2024-03-25', 12, 6.25),
(6, 6, 106, 206, '2024-03-25', 5, 3.99),
(7, 7, 107, 207, '2024-03-25', 18, 9.99),
(8, 8, 108, 208, '2024-03-25', 13, 7.49),
(9, 9, 109, 209, '2024-03-25', 22, 11.99),
(10, 10, 110, 210, '2024-03-25', 7, 5.25),
(11, 11, 111, 211, '2024-03-25', 14, 8.99),
(12, 12, 112, 212, '2024-03-25', 9, 6.49),
(13, 13, 113, 213, '2024-03-25', 16, 9.75),
(14, 14, 114, 214, '2024-03-25', 11, 7.25),
(15, 15, 115, 215, '2024-03-25', 19, 10.99),
(16, 16, 116, 216, '2024-03-25', 6, 4.49),
(17, 17, 117, 217, '2024-03-25', 23, 12.25),
(18, 18, 118, 218, '2024-03-25', 9, 5.99),
(19, 19, 119, 219, '2024-03-25', 15, 8.75),
(20, 20, 120, 220, '2024-03-25', 10, 6.49);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `Order_ID` int NOT NULL AUTO_INCREMENT,
  `Customer_ID` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Total_Price` float NOT NULL,
  PRIMARY KEY (`Order_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_ID`, `Customer_ID`, `Date`, `Total_Price`) VALUES
(19, '21', '2024-03-28', 3333),
(20, '2', '2024-03-03', 45),
(34, '0', '2024-03-25', 129.97),
(33, '0', '2024-03-24', 9.99),
(35, '0', '2024-03-25', 344.82),
(36, '0', '2024-03-25', 7.99),
(37, '0', '2024-03-25', 49.99),
(38, '0', '2024-03-25', 29.99),
(39, '24', '2024-03-25', 15.98),
(40, '24', '2024-03-25', 29.99),
(41, '24', '2024-03-25', 29.99),
(45, '24', '2024-03-25', 299.9),
(46, '24', '2024-03-25', 299.9),
(48, '2', '2525-03-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

DROP TABLE IF EXISTS `orderline`;
CREATE TABLE IF NOT EXISTS `orderline` (
  `Line_ID` int NOT NULL,
  `Order_ID` int NOT NULL,
  `Product_ID` int NOT NULL,
  `Quantity` int NOT NULL,
  `Price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`Line_ID`, `Order_ID`, `Product_ID`, `Quantity`, `Price`) VALUES
(1, 1, 301, 2, 25.5),
(2, 1, 302, 1, 15.75),
(3, 2, 303, 3, 10),
(4, 2, 304, 2, 8.5),
(5, 3, 305, 1, 30.25),
(6, 3, 306, 4, 12.75),
(7, 4, 307, 2, 20),
(8, 4, 308, 3, 18.5),
(9, 5, 309, 3, 15.75),
(10, 5, 310, 1, 35),
(11, 6, 311, 2, 10.5),
(12, 6, 312, 1, 28.75),
(13, 7, 313, 4, 7.25),
(14, 7, 314, 2, 22),
(15, 8, 315, 1, 18.75),
(16, 8, 316, 3, 11.5),
(17, 9, 317, 2, 14.25),
(18, 9, 318, 2, 26),
(19, 10, 319, 1, 30.5),
(20, 10, 320, 4, 9.75);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Product_ID` int NOT NULL AUTO_INCREMENT,
  `Image Source` varchar(250) NOT NULL,
  `Product Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Product Description` varchar(250) NOT NULL,
  `Product Price` float NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Vendor_ID` int NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `Image Source`, `Product Name`, `Product Description`, `Product Price`, `Type`, `Vendor_ID`) VALUES
(1, 'https://th.bing.com/th/id/OPE.NOfZ0sVU2p1DcA300C300?w=200&h=220&rs=1&dpr=1.3&pid=21.1', 'Aquarium Filter', 'High-quality filter for maintaining clean water in your aquarium', 29.99, 'Filter', 1),
(2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOqzvrx3jXFkYPTi_9ZSKKhgwqFal7CxyWPw&s', 'Aquarium Decor', 'Great Decor to make your fish friends feel at home', 9.99, 'Accessory', 2),
(3, 'https://th.bing.com/th/id/OIP.8FDIh5Vt2qHoWXrWrsULwgAAAA?w=216&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Clown Fish', 'Best fish for a good joke!', 39.99, 'Fish', 1),
(4, 'https://th.bing.com/th/id/OIP.1Yl1BcAnkXP3um8lg8ZPmAHaHa?w=163&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Tank 5 Gallon', 'Great fish tank for a few fishy friends', 49.99, 'Equipment', 3),
(5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-_s1Wzu2AFIVjnoi7SOnjuKbE0CP2PbCIrA&s', 'Fish Net', 'Durable net for safely catching and transferring fish in your aquarium', 5.99, 'Accessory', 2),
(6, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWDhzS_zM0QCc9_X0nXr2jREYXeWutT1h6vQ&s', 'Aquarium Gravel', 'Colorful gravel substrate to enhance the aesthetics of your aquarium', 14.99, 'Decoration', 1),
(7, 'https://th.bing.com/th/id/OIP.wNGJQeS7zeVuZVUzdRGi-QAAAA?w=204&h=140&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Water Test Kit', 'Complete kit for testing the water parameters in your aquarium', 19.99, 'Equipment', 3),
(8, 'https://th.bing.com/th/id/OIP.aZrChXD6Ny0fpacbqCbT4gAAAA?w=224&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Algae Scraper', 'Handheld tool for removing algae buildup from aquarium glass', 7.99, 'Accessory', 2),
(9, 'https://th.bing.com/th/id/OIP.ndxUHEgUFvcEzgBDmfW2nQAAAA?w=147&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Air Pump', 'Quiet and efficient air pump for providing oxygen to your aquarium inhabitants', 24.99, 'Equipment', 1),
(10, 'https://th.bing.com/th/id/OPE.slSdCp2yWvsmcA300C300?w=160&h=150&rs=1&dpr=1.3&pid=21.1', 'Fish Tank Stand', 'Durable stand meticulously crafted to support your aquarium setup securely and elegantly', 79.99, 'Furniture', 3),
(11, 'https://th.bing.com/th/id/OIP.zsHl0_xbKvWUDlSd37epXwHaEo?w=290&h=181&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Rainbow Fish', 'Exquisite Rainbow fish bred in the pristine waters of Hawaii, renowned for their vibrant colors and graceful movements', 9.99, 'Fish', 2),
(12, 'https://th.bing.com/th/id/OIP.SikGUEZp6i1yf1YgdjxM_gHaHa?w=189&h=189&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Fish Tank Cleaner', 'Professional-grade cleaner meticulously formulated to eradicate dirt and grime from aquarium surfaces, leaving them spotless and gleaming', 11.99, 'Maintenance', 1),
(13, 'https://th.bing.com/th/id/OIP.sqMxJAuZHjWXumHcjJraxQAAAA?w=248&h=198&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Gold Fish', 'Exquisite Goldfish bred with care and precision to thrive in aquarium environments, adding elegance and grace to any aquatic setting', 8.99, 'Fish', 3),
(14, 'https://th.bing.com/th/id/OIP.vTztgL9kqyP9TnotMy5p_gAAAA?w=239&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Beta Fish', 'Colorful Beta Fish renowned for their vibrant hues and captivating personalities, adding a touch of sophistication to any aquarium', 16.99, 'Fish', 2),
(15, 'https://th.bing.com/th/id/OIP.Vo3it_VYacaotZkrWofJZAAAAA?w=229&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Gravel Stone', 'Premium-quality gravel stones meticulously selected to enhance the visual appeal of your aquarium, creating a natural and captivating underwater landscape', 17.99, 'Accessory', 1),
(16, 'https://th.bing.com/th/id/OIP.7EjRG48s_mrCTwEd09wlbQAAAA?w=212&h=141&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Fun Decor', 'Whimsical Decorations crafted to delight and entertain, creating a lively and vibrant environment for your aquatic friends', 4.99, 'Equipment', 3),
(17, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSYi6cLCedvT9rDewepxjmepG582zdBk3iyw&s', 'Starfish', 'Elevate your aquarium with our captivating Starfish. Add beauty and intrigue to your underwater world effortlessly.', 13.99, 'Fish', 2),
(18, 'https://th.bing.com/th/id/OIP.JEjnVHVt7nosXPbQszPUAwAAAA?w=150&h=136&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Thermometer', 'Precision-engineered thermometer meticulously calibrated to provide accurate and reliable monitoring of water temperature in your aquarium, ensuring optimal conditions for your aquatic inhabitants', 6.99, 'Equipment', 1),
(19, 'https://th.bing.com/th/id/OIP.ndxUHEgUFvcEzgBDmfW2nQAAAA?w=147&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Aquarium Air Pump', 'Whisper-quiet air pump meticulously designed to deliver a steady stream of oxygen to your aquarium inhabitants, promoting their health and vitality', 24.99, 'Equipment', 1),
(20, 'https://th.bing.com/th/id/OIP.O7JBN9NFess6WqlfszjMVQAAAA?w=191&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Neon Tetra', 'Elegant Neon Tetra meticulously bred to bring vibrant colors and graceful movement to your freshwater aquarium, adding a touch of sophistication and vitality to your aquatic ecosystem', 6.99, 'Fish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `Role_ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Role_ID`, `Role`) VALUES
('1', 'Admin'),
('2', 'Customer'),
('3', 'Basic Customer');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `Store_ID` int NOT NULL AUTO_INCREMENT,
  `Address` varchar(50) NOT NULL,
  `Hours` varchar(50) NOT NULL,
  PRIMARY KEY (`Store_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`Store_ID`, `Address`, `Hours`) VALUES
(1, '570 Cedar St, Yetanothercity, WA 78901', 'Mon-Sat: 9am-9pm, Sun: 11am-6pm'),
(2, '567 Cedar St, Yetanothercity, WA 78901', 'Mon-Sat: 9am-9pm, Sun: 11am-6pm'),
(3, '890 Maple St, Yetanotherstate, IL 12345', 'Mon-Fri: 7:30am-6:30pm, Sat: 8am-4pm, Sun: Closed'),
(4, '234 Birch St, Lastcity, MA 67890', 'Mon-Fri: 9:30am-8pm, Sat: 10am-5pm, Sun: Closed'),
(5, '678 Walnut St, Laststate, AZ 34567', 'Mon-Fri: 8am-5pm, Sat-Sun: Closed'),
(6, '901 Cherry St, Finalcity, CO 45678', 'Mon-Sat: 10am-6pm, Sun: 11am-4pm'),
(7, '345 Lemon St, Finalstate, NV 23456', 'Mon-Fri: 9am-7pm, Sat: 10am-3pm, Sun: Closed'),
(8, '789 Grape St, Endcity, OR 78901', 'Mon-Sat: 9:30am-8pm, Sun: 10am-6pm'),
(9, '123 Orange St, Endstate, NC 12345', 'Mon-Fri: 8:30am-6:30pm, Sat: 9am-5pm, Sun: Closed'),
(10, '456 Banana St, Terminatedcity, MI 67890', 'Mon-Sat: 8am-8pm, Sun: 10am-4pm'),
(11, '789 Apple St, Terminatedstate, OH 45678', 'Mon-Fri: 9am-5:30pm, Sat: 10am-2pm, Sun: Closed'),
(12, '234 Mango St, Finalterminator, TN 23456', 'Mon-Sat: 10am-7pm, Sun: 11am-5pm'),
(13, '567 Papaya St, Unendingcity, WI 78901', 'Mon-Fri: 9:30am-6:30pm, Sat: 10am-4pm, Sun: Closed'),
(14, '890 Strawberry St, Unendingstate, OK 12345', 'Mon-Sat: 8am-8pm, Sun: 9am-6pm'),
(15, '123 Pineapple St, Eternalcity, UT 67890', 'Mon-Fri: 9am-5:30pm, Sat: 10am-3pm, Sun: Closed'),
(16, '456 Blueberry St, Eternalstate, ID 45678', 'Mon-Sat: 8:30am-6:30pm, Sun: 9am-4pm'),
(65, '123go', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `Vendor_ID` int NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`Vendor_ID`, `Name`, `Address`) VALUES
(401, 'Aquatic Wonders', '123 Main St'),
(402, 'Marine Kingdom', '456 Elm St'),
(403, 'Freshwater Oasis', '789 Oak St'),
(404, 'Saltwater Haven', '321 Pine St'),
(405, 'Tropical Treasures', '654 Maple St'),
(406, 'Aqua World', '987 Birch St'),
(407, 'Coral Reef Co.', '741 Cedar St'),
(408, 'Aquarium Emporium', '852 Spruce St'),
(409, 'Fishy Business', '369 Walnut St'),
(410, 'Underwater Paradise', '147 Cherry St'),
(411, 'Oceanic Delight', '258 Peach St'),
(412, 'Deep Blue Sea', '963 Plum St'),
(413, 'Riverbank Aquatics', '579 Apple St'),
(414, 'Seaside Supplies', '753 Orange St'),
(415, 'Aquatic Life', '159 Banana St'),
(416, 'Marine Magic', '357 Grape St'),
(417, 'Freshwater Fins', '852 Water St'),
(418, 'Seahorse Supplies', '753 Lemon St'),
(419, 'Coral Cove', '951 Lime St'),
(420, 'Reef Reflections', '456 Avocado St');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
