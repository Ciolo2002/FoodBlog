-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 02, 2021 alle 18:17
-- Versione del server: 10.4.18-MariaDB
-- Versione PHP: 8.0.3

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
(3, 'Images/CUTBreadRolls.jpg'),
(4, 'Images/BreadRolls.jpg'),
(6, 'Images/CUTTortillas.jpg'),
(7, 'Images/Tortillas.jpg'),
(8, 'Images/CUTToast2.jpg'),
(9, 'Images/Toast2.jpg'),
(10, 'Images/CUTEnglish.jpg'),
(11, 'Images/English.jpg'),
(12, 'Images/ProperPasta.png'),
(13, 'Images/EasyAsBread.png');

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
(4, 'Water', 1, NULL),
(5, ' Egg Beaten', 1, NULL),
(6, 'Table Salt', 1, NULL),
(7, 'Fresh Yeast', 1, 8),
(8, 'Dry Yeast', 1, 7),
(9, 'Granulated Sugar', 1, NULL),
(10, 'Melted Butter', 1, NULL),
(11, 'Greek Yoghurt', 1, NULL),
(12, 'Unsalted Butter Cold', 1, NULL),
(13, 'Baking Powder', 1, NULL),
(14, 'Whole Milk Cold', 1, NULL);

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
(1, 'Easy As Bread', 'https://www.amazon.it/kindle-store-ebooks/b?ie=UTF8&node=818937031', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae tempus mi, vitae rhoncus ligula. Pellentesque vitae turpis eu nisl tincidunt aliquet id non tortor. Vivamus et eleifend sapien. Curabitur congue efficitur euismod. Nam mollis, nisl vel posuere aliquam, justo enim congue libero, ut dignissim turpis arcu vitae nunc. Phasellus.', 13),
(2, 'Proper Pasta', 'https://www.amazon.it/kindle-store-ebooks/b?ie=UTF8&node=818937031', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae tempus mi, vitae rhoncus ligula. Pellentesque vitae turpis eu nisl tincidunt aliquet id non tortor. Vivamus et eleifend sapien. Curabitur congue efficitur euismod. Nam mollis, nisl vel posuere aliquam, justo enim congue libero, ut dignissim turpis arcu vitae nunc. Phasellus.', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `recipes`
--

CREATE TABLE `recipes` (
  `IdRecipe` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Preparation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recipes`
--

INSERT INTO `recipes` (`IdRecipe`, `Title`, `Preparation`) VALUES
(1, 'BREAD ROLLS ; recipe for 10 rolls', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR  TOTAL | SERVES 4-8 ;\r\n01 Dissolve the yeast and sugar in the water and leave to stand until active and foaming. This should take about 10 minutes. ;\r\n02 Combine the flour and salt in a large bowl and add the yeast mixture and the beaten egg and begin to bring to a dough. Ensure everything is combined and there is no flour left in the bowl. ;\r\n03 Tip out the dough and begin to knead on an unfloured work surface for 10-12 minutes until the dough is smooth and springs back when being gently poked ;\r\n04 Put the dough into a large bowl, cover with cling film and leave to proof until double in size. About 1 – 2 hours depending on the environment. ;\r\n05 Once the dough has been sufficiently proofed knock the air out of it my gently pushing your hand into the centre and divide into 80g pieces. ;\r\n06 Roll the pieces into little balls using the surface tension method and place them on a lined baking tray with enough space to proof once more. Cover with a wet cloth to prevent dehydration. ;\r\n07 Preheat the oven to 180°C or 350f. ;\r\n08 Allow them to double in size once more (about 30 minutes) and carefully brush them half of the melted butter ensuring not to knock out the air. ;\r\n09 Bake them at 180°C for 10-15 minutes or until golden brown. ;\r\n10 Brush them with the remaining butter and allow them cool completely before use.'),
(2, 'FLOUR TORTILLAS ; recipe for 8 tortillas', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR TOTAL | SERVES 4-8 ;\r\n01 Combine the flour, salt, and baking powder in a large bowl. ;\r\n02 Cut the cold butter into small pieces and rub it into the flour mix using your fingertips until you have a fine breadcrumb texture. ;\r\n03 Add the yoghurt and gently kneed until combined. Cover loosely with cling film and rest the dough for 10 minutes. ;\r\n04 Once the dough has rested, roll it into a sausage shape and equally divide the dough into 8 portions, shape them into balls and rest them for a further 10 minutes. ;\r\n05 Using a floured rolling pin, roll each portion out to 10 inches in diameter on a lightly floured work surface. ;\r\n06 Cook one at a time in a large dry non-stick frying pan over a medium to low heat turning over only once during cooking. ;\r\n07 Allow the finished Tortillas to cool completely and soften before use.'),
(3, 'BREAKFAST TOAST ; recipe for 1 loaf', '30 MINUTE PREP |15 MINUTE COOKING | 15 MINUTE REST | 1 HOUR TOTAL | SERVES 4-8 ;\r\n01 Combine the sugar yeast and water and leave to stand to until the yeast is foaming. ;\r\n02 Add the flour, salt, and whole milk together and mix it too a loose dough. If the dough is wet, let it stand for 5 minutes, dust with a little flour and start kneading. ;\r\n03 Knead for 10-15 minutes until the dough is smooth and springy. After a couple of minutes kneading you will start to notice a significant difference in the consistency. ;\r\n04 Once sufficiently kneading, place the dough in a large bowl and cover with a damp cloth. Allow the dough to double in size (about 1 hour). ;\r\n05 Lightly oil and flour an appropriately sized loaf tin and preheat your oven to 180°C. ;\r\n06 Once the dough has doubled in size, knock the air out and flatten the dough. Roll the dough over itself to create a sausage shape and place it in the loaf tin. Ensure to push the dough into the corners of the tin. ;\r\n07 Cover it with a damp cloth and allow the dough to double in volume once more; 08. Bake at 180°C for 20-25 minutes or until golden brown. (12-15 minutes for smaller loaves). If you are unsure you can check the core temperature using a probe thermometer. Be sure the breach reaches a minimum of 86°C.');

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
(1, 1, 3),
(2, 1, 4),
(4, 2, 6),
(5, 2, 7),
(6, 3, 8),
(7, 3, 9);

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
(2, 2, 220),
(2, 1, 220),
(2, 11, 150),
(2, 6, 5),
(2, 13, 5),
(2, 12, 65),
(3, 1, 500),
(3, 2, 500),
(3, 3, 150),
(3, 14, 150),
(3, 7, 21),
(3, 8, 7),
(3, 9, 40),
(3, 6, 10);

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
(1, 4, 'It\'s so tasy!', 3, 1),
(2, 2, 'I don\'t really like it.', 1, 2),
(4, 4, 'Yummy!!!', 5, 2),
(18, 5, 'I love them', 13, 1),
(20, 4, 'So easy to prepare :)', 2, 2),
(58, 2, 'This recipe sucks', 1, 1),
(59, 3, 'I recommend that you eat them when you are grilling with hamburgers', 3, 1),
(60, 4, 'Thanks, I will make them every day for my children', 1, 3),
(61, 1, 'When I put Nutella on my toasts they break', 8, 3),
(62, 5, 'With apricot jam this is my absolute favorite snack', 6, 3),
(63, 5, 'They are exactly the same as the ones I ate in Mexico.  ', 6, 2),
(65, 4, 'They\'re so delicious ', 5, 3),
(70, 2, 'I need this recipe in the gluten free version', 20, 2),
(87, 5, 'These toasts are tasty', 15, 3),
(95, 3, ' I tried making these toasts yesterday but my skills are not that developed, I\'ll try again next week', 20, 3);

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
(3, 'Michael', 'Sarto', 'michael.sarto@ptpvenezia.edu.it', '$2y$10$UEGXAh3/0XehkjZyizPrbuHQcfVCLkDKomDYuWVnjCj2qq.iNfaiS', 1, 2),
(5, 'Anna', 'Contiero', 'anna.contiero1970@gmail.com', '$2y$10$dMiqSbXPGbRVui.paQos/ef2SA7KgBI4sy/2xqcgvX1h2sxOrdx8K', 1, 3),
(6, 'Paolo', 'Bonolis', 'paolo.bonolis@live.com', '$2y$10$JdPymdsxzNN4/3wC9suBa.0xJG5Q0xAkPzny3gHNZwAyFccEFU73m', 1, 3),
(7, 'Luca', 'Laurentis', 'luca.laurentis@gmail.it', '$2y$10$zxo7k1aWjJrby5oH/9h0zeMACik6LRX8Bjh/RcDXwYnmkRAjsH8T6', 0, 3),
(8, 'Csaba', 'Zorba', 'csaba.zorza@gmail.it', '$2y$10$qCz6/EDMZhaLfNh6SuxaQeuNQ5UfNLb4LS2IUjSpGojw3OE3GIePi', 1, 3),
(9, 'Antonella', 'Kinder', 'antonella@kinder.it', '$2y$10$3fl/6xxIlgxbl4t06U7Hn.B5PcrFvMEoxYtAyBHGQN3.On3TWiqhy', 1, 3),
(10, 'Michele', 'Sarto', 'sarto@tiscali.it', '$2y$10$Tx4WeaPqPrvuhmFESs9nduCKVMKXRQmJiaRjRdxpUCXd/1JCMUpvO', 1, 3),
(11, 'Lorella', 'Cuccarini', 'lorella@moltobella.co.uk', '$2y$10$6pHF4lGkp3kuj0h6UyxCBuZl/I2SFOksK4oA6cYFdjFZdbz6i49fm', 0, 3),
(12, 'Grace', 'Gullidge', 'ciao@ciao.it', '$2y$10$nAno1NOCGtHqBJvkSCxLIejtFbhQAyCFsBFucazSk9OsdpJvEguQ2', 0, 3),
(13, 'Nicola', 'Panizzolo', 'nicola.panizollo@ptpvenezia.edu.it', '$2y$10$58P.iDm908KPmJ2DgZ8zuuaxx1bpHVAHPuRemSA3Q7ddYC37wbfL6', 1, 3),
(15, 'Ethan', 'Franceschin', 'ethan.franceschin@ptpvenezia.edu.it', '$2y$10$v/IshXfaAnKzLemWzzmhHuThx6CWKbgo.24NyYCel9UOQ9MXCpfLG', 1, 3),
(16, 'Leonardo', 'Vio', 'leonardo.vio56@gmail.com', '$2y$10$YS3HJXqUXQ.8qEewIQyyb.JP/DOZaMoZnPiVmH/Mim6RjejWqMqRu', 1, 3),
(17, 'Diego', 'Nardo', 'diego.nardo@magia.org.uk', '$2y$10$i1d5mW63jHWv1onoHbHgt.U79l1.2PD9aRDB8QAqtv64vkyRZiEUS', 0, 3),
(18, 'Claudia', 'Dei Rossi', 'claudia@deirossi.it', '$2y$10$l/pWcTCXLwONAcK131t0IumSNGB3Z.8QzaGZ5BLeD5wxbJTcGqMI6', 1, 3),
(19, 'Marta', 'Terranova', 'marta.evvia@gmail.it', '$2y$10$hAVBeGIKd8IL5F18glsKheF2FgQJCrB5pv4tl3DCGJrl1jcvErtpO', 1, 3),
(20, 'Nicolò', 'Bighetto', 'nickbig@hello.yuppi', '$2y$10$KUeg25.heeCdkG781LIc6.3zOLfZ.uTpr0vx6Dh38KvcMbxjRetu.', 0, 3),
(21, 'Hadda', 'Hakim', 'vortrex@ciao.ciao', '$2y$10$uNvd5wcDWWmAYix03zFfvelhKtNWbqYKjYu.gyNI5t7FkdbXE0Pt.', 0, 3),
(31, 'Ludovico', 'Ariosto', 'ludovico@arrosto.haha', '$2y$10$/H7SZD1xOWaUZPqJ2nv2cu2S5R.TE9O1.z2L07jpL.CwCbqj16JoO', 0, 3),
(33, 'Goku', 'Terzo Livello', 'goku@gmail.it', '$2y$10$tlRSkwIzlC5lMhFSgQcOTugYm2KAzyIEmgHhQnVGMbW4h.YpNvkBi', 0, 3),
(35, 'Gerry', 'Scotty', 'gerry@striscialanotizia.it', '$2y$10$DINquVgz6qMQiTzBDbM2j.OcSwUqHN0nlaQpta6vmOLZbT9IoUCOm', 0, 3),
(36, 'Topolino', 'Disney', 'topolino@ciao.boh', '$2y$10$fbf1wAcPwzOEuxwvHY0F8uVniTpHUhf8UHlwnHg4AbT9PDgai/UvG', 0, 3),
(38, 'Minnie', 'Disney', 'minnie@disney.it', '$2y$10$yfgRtneAGTUIEhuJr2Sbg.hv65RJiThz8yuvhbs7FkK9mXGolAVJy', 0, 3),
(39, 'Rosa', 'Chemical', 'rosa@music.it', '$2y$10$jeyDq6PsAyzoeRMJ.bOZAemjdOzkqZu7LenyaPF/Uwnf/.VWmj14S', 1, 3),
(40, 'Matthew David', 'Gullidge', 'burntleeksandrawbeets@gmail.com', '$2y$10$n529dtGZ78.sa9Ns/5bEk.Pj7SkaSZtkYTinE7D3LxyfmF/8TekMC', 1, 1);

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
  ADD KEY `IdRecipe` (`IdRecipe`),
  ADD KEY `IdIngredient` (`IdIngredient`);

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
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `images`
--
ALTER TABLE `images`
  MODIFY `IdImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IdIngredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `measureunits`
--
ALTER TABLE `measureunits`
  MODIFY `IdMeasureUnit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `recipes`
--
ALTER TABLE `recipes`
  MODIFY `IdRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `recipesimages`
--
ALTER TABLE `recipesimages`
  MODIFY `IdRecipeImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `reviews`
--
ALTER TABLE `reviews`
  MODIFY `IdReview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FK_alernative` FOREIGN KEY (`IdAlternative`) REFERENCES `ingredients` (`IdIngredient`),
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`IdMeasureUnit`) REFERENCES `measureunits` (`IdMeasureUnit`);

--
-- Limiti per la tabella `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`IdImage`) REFERENCES `images` (`IdImage`);

--
-- Limiti per la tabella `recipesimages`
--
ALTER TABLE `recipesimages`
  ADD CONSTRAINT `recipesimages_ibfk_1` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`),
  ADD CONSTRAINT `recipesimages_ibfk_2` FOREIGN KEY (`IdImage`) REFERENCES `images` (`IdImage`),
  ADD CONSTRAINT `removeRecipeImage` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE,
  ADD CONSTRAINT `removeRecipeImg` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE;

--
-- Limiti per la tabella `recipesingredients`
--
ALTER TABLE `recipesingredients`
  ADD CONSTRAINT `recipesingredients_ibfk_1` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`),
  ADD CONSTRAINT `recipesingredients_ibfk_2` FOREIGN KEY (`IdIngredient`) REFERENCES `ingredients` (`IdIngredient`),
  ADD CONSTRAINT `removeRecipe` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`) ON DELETE CASCADE;

--
-- Limiti per la tabella `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `dropUser` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`IdRecipe`) REFERENCES `recipes` (`IdRecipe`);

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `categories` (`IdCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
