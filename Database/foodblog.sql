-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 31, 2021 alle 21:56
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodblog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `IdCategory` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`IdCategory`, `Category`) VALUES
(1, 'Chef'),
(2, 'Administrator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE `images` (
  `IdImage` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`IdImage`, `Path`) VALUES
(1, 'Images/Instagram.png'),
(2, 'Images/Pinterest.png'),
(4, 'Images/BreadRolls.jpg'),
(7, 'Images/Tortillas.jpg'),
(9, 'Images/Toast2.jpg'),
(10, 'Images/CUTEnglish.jpg'),
(11, 'Images/English.jpg'),
(13, 'Images/EasyAsBread.png'),
(20, 'Images/ProperPasta.png'),
(21, 'Images/ProperPasta.png'),
(22, 'Images/ProperPasta.png'),
(23, 'Images/ProperPasta.png'),
(24, 'Images/ProperPasta.png'),
(25, 'Images/ProperPasta.png'),
(26, 'Images/ProperPasta.png'),
(27, 'Images/ProperPasta.png'),
(28, 'Images/ProperPasta.png'),
(29, 'Images/EasyAsBread.png'),
(30, 'Images/ProperPasta.png'),
(37, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(38, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(39, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(40, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(41, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(42, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(43, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(44, 'Images/Toast2.jpg'),
(45, 'Images/English.jpg'),
(46, 'Images/BreadRolls.jpg'),
(47, 'Images/strawberries.jpg'),
(48, 'Images/BreadRolls.jpg'),
(49, 'Images/BreadRolls.jpg'),
(50, 'Images/yeast2.jpg'),
(51, 'Images/yeast3.jpg'),
(52, 'Images/English.jpg'),
(53, 'Images/BreadRolls.jpg'),
(54, 'Images/yeast2.jpg'),
(55, 'Images/yeast3.jpg'),
(56, 'Images/yeast2.jpg'),
(57, 'Images/strawberries.jpg'),
(58, 'Images/English.jpg'),
(59, 'Images/chillisinwater.jpg'),
(60, 'Images/BreadRolls.jpg'),
(61, 'Images/BreadRolls.jpg'),
(62, 'Images/yeast2.jpg'),
(63, 'Images/yeast2.jpg'),
(64, 'Images/chillisinwater.jpg'),
(65, 'Images/chillisinwater.jpg'),
(66, 'Images/chillisinwater.jpg'),
(67, 'Images/chillisinwater.jpg'),
(68, 'Images/chillisinwater.jpg'),
(69, 'Images/chillisinwater.jpg'),
(70, 'Images/chillisinwater.jpg'),
(71, 'Images/BreadRolls.jpg'),
(72, 'Images/chillisinwater.jpg'),
(73, 'Images/English.jpg'),
(74, 'Images/MeFace.jpg'),
(75, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(76, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(77, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(78, 'Images/strawberries.jpg'),
(79, 'Images/No-Churn Bee Pollen Ice Cream.jpg'),
(80, 'Images/No-Churn Bee Pollen Ice Cream.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingredients`
--

CREATE TABLE `ingredients` (
  `IdIngredient` int(11) NOT NULL,
  `Ingredient` varchar(255) NOT NULL,
  `IdMeasureUnit` int(11) NOT NULL,
  `IdAlternative` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingredients`
--

INSERT INTO `ingredients` (`IdIngredient`, `Ingredient`, `IdMeasureUnit`, `IdAlternative`) VALUES
(1, '00 Flour', 1, 2),
(2, 'Bread Flour', 1, 1),
(3, 'Water 95°', 1, NULL),
(5, ' Egg Beaten', 1, NULL),
(6, 'Table Salt', 1, NULL),
(7, 'Fresh Yeast', 1, 8),
(8, 'Dry Yeast', 1, 7),
(9, 'Granulated Sugar', 1, NULL),
(10, 'Melted Butter', 1, NULL),
(11, 'Greek Yoghurt', 1, NULL),
(12, 'Unsalted Butter Cold', 1, NULL),
(13, 'Baking Powder', 1, NULL),
(14, 'Whole Milk Cold', 1, NULL),
(29, 'Bee Pollen', 1, NULL),
(30, 'Liquid Glucose', 1, NULL),
(31, 'UHT Cream', 1, 32),
(32, 'Double Cream', 1, 31),
(33, 'UHT Semi-Skimmed Milk', 1, 34),
(34, 'regular Semi-Skimmed Milk', 1, 33),
(35, '00 Flour', 1, 36),
(36, 'Table Salt', 1, 35),
(37, 'UHT Cream', 1, 38),
(38, 'UHT Semi-Skimmed Milk', 1, 37),
(39, 'UHT Cream', 1, 40),
(40, 'UHT Semi-Skimmed Milk', 1, 39),
(41, 'Melted Butter', 1, 42),
(42, 'Bread Flour', 1, 41),
(43, 'Bee Pollen', 1, 44),
(44, 'Baking Powder', 1, 43),
(45, 'UHT Cream', 1, 46),
(46, 'UHT Semi-Skimmed Milk', 1, 45),
(47, 'Bee Pollen', 1, 48),
(48, 'Baking Powder', 1, 47),
(49, 'UHT Cream', 1, 50),
(50, 'UHT Semi-Skimmed Milk', 1, 49),
(51, 'UHT Cream', 1, 52),
(52, 'UHT Semi-Skimmed Milk', 1, 51);

-- --------------------------------------------------------

--
-- Struttura della tabella `measureunits`
--

CREATE TABLE `measureunits` (
  `IdMeasureUnit` int(11) NOT NULL,
  `MeasureUnit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `measureunits`
--

INSERT INTO `measureunits` (`IdMeasureUnit`, `MeasureUnit`) VALUES
(1, 'g');

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `IdProduct` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Link` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `IdImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`IdProduct`, `Title`, `Link`, `Description`, `IdImage`) VALUES
(1, 'Easy As Bread', 'https://www.amazon.it/kindle-store-ebooks/b?ie=UTF8&node=818937031', 'Bread is the most respected staple food across the globe. We love it for good reason. It is inexpensive. It is delicious. It has been around since the beginning and we are familiar with it. \r\n\r\nBread is the only food that connects our different cultures and social groups. Through race, religion, poverty and wealth. Bread is celebrated. If you are interested in a further understanding of your own food culture or have curiosities about others and the similarities between them all. There is no better place to start than with bread. This book consists of easy bread recipes that are diverse and will cover a wide range of cuisine’s so you can eat good bread and turn every meal into a great meal.\r\n', 13),
(12, 'Proper Pasta', 'https://www.amazon.it/kindle-store-ebooks/b?ie=UTF8&node=818937031', '\r\nMaecenas condimentum laoreet felis, ut cursus orci semper sit amet. Sed fermentum consequat ante quis eleifend. Mauris ac auctor turpis. Integer a tristique tortor. Quisque pulvinar quis sem sit amet cursus. Proin sollicitudin malesuada dolor sit amet dignissim. Vivamus nibh elit, malesuada ac volutpat ac, tempor nec nunc. Nunc quis nibh orci. Mauris semper, ex sed volutpat consectetur, quam sapien feugiat ex, in bibendum quam arcu quis erat.\r\n', 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `recipes`
--

CREATE TABLE `recipes` (
  `IdRecipe` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Preparation` text DEFAULT NULL,
  `State` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recipes`
--

INSERT INTO `recipes` (`IdRecipe`, `Title`, `Preparation`, `State`) VALUES
(0, 'TEST;test', 'TEST; test', 1),
(1, 'BREAD ROLLS ; recipe for 10 rolls', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR  TOTAL | SERVES 4-8 ;\r\n01 Dissolve the yeast and sugar in the water and leave to stand until active and foaming. This should take about 10 minutes. ;\r\n02 Combine the flour and salt in a large bowl and add the yeast mixture and the beaten egg and begin to bring to a dough. Ensure everything is combined and there is no flour left in the bowl. ;\r\n03 Tip out the dough and begin to knead on an unfloured work surface for 10-12 minutes until the dough is smooth and springs back when being gently poked ;\r\n04 Put the dough into a large bowl, cover with cling film and leave to proof until double in size. About 1 – 2 hours depending on the environment. ;\r\n05 Once the dough has been sufficiently proofed knock the air out of it my gently pushing your hand into the centre and divide into 80g pieces. ;\r\n06 Roll the pieces into little balls using the surface tension method and place them on a lined baking tray with enough space to proof once more. Cover with a wet cloth to prevent dehydration. ;\r\n07 Preheat the oven to 180°C or 350f. ;\r\n08 Allow them to double in size once more (about 30 minutes) and carefully brush them half of the melted butter ensuring not to knock out the air. ;\r\n09 Bake them at 180°C for 10-15 minutes or until golden brown. ;\r\n10 Brush them with the remaining butter and allow them cool completely before use.', 1),
(2, 'FLOUR TORTILLAS ; recipe for 8 tortillas', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR TOTAL | SERVES 4-8 ;\r\n01 Combine the flour, salt, and baking powder in a large bowl. ;\r\n02 Cut the cold butter into small pieces and rub it into the flour mix using your fingertips until you have a fine breadcrumb texture. ;\r\n03 Add the yoghurt and gently kneed until combined. Cover loosely with cling film and rest the dough for 10 minutes. ;\r\n04 Once the dough has rested, roll it into a sausage shape and equally divide the dough into 8 portions, shape them into balls and rest them for a further 10 minutes. ;\r\n05 Using a floured rolling pin, roll each portion out to 10 inches in diameter on a lightly floured work surface. ;\r\n06 Cook one at a time in a large dry non-stick frying pan over a medium to low heat turning over only once during cooking. ;\r\n07 Allow the finished Tortillas to cool completely and soften before use.', 1),
(3, 'BREAKFAST TOAST ; recipe for 1 loaf', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR TOTAL | SERVES 4-8 ;\r\n01 Combine the sugar yeast and water and leave to stand to until the yeast is foaming. ;\r\n02 Add the flour, salt, and whole milk together and mix it too a loose dough. If the dough is wet, let it stand for 5 minutes, dust with a little flour and start kneading. ;\r\n03 Knead for 10-15 minutes until the dough is smooth and springy. After a couple of minutes kneading you will start to notice a significant difference in the consistency. ;\r\n04 Once sufficiently kneading, place the dough in a large bowl and cover with a damp cloth. Allow the dough to double in size (about 1 hour). ;\r\n05 Lightly oil and flour an appropriately sized loaf tin and preheat your oven to 180°C. ;\r\n06 Once the dough has doubled in size, knock the air out and flatten the dough. Roll the dough over itself to create a sausage shape and place it in the loaf tin. Ensure to push the dough into the corners of the tin. ;\r\n07 Cover it with a damp cloth and allow the dough to double in volume once more; 08. Bake at 180°C for 20-25 minutes or until golden brown. (12-15 minutes for smaller loaves). If you are unsure you can check the core temperature using a probe thermometer. Be sure the breach reaches a minimum of 86°C.', 1),
(4, 'NO-CHURN BEE POLLEN ICE CREAM;recipe for 12  icecream ball', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR TOTAL | SERVES 4-8; 01 Add all of the ingredients together except the Cream and bring to the boil ;\r\n02 Blend the mixture together in a food processor or with a stick blender ;\r\n03 Pass the mixture through a seize and discard the remnants ;\r\n04 Refrigerate ;\r\n05 Whip the Cream until nearly stiff ;\r\n06 Fold the whipped Cream into the Bee Pollen mixture gently. Be careful not to knock out the air ;\r\n07 Place the Ice Cream in the freezer and stir gently with a spoon 3-4 times over a couple of hours until the Ice Cream is frozen and ready to serve ;', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `recipesimages`
--

CREATE TABLE `recipesimages` (
  `IdRecipeImage` int(11) NOT NULL,
  `IdRecipe` int(11) DEFAULT NULL,
  `IdImage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recipesimages`
--

INSERT INTO `recipesimages` (`IdRecipeImage`, `IdRecipe`, `IdImage`) VALUES
(2, 1, 4),
(5, 2, 7),
(7, 3, 9),
(18, 4, 80);

-- --------------------------------------------------------

--
-- Struttura della tabella `recipesingredients`
--

CREATE TABLE `recipesingredients` (
  `IdRecipe` int(11) NOT NULL,
  `IdIngredient` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recipesingredients`
--

INSERT INTO `recipesingredients` (`IdRecipe`, `IdIngredient`, `Quantity`) VALUES
(1, 1, 500),
(1, 2, 500),
(1, 3, 200),
(1, 5, 130),
(1, 6, 10),
(1, 7, 21),
(1, 8, 7),
(1, 9, 20),
(1, 10, 50),
(2, 1, 220),
(2, 2, 220),
(2, 6, 5),
(2, 11, 150),
(2, 12, 65),
(2, 13, 5),
(3, 1, 500),
(3, 2, 500),
(3, 3, 150),
(3, 6, 10),
(3, 7, 21),
(3, 8, 7),
(3, 9, 40),
(3, 14, 150),
(4, 6, 1),
(4, 9, 125),
(4, 29, 100),
(4, 30, 200),
(4, 51, 400),
(4, 52, 200);

-- --------------------------------------------------------

--
-- Struttura della tabella `reviews`
--

CREATE TABLE `reviews` (
  `IdReview` int(11) NOT NULL,
  `Stars` int(11) NOT NULL,
  `Review` varchar(255) DEFAULT NULL,
  `IdUser` int(11) NOT NULL,
  `IdRecipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reviews`
--

INSERT INTO `reviews` (`IdReview`, `Stars`, `Review`, `IdUser`, `IdRecipe`) VALUES
(2, 2, 'I don\'t really like it.', 1, 2),
(4, 4, 'Yummy!!!', 5, 2),
(18, 5, 'I love them', 13, 1),
(20, 4, 'So easy to prepare :)', 2, 2),
(58, 2, 'This recipe sucks', 1, 1),
(60, 4, 'Thanks, I will make them every day for my children', 1, 3),
(61, 1, 'When I put Nutella on my toasts they break', 8, 3),
(62, 5, 'With apricot jam this is my absolute favorite snack', 6, 3),
(63, 5, 'They are exactly the same as the ones I ate in Mexico.  ', 6, 2),
(65, 4, 'They\'re so delicious ', 5, 3),
(70, 2, 'I need this recipe in the gluten free version', 20, 2),
(87, 5, 'These toasts are tasty', 15, 3),
(95, 3, ' I tried making these toasts yesterday but my skills are not that developed, I\'ll try again next week', 20, 3),
(107, 5, 'Ice ice. Deam Sosa this gelato is so good. ', 41, 4),
(108, 3, 'Without churn this recipe is very easy to prepare but the taste is not the same :/', 16, 4),
(115, 4, 'Sweeeet (❁´◡`❁)', 21, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Newsletter` tinyint(1) NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`IdUser`, `Name`, `Surname`, `Email`, `Password`, `Newsletter`, `Category`) VALUES
(1, 'Luigi', 'Verdi', 'luigi.verdi@gmail.com', '$2y$10$0SV.H/mkgmB0.5Y1dZIp2.KDy.t5z8b3Ywa9otEzpTOtkmFdhBkyS', 1, 3),
(2, 'Maria', 'Rossi', 'maria@ciao.it', '$2y$10$GAr5ECFJJSzOxWiSxpT5qeSgen8C.Ez452TpsglpmG0SLG/3i1nQC', 0, 3),
(3, 'Michael', 'Sarto', 'michael.sarto@ptpvenezia.edu.it', '$2y$10$l3LeiP95BeQLPKJsj2/Fn.gsYOQd9GH/QgvYqhHMjRhr0f5GJoU5q', 1, 2),
(5, 'Anna', 'Contiero', 'anna.contiero1970@gmail.com', '$2y$10$dMiqSbXPGbRVui.paQos/ef2SA7KgBI4sy/2xqcgvX1h2sxOrdx8K', 1, 3),
(6, 'Paolo', 'Bonolis', 'paolo.bonolis@live.com', '$2y$10$JdPymdsxzNN4/3wC9suBa.0xJG5Q0xAkPzny3gHNZwAyFccEFU73m', 1, 3),
(7, 'Luca', 'Laurentis', 'luca.laurentis@gmail.it', '$2y$10$zxo7k1aWjJrby5oH/9h0zeMACik6LRX8Bjh/RcDXwYnmkRAjsH8T6', 0, 3),
(8, 'Csaba', 'Zorba', 'csaba.zorza@gmail.it', '$2y$10$qCz6/EDMZhaLfNh6SuxaQeuNQ5UfNLb4LS2IUjSpGojw3OE3GIePi', 1, 3),
(9, 'Antonella', 'Kinder', 'antonella@kinder.it', '$2y$10$3fl/6xxIlgxbl4t06U7Hn.B5PcrFvMEoxYtAyBHGQN3.On3TWiqhy', 1, 3),
(10, 'Michele', 'Sarto', 'sarto@tiscali.it', '$2y$10$Tx4WeaPqPrvuhmFESs9nduCKVMKXRQmJiaRjRdxpUCXd/1JCMUpvO', 1, 3),
(12, 'Grace', 'Gullidge', 'ciao@ciao.it', '$2y$10$nAno1NOCGtHqBJvkSCxLIejtFbhQAyCFsBFucazSk9OsdpJvEguQ2', 0, 3),
(13, 'Nicola', 'Panizzolo', 'nicola.panizollo@ptpvenezia.edu.it', '$2y$10$58P.iDm908KPmJ2DgZ8zuuaxx1bpHVAHPuRemSA3Q7ddYC37wbfL6', 1, 3),
(15, 'Ethan', 'Franceschin', 'ethan.franceschin@ptpvenezia.edu.it', '$2y$10$v/IshXfaAnKzLemWzzmhHuThx6CWKbgo.24NyYCel9UOQ9MXCpfLG', 1, 3),
(16, 'Leonardo', 'Vio', 'leonardo.vio56@gmail.com', '$2y$10$YS3HJXqUXQ.8qEewIQyyb.JP/DOZaMoZnPiVmH/Mim6RjejWqMqRu', 1, 3),
(17, 'Diego', 'Nardo', 'diego.nardo@magia.org.uk', '$2y$10$i1d5mW63jHWv1onoHbHgt.U79l1.2PD9aRDB8QAqtv64vkyRZiEUS', 0, 3),
(18, 'Claudia', 'Dei Rossi', 'claudia@deirossi.it', '$2y$10$l/pWcTCXLwONAcK131t0IumSNGB3Z.8QzaGZ5BLeD5wxbJTcGqMI6', 1, 3),
(19, 'Marta', 'Terranova', 'marta.terranova@gmail.it', '$2y$10$hAVBeGIKd8IL5F18glsKheF2FgQJCrB5pv4tl3DCGJrl1jcvErtpO', 1, 3),
(20, 'Nicolò', 'Bighetto', 'nickbig@hello.yuppi', '$2y$10$KUeg25.heeCdkG781LIc6.3zOLfZ.uTpr0vx6Dh38KvcMbxjRetu.', 0, 3),
(21, 'Hadda', 'Hakim', 'vortrex@ciao.ciao', '$2y$10$uNvd5wcDWWmAYix03zFfvelhKtNWbqYKjYu.gyNI5t7FkdbXE0Pt.', 0, 3),
(31, 'Ludovico', 'Ariosto', 'ludovico@arrosto.haha', '$2y$10$/H7SZD1xOWaUZPqJ2nv2cu2S5R.TE9O1.z2L07jpL.CwCbqj16JoO', 0, 3),
(36, 'Topolino', 'Disney', 'topolino@ciao.it', '$2y$10$fbf1wAcPwzOEuxwvHY0F8uVniTpHUhf8UHlwnHg4AbT9PDgai/UvG', 1, 3),
(38, 'Minnie', 'Disney', 'minnie@disney.it', '$2y$10$yfgRtneAGTUIEhuJr2Sbg.hv65RJiThz8yuvhbs7FkK9mXGolAVJy', 0, 3),
(39, 'Rosa', 'Chemical', 'rosa@music.it', '$2y$10$jeyDq6PsAyzoeRMJ.bOZAemjdOzkqZu7LenyaPF/Uwnf/.VWmj14S', 1, 3),
(40, 'Matthew David', 'Gullidge', 'burntleeksandrawbeets@gmail.com', '$2y$10$n529dtGZ78.sa9Ns/5bEk.Pj7SkaSZtkYTinE7D3LxyfmF/8TekMC', 1, 1),
(41, 'Sfera', 'Ebbasta', 'sfera.ebbasta@bhmg.it', '$2y$10$ITPtwtXfARzLnnm1JN2ibO3IrfFkhTsu8.dbOXi5LsSYVYdvct9Ja', 1, 3),
(44, 'Bianca', 'Zennaro', 'bianca@famosa.it', '$2y$10$s1PxNjODE5udfLqoid064excuCBftiCL3H6A9gkO3JFcX5DODCXu6', 0, 3),
(46, 'Claudia', 'Dei Roxxxy', 'claudiadeirossi@iam.com', '$2y$10$zMxgLlSvuvHA40eYBTDJgexi/37.5evkcx.TAUV/IWr1MgthGKBHS', 0, 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indici per le tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`IdImage`);

--
-- Indici per le tabelle `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IdIngredient`),
  ADD KEY `IdMeasureUnit` (`IdMeasureUnit`),
  ADD KEY `FK_alernative` (`IdAlternative`);

--
-- Indici per le tabelle `measureunits`
--
ALTER TABLE `measureunits`
  ADD PRIMARY KEY (`IdMeasureUnit`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`IdProduct`),
  ADD KEY `IdImage` (`IdImage`);

--
-- Indici per le tabelle `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`IdRecipe`);

--
-- Indici per le tabelle `recipesimages`
--
ALTER TABLE `recipesimages`
  ADD PRIMARY KEY (`IdRecipeImage`),
  ADD KEY `IdRecipe` (`IdRecipe`),
  ADD KEY `IdImage` (`IdImage`);

--
-- Indici per le tabelle `recipesingredients`
--
ALTER TABLE `recipesingredients`
  ADD KEY `ingredient_fk_1` (`IdIngredient`),
  ADD KEY `IdRecipe` (`IdRecipe`);

--
-- Indici per le tabelle `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`IdReview`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdRecipe` (`IdRecipe`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD KEY `Category` (`Category`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `images`
--
ALTER TABLE `images`
  MODIFY `IdImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IdIngredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT per la tabella `measureunits`
--
ALTER TABLE `measureunits`
  MODIFY `IdMeasureUnit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `recipes`
--
ALTER TABLE `recipes`
  MODIFY `IdRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `recipesimages`
--
ALTER TABLE `recipesimages`
  MODIFY `IdRecipeImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `recipesingredients`
--
ALTER TABLE `recipesingredients`
  MODIFY `IdRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `reviews`
--
ALTER TABLE `reviews`
  MODIFY `IdReview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`IdMeasureUnit`) REFERENCES `measureunits` (`IdMeasureUnit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredients_ibfk_2` FOREIGN KEY (`IdAlternative`) REFERENCES `ingredients` (`IdIngredient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`IdImage`) REFERENCES `images` (`IdImage`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recipesimages`
--
ALTER TABLE `recipesimages`
  ADD CONSTRAINT `recipesimages_ibfk_1` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipesimages_ibfk_2` FOREIGN KEY (`IdImage`) REFERENCES `images` (`IdImage`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recipesingredients`
--
ALTER TABLE `recipesingredients`
  ADD CONSTRAINT `ingredient_fk_1` FOREIGN KEY (`IdIngredient`) REFERENCES `ingredients` (`IdIngredient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipesingredients_ibfk_1` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `categories` (`IdCategory`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
