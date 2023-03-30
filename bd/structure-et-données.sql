-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 04:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leila`
--
CREATE DATABASE IF NOT EXISTS `leila` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `leila`;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` tinyint(4) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `rang` tinyint(4) DEFAULT NULL,
  `id_parent` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `rang`, `id_parent`) VALUES
(0, '--no-parent', NULL, NULL),
(1, 'Menu', 1, 0),
(2, 'Carte des vins', 2, 0),
(3, 'Entrées', 1, 1),
(4, 'Poissons', 2, 1),
(5, 'Viandes', 3, 1),
(6, 'Fromages du Québec', 4, 1),
(7, 'Desserts', 5, 1),
(8, 'Vins effervescents', 1, 2),
(9, 'Vins blancs', 2, 2),
(10, 'Vins rouges', 3, 2),
(42, 'Brunch', NULL, 0),
(44, 'Cocktails et apéros', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plat`
--

CREATE TABLE `plat` (
  `id` smallint(6) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `portion` tinyint(4) NOT NULL DEFAULT 1,
  `prix` decimal(5,2) NOT NULL,
  `id_categorie` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plat`
--

INSERT INTO `plat` (`id`, `nom`, `detail`, `portion`, `prix`, `id_categorie`) VALUES
(1, 'Escargots à la crème d\'ail', '', 1, '31.00', 3),
(2, 'Foie gras de canard poêlé aux coings', 'gâteau et infusion de coing à la verveine', 2, '34.00', 3),
(3, 'Jardin de champignons d\'automne', 'crème de cèpes, émulsion au thé noir', 1, '33.00', 3),
(4, 'Sandre à la peau croustillante', 'fondue d\'échalotes, sauce au vin rouge', 1, '42.00', 4),
(5, 'Saint-pierre rôti aux olives taggiasche', 'mousseline d\'artichaut, fumet de poisson au citron kalamansi', 1, '49.00', 4),
(6, 'Bar cuit à la vapeur et criste marine', 'déclinaison de riz et coquillages, jus au curcuma', 2, '58.00', 4),
(7, 'Côte de porcelet et poitrine de cochon du Cantal croustillant', 'légumes de saison et crémeux de céleri-rave', 1, '42.00', 5),
(8, 'Filet de canette rôti sur la peau, jus au porto infusé à l\'hibiscus', 'tartelette de figues et cuisse confite, petite chartreuse de figues', 1, '44.00', 5),
(9, 'Ris de veau doré au sautoir et cèpes', 'mousseline de cèpes, jus de veau à la cazette du Morvan', 1, '63.00', 5),
(10, 'Chariot de fromages affinés de nos régions', '', 1, '12.00', 6),
(11, 'Poire Louise Bonne pochée au citron doux', 'parfait glacé à la Nepeta, crumble de petit épeautre', 1, '13.00', 7),
(12, 'Fleur de cassis de Bourgogne', 'chiboust à la vanille et chocolat grand cru de Madagascar', 1, '13.00', 7),
(13, 'Tarte fine aux pommes de Bernard Loiseau', 'sorbet pomme verte', 1, '12.00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nom_complet` varchar(50) DEFAULT NULL,
  `courriel` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `dcc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirmation` char(28) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Les comptes doivent être activés par le super admin.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_complet`, `courriel`, `mdp`, `dcc`, `confirmation`, `actif`) VALUES
(1, 'Gaston Miron', 'test@test.com', '$2y$10$ADk924OM91PEE32g3N6UP.zvM9.DFvtMxiVuile7EohMMLuQ1i5kG', '2023-03-30 02:16:10', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vin`
--

CREATE TABLE `vin` (
  `id` smallint(6) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `provenance` varchar(100) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `id_categorie` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vin`
--

INSERT INTO `vin` (`id`, `nom`, `detail`, `provenance`, `prix`, `id_categorie`) VALUES
(1, 'Cidre Fermier Biologique', 'Des Bulles, Genre, Clos Saragnat', 'Québec', '38.00', 8),
(2, 'Cidre Mousseux', 'Récolte 2012, Michel Jodoin', 'Québec', '45.00', 8),
(3, 'Cava Brut', '1312, Mestres', 'Espagne', '50.00', 8),
(4, 'Savoie', 'Ayse Brut, Dominique Belluard', 'France', '72.00', 8),
(5, 'Champagne Brut Nature', '1er Cru Vertus, Blanc de Blancs, Pascal Doquet', 'France', '115.00', 8),
(6, 'Champagne Extra Brut', 'Fleury 2000', 'France', '150.00', 8),
(7, 'Champagne Extra Brut', 'Saignée de Sorbée, Vouette & Sorbée', 'France', '160.00', 8),
(8, 'Champagne Extra Brut, Les Béguines, La Closerie', '', 'France', '180.00', 8),
(9, 'Cavalier du Versant', 'Domaine Gélinas 2011', 'Québec', '42.00', 9),
(10, 'Mantinia, Moschofilero', 'Tselepos Classique 2013', 'Grèce', '46.00', 9),
(11, 'Côtes de Duras, Nadia', 'Nadia Lusseau 2013', 'France', '48.00', 9),
(12, 'Muscadet Sèvre et Maine', 'Vincent Caillé 2013', 'France', '50.00', 9),
(13, 'Saint-Foy Bordeaux Blanc', 'Château les Mangons 2012', 'France', '54.00', 9),
(14, 'Burgenland, Grüner Veltliner', 'Meinklang 2013', 'Autriche', '55.00', 9),
(15, 'Vin de France ( Bergerac, Sud-Ouest)', 'Les Abeilles de Collinettes, Lestignac 2012', 'France', '57.00', 9),
(16, 'Les Rosiers', 'Les Pervenches 2013', 'Québec', '62.00', 9),
(17, 'Vin de Table (Roussillon), Juste Ciel !', 'La Petite Baigneuse 2012', 'France', '62.00', 9),
(18, 'Vin de France (Beaujolais), Escapade', 'France Gonzalvez 2012', 'France', '63.00', 9),
(19, 'Badisher Landwein, Viviser', ' Ziereisen 2011', 'Allemagne', '65.00', 9),
(20, 'Südtirol-Alto Aldige', 'Chardonnay, Hartman Donà 2012', 'Italie', '67.00', 9),
(21, 'Nahe, WeisserBurgunder Troken Gäseritsch', 'Weingut Hahnmühle 2012', 'Allemagne', '70.00', 9),
(22, 'Priorat, Clos Martina 2011', 'Mas den Blei 2011', 'Espagne', '72.00', 9),
(23, 'Vino Bianco (Piémont)', 'Ezio Trinchero', 'Italie', '75.00', 9),
(24, 'Côtes du Jura, Naturé', 'Domaine Berthet Bondet 2012', 'France', '78.00', 9),
(25, 'Venezia Giulia, Ribolla Gialla', 'Paraschos 2009', 'Italie', '82.00', 9),
(26, 'Vin de Savoie, Le Feu', 'Dominique Belluard 2011', 'France', '86.00', 9),
(27, 'Somlo, Juhfark', 'Meinklang 2010', 'Hongrie', '87.00', 9),
(28, 'Anjou, Victoire', 'Nicolas Reau 2012', 'France', '89.00', 9),
(29, 'Vacqueyras, Minéral', 'Montirius 2011', 'France', '89.00', 9),
(30, 'Vin de France (Loire), Vino Bianco', 'Marie Thibault 2011', 'France', '92.00', 9),
(31, 'Saint-Véran, La Goutte du Charme', 'Domaine Combier 2011', 'France', '96.00', 9),
(32, 'Bourgogne, Le Petit Têtu', 'Jean-Marie Berrux 2012', 'France', '99.00', 9),
(33, 'Beaune 1er Cru Les Coucherias', 'J.Claude Rateau 2002', 'France', '102.00', 9),
(34, 'Sancerre, Monts Damnés', 'Gérard Boulay 2011', 'France', '110.00', 9),
(35, 'Côtes du Jura', 'Savagnin Les Chalasses Marnes Bleues 2011', 'France', '130.00', 9),
(36, 'Meursault', 'Jean Philippe Fichet 2011', 'France', '155.00', 9),
(37, 'Hermitage, Prisme', 'Julien Pilon 2012', 'France', '175.00', 9),
(38, 'Chablis 1er Cru Forêt', 'Domaine François Raveneau 2011', 'France', '180.00', 9),
(39, 'Côtes du Rhône Signargues', 'Domain de la Coudette 2012', 'France', '43.00', 10),
(40, 'Marcillac, Cuvée Laïris', 'Jean-Luc Matha 2010', 'France', '44.00', 10),
(41, 'Rioja', 'Vina Ilusion 2013', 'Espagne', '48.00', 10),
(42, 'Côtes du Rhône, Cuvée Tradition', 'Domaine les Hautes Cances 2011', 'France', '50.00', 10),
(43, 'Vin de France (Ardèche), Vin Nu', 'Les Deux Terres 2013', 'France', '50.00', 10),
(44, 'BO2 (Andalousie)', 'Barranco Oscuro', 'Espagne', '52.00', 10),
(45, 'Vin de France (Beaujolais), Raisins Gaulois', 'M. Lapierre 2013', 'France', '53.00', 10),
(46, 'Bourgueil, Avis de Vin Fort', 'Domaine Breton 2013', 'France', '57.00', 10),
(47, 'Saumur Champigny, Ruben', 'Domaine Bobinet 2013', 'France', '61.00', 10),
(48, 'Burgenland, Blaufränkish', 'Moric 2012', 'Autriche', '66.00', 10),
(49, 'Vino Rosso (Sicile), Palmento', 'Vino di Anna 2012', 'Italie', '68.00', 10),
(50, 'Sainte-Foy Bordeaux', 'Château les Mangons 2003', 'France', '70.00', 10),
(51, 'Régnié', 'G. Descombes 2011', 'France', '75.00', 10),
(52, 'Arbois Pupillin, La Chamade', 'Philippe Bornard 2010', 'France', '78.00', 10),
(53, 'Rheingau, Spätburguner Rotwein Trocken', 'Peter Jakob Kühn 2012', 'Allemagne', '80.00', 10),
(54, 'Monferrato Dolcetto, Le Taragne', 'Ezio Trinchero 2006', 'Italie', '82.00', 10),
(55, 'Campania Aglianico, Drogone', 'Cantina Giardino 2008', 'Italie', '85.00', 10),
(56, 'Rosso Veneto, Verdugo', 'Masiero Gianfranco 2010', 'Italie', '96.00', 10),
(57, 'Rioja, Vina Tondonia', 'R. Lopez de Heredia 2002', 'Espagne', '99.00', 10),
(58, 'Pic Saint-Loup (Languedoc), Fleuve Amour', 'Zélige-Caravent 2010', 'France', '105.00', 10),
(59, 'Auxey-Duresses', 'Alain Gras 2012', 'France', '108.00', 10),
(60, 'Macon, La Maison Romane', 'Château de Berzé 2011', 'France', '112.00', 10),
(61, 'Barolo', 'Josetta Saffirio 2009', 'Italie', '125.00', 10),
(62, 'Marsannay, Trois Terres', 'Domaine Jean Fournier 2011', 'France', '130.00', 10),
(63, 'Barbaresco (Piémont), Montestefano', 'Rivella Serafino 2009', 'Italie', '131.00', 10),
(64, 'Cornas, Chaillot', 'Thierry Allemand 2009', 'France', '175.00', 10),
(65, 'Nuits Saint Georges, Les Damodes', 'Domaine Ballorin 2010', 'France', '190.00', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`,`id_parent`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courriel` (`courriel`),
  ADD UNIQUE KEY `confirmation` (`confirmation`);

--
-- Indexes for table `vin`
--
ALTER TABLE `vin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `plat`
--
ALTER TABLE `plat`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vin`
--
ALTER TABLE `vin`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `plat`
--
ALTER TABLE `plat`
  ADD CONSTRAINT `plat_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `vin`
--
ALTER TABLE `vin`
  ADD CONSTRAINT `vin_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
