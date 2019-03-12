-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2016 at 12:30 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1476291`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attribute_id` int(11) UNSIGNED NOT NULL,
  `attribute_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_name`) VALUES
(1, 'Dark'),
(2, 'Light'),
(3, 'Wind'),
(4, 'Water'),
(5, 'Earth'),
(6, 'Fire'),
(7, 'Divine');

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE `card_type` (
  `card_type_id` int(11) UNSIGNED NOT NULL,
  `card_type_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`card_type_id`, `card_type_name`) VALUES
(1, 'Normal'),
(2, 'Effect'),
(3, 'Ritual'),
(4, 'Fusion'),
(5, 'Synchro'),
(6, 'Xyz'),
(7, 'Toon'),
(8, 'Spirit'),
(9, 'Union'),
(10, 'Gemini'),
(11, 'Tuner'),
(12, 'Flip'),
(13, 'Pendulum');

-- --------------------------------------------------------

--
-- Table structure for table `monster`
--

CREATE TABLE `monster` (
  `monster_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` smallint(2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `attack` smallint(6) NOT NULL,
  `defence` smallint(6) NOT NULL,
  `card_text` text NOT NULL,
  `fk_attribute_id` int(11) UNSIGNED NOT NULL,
  `fk_monster_type_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monster`
--

INSERT INTO `monster` (`monster_id`, `name`, `level`, `image`, `attack`, `defence`, `card_text`, `fk_attribute_id`, `fk_monster_type_id`) VALUES
(1, 'Ancient Lamp', 3, 'AncientLamp.png', 900, 1400, 'During your Main Phase: You can Special Summon "La Jinn the Mystical Genie of the Lamp" from your hand. This card must be face-up on the field to activate and to resolve this effect. Before damage calculation, if this card is being attacked by an opponent''s monster, and was face-down at the start of the Damage Step: You can target 1 monster your opponent controls, except the attacking monster; the attacking monster attacks it instead, and you proceed to damage calculation.', 3, 1),
(2, 'Nekroz of Catastor', 5, 'NekrozofCatastor.png', 2200, 1200, 'You can Ritual Summon this card with any "Nekroz" Ritual Spell Card. Must be Ritual Summoned without using "Nekroz of Catastor", and cannot be Special Summoned by other ways. You can discard this card, then target 1 "Nekroz" monster in your Graveyard; Special Summon it. You can only use this effect of "Nekroz of Catastor" once per turn. At the start of the Damage Step, if a "Nekroz" monster you control battles an opponent''s face-up monster that was Special Summoned from the Extra Deck: Destroy that monster.', 4, 3),
(3, 'Dark Doriado', 5, 'DarkDoriado.png', 1800, 1400, 'If this card is Normal or Special Summoned: You can choose 4 monsters from your Deck (1 EARTH, 1 WATER, 1 FIRE, and 1 WIND), then place them on the top of the Deck in any order.', 1, 1),
(4, 'Zefraniu, Secret of the Yang Zing', 6, 'ZefraniuSecretoftheYangZing.png', 0, 2600, 'When this card is Pendulum Summoned, or when this card is destroyed by battle or card effect while in your Monster Zone: You can add 1 ''Yang Zing'' or ''Zefra'' Spell/Trap Card from your Deck to your hand. You can only use this effect of ''Zefraniu, Secret of the Yang Zing'' once per turn.', 5, 23),
(5, 'Blue-Eyes White Dragon', 8, 'BlueEyesWhiteDragon.png', 3000, 2500, 'This legendary dragon is a powerful engine of destruction. Virtually invincible, very few have faced this awesome creature and lived to tell the tale.', 2, 3),
(7, 'Fox Fire', 2, 'FoxFire.png', 300, 200, 'During the End Phase, if this card was destroyed by battle and sent to the Graveyard this turn and was face-up at the start of the Damage Step: Special Summon this card from the Graveyard. This face-up card cannot be Tributed for a Tribute Summon.', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `monster_junction_card_type`
--

CREATE TABLE `monster_junction_card_type` (
  `monster_id` int(10) UNSIGNED NOT NULL,
  `card_type_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monster_junction_card_type`
--

INSERT INTO `monster_junction_card_type` (`monster_id`, `card_type_id`) VALUES
(1, 2),
(2, 2),
(2, 3),
(3, 2),
(3, 13),
(4, 2),
(4, 13),
(5, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `monster_type`
--

CREATE TABLE `monster_type` (
  `monster_type_id` int(11) UNSIGNED NOT NULL,
  `monster_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monster_type`
--

INSERT INTO `monster_type` (`monster_type_id`, `monster_type_name`) VALUES
(1, 'Spellcaster'),
(2, 'Pyro'),
(3, 'Dragon'),
(4, 'Zombie'),
(5, 'Warrior'),
(6, 'Beast-Warrior'),
(7, 'Beast'),
(8, 'Winged Beast'),
(9, 'Fiend'),
(10, 'Fairy'),
(11, 'Insect'),
(12, 'Dinosaur'),
(13, 'Reptile'),
(14, 'Fish'),
(15, 'Sea Serpent'),
(16, 'Aqua'),
(17, 'Thunder'),
(18, 'Rock'),
(19, 'Plant'),
(20, 'Machine'),
(21, 'Psychic'),
(22, 'Divine-Beast'),
(23, 'Wyrm');

-- --------------------------------------------------------

--
-- Table structure for table `pendulum`
--

CREATE TABLE `pendulum` (
  `pendulum_id` int(11) UNSIGNED NOT NULL,
  `pendulum_scale` smallint(2) NOT NULL,
  `pendulum_effect` varchar(200) NOT NULL,
  `fk_monster_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendulum`
--

INSERT INTO `pendulum` (`pendulum_id`, `pendulum_scale`, `pendulum_effect`, `fk_monster_id`) VALUES
(1, 5, 'All EARTH, WATER, FIRE, and WIND monsters you control gain 200 ATK and DEF for every different Attribute among the monsters you control.', 3),
(2, 7, 'You cannot Pendulum Summon monsters, except ''Yang Zing'' and ''Zefra'' monsters. This effect cannot be negated.', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `card_type`
--
ALTER TABLE `card_type`
  ADD PRIMARY KEY (`card_type_id`);

--
-- Indexes for table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`monster_id`),
  ADD KEY `fk_attribute_id` (`fk_attribute_id`),
  ADD KEY `fk_monster_type_id` (`fk_monster_type_id`);

--
-- Indexes for table `monster_junction_card_type`
--
ALTER TABLE `monster_junction_card_type`
  ADD PRIMARY KEY (`monster_id`,`card_type_id`),
  ADD KEY `fk_card_type` (`card_type_id`);

--
-- Indexes for table `monster_type`
--
ALTER TABLE `monster_type`
  ADD PRIMARY KEY (`monster_type_id`);

--
-- Indexes for table `pendulum`
--
ALTER TABLE `pendulum`
  ADD PRIMARY KEY (`pendulum_id`),
  ADD KEY `fk_monster_id` (`fk_monster_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attribute_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `card_type`
--
ALTER TABLE `card_type`
  MODIFY `card_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `monster`
--
ALTER TABLE `monster`
  MODIFY `monster_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `monster_type`
--
ALTER TABLE `monster_type`
  MODIFY `monster_type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pendulum`
--
ALTER TABLE `pendulum`
  MODIFY `pendulum_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `monster`
--
ALTER TABLE `monster`
  ADD CONSTRAINT `monster_ibfk_1` FOREIGN KEY (`fk_attribute_id`) REFERENCES `attribute` (`attribute_id`),
  ADD CONSTRAINT `monster_ibfk_2` FOREIGN KEY (`fk_monster_type_id`) REFERENCES `monster_type` (`monster_type_id`);

--
-- Constraints for table `monster_junction_card_type`
--
ALTER TABLE `monster_junction_card_type`
  ADD CONSTRAINT `fk_card_type` FOREIGN KEY (`card_type_id`) REFERENCES `card_type` (`card_type_id`),
  ADD CONSTRAINT `fk_monster` FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

--
-- Constraints for table `pendulum`
--
ALTER TABLE `pendulum`
  ADD CONSTRAINT `pendulum_ibfk_1` FOREIGN KEY (`fk_monster_id`) REFERENCES `monster` (`monster_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
