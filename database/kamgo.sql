SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `kamgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `emplacement`
--

CREATE TABLE `emplacement` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emplacement`
--

INSERT INTO `emplacement` (`id`, `nom`, `distance`, `disponible`) VALUES
(3, 'Poste', '3', 1),
(5, 'Melen', '11', 1),
(6, 'Mendong', '15', 1),
(7, 'Damas', '8', 1),
(8, 'Messassi', '12', 1),
(9, 'Emana', '10', 1),
(10, 'Awae', '16', 1),
(11, 'Etoudi', '9', 1),
(13, 'Nkoabang', '14', 0),
(16, 'Ekounou', '7', 1),
(18, 'Ngousso', '7', 0),
(19, 'Ekounou', '7', 1),
(21, 'Essos', '5', 1),
(23, 'Mimboman', '7', 1),
(24, 'Bastos', '10', 1)
;

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `date_trajet` varchar(20) NOT NULL,
  `point_embarquement` varchar(50) NOT NULL,
  `point_arret` varchar(50) NOT NULL,
  `type_taxi` varchar(20) NOT NULL,
  `distance_totale` varchar(50) NOT NULL,
  `bagage` varchar(50) NOT NULL,
  `prix_total` varchar(50) NOT NULL,
  `statut` int(1) NOT NULL,
  `id_utilisateur_client` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `date_trajet`, `point_embarquement`, `point_arret`, `type_taxi`, `distance_totale`, `bagage`, `prix_total`, `statut`, `id_utilisateur_client`) VALUES
(63, '2024-12-04 11:35', 'Melen', 'Damas', 'Taxi classique', '7', '14', '1500', 2, 10),
(65, '2024-12-04 08:28', 'Awae', 'Messassi', 'Taxi classique', '17', '34', '2500', 1, 9),
(66, '2024-12-04 06:29', 'Damas', 'Poste', 'Taxi classique', '10', '18', '1500', 1, 9),
(67, '2024-12-04 11:29', 'Ngousso', 'Bastos', 'Taxi VIP', '12', '15', '3500', 1, 9),
(68, '2024-12-04 15:34', 'Bastos', 'Damas', 'Taxi classique', '24', '34', '2500', 1, 10),
(69, '2024-12-04 13:35', 'Etoudi', 'Ekounou', 'Taxi classique', '23', '44', '2000', 0, 10),
(70, '2024-12-04 10:35', 'Nkoabang', 'Essos', 'Taxi VIP', '21', '11', '3000', 1, 10),
(71, '2024-12-04 12:35', 'Messassi', 'Damas', 'Taxi VIP', '35', '27', '3500', 1, 10),
(79, '2024-12-04 06:46', 'Mendong', 'Mimboman', 'Motos taxi', '22', '0', '1500', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `date_inscription` varchar(20) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `bloquer` tinyint(1) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `administrateur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `email`, `nom_client`, `date_inscription`, `numero`, `bloquer`, `mot_de_passe`, `administrateur`) VALUES
(8, 'admin@admin.com', 'admin', '2024-04-25 03:48', '695787191', 1, '5cbcf07e36fe37142b407ace0211cbf7', 1),
(9, 'localhost@localhost.com', 'Localhost', '2024-05-02 06:03', '695585806', 1, '827ccb0eea8a706c4c34a16891f84e7b', 0),
(36, 'mohamadou055@gmail.com', 'laminou', '2024-04-29 06:42', '695787191', 0, '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emplacement`
--
ALTER TABLE `emplacement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `id` (`id_utlisateur_client`);

--
-- Indexes for table `user`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emplacement`
--
ALTER TABLE `emplacement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ride`
--
ALTER TABLE `ride`
  ADD CONSTRAINT `id` FOREIGN KEY (`customer_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;