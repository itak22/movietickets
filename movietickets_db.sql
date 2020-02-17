-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 05:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movietickets_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `date_tbl`
--

CREATE TABLE `date_tbl` (
  `date_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `date_tbl`
--

INSERT INTO `date_tbl` (`date_id`, `date`) VALUES
(1, '2020-02-20'),
(2, '2020-02-21'),
(3, '2020-02-22'),
(4, '2020-02-23'),
(5, '2020-02-17'),
(6, '2020-02-18'),
(7, '2020-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `hall_tbl`
--

CREATE TABLE `hall_tbl` (
  `hall_id` int(11) NOT NULL,
  `hallname` varchar(10) NOT NULL,
  `price_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hall_tbl`
--

INSERT INTO `hall_tbl` (`hall_id`, `hallname`, `price_id`) VALUES
(1, 'Cinema 1', 1),
(2, 'Cinema 2', 1),
(3, 'Cinema 3', 1),
(4, 'Cinema 4', 1),
(5, 'Cinema 5', 1),
(6, 'Cinema 6', 1),
(7, 'Cinema 7', 1),
(8, 'Cinema 8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `login_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`login_id`, `email`, `password`) VALUES
(1, 'tak@tak', '381e6d8ef38f8a7d9faf905473ac474d'),
(2, 'john@kurt', '381e6d8ef38f8a7d9faf905473ac474d'),
(6, 'admin@admin', '381e6d8ef38f8a7d9faf905473ac474d');

-- --------------------------------------------------------

--
-- Table structure for table `moviecategory_tbl`
--

CREATE TABLE `moviecategory_tbl` (
  `moviecategory_id` int(11) NOT NULL,
  `moviecategory` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moviecategory_tbl`
--

INSERT INTO `moviecategory_tbl` (`moviecategory_id`, `moviecategory`) VALUES
(1, 'Upcoming'),
(2, 'Now Showing');

-- --------------------------------------------------------

--
-- Table structure for table `movie_tbl`
--

CREATE TABLE `movie_tbl` (
  `movie_id` int(11) NOT NULL,
  `moviename` varchar(100) NOT NULL,
  `moviecategory_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `trailer` varchar(11) NOT NULL,
  `overview` varchar(500) NOT NULL,
  `runninghours` varchar(10) NOT NULL,
  `runningminutes` varchar(10) NOT NULL,
  `releasedate` date NOT NULL,
  `rated-r` varchar(10) NOT NULL,
  `cast` varchar(50) NOT NULL,
  `directors` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_tbl`
--

INSERT INTO `movie_tbl` (`movie_id`, `moviename`, `moviecategory_id`, `image`, `trailer`, `overview`, `runninghours`, `runningminutes`, `releasedate`, `rated-r`, `cast`, `directors`) VALUES
(3, 'Bad Boys for life', 2, 'badboys.jpg', 'jKCj3XuPG8M', 'The wife and son of a Mexican drug lord embark on a vengeful quest to kill all those involved in his trial and imprisonment -- including Miami Detective Mike Lowrey. When Mike gets wounded, he teams up with partner Marcus Burnett and AMMO -- a special tactical squad -- to bring the culprits to justice. But the old-school, wisecracking cops must soon learn to get along with their new elite counterparts if they are to take down the vicious cartel that threatens their lives.', '2', '4', '2020-01-17', 'R-13', 'Will Smith, Martin Lawrence', 'Adil El Arbi, Bilall Fallah '),
(4, 'Star Wars: The Rise of Skywalker', 2, 'starwars.jpg', '83apjSbVV-o', 'When it\'s discovered that the evil Emperor Palpatine did not die at the hands of Darth Vader, the rebels must race against the clock to find out his whereabouts. Finn and Poe lead the Resistance to put a stop to the First Order\'s plans to form a new Empire, while Rey anticipates her inevitable confrontation with Kylo Ren.', '2', '22', '2019-12-20', 'PG-13', 'Daisy Ridley', 'J.J. Abrams'),
(5, 'Dolittle', 2, 'dolittle.jpg', 'FEf412bSPLs', 'Dr. John Dolittle lives in solitude behind the high walls of his lush manor in 19th-century England. His only companionship comes from an array of exotic animals that he speaks to on a daily basis. But when young Queen Victoria becomes gravely ill, the eccentric doctor and his furry friends embark on an epic adventure to a mythical island to find the cure.', '1', '40', '2020-01-17', 'PG', 'Robert Downey Jr.', 'Stephen Gaghan'),
(6, 'Underwater', 2, 'underwater.jpg', 'jCFWEzIVILc', 'Disaster strikes more than six miles below the ocean surface when water crashes through the walls of a drilling station. Led by their captain, the survivors realize that their only hope is to walk across the sea floor to reach the main part of the facility. But they soon find themselves in a fight for their lives when they come under attack from mysterious and deadly creatures that no one has ever seen.', '1', '35', '2020-01-10', 'PG-13', 'William Eubank', 'Kristen Stewart'),
(7, 'Birds of Prey', 1, 'birdsofprey.jpg', 'kGM4uYZzfu0', 'After splitting with the Joker, Harley Quinn joins superheroes Black Canary, Huntress and Renee Montoya to save a young girl from an evil crime lord, Black Mask in Gotham City.', '1', '49', '2020-02-06', 'R-16', 'Margot Robbie', 'Cathy Yan'),
(8, 'The King\'s Man', 1, 'thekingsman.jpg', 'e82JHkkPw54', 'One man must race against time to stop history\'s worst tyrants and criminal masterminds as they get together to plot a war that could wipe out millions of people and destroy humanity.', '2', '14', '2020-02-16', 'R', 'Harris Dickinson', 'Matthew Vaughn'),
(10, 'jumanji', 2, 'jumanji.jpeg', 'kkk', 'kkk', '1', '1', '2020-02-17', 'r18', 'kurt', 'kurt');

-- --------------------------------------------------------

--
-- Table structure for table `price_tbl`
--

CREATE TABLE `price_tbl` (
  `price_id` int(11) NOT NULL,
  `price` varchar(4) NOT NULL,
  `pricecategory` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_tbl`
--

INSERT INTO `price_tbl` (`price_id`, `price`, `pricecategory`) VALUES
(1, '250P', 'Regular'),
(2, '350P', 'Premium');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_tbl`
--

CREATE TABLE `reserve_tbl` (
  `reserve_id` int(11) NOT NULL,
  `reservedate` date NOT NULL,
  `time_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserve_tbl`
--

INSERT INTO `reserve_tbl` (`reserve_id`, `reservedate`, `time_id`, `seat_id`, `login_id`) VALUES
(24, '2020-02-11', 64, 1, 1),
(25, '2020-02-11', 64, 2, 1),
(26, '2020-02-11', 64, 3, 1),
(27, '2020-02-11', 64, 4, 1),
(29, '2020-02-11', 64, 5, 1),
(30, '2020-02-11', 64, 18, 1),
(31, '2020-02-11', 64, 9, 1),
(32, '2020-02-11', 64, 19, 1),
(33, '2020-02-11', 64, 21, 1),
(34, '2020-02-11', 64, 23, 1),
(39, '2020-02-12', 25, 3, 1),
(40, '2020-02-12', 25, 4, 1),
(43, '2020-02-16', 64, 3, 2),
(44, '2020-02-16', 64, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review_tbl`
--

CREATE TABLE `review_tbl` (
  `review_id` int(11) NOT NULL,
  `review` varchar(2000) NOT NULL,
  `rate` varchar(2) NOT NULL,
  `reviewdate` date NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `login_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review_tbl`
--

INSERT INTO `review_tbl` (`review_id`, `review`, `rate`, `reviewdate`, `nickname`, `login_id`, `movie_id`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore id incidunt, ab, sunt unde aliquam rerum nihil eos reprehenderit nam exercitationem commodi in numquam expedita neque qui ullam! Debitis eius porro maxime eum aliquid optio vel accusantium, distinctio quos consequuntur minima aspernatur, placeat itaque in ratione laboriosam quidem consectetur odit.', '9', '2020-02-08', 'tak', 1, 1),
(2, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas animi veniam nulla voluptatem optio! Non iste, nesciunt libero nostrum sapiente voluptate id delectus omnis explicabo magnam iusto similique? Ut, aliquam.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Laborum veniam fugiat, temporibus magnam ad neque deleniti amet ex doloremque ipsum rem voluptatibus dolor, dicta repudiandae et saepe iure laudantium. Unde.', '10', '2020-02-08', 'tak', 1, 2),
(3, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores aperiam alias voluptatem? Error reiciendis aperiam explicabo obcaecati autem officiis. Quaerat nobis reiciendis minima illo quis nemo rerum hic recusandae voluptatibus.\r\n\r\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam aperiam dolor at asperiores sapiente! Officiis neque reprehenderit enim quae maiores!', '10', '2020-02-08', 'tak', 1, 2),
(4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores aperiam alias voluptatem? Error reiciendis aperiam explicabo obcaecati autem officiis. Quaerat nobis reiciendis minima illo quis nemo rerum hic recusandae voluptatibus.\r\n\r\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam aperiam dolor at asperiores sapiente! Officiis neque reprehenderit enim quae maiores!', '10', '2020-02-08', 'tak', 1, 2),
(5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores aperiam alias voluptatem? Error reiciendis aperiam explicabo obcaecati autem officiis. Quaerat nobis reiciendis minima illo quis nemo rerum hic recusandae voluptatibus.\r\n\r\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam aperiam dolor at asperiores sapiente! Officiis neque reprehenderit enim quae maiores!', '10', '2020-02-08', 'tak', 1, 2),
(7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, voluptates! Sit similique dignissimos itaque voluptatem omnis at error asperiores porro aperiam provident odio, dolor voluptatum, consequatur, voluptate ea libero fugiat?\r\n                    \r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Officiis sunt nam velit aut ipsam animi non tempore nihil, repudiandae hic.', '10', '2020-02-08', 'tak', 1, 2),
(8, 'kkkk', '5', '2020-02-08', 'ima', 1, 2),
(9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '8', '2020-02-09', 'ima', 1, 5),
(10, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '8', '2020-02-09', 'ima', 1, 5),
(11, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '6', '2020-02-09', 'ima', 1, 6),
(13, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima similique sit nostrum quam? Rem repellat quibusdam quae, a accusamus magni iure temporibus vitae dolore soluta architecto, quos aspernatur. Porro libero expedita a placeat, recusandae doloribus, voluptate laboriosam, quos quisquam accusantium voluptatum qui vitae consequatur mollitia enim culpa error voluptatibus! Iste?', '8', '2020-02-09', 'kurt', 1, 6),
(14, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, fugiat facilis. Ut debitis quia placeat iure molestias perferendis, necessitatibus nostrum asperiores. Dolore, ea! In, iusto nobis! Labore, non saepe, sint harum architecto commodi dicta a quam dolores dolor optio amet numquam itaque, esse omnis in aut totam fuga. Incidunt, cupiditate?', '7', '2020-02-09', 'tak', 1, 4),
(15, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, fugiat facilis. Ut debitis quia placeat iure molestias perferendis, necessitatibus nostrum asperiores. Dolore, ea! In, iusto nobis! Labore, non saepe, sint harum architecto commodi dicta a quam dolores dolor optio amet numquam itaque, esse omnis in aut totam fuga. Incidunt, cupiditate?', '8', '2020-02-09', 'ima', 1, 4),
(16, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, fugiat facilis. Ut debitis quia placeat iure molestias perferendis, necessitatibus nostrum asperiores. Dolore, ea! In, iusto nobis! Labore, non saepe, sint harum architecto commodi dicta a quam dolores dolor optio amet numquam itaque, esse omnis in aut totam fuga. Incidunt, cupiditate?', '10', '2020-02-09', 'itak22', 1, 3),
(17, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, fugiat facilis. Ut debitis quia placeat iure molestias perferendis, necessitatibus nostrum asperiores. Dolore, ea! In, iusto nobis! Labore, non saepe, sint harum architecto commodi dicta a quam dolores dolor optio amet numquam itaque, esse omnis in aut totam fuga. Incidunt, cupiditate?', '9', '2020-02-09', 'tak', 1, 3),
(18, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium fuga nostrum quam optio iusto cum, dolore ipsum sit, iure molestias commodi mollitia? Aut, velit aspernatur, deleniti officiis molestias repellat accusamus exercitationem magnam et minus suscipit dolorem dolore incidunt reiciendis fugiat, explicabo recusandae dolores voluptatem ipsum consequuntur? Dolor voluptatem perspiciatis eum!', '9', '2020-02-09', 'tak', 1, 2),
(19, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium fuga nostrum quam optio iusto cum, dolore ipsum sit, iure molestias commodi mollitia? Aut, velit aspernatur, deleniti officiis molestias repellat accusamus exercitationem magnam et minus suscipit dolorem dolore incidunt reiciendis fugiat, explicabo recusandae dolores voluptatem ipsum consequuntur? Dolor voluptatem perspiciatis eum!', '6', '2020-02-09', 'tak', 1, 2),
(20, 'kkkk', '4', '2020-02-09', 'tak', 2, 6),
(21, 'fantastic', '7', '2020-02-09', 'tak', 1, 4),
(22, 'tak', '8', '2020-02-09', 'tak', 1, 6),
(23, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa aspernatur sed molestiae dicta aliquam perferendis officia! Possimus unde deserunt iste obcaecati nesciunt atque vitae corporis exercitationem facere dolor officiis asperiores ex aut magni nobis, nulla rerum earum reprehenderit velit voluptatum sequi tempore. Odio pariatur expedita accusantium assumenda recusandae adipisci. Dolores?', '9', '2020-02-09', 'itak22', 1, 6),
(24, 'tak', '8', '2020-02-10', 'tak', 1, 6),
(25, 'tak', '4', '2020-02-10', 'tak', 1, 4),
(29, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '5', '2020-02-10', 'kurt', 1, 5),
(30, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '5', '2020-02-10', 'kurt', 1, 5),
(31, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '5', '2020-02-10', 'kurt', 1, 5),
(32, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '6', '2020-02-10', 'tak', 1, 5),
(33, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '7', '2020-02-10', 'tak', 1, 5),
(35, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero fugiat quae provident nam commodi nemo hic molestias cum error necessitatibus porro corporis ea, ratione incidunt accusamus, nobis obcaecati! Odit aspernatur quam praesentium! Modi deleniti doloribus ipsum porro culpa maxime autem tempora voluptatem dicta, fuga magnam repellat soluta dolores explicabo et consequatur voluptates qui fugiat illo. At, consequuntur rem maiores suscipit placeat sunt repellendus ipsam adipisci possimus quibusdam tempore corrupti officiis nostrum quas voluptatum reprehenderit quos ad modi sed laborum, quia inventore libero in necessitatibus. Temporibus, tenetur pariatur libero nisi ut consequatur, saepe excepturi minima vitae harum ratione esse cupiditate soluta.', '10', '2020-02-16', 'ima', 1, 6),
(36, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit impedit dicta reprehenderit! Enim excepturi aspernatur in harum aliquid, odio ratione commodi, blanditiis at, quae soluta esse ullam tempora labore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus perspiciatis fuga eum aperiam culpa eligendi inventore. Quae libero mollitia sequi.', '5', '2020-02-17', 'kurt', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `seat_tbl`
--

CREATE TABLE `seat_tbl` (
  `seat_id` int(11) NOT NULL,
  `seatrow` varchar(1) NOT NULL,
  `seatnumber` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT 'grey'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat_tbl`
--

INSERT INTO `seat_tbl` (`seat_id`, `seatrow`, `seatnumber`, `color`) VALUES
(1, 'A', '1', 'grey'),
(2, 'A', '2', 'grey'),
(3, 'A', '3', 'grey'),
(4, 'A', '4', 'grey'),
(5, 'A', '5', 'grey'),
(6, 'A', '6', 'grey'),
(7, 'A', '7', 'grey'),
(8, 'A', '8', 'grey'),
(9, 'A', '9', 'grey'),
(10, 'A', '10', 'grey'),
(11, 'A', '11', 'grey'),
(12, 'A', '12', 'grey'),
(13, 'B', '1', 'grey'),
(14, 'B', '2', 'grey'),
(15, 'B', '3', 'grey'),
(16, 'B', '4', 'grey'),
(17, 'B', '5', 'grey'),
(18, 'B', '6', 'grey'),
(19, 'B', '7', 'grey'),
(20, 'B', '8', 'grey'),
(21, 'B', '9', 'grey'),
(22, 'B', '10', 'grey'),
(23, 'B', '11', 'grey'),
(24, 'B', '12', 'grey');

-- --------------------------------------------------------

--
-- Table structure for table `theater_tbl`
--

CREATE TABLE `theater_tbl` (
  `theater_id` int(11) NOT NULL,
  `theatername` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater_tbl`
--

INSERT INTO `theater_tbl` (`theater_id`, `theatername`, `location`) VALUES
(1, 'TI Cinema Cebu', 'Cardinal Rosales Ave, Cebu City, 4000 Cebu'),
(2, 'TI Cinema IT Park', 'V. Padriga Street, Cebu IT Park, Cebu City'),
(3, 'TI Cinema Manila', 'Diosdado Macapagal Blvd, cor Aseana Ave, Paranaque City, 1701 Metro Manila');

-- --------------------------------------------------------

--
-- Table structure for table `time_tbl`
--

CREATE TABLE `time_tbl` (
  `time_id` int(11) NOT NULL,
  `startinghours` varchar(2) NOT NULL,
  `startingminutes` varchar(2) NOT NULL,
  `startingam/pm` varchar(2) NOT NULL,
  `endinghours` varchar(2) NOT NULL,
  `endingminutes` varchar(2) NOT NULL,
  `endingam/pm` varchar(2) NOT NULL,
  `date_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_tbl`
--

INSERT INTO `time_tbl` (`time_id`, `startinghours`, `startingminutes`, `startingam/pm`, `endinghours`, `endingminutes`, `endingam/pm`, `date_id`, `movie_id`, `theater_id`, `hall_id`) VALUES
(1, '12', '00', 'pm', '2', '00', 'pm', 4, 7, 1, 7),
(2, '3', '00', 'pm', '5', '00', 'pm', 4, 7, 1, 7),
(3, '6', '00', 'pm', '8', '00', 'pm', 4, 7, 1, 7),
(4, '9', '00', 'pm', '11', '00', 'pm', 4, 7, 1, 7),
(5, '11', '00', 'am', '1', '00', 'pm', 4, 7, 2, 7),
(6, '2', '00', 'pm', '4', '00', 'pm', 4, 7, 2, 7),
(7, '5', '00', 'pm', '7', '00', 'pm', 4, 7, 2, 7),
(8, '8', '00', 'pm', '10', '00', 'pm', 4, 7, 2, 7),
(9, '1', '00', 'pm', '3', '00', 'pm', 4, 7, 3, 7),
(10, '4', '00', 'pm', '6', '00', 'pm', 4, 7, 3, 7),
(11, '7', '00', 'pm', '9', '00', 'pm', 4, 7, 3, 7),
(12, '10', '00', 'pm', '12', '00', 'am', 4, 7, 3, 7),
(13, '10', '00', 'am', '12', '00', 'pm', 7, 8, 1, 8),
(14, '1', '00', 'pm', '3', '00', 'pm', 7, 8, 1, 8),
(15, '4', '00', 'pm', '6', '00', 'pm', 7, 8, 1, 8),
(16, '7', '00', 'pm', '9', '00', 'pm', 7, 8, 1, 8),
(17, '12', '10', 'pm', '2', '10', 'pm', 7, 8, 2, 8),
(18, '3', '10', 'pm', '5', '10', 'pm', 7, 8, 2, 8),
(19, '6', '10', 'pm', '8', '10', 'pm', 7, 8, 2, 8),
(20, '9', '10', 'pm', '11', '10', 'pm', 7, 8, 2, 8),
(21, '11', '10', 'am', '13', '10', 'pm', 7, 8, 3, 8),
(22, '2', '10', 'pm', '4', '10', 'pm', 7, 8, 3, 8),
(23, '5', '10', 'pm', '7', '10', 'pm', 7, 8, 3, 8),
(24, '8', '10', 'pm', '10', '10', 'pm', 7, 8, 3, 8),
(25, '1', '10', 'pm', '3', '10', 'pm', 2, 3, 1, 3),
(26, '4', '10', 'pm', '6', '10', 'pm', 2, 3, 1, 3),
(27, '7', '10', 'pm', '9', '10', 'pm', 2, 3, 1, 3),
(28, '10', '10', 'pm', '12', '10', 'am', 2, 3, 1, 3),
(29, '10', '10', 'am', '12', '10', 'pm', 2, 3, 2, 3),
(30, '1', '10', 'pm', '3', '10', 'pm', 2, 3, 2, 3),
(31, '4', '10', 'pm', '6', '10', 'pm', 2, 3, 2, 3),
(32, '7', '10', 'pm', '9', '10', 'pm', 2, 3, 2, 3),
(36, '12', '20', 'pm', '2', '20', 'pm', 2, 3, 3, 3),
(37, '3', '20', 'pm', '5', '20', 'pm', 2, 3, 3, 3),
(38, '6', '20', 'pm', '8', '20', 'pm', 2, 3, 3, 3),
(39, '9', '20', 'pm', '11', '20', 'pm', 2, 3, 3, 3),
(40, '11', '20', 'am', '1', '20', 'pm', 2, 4, 1, 4),
(41, '2', '20', 'pm', '4', '20', 'pm', 2, 4, 1, 4),
(42, '5', '20', 'pm', '7', '20', 'pm', 2, 4, 1, 4),
(43, '8', '20', 'pm', '10', '20', 'pm', 2, 4, 1, 4),
(44, '1', '20', 'pm', '3', '20', 'pm', 2, 4, 2, 4),
(45, '4', '20', 'pm', '6', '20', 'pm', 2, 4, 2, 4),
(46, '7', '20', 'pm', '9', '20', 'pm', 2, 4, 2, 4),
(47, '10', '20', 'pm', '12', '20', 'am', 2, 4, 2, 4),
(48, '10', '20', 'am', '12', '20', 'pm', 2, 0, 3, 4),
(49, '1', '20', 'pm', '3', '20', 'pm', 2, 4, 3, 4),
(50, '4', '20', 'pm', '6', '20', 'pm', 2, 4, 3, 4),
(51, '7', '20', 'pm', '9', '20', 'pm', 2, 4, 3, 4),
(52, '12', '30', 'pm', '2', '30', 'pm', 2, 5, 1, 5),
(53, '3', '30', 'pm', '5', '30', 'pm', 2, 5, 1, 5),
(54, '6', '30', 'pm', '8', '30', 'pm', 2, 5, 1, 5),
(55, '9', '30', 'pm', '11', '30', 'pm', 2, 5, 1, 5),
(56, '11', '30', 'am', '1', '30', 'pm', 2, 5, 2, 5),
(57, '2', '30', 'pm', '4', '30', 'pm', 2, 5, 2, 5),
(58, '5', '30', 'pm', '7', '30', 'pm', 2, 5, 2, 5),
(59, '8', '30', 'pm', '10', '30', 'pm', 2, 5, 2, 5),
(60, '1', '30', 'pm', '3', '30', 'pm', 2, 5, 3, 5),
(61, '4', '30', 'pm', '6', '30', 'pm', 2, 5, 3, 5),
(62, '7', '30', 'pm', '9', '30', 'pm', 2, 5, 3, 5),
(63, '10', '30', 'pm', '12', '30', 'am', 2, 5, 3, 5),
(64, '10', '30', 'am', '12', '30', 'pm', 2, 6, 1, 6),
(65, '1', '30', 'pm', '3', '30', 'pm', 2, 6, 1, 6),
(66, '4', '30', 'pm', '6', '30', 'pm', 2, 6, 1, 6),
(67, '7', '30', 'pm', '9', '30', 'pm', 2, 6, 1, 6),
(68, '12', '40', 'pm', '2', '40', 'pm', 2, 6, 2, 6),
(69, '3', '40', 'pm', '5', '40', 'pm', 2, 6, 2, 6),
(70, '6', '40', 'pm', '8', '40', 'pm', 2, 6, 2, 6),
(71, '9', '40', 'pm', '11', '40', 'pm', 2, 6, 2, 6),
(72, '11', '40', 'am', '1', '40', 'pm', 2, 6, 3, 6),
(73, '2', '40', 'pm', '4', '40', 'pm', 2, 6, 3, 6),
(74, '5', '40', 'pm', '7', '40', 'pm', 2, 6, 3, 6),
(75, '8', '40', 'pm', '10', '40', 'pm', 2, 6, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'U',
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `firstname`, `lastname`, `phonenumber`, `status`, `login_id`) VALUES
(1, 'Takuto', 'Imari', '08068662024', 'U', 1),
(2, 'John', 'Kurt', '08068662024', 'U', 2),
(5, 'admin', 'admin', '08068662024', 'A', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `date_tbl`
--
ALTER TABLE `date_tbl`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `hall_tbl`
--
ALTER TABLE `hall_tbl`
  ADD PRIMARY KEY (`hall_id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `moviecategory_tbl`
--
ALTER TABLE `moviecategory_tbl`
  ADD PRIMARY KEY (`moviecategory_id`);

--
-- Indexes for table `movie_tbl`
--
ALTER TABLE `movie_tbl`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `price_tbl`
--
ALTER TABLE `price_tbl`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `reserve_tbl`
--
ALTER TABLE `reserve_tbl`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `review_tbl`
--
ALTER TABLE `review_tbl`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `seat_tbl`
--
ALTER TABLE `seat_tbl`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `theater_tbl`
--
ALTER TABLE `theater_tbl`
  ADD PRIMARY KEY (`theater_id`);

--
-- Indexes for table `time_tbl`
--
ALTER TABLE `time_tbl`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `date_tbl`
--
ALTER TABLE `date_tbl`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hall_tbl`
--
ALTER TABLE `hall_tbl`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `moviecategory_tbl`
--
ALTER TABLE `moviecategory_tbl`
  MODIFY `moviecategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movie_tbl`
--
ALTER TABLE `movie_tbl`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `price_tbl`
--
ALTER TABLE `price_tbl`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reserve_tbl`
--
ALTER TABLE `reserve_tbl`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `review_tbl`
--
ALTER TABLE `review_tbl`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `seat_tbl`
--
ALTER TABLE `seat_tbl`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `theater_tbl`
--
ALTER TABLE `theater_tbl`
  MODIFY `theater_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_tbl`
--
ALTER TABLE `time_tbl`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
