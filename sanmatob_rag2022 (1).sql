-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2022 at 03:07 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanmatob_rag2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `quote` text,
  `img_path` varchar(150) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content1` text,
  `content2` text,
  `heading` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `quote`, `img_path`, `reg_date`, `content1`, `content2`, `heading`) VALUES
(1, 'वर्ष 1949 में स्थापित \"हिन्दी दैनिक सन्मार्ग\" पूर्वी भारत का सर्वाधिक प्रसारित और व्यापक रूप से पढ़ा जाने वाला समाचार पत्र है । इसका मुख्यालय कोलकाता में है । अपनी  76 वर्षों की उल्लेखनीय यात्रा में इसने पश्चिम बंगाल, उड़ीसा, बिहार और झारखंड में अपने 10 लाख पाठक बनाये हैं ।\r\n\"सन्मार्ग फाउंडेशन\"  \"हिन्दी दैनिक सन्मार्ग\" की सीएसआर शाखा है । इसका मुख्य उद्देश्य शिक्षा के क्षेत्र में कार्य करना  है,  साथ ही  देश के छात्रों  को हिन्दी के विकास और प्रचार-प्रसार कार्य में उत्कृष्टता लाने के लिए प्रोत्साहित करना है । \r\n\"राम अवतार गुप्त प्रतिभा पुरस्कार\" हमारे संस्थापक संपादक स्व. आर. ए. गुप्त को समर्पित है । इसकी स्थापना वर्ष 2006 में हुई  । इसका उद्देश्य उन छात्रों, शिक्षकों और संस्थानों को  प्रोत्साहित एवं पुरस्कृत करना है जो हिन्दी में  बेहतरीन कार्य कर रहे हैं । हमें यह बताते हुए गर्व की अनुभूति हो रही है कि हमने छात्रों, संकायों और संस्थानों में  हिन्दी के प्रति अभिरुचि बढ़ाने में मदद की है ।   हर वर्ष इसके आयोजन में आवेदकों की संख्या बढ़ती गयी  । वर्ष 2019 में 15000 से ज्यादा आवेदन हमें प्राप्त हुए, 250 पुरस्कार एवं हजारों प्रमाणपत्र प्रदान किये गये । इसके अतिरिक्त हम विद्यालय के वरिष्ठ हिन्दी शिक्षकों तथा हिन्दी में उत्कृष्ट परिणाम लाने वाले विद्यालयों को भी सम्मानित करते हैं ।\r\nवर्ष 2013 में हमने   पूरे बंगाल में इसका आयोजन प्रारंभ कर दिया । \r\n हमारा मुख्य उद्देश्य हिन्दी में उत्कृष्ट प्रदर्शन करने वाले छात्रों को प्रोत्साहित करना और हिन्दी के प्रति उनके मन में  गर्व की भावना को  जागृत करना है ।\r\nजो छात्र अपनी उच्च शिक्षा  हिन्दी में करना चाहते हैं , उन्हें हम छात्रवृत्ति भी प्रदान करते हैं ।\r\nहमें यह बताते हुए गर्व की अनुभूति हो रही है कि हमारा नवीनतम कदम है \"समार्ट विद्यार्थी \"।  यह पूरे बंगाल के हिन्दी माध्यम के विद्यालयों में अध्ययन कर रहे 9 लाख छात्रों को नि:शुल्क ई-​शिक्षा प्रदान करने का प्रयास   है । यह कार्य हम पश्चिम बंगाल सरकार के शिक्षा विभाग के सहयोग से कर रहे हैं । कोरोना महामारी को देखते हुए इसका आरंभ अप्रैल 2020 में किया गया ।', 'assets/images/about-us/', '2021-06-25 06:42:03', 'Sanmarg meaning the righteous path is the largest circulated Hindi daily in Eastern India, head\r\nquartered in Kolkata. Founded in 1949, it has built a 1million+ loyal reader database across West\r\nBengal, Jharkhand, Bihar &amp; Orissa. Keeping up with times Sanmarg enjoys a strong presence across\r\nall digital platforms.\r\nSanmarg foundation is the CSR wing of Sanmarg established with the aim of facilitating education.\r\nThe primary focus being on promoting excellence in Hindi amongst students, teachers and\r\ninstitutions.\r\nRam Awatar Gupt Pratibha Puraskar was initiated in 2006 by our founder editor the late R. A.\r\nGupta. and today the name symbolises &quot;Excellence &amp; Pride in Hindi&quot;. We proudly claim that we\r\nhelped increase interest towards the Hindi language in the youth of today.\r\nThe award ceremony accolades thousands of students, teachers and institution&#39;s for their work in\r\nHindi. Each edition is more memorable and expansive than the other. Today we have various\r\neditions across Bengal.\r\nThe cause is furthered by providing scholarships to students wanting to pursue Hindi for their higher\r\nstudies.\r\nWe practice what we believe in and this led to the birth of &quot;Smart Vidyarthi&quot; during the 2020\r\npandemic. It is an effort to impart free online education to 9 lakh+ students studying in Hindi\r\nmedium schools across Bengal. This is in partnership with the Government of West Bengal Department of\r\nEducation and was started in April 2020.', 'He lay on his armour-like  back, and if he lifted. ultrices ultrices sapien, nec tincidunt nunc posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing.', '&quot; हमारा सपना हर छात्र हिंदी को माने अपना &quot;');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `img_path` varchar(500) NOT NULL,
  `heading1` varchar(1000) DEFAULT NULL,
  `heading2` varchar(1000) DEFAULT NULL,
  `heading3` text,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `btn_name` varchar(100) DEFAULT NULL,
  `btn_link` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `page_name`, `img_path`, `heading1`, `heading2`, `heading3`, `reg_date`, `btn_name`, `btn_link`) VALUES
(1, 'home', 'assets/images/slider-main/bg4.jpg', '\"राम अवतार गुप्त प्रतिभा पुरस्कार\" यह नाम आज, \"हिंदी में उत्कृष्टता एवं गौरव\" का पर्याय बन गया है | इस पुरस्कार समारोह में हजारों छात्रों, शिक्षकों और संस्थानो को हिंदी में उनके काम के लिए सम्मानित किया जाता है।\r\n\r\n', 'Construction Industry', 'You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team looking for talent like.', '2021-06-11 10:46:49', 'Know us', 'home/about/about'),
(2, 'home', 'assets/images/slider-main/bg5.jpg', '\"राम अवतार गुप्त प्रतिभा पुरस्कार\" यह नाम आज, \"हिंदी में उत्कृष्टता एवं गौरव\" का पर्याय बन गया है | इस पुरस्कार समारोह में हजारों छात्रों, शिक्षकों और संस्थानो को हिंदी में उनके काम के लिए सम्मानित किया जाता है।\r\n\r\n', 'Your Choice is Simple', 'You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team looking for talent like.', '2021-06-11 10:49:23', 'Contact us', 'home/contact/contact'),
(3, 'about', 'assets/images/banner/banner1.jpg', 'About', NULL, NULL, '2021-06-01 08:53:10', NULL, NULL),
(4, 'contact', 'assets/images/banner/banner1.jpg', 'Contact', NULL, NULL, '2021-06-01 11:01:38', NULL, NULL),
(5, '2020', 'assets/images/banner/prv2020.jpg', NULL, NULL, NULL, '2021-06-25 12:32:15', NULL, NULL),
(6, '2019', 'assets/images/banner/banner4.jpg', NULL, NULL, NULL, '2021-06-23 06:37:02', NULL, NULL),
(7, '2018', 'assets/images/banner/prv2018.jpg', NULL, NULL, NULL, '2021-06-25 12:32:48', NULL, NULL),
(8, '2017', 'assets/images/banner/banner1.jpg', NULL, NULL, NULL, '2021-06-04 13:04:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `heading` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `heading`, `content`, `reg_date`) VALUES
(1, 'Find Our Location', '{\"address\":[{\"heading\":\"Visit Our Office\",\"icon\":\"fas fa-map-marker-alt\",\"content\":\"160/B, Chittaranjan Avenue, Kolkata\"}],\"email\":[{\"heading\":\"Email Us\",\"icon\":\"fa fa-envelope\",\"content\":\"ragpp@sanmarg.in\"}],\"phone\":[{\"heading\":\"Call Us\",\"icon\":\"fa fa-phone-square\",\"content\":\"9830222232<br> Monday - Friday (11:00am - 5:00pm)\"}]}', '2021-06-25 08:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `env_board_dtl`
--

CREATE TABLE `env_board_dtl` (
  `id` int(2) NOT NULL,
  `board_name` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_board_dtl`
--

INSERT INTO `env_board_dtl` (`id`, `board_name`) VALUES
(1, 'WEST BENGAL'),
(2, 'WBCHSE'),
(3, 'CBSE'),
(4, 'ICSE');

-- --------------------------------------------------------

--
-- Table structure for table `env_locations`
--

CREATE TABLE `env_locations` (
  `id` int(2) NOT NULL,
  `location_name` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `env_locations`
--

INSERT INTO `env_locations` (`id`, `location_name`) VALUES
(1, 'Kolkata'),
(2, 'Durgapur, Asansol & Raniganj'),
(3, 'Rest Of Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `header_above`
--

CREATE TABLE `header_above` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `fb_link` varchar(150) NOT NULL,
  `twitter_link` varchar(150) NOT NULL,
  `insta_link` varchar(150) NOT NULL,
  `reg_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `header_above`
--

INSERT INTO `header_above` (`id`, `address`, `fb_link`, `twitter_link`, `insta_link`, `reg_datetime`) VALUES
(1, '160/B, Chittaranjan Avenue, Kolkata', 'https://facebbok.com/themefisher.com', 'https://twitter.com/themefisher.com', 'https://instagram.com/themefisher.com', '2021-06-11 10:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `header_below`
--

CREATE TABLE `header_below` (
  `id` int(11) NOT NULL,
  `heading` varchar(200) NOT NULL,
  `btn_name` varchar(500) NOT NULL,
  `btn_link` varchar(500) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `header_below`
--

INSERT INTO `header_below` (`id`, `heading`, `btn_name`, `btn_link`, `reg_date`) VALUES
(1, 'Register here for RAG 2021', 'REGISTER NOW', 'https://www.w3schools.com/', '2021-06-25 10:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `heading` varchar(200) DEFAULT NULL,
  `content` text NOT NULL,
  `img_path` varchar(500) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `heading`, `content`, `img_path`, `reg_date`, `section`) VALUES
(1, 'What RAG is', '{\"right\":[{\"heading\":\"विद्यार्थी अभिदाता\",\"details\":\"3 selected अभिदाता from each board & class will be provided a scholarship to pursue their education.\"},{\"heading\":\"उच्च विद्यार्थी अभिदाता\",\"details\":\"3 अभिदाता (B.A. & M.A. ) will be assisted for further development.\"},{\"heading\":\"गुरु प्रोत्साहन**\",\"details\":\"The work of 3 Hindi teachers will be promoted extensively.\"}],\"left\":[{\"heading\":\"अपराजय\",\"details\":\"Assistance to especially abled children to pursue their education in Hindi.\"},{\"heading\":\"अंकुर\",\"details\":\"Assistance to students for enhancing their vocational skills in Hindi.\"},{\"heading\":\"सर्वश्रेष्ठ संस्थान\",\"details\":\"Encouraging institutions which work towards development\"}]}', 'assets/images/services/R_abt.jpg', '2021-06-25 06:23:01', 'about_rag'),
(3, NULL, '{\"counter\":[{\"title\":\"Years\",\"img_path\":\"assets/images/icon-image/fact1.png\",\"count\":\"1789\"},{\"title\":\"Total registration\",\"img_path\":\"assets/images/icon-image/fact2.png\",\"count\":\"647\"},{\"title\":\"Prices\",\"img_path\":\"assets/images/icon-image/fact3.png\",\"count\":\"4000\"}]}', NULL, '2021-05-29 10:02:55', 'counter'),
(4, 'Gallery', '{\"2020\":[\"assets/images/projects/2020/\"],\"2019\":[\"assets/images/projects/2019/\"],\"2018\":[\"assets/images/projects/2018/\"]}', 'assets/images/projects/', '2021-06-25 12:54:45', 'gallery'),
(5, NULL, '{\"right\":[{\"heading\":\"Can We Help?\",\"content\":\"9830222232\"}],\"left\":[{\"heading\":\"to assist you\",\"content\":\"We are here\"}]}', NULL, '2021-06-14 07:16:08', 'help_center'),
(6, 'Our Sponsors', '[\"client1.png\",\"client2.png\",\"client3.png\",\"client4.png\",\"client5.png\",\"client6.png\"]', 'assets/images/client/2019/', '2021-06-14 09:50:43', 'sponsor');

-- --------------------------------------------------------

--
-- Table structure for table `school_list`
--

CREATE TABLE `school_list` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_address` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_list`
--

INSERT INTO `school_list` (`id`, `school_name`, `school_address`) VALUES
(1, 'Gandhinagar High school', 'Howrah,Kolkata'),
(2, 'Ramkrishna Misson High School(H.S', 'Bali,Howrah.'),
(3, 'Mission High School', 'Barasat,Kolkata.'),
(4, 'Goutham Smriti satpati binapani Vidyamandir', 'Medinipur,WestBengal.'),
(5, 'New School', 'Kolkata,WestBengal.\r\n'),
(6, 'holy home high school ', 'Shrirampur,howrah,kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(2) NOT NULL,
  `form_date_time` varchar(111) NOT NULL,
  `reg_id` varchar(111) NOT NULL,
  `ip_address` varchar(111) NOT NULL,
  `reg_location` varchar(111) NOT NULL,
  `boardexam` varchar(111) NOT NULL,
  `category` varchar(111) NOT NULL,
  `disorder` varchar(111) NOT NULL,
  `phy_disorder_name` varchar(111) NOT NULL,
  `mental_disorder_name` varchar(111) NOT NULL,
  `disorder_detail` varchar(100) NOT NULL,
  `disorder_file` varchar(111) NOT NULL,
  `fname` varchar(111) NOT NULL,
  `lname` varchar(111) NOT NULL,
  `hname` varchar(111) NOT NULL,
  `hlname` varchar(111) NOT NULL,
  `student_photo_file` varchar(111) NOT NULL,
  `hname_correct` varchar(111) NOT NULL,
  `hname_file` varchar(111) NOT NULL,
  `student_gender` varchar(111) NOT NULL,
  `student_dob` varchar(100) NOT NULL,
  `student_email` varchar(111) NOT NULL,
  `student_mobile` varchar(111) NOT NULL,
  `board_roll_no` varchar(111) NOT NULL,
  `admit_card_file` varchar(111) NOT NULL,
  `school_name` varchar(111) NOT NULL,
  `school_address` varchar(111) NOT NULL,
  `other_school_name` varchar(111) NOT NULL,
  `other_school_address` varchar(111) NOT NULL,
  `school_medium` varchar(111) NOT NULL,
  `class` varchar(100) NOT NULL,
  `last_year_marks1` varchar(111) NOT NULL,
  `last_year_marks2` varchar(111) NOT NULL,
  `last_year_marks3` varchar(111) NOT NULL,
  `current_year_marks1` varchar(111) NOT NULL,
  `current_year_marks2` varchar(111) NOT NULL,
  `current_year_preboards` varchar(111) NOT NULL,
  `parent_name` varchar(111) NOT NULL,
  `parent_mobile` varchar(111) NOT NULL,
  `emergency_landline` varchar(111) NOT NULL,
  `parent_email` varchar(100) NOT NULL,
  `home_address` varchar(111) NOT NULL,
  `city` varchar(111) NOT NULL,
  `state` varchar(111) NOT NULL,
  `pincode` varchar(111) NOT NULL,
  `family_income` varchar(111) NOT NULL,
  `facebook_handle` varchar(111) NOT NULL,
  `twitter_handle` varchar(111) NOT NULL,
  `ragaward_source` varchar(111) NOT NULL,
  `ragaward_source_other` varchar(111) NOT NULL,
  `sanmarg_reader` varchar(100) NOT NULL,
  `hawker_name` varchar(111) NOT NULL,
  `hawker_telephone` varchar(111) NOT NULL,
  `rag_pariksha_participated` varchar(111) NOT NULL,
  `rag_pariksha_rollno` varchar(111) NOT NULL,
  `rag_pariksha_marks` varchar(111) NOT NULL,
  `rag_participated_chk` varchar(111) NOT NULL,
  `ankur` varchar(111) NOT NULL,
  `ankur_activity_textwork` varchar(111) NOT NULL,
  `ankur_activity_file` varchar(111) NOT NULL,
  `all_activity_file` varchar(100) NOT NULL,
  `yuva` varchar(111) NOT NULL,
  `marksheet_file` varchar(100) NOT NULL,
  `qualified` enum('yes','no') NOT NULL DEFAULT 'no',
  `verified` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `form_date_time`, `reg_id`, `ip_address`, `reg_location`, `boardexam`, `category`, `disorder`, `phy_disorder_name`, `mental_disorder_name`, `disorder_detail`, `disorder_file`, `fname`, `lname`, `hname`, `hlname`, `student_photo_file`, `hname_correct`, `hname_file`, `student_gender`, `student_dob`, `student_email`, `student_mobile`, `board_roll_no`, `admit_card_file`, `school_name`, `school_address`, `other_school_name`, `other_school_address`, `school_medium`, `class`, `last_year_marks1`, `last_year_marks2`, `last_year_marks3`, `current_year_marks1`, `current_year_marks2`, `current_year_preboards`, `parent_name`, `parent_mobile`, `emergency_landline`, `parent_email`, `home_address`, `city`, `state`, `pincode`, `family_income`, `facebook_handle`, `twitter_handle`, `ragaward_source`, `ragaward_source_other`, `sanmarg_reader`, `hawker_name`, `hawker_telephone`, `rag_pariksha_participated`, `rag_pariksha_rollno`, `rag_pariksha_marks`, `rag_participated_chk`, `ankur`, `ankur_activity_textwork`, `ankur_activity_file`, `all_activity_file`, `yuva`, `marksheet_file`, `qualified`, `verified`) VALUES
(1, '2022-05-21 11:01:59', '0000001', '136.232.70.46', 'Kolkata', 'WBCHSE', 'General', '', '', '', '', '', 'soubhik', 'mandal', 'सौभिक', 'मंडल', '120163832_3243502805768727_8402847481295074674_n.png', 'Yes', '', 'Male', '2005-12-08', 'manojmahatayt@gmail.com', '8686868636', '424242', '120163832_3243502805768727_8402847481295074674_n.png', 'holy home high school', 'Shrirampur,howrah,kolkata', '', '', 'Hindi Medium', 'Class-12', '76', '56', '76', '78', '86', '65', 'parent Name', '8585856363', '645646464645', 'new@gmail.com', 'gdgdfgdg', 'Kolkata', 'West Bengal', '723533', 'below 2.5 lakhs', 'facebook.com', 'twitter.com', 'Sanmarg Newspaper', '', 'Yes', 'hawkername', '5675675757', 'Yes', '5657566', '78', 'Yes', 'Yes', 'ghjghjghj', '66.jpg', '5555.jpg', 'Yes', '', 'yes', 'yes'),
(2, '2022-05-21 15:22:07', '0000002', '136.232.70.46', 'Durgapur, Asansol & Raniganj(South Bengal District )', 'WBCHSE', 'Aparajay', 'Physically Challenged', 'Amputation', '', 'sfsdfsdfsfsf', '120163832_3243502805768727_8402847481295074674_n.png', 'sourav', 'marduney', 'सौरव', 'मार्डुने', 'PHOTO-2021-05-24-16-56-26-1.jpg', 'No', '111.jpg', 'Male', '2005-12-12', 'manojmahatayt@gmail.com', '8686868636', '424242', '55.jpg', 'Ramkrishna Misson High School(H.S', 'Bali,Howrah.', '', '', 'Hindi Medium', 'Class-10', '76', '56', '76', '78', '86', '65', 'parent Name', '8585856363', '645646464645', 'new@gmail.com', 'dfsfsfsfsfsf', 'Kolkata', 'West Bengal', '723533', 'below 2.5 lakhs', 'facebook.com', 'twitter.com', 'Sanmarg Newspaper', '', 'Yes', 'hawkername', '5675675757', 'Yes', '5657566', '78', '', 'Yes', 'hgghjgjjhg', 'd1don.jpg', '7.jpg', 'Yes', '', 'no', 'yes'),
(3, '2022-06-04 13:07:35', '0000003', '136.232.70.46', 'Kolkata', 'WBCHSE', 'General', '', '', '', '', '', 'manoj', 'mahata', 'मनोज', 'महता', 'images.jpg', 'Yes', '', 'Male', '2005-12-08', 'manojmahatayt@gmail.com', '8686868636', '424242', 'back5.jpg', 'Goutham Smriti satpati binapani Vidyamandir', 'Medinipur,WestBengal.', '', '', 'Hindi Medium', 'Class-10', '76', '56', '76', '78', '86', '65', 'parent Name', '8585856363', '645646464645', 'new@gmail.com', 'fgdgdg', 'Kolkata', 'West Bengal', '723533', 'below 2.5 lakhs', 'facebook.com', 'twitter.com', 'Sanmarg Epaper', '', 'Yes', 'hawkername', '5675675757', 'Yes', '5657566', '67', '', 'No', '', '', '', 'Yes', '', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`name`, `email`, `subject`, `message`, `id`) VALUES
('name', 'email', 'sub', 'msg', 1),
('payel', '9804payel@gmail.com', 'check mail', 'sd', 2),
('payel', 'admin@hj.nm', 'test mail from badsamwad', 'jhijijij', 3),
('payel', 'admin@hj.nm', 'test mail from badsamwad', 'kkk', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(2) NOT NULL,
  `username` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin192', 'admin192'),
(2, 'manoj', 'manoj192'),
(3, 'suman', 'suman192');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `guest` text,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `guest`, `reg_date`) VALUES
(1, '{\"2020\": [{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"}],\"2019\":[{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"}],\"2018\":[{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"}],\"2017\":[{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"},{\"img\":\"\",\"name\":\"\",\"designation\":\"\"}]}', '2021-06-04 13:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `guest` text,
  `splMoments` text,
  `winners` text,
  `gallery` text,
  `sponsor` text,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `guest`, `splMoments`, `winners`, `gallery`, `sponsor`, `regDate`) VALUES
(1, 2020, '{\"guest\":[{\"img_path\":\"assets/images/guest/2020/g1.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2020/g2.jpg\",\"name\":\"Ghum Touch Hospital\",\"designation\":\"Healthcare\"}]}', '{\"moments\":[{\"img_path\":\"assets/images/special-moments/2020/slide-page1.jpg\",\"heading\":\"Leadership\"},{\"img_path\":\"assets/images/special-moments/2020/slide-page2.jpg\",\"heading\":\"Relationships\"},{\"img_path\":\"assets/images/special-moments/2020/slide-page3.jpg\",\"heading\":\"Performance\"}]}', '{\"winner\":[{\"img_path\":\"assets/images/winner/2020/team1.jpg\",\"name\":\"Nats Stenman\",\"school\":\"Chief Operating Officer\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2020/team2.jpg\",\"name\":\"Angela Lyouer\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2020/team3.jpg\",\"name\":\"Mark Conter\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2020/team4.jpg\",\"name\":\"Ayesha Stewart\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2020/team5.jpg\",\"name\":\"Dave Clarkte\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2020/team6.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"}]}', 'assets/images/projects/2020/', 'assets/images/client/2020/', '2021-06-25 11:44:03'),
(2, 2019, '{\"guest\":[{\"img_path\":\"assets/images/guest/2019/g1.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g2.jpg\",\"name\":\"Ghum Touch Hospital\",\"designation\":\"Healthcare\"},{\"img_path\":\"assets/images/guest/2019/g3.jpg\",\"name\":\"TNT East Facility\",\"designation\":\"Government\"},{\"img_path\":\"assets/images/guest/2019/g4.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g5.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g6.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g7.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g8.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2019/g9.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"}]}', '{\"moments\":[{\"img_path\":\"assets/images/special-moments/2019/spl1.jpg\",\"heading\":\"Leadership\"},{\"img_path\":\"assets/images/special-moments/2019/spl2.jpg\",\"heading\":\"Relationships\"},{\"img_path\":\"assets/images/special-moments/2019/spl3.jpg\",\"heading\":\"Relationships\"}]}', '{\"winner\":[{\"img_path\":\"assets/images/winner/2019/w1.jpg\",\"name\":\"Nats Stenman\",\"school\":\"Chief Operating Officer\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w2.jpg\",\"name\":\"Angela Lyouer\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w3.jpg\",\"name\":\"Mark Conter\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w4.jpg\",\"name\":\"Ayesha Stewart\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w5.jpg\",\"name\":\"Dave Clarkte\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w6.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w7.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w8.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w9.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w10.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w11.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w12.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w13.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w14.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w15.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2019/w16.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"}]}', 'assets/images/projects/2019/', 'assets/images/client/2019/', '2021-06-12 13:30:50'),
(3, 2018, '{\"guest\":[{\"img_path\":\"assets/images/guest/2018/g1.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2018/g2.jpg\",\"name\":\"Ghum Touch Hospital\",\"designation\":\"Healthcare\"},{\"img_path\":\"assets/images/guest/2018/g3.jpg\",\"name\":\"TNT East Facility\",\"designation\":\"Government\"},{\"img_path\":\"assets/images/guest/2018/g4.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2018/g5.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2018/g6.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2018/g7.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2018/g8.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"}]}', '{\"moments\":[{\"img_path\":\"assets/images/special-moments/2018/spl1.jpg\",\"heading\":\"Leadership\"},{\"img_path\":\"assets/images/special-moments/2018/spl2.jpg\",\"heading\":\"Relationships\"},{\"img_path\":\"assets/images/special-moments/2018/spl3.jpg\",\"heading\":\"Performance\"}]}', '{\"winner\":[{\"img_path\":\"assets/images/winner/2018/w1.jpg\",\"name\":\"Nats Stenman\",\"school\":\"Chief Operating Officer\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w2.jpg\",\"name\":\"Angela Lyouer\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w3.jpg\",\"name\":\"Mark Conter\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w4.jpg\",\"name\":\"Ayesha Stewart\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w5.jpg\",\"name\":\"Dave Clarkte\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w6.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w7.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w8.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w9.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w10.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w11.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w12.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w13.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w14.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w15.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2018/w16.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"}]}', 'assets/images/projects/2018/', 'assets/images/client/2018/', '2021-06-12 13:42:02'),
(4, 2017, '{\"guest\":[{\"img_path\":\"assets/images/guest/2017/project1.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"},{\"img_path\":\"assets/images/guest/2017/project2.jpg\",\"name\":\"Ghum Touch Hospital\",\"designation\":\"Healthcare\"},{\"img_path\":\"assets/images/guest/2017/project3.jpg\",\"name\":\"TNT East Facility\",\"designation\":\"Government\"},{\"img_path\":\"assets/images/guest/2017/project1.jpg\",\"name\":\"Capital Teltway Building\",\"designation\":\"Commercial, Interiors\"}]}', '{\"moments\":[{\"img_path\":\"assets/images/special-moments/2017/slide-page1.jpg\",\"heading\":\"Leadership\"},{\"img_path\":\"assets/images/special-moments/2017/slide-page2.jpg\",\"heading\":\"Relationships\"},{\"img_path\":\"assets/images/special-moments/2017/slide-page3.jpg\",\"heading\":\"Performance\"}]}', '{\"winner\":[{\"img_path\":\"assets/images/winner/2017/team1.jpg\",\"name\":\"Nats Stenman\",\"school\":\"Chief Operating Officer\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2017/team2.jpg\",\"name\":\"Angela Lyouer\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2017/team3.jpg\",\"name\":\"Mark Conter\",\"school\":\"Birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2017/team4.jpg\",\"name\":\"Ayesha Stewart\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2017/team5.jpg\",\"name\":\"Dave Clarkte\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"},{\"img_path\":\"assets/images/winner/2017/team6.jpg\",\"name\":\"Elton Joe\",\"school\":\"birla school\",\"description\":\"Nats Stenman began his career in construction with boots on the ground\"}]}', 'assets/images/projects/2017/', 'assets/images/client/2017/', '2021-06-11 07:49:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `env_board_dtl`
--
ALTER TABLE `env_board_dtl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `env_locations`
--
ALTER TABLE `env_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_above`
--
ALTER TABLE `header_above`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_below`
--
ALTER TABLE `header_below`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_list`
--
ALTER TABLE `school_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `env_board_dtl`
--
ALTER TABLE `env_board_dtl`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `env_locations`
--
ALTER TABLE `env_locations`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `header_above`
--
ALTER TABLE `header_above`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `header_below`
--
ALTER TABLE `header_below`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `school_list`
--
ALTER TABLE `school_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
