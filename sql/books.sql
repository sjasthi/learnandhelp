-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 05:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_and_help_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `callNumber` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `publisher` varchar(200) DEFAULT NULL,
  `publishYear` varchar(20) DEFAULT NULL,
  `numPages` int(11) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `grade_level` varchar(100) DEFAULT 'High School',
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `callNumber`, `title`, `author`, `publisher`, `publishYear`, `numPages`, `price`, `image`, `grade_level`, `available`, `date_created`, `date_modified`) VALUES
(1377, '1', 'సమ్మీకి నేస్తం దొరికింది', 'రూపమ్ క్యారొల్', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '30', 'images/books/649ee4912ba451.03444147.png', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1378, '2', 'తుంపా మరియు పిచ్చుకలు', 'స్వప్నమయి చక్రవర్తి', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '30', 'images/books/book1378.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1379, '3', 'ఏద ఇస్తామో దానిని పొందుతాము', 'శుద్ద సత్వబసు', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '30', 'images/books/book1379.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1380, '4', 'నోనా మరియు వాన', 'ప్రియా నాగరాజన్', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '35', 'images/books/book1380.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1381, '5', 'ఎందుకు?', 'మీనాక్షీ స్వామి', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '35', 'images/books/book1381.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1382, '6', 'మంగు బొంగరం', 'కామాక్షి బాల సుబ్రహ్మణ్యం', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '19', 'images/books/book1382.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1383, '7', 'చక్రాల కధ', 'అనూప్ రే', 'నేషనల్ బుక్ ట్రస్ట్', ' ', 0, '18', 'images/books/book1383.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1384, '8', 'రిబ్బను', ' సుకుమార్ శంకర్', 'సిబిటి ప్రచురణలు ', ' ', 0, '18', 'images/books/book1384.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1385, '9', 'రాజు గారి మీసాలు', ' ఆశా నెహేమియ', 'సిబిటి ప్రచురణలు ', ' ', 0, '18', 'images/books/book1385.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1386, '10', 'పెద్ద పులి చిన్నదోమ', 'మృణాళిని శ్రీవాస్తవ', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1386.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1387, '11', 'పశువుల సంత', 'శర్మిలా కాంత', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1387.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1388, '12', 'ఓలీ, ఇంకా ఔలీ', 'బెనితా సేన్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1388.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1389, '13', 'నేనూ నా చేపలు', 'కళ్యాణీ రాజన్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1389.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1390, '14', 'నీటి పాత్ర', 'ప్రతిభా నాధ్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1390.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1391, '15', 'నలుగురు చెవిటి వాళ్ళు', 'శంకర్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1391.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1392, '16', 'నడిచే చెట్టు', 'దీపా అగర్వాల్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1392.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1393, '17', 'నా తోట', ' సిగ్రున్ శ్రీవాస్తవ', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1393.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1394, '18', 'సింహము మరియు కుందేలు', 'శంకర్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1394.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1395, '19', 'సూర్యుని దస్తీ', 'తరుణ్ చెరియన్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1395.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1396, '20', 'శ్రీమతి ఉన్నిగారి తమాషా స్వెట్టర్లు', 'ఆషా నెహెమియా', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1396.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1397, '21', 'ఉత్తరం పోస్టు చేసిన చుమ్కీ', 'మిత్ర పూకన్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1397.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1398, '22', 'కోతి, పెన్సిలు కధ', 'లలితా బావా', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1398.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1399, '23', 'కోయిల గడియారం', 'కావేరి భట్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1399.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1400, '24', 'కిట్టి గాలిపటం', 'కావేరి భట్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1400.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1401, '25', 'కాళ్ళ సమస్యలు', 'అఖిలా గిరిరాజ్ కుమార్', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1401.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1402, '26', 'కచ్రూ కుందేలు', 'సంగీతా గుప్తా', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1402.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1403, '27', 'జంతుశాలలో మంగలి', 'ప్రతిభా నాధ్', 'సిబిటి ప్రచురణలు ', ' ', 0, '30', 'images/books/book1403.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1404, '28', 'హరివిల్లు జారుడబండ', 'ముక్తాముంజల్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1404.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1405, '29', 'చిట్ కూ', ' సురేఖా పనాండీకల్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1405.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1406, '30', 'చిన్న ఎర్ర బండి', 'మేరీ జేన్ హెన్రీ', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1406.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1407, '31', 'బొమ్మ గుర్రం', 'దీపా అగర్వాల్', 'సిబిటి ప్రచురణలు ', ' ', 0, '18', 'images/books/book1407.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1408, '32', 'అమ్మమ్మ చీర', 'ఆషా నెహెమియా', 'సిబిటి ప్రచురణలు ', ' ', 0, '20', 'images/books/book1408.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1409, '33', 'అవ్వకాకి', 'శంకర్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1409.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1410, '34', 'నాకోసం బెలూన్లు', 'నవీన్ మేనన్', 'సిబిటి ప్రచురణలు ', ' ', 0, '25', 'images/books/book1410.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1411, '35', 'విశ్వాస పాత్రమైన ముంగిస', 'శంకర్', 'సిబిటి ప్రచురణలు ', ' ', 0, '18', 'images/books/book1411.jpg', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1412, '36', 'భూమి', 'ముంజులూరి కృష్ణకుమారి', 'అలకనంద ప్రచురణలు', ' ', 0, '30', 'images/books/book1412.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1413, '37', 'సౌర వ్యవస్ధ', 'ముంజులూరి కృష్ణకుమారి', 'అలకనంద ప్రచురణలు', ' ', 0, '30', 'images/books/book1413.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1414, '38', 'చంద్రుడు', 'ముంజులూరి కృష్ణకుమారి', 'అలకనంద ప్రచురణలు', ' ', 0, '30', 'images/books/book1414.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1415, '39', 'సూర్యుడు', 'ముంజులూరి కృష్ణకుమారి', 'అలకనంద ప్రచురణలు', ' ', 0, '30', 'images/books/book1415.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1416, '40', 'నువ్వు నా అమ్మవా', 'పి.డి ఈస్ట్ మాన్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '15', 'images/books/book1416.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1417, '41', 'ఆనందంగా ఉండాలంటే', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1417.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1418, '42', 'గోరింక గూడు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '6', 'images/books/book1418.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1419, '43', 'టప్ టప్ .. కిచ్ కిచ్', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1419.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1420, '44', 'నా ముద్దుల కుక్క', 'కమల', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1420.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1421, '45', 'కుమ్మరి నరసయ్య', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1421.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1422, '46', 'జనం పాటలు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1422.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1423, '47', 'రండి చూడండి', 'వర్షా సహస్రవృద్దే', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1423.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1424, '48', 'చాదస్తపు మొగుడు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1424.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1425, '49', 'పకపకలు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1425.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1426, '50', 'పాస్..పాస్', 'వర్షా సహస్రవృద్దే', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1426.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1427, '51', 'మనుషుల్లో మాణిక్యాలు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1427.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1428, '52', 'పిచ్చి లోకం', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1428.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1429, '53', 'పాపం ఊసరవల్లి', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1429.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1430, '54', 'ఐసరబుజ్జీ పుల్లయ్య', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1430.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1431, '55', 'ఎన్నెన్ని ఆకులో', 'వర్షా సహస్రవృద్దే', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1431.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1432, '56', 'రామలింగడి కధలు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1432.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1433, '57', 'మాట్లాడే చేప', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1433.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1434, '58', 'నక్క-వడ', 'కమల', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1434.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1435, '59', 'గాలి గుడ్డు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1435.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1436, '60', 'బెలూన్', 'వర్షా సహస్రవృద్దే', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1436.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1437, '61', 'మన సాహసగాళ్ళు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1437.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1438, '62', 'పిల్లి పురాణం', 'ఎస్. శివదాస్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1438.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1439, '63', 'నాపిల్ల ఎక్కడ', 'కమల', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1439.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1440, '64', 'మన శరీరం', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1440.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1441, '65', 'వెర్రిబాగుల వేమయ్య', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1441.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1442, '66', 'ఎవరి తోక', 'కమల', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1442.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1443, '67', 'ఆకులతో జూ', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1443.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1444, '68', 'కోకిలమ్మ కధ', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1444.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1445, '69', 'ఇదీ లోకం', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1445.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1446, '70', 'నేను చెట్టును', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1446.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1447, '71', 'పిట్టా పిట్టా', ' ', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1447.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1448, '72', 'పిల్లి ఇల్లు', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '15', 'images/books/book1448.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1449, '73', 'పెన్సిల్ దొరికింది', 'వి.సుతేయన్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '16', 'images/books/book1449.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1450, '74', 'నేను వస్తా', 'వి.సుతేయన్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '16', 'images/books/book1450.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1451, '75', 'చల్ చల్ గుర్రం', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '12', 'images/books/book1451.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1452, '76', 'నాలుగు తోకల ఎలుక', 'వి.బాల సుబ్రమణ్యం', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1452.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1453, '77', 'పిల్లి పిల్లలు', 'వి.సుతేయన్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1453.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1454, '78', 'పడవ కదిలింది', 'వి.సుతేయన్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1454.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1455, '79', 'సూరీడు బిడ్డలు', 'డా. రాణాప్రతాప్ సింహ్', 'జనవిజ్ఞాన వేదిక', ' ', 0, '10', 'images/books/book1455.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1456, '80', 'మనకధ', 'ఎండ్రూఎండ్రీస్టీవెన్ శైప్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1456.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1457, '81', 'చిట్టి రాకుమారి చందమామ', 'జేమ్స్ తర్ బర్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1457.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1458, '82', 'కొత్త బ్యాగ్', 'భూపాల్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1458.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1459, '83', 'మూడు ఏనుగులు', ' ', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1459.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1460, '84', 'తోకతెగిన తోడేలు', ' ', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1460.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1461, '85', 'నా తప్పేమిటో!', ' ', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1461.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1462, '86', 'ఎద్దు కధ', 'మననరోలీఫ్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1462.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1463, '87', 'బుచ్చిబాబు బొమ్మకారు', 'కె.అంజన', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1463.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1464, '88', 'కధకాని కధ', 'కాకర్లమూడి విజయ్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1464.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1465, '89', 'పెన్సిల్ బాక్స్', ' ', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1465.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1466, '90', 'వంశీధర్ నిజాయితీ', 'ప్రేమ్ చంద్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1466.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1467, '91', 'నడిచేటి నావ కధ', 'ఎస్.పిఖత్రీ', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1467.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1468, '92', 'గుడ్డు నుంచి పిల్ల', 'మిల్సెంట్ సెల్సెన్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1468.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1469, '93', 'పులి తాబేలు', 'వివేక్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1469.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1470, '94', 'బొటన వ్రేలితో బొమ్మలు', 'అరవింద్ గుప్తా', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1470.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1471, '95', 'అందాల పార్కు', 'కె.అంజన', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1471.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1472, '96', 'పొడుపు కధలు', 'చింతాదీక్షితులు', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1472.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(1473, '97', 'జంతువుల వింత భాష', 'కాకర్లమూడి విజయ్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1473.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1474, '98', 'రహస్యం', 'క్వెంటీన్రేనాల్డ్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '10', 'images/books/book1474.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(1475, '99', 'చిటపట చినుకులు', 'అరవింద్ గుప్తా', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '20', 'images/books/book1475.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(1476, '100', 'సముద్ర నేస్తాలు', 'సప్దర్', 'ప్రజాశక్తి బుక్ హౌస్', ' ', 0, '15', 'images/books/book1476.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4632, '2339', 'Birds and Animals in Indian Art', 'Geeta Jain', 'National Book Trust', '2014', 12, '50', 'images/books/2339.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4633, '2340', 'Owl Ball', 'Francesca Xotta', 'National Book Trust', '2011', 12, '35', 'images/books/2340.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4634, '2341', 'From Bone to Stone', 'karen hey dock', 'National Book Trust', '2013', 28, '45', 'images/books/2341.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4635, '2342', 'Homes ', 'Manifred Bofinger', 'National Book Trust', '2012', 15, '18', 'images/books/2342.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4636, '2343', 'Once in a village', 'H.C. Madam', 'National Book Trust', '2014', 13, '30', 'images/books/2343.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4637, '2344', 'Who is Bigger Fool', 'Shri Krishna kumar', 'National Book Trust', '2012', 15, '25', 'images/books/2344.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4638, '2345', 'A Visit to the City Market', 'Manjula Padmanadham', 'National Book Trust', '2013', 15, '30', 'images/books/2345.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4639, '2346', 'The Coming of Wheels', 'Anup Ray', 'National Book Trust', '2014', 20, '25', 'images/books/2346.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4640, '2347', 'Tale of a Moustache', 'R.K.Murthy', 'National Book Trust', '2013', 20, '30', 'images/books/2347.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4641, '2348', 'A baby Harnbill learns to fly', 'Dilip kumar barva', 'National Book Trust', '2014', 15, '25', 'images/books/2348.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4642, '2349', 'This is my story', 'Viky Arya', 'National Book Trust', '2011', 16, '25', 'images/books/2349.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4643, '2350', 'Tyltyl&#39;s Advantures', 'swapna Dulta', 'National Book Trust', '2011', 10, '17', 'images/books/2350.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4644, '2351', 'Stripes in the Jungle', 'Geetika Jain', 'National Book Trust', '2014', 16, '30', 'images/books/2351.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4645, '2352', 'Titli and the music of Hope', 'Fouzia aziz minallah', 'National Book Trust', '2012', 20, '25', 'images/books/2352.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4646, '2353', 'Tortoise wins again', 'kiran Tamuly', 'National Book Trust', '2014', 20, '30', 'images/books/2353.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4647, '2354', 'Sunflowers and Butterfiles', 'Jeyanthi Manokaran', 'National Book Trust', '2103', 30, '25', 'images/books/2354.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4648, '2355', 'Red Kite', 'Geeta Dharmarajan', 'National Book Trust', '2008', 24, '15', 'images/books/2355.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4649, '2356', 'A Trip to the Mountains', 'swapna Dulta', 'National Book Trust', '2014', 24, '35', 'images/books/2356.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4650, '2357', 'Rintu and this Campass', 'Abhijit Segupta', 'National Book Trust', '2014', 20, '35', 'images/books/2357.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4651, '2358', 'Mangoose Becomes Kings', 'Baldev Singh', 'National Book Trust', '2013', 16, '30', 'images/books/2358.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4652, '2359', 'The Verdict and other tales from the East', 'kala thairani', 'National Book Trust', '2014', 30, '60', 'images/books/2359.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4653, '2360', 'Stories for Chiladren by jeelani Bano', 'sarla mohanlal', 'National Book Trust', '2014', 20, '50', 'images/books/2360.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4654, '2361', 'I Like World', 'Jeyanthi Manokaran', 'National Book Trust', '2011', 16, '17', 'images/books/2361.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4655, '2362', 'WHY?', 'Meenakshi Swami', 'National Book Trust', '2014', 10, '35', 'images/books/2362.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4656, '2363', 'Greet When you meet', 'Shyamalas', 'National Book Trust', '2014', 15, '30', 'images/books/2363.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4657, '2364', 'Tumpa and the Sparrows', 'Alok Chatterjee', 'National Book Trust', '2014', 16, '25', 'images/books/2364.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4658, '2365', 'Ravan', 'Anjani sharma', 'National Book Trust', '2014', 10, '30', 'images/books/2365.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4659, '2366', 'The Elephant and the Dog', 'Badri Narayan', 'National Book Trust', '2014', 15, '25', 'images/books/2366.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4660, '2367', 'Nine Little Birds', 'NT RAJEEV', 'National Book Trust', '2012', 0, '30', 'images/books/2367.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4661, '2368', 'A Baby Lion Learnsto Roar', 'Indu rana', 'National Book Trust', '2016', 0, '40', 'images/books/2368.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4662, '2369', 'Little Elephant Throws a Party', 'Meenakshi and Tanmay Bhorat', 'National Book Trust', '2014', 0, '40', 'images/books/2369.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4663, '2370', 'The Prince and the coral sea', 'Daisaku I kea', 'National Book Trust', '2011', 0, '55', 'images/books/2370.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4664, '2371', 'Ripe and Ready', 'Sukumar ray', 'National Book Trust', '2015', 0, '35', 'images/books/2371.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4665, '2372', 'The Beautiful Peacock', 'Nirensen Gupta', 'National Book Trust', '2011', 0, '17', 'images/books/2372.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4666, '2373', 'Our Tree', 'Pranab Chakravarthi', 'National Book Trust', '2014', 0, '25', 'images/books/2373.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4667, '2374', 'What is Right? What is Worng?', 'Sigrun srivastava', 'National Book Trust', '2012', 0, '18', 'images/books/2374.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4668, '2375', 'Little Sunshine', 'Jaswant Singh Birdi', 'National Book Trust', '2014', 0, '25', 'images/books/2375.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4669, '2376', 'Mini visits the Atlantic Ocean', 'Herminder ohri', 'National Book Trust', '2014', 0, '30', 'images/books/2376.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4670, '2377', '1 to 10 ', 'Mickey Patel', 'National Book Trust', '2012', 0, '18', 'images/books/2377.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4671, '2378', 'Tails', 'Hydrose Aaluwa', 'National Book Trust', '2012', 0, '19', 'images/books/2378.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4672, '2379', 'WE INDIANS', 'Mahrooj.wadia', 'National Book Trust', '2012', 0, '25', 'images/books/2379.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4673, '2380', 'Neem Baba', 'S.I Farooqi', 'National Book Trust', '2012', 0, '40', 'images/books/2380.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4674, '2381', 'Frogs and Snakes', 'Ganesh Haloi', 'National Book Trust', '2014', 0, '20', 'images/books/2381.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4675, '2382', 'A Crows Tale', 'Judhajit Sengupta', 'National Book Trust', '2012', 0, '18', 'images/books/2382.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4676, '2383', 'Bu-Bu-Bulbuli&#39;s Garden', 'Santanootamuly', 'National Book Trust', '2012', 0, '30', 'images/books/2383.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4677, '2384', 'A Happy Sunday', 'Debasish Deb', 'National Book Trust', '2015', 0, '35', 'images/books/2384.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4678, '2385', 'My First Railway Journey', 'Mrinal mitra', 'National Book Trust', '2014', 0, '25', 'images/books/2385.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4679, '2386', 'The Wonderful Vacation', 'anuradha bhasin', 'National Book Trust', '2013', 0, '25', 'images/books/2386.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4680, '2387', 'Holiday…. Oh No No', 'Jaswinder kaur bindra', 'National Book Trust', '2014', 0, '25', 'images/books/2387.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4681, '2388', 'Lalu and the Red kite', 'Ashish', 'National Book Trust', '2012', 0, '18', 'images/books/2388.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4682, '2389', 'From Land to sea', 'Vinita singhal', 'National Book Trust', '2013', 0, '40', 'images/books/2389.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4683, '2390', 'Strange ways of the Honeybee', 'S.I Farooqi', 'National Book Trust', '2012', 0, '30', 'images/books/2390.JPG', 'High School, Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4684, '2391', 'Diwali', 'Ravi Paranjape', 'National Book Trust', '2013', 0, '16', 'images/books/2391.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4685, '2392', 'Our useful Plants', 'K.s. Sekharam', 'National Book Trust', '2014', 0, '30', 'images/books/2392.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4686, '2393', 'Animal world', 'Aurobindo kundy', 'National Book Trust', '2014', 0, '25', 'images/books/2393.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4687, '2394', 'This is Rajasthan', 'S.Senroy', 'National Book Trust', '2014', 0, '25', 'images/books/2394.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4688, '2395', 'SET ME FREE', 'aSHISH', 'National Book Trust', '2014', 0, '20', 'images/books/2395.JPG', 'Primary School Upper, Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4689, '2396', 'Busy Ants', 'Pulak Biswas', 'National Book Trust', '2013', 0, '18', 'images/books/2396.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4690, '2397', 'Patterns from Nature', 'Judhajit Sengupta', 'National Book Trust', '2014', 0, '20', 'images/books/2397.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4691, '2398', 'Anandi&#39;s Rainbows', 'Anup ray', 'National Book Trust', '2014', 0, '35', 'images/books/2398.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4692, '2399', 'Some street Games of India', 'MWK Raj Anand', 'National Book Trust', '2012', 0, '25', 'images/books/2399.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4693, '2400', 'Andaman', 'Anvita abbi', 'National Book Trust', '2014', 0, '30', 'images/books/2400.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4694, '2401', 'The Sultan&#39;s choice and other stories', 'kala thairani', 'National Book Trust', '2014', 0, '60', 'images/books/2401.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4695, '2402', 'Name that Animal', 'Niranjan Ghoshal', 'National Book Trust', '2013', 0, '30', 'images/books/2402.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4696, '2403', 'Mitha and her Magic shoes', 'B.G . Gujjarappa', 'National Book Trust', '2014', 148, '30', 'images/books/2403.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4697, '2404', 'Little Wonders ', 'Laxmi khanna suman', 'National Book Trust', '2014', 95, '45', 'images/books/2404.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4698, '2405', 'The Great Baloon Story', 'R.K.Murthy', 'National Book Trust', '2013', 63, '35', 'images/books/2405.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4699, '2406', 'Bapu I', 'E.C. Freitas', 'National Book Trust', '2014', 63, '30', 'images/books/2406.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4700, '2407', 'Bapu II', 'E.C. Freitas', 'National Book Trust', '2014', 63, '40', 'images/books/2407.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4701, '2408', 'Be Prepared', 'Uma Anand', 'National Book Trust', '2013', 63, '25', 'images/books/2408.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4702, '2409', 'Who&#39;s who at the Zoo', 'Ruskin Bond', 'National Book Trust', '2014', 63, '25', 'images/books/2409.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4703, '2410', 'Wild Wood notes', 'Jit Roy', 'National Book Trust', '2015', 63, '30', 'images/books/2410.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4704, '2411', 'The Colourful world of flags', 'K.V.Singh', 'National Book Trust', '2011', 95, '50', 'images/books/2411.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4705, '2412', 'The Money Lender', 'Jai Prakash Rai', 'National Book Trust', '2014', 14, '15', 'images/books/2412.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4706, '2413', 'Ek - Kori&#39;s Dream', 'Mahasveta Devi', 'National Book Trust', '2014', 61, '30', 'images/books/2413.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4707, '2414', 'Books Forever', 'Manoj Das', 'National Book Trust', '2014', 64, '30', 'images/books/2414.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4708, '2415', 'Eto A Munda Won the Battle', 'Mahasveta Devi', 'National Book Trust', '2014', 63, '25', 'images/books/2415.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4709, '2416', 'A Trip to Heaven', 'Leelavathi Bhagwat', 'National Book Trust', '2015', 63, '30', 'images/books/2416.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4710, '2417', 'Rohanta and Nandriya', 'Krishna Chaitanya', 'National Book Trust', '2014', 63, '30', 'images/books/2417.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4711, '2418', 'Gautama Buddha', 'Leela George', 'National Book Trust', '2013', 63, '25', 'images/books/2418.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4712, '2419', 'Once Upon a time', 'M Choksi and PM Joshi', 'National Book Trust', '2014', 62, '30', 'images/books/2419.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4713, '2420', 'The Voyage of Trishna', 'T.P.S. Chowdary', 'National Book Trust', '2006', 78, '18', 'images/books/2420.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4714, '2421', 'The Story of Rice', 'Ramesh Dutt Sharma', 'National Book Trust', '2014', 63, '30', 'images/books/2421.JPG', 'Primary School Lower', 1, '2023-06-30 19:38:47', '2023-07-04 03:29:42'),
(4715, '2422', 'Our Army', 'Major- General D.K.Palit', 'National Book Trust', '2011', 59, '19', 'images/books/2422.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4716, '2423', 'Stories of Valour', 'Rajendra Awasthy', 'National Book Trust', '2014', 63, '30', 'images/books/2423.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24'),
(4717, '2424', 'Inventions that Changed the World-1', 'Mir Najanat Ali', 'National Book Trust', '2015', 64, '30', 'images/books/2424.JPG', 'High School', 1, '2023-06-30 19:38:47', '2023-07-04 03:31:28'),
(4932, '2639', 'Bush Roses', 'hamlyn', 'London', '', 32, '0.5', 'images/books/2639.JPG', 'Primary School Upper', 1, '2023-06-30 19:38:47', '2023-07-04 03:32:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
