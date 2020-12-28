-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2020 at 07:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_KimberleyB_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_KimberleyB_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_KimberleyB_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `petsId` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `age` int(15) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `hobbies` varchar(200) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`petsId`, `image`, `age`, `name`, `description`, `hobbies`, `location`) VALUES
(1, 'https://hips.hearstapps.com/countryliving.cdnds.net/17/47/1511194376-cavachon-puppy-christmas.jpg', 0, 'Buster', 'Buster is your new best friend...He is super playful and loves to explore!', 'chewing on stuffed animals and cuddles', 'Vienna, Austria'),
(2, 'https://cdn.mos.cms.futurecdn.net/vChK6pTy3vN3KbYZ7UU7k3-1200-80.jpg', 1, 'Susie', 'kitten', 'sleeping', 'Vienna, Austria'),
(3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Juvenile_Ragdoll.jpg/220px-Juvenile_Ragdoll.jpg', 0, 'Schrödinger', 'Lost kitten found, needs a good home', 'being dead and alive...', 'Graz, Austria'),
(4, 'https://www.milofoundation.org/wp-content/uploads/2020/06/kb_milo_62-scaled-847x1024.jpg', 2, 'Scottie', 'Scottie needs a good fun loving home with children to play with.', 'digging', 'Salzburg, Austria'),
(5, 'https://resources.stuff.co.nz/content/dam/images/1/s/z/7/x/o/image.related.StuffLandscapeSixteenByNine.1420x800.1zpvqh.png/1584686291889.jpg', 10, 'Smalls', 'Lovely older dog needs a loving family', 'Playing catch', 'Vienna, Austria'),
(6, 'https://static.onecms.io/wp-content/uploads/sites/47/2020/07/20/senior-golden-retriever-164856048-2-2000.jpg', 12, 'Andie', 'Beautiful dog who needs a loving home. Better with older adults, as she is not used to small children', 'snuggling and exploring', 'Vienna, Austria'),
(7, 'https://www.ardengrange.com/sites/admin/plugins/elfinder/files/ardengrange/Nutrition%20and%20Advice%20section/Fact%20Sheets%20section/Canine%20Fact%20Sheets/Puppy%20section/Puppy%20guide%20images/Scruffy%20pup.jpg', 0, 'Ellie', 'Sweet small dog wanting a loving home. ', 'run outside and play', 'Vienna, Austria'),
(8, 'https://vetstreet-brightspot.s3.amazonaws.com/dc/bc/58bcc58f4fc0a745750080074294/senior-cat-thinkstock-463675029-335sm3714.jpg', 11, 'Patches', 'Loving older cat who just wants some attention', 'playing with toys', 'Graz, Austria'),
(9, 'https://www.declawing.com/images/supplies_needed_for_older_cat.jpg', 12, 'Maxie', 'Calm cat that is good around children or adults. Very calm and quiet', 'Laying around', 'Vienna, Austria'),
(10, 'https://www.cesarsway.com/wp-content/uploads/2019/10/AdobeStock_190562703.jpeg', 5, 'Jake', 'Playful dog for a playful family. Jake needs a family with high energy to keep up with him!', 'Fetch and running in the Park', 'Innsbruck, Austria'),
(11, 'https://i.dailymail.co.uk/1s/2019/11/18/16/21162158-0-image-a-44_1574095086222.jpg', 3, 'Sophie', 'Perfect dog for people with allergies! ', 'Playing and snuggling', 'Vienna, Austria'),
(12, 'https://www.thesprucepets.com/thmb/-UHyBMUvHaMyFuCPWRnoYgLhVgA=/2304x1296/smart/filters:no_upscale()/close-up-of-cat-lying-on-floor-at-home-908763830-1d61bee6961b45ee8a55bdfa5da1ebb3.jpg', 6, 'Midnight', 'No bad luck here! This sweet cat just wants to be loved. Gentle cat that is good around children', 'Playing with her toys', 'Vienna, Austria');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userType` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `userType`) VALUES
(1, 'Kimberley Blankenhorn', 'kimberley@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'admin'),
(2, 'Jane', 'jane@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user'),
(3, 'joe', 'joe@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`petsId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `petsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
