CREATE TABLE `ticket_records` (
    `Id` INT NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(150) NOT NULL,
    `Ticket` INT NOT NULL,
    `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `Restraurant` INT NOT NULL, PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Restraurant` (
    `Id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `sitesettings` (
  `Id` int(10) UNSIGNED NOT NULL,
  `totaltables` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_records`
--

CREATE TABLE `ticket_records` (
  `Id` int(11) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Ticket` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Restraurant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `EmailConfirmed` tinyint(1) NOT NULL DEFAULT 0,
  `Phone` varchar(15) NOT NULL,
  `Names` varchar(70) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Ref` varchar(25) NOT NULL,
  `CDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Active` tinyint(1) NOT NULL,
  `Role` varchar(15) NOT NULL,
  `Restraurant` int(11) NOT NULL DEFAULT 0,
  `Status` tinyint(1) DEFAULT 1,
  `ImageSet` tinyint(1) DEFAULT 0,
  `Image Upload Time` datetime DEFAULT NULL,
  `Image Name` varchar(150) NOT NULL,
  `ResetCode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
