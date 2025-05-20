-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 20, 2025 alle 21:59
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ripetizioni`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
  `ID` int(11) NOT NULL,
  `classe` int(1) NOT NULL,
  `sezione` char(1) NOT NULL,
  `indirizzo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `classe`
--

INSERT INTO `classe` (`ID`, `classe`, `sezione`, `indirizzo`) VALUES
(18, 5, 'C', 'I'),
(19, 5, 'A', 'I'),
(20, 4, 'N', 'EN'),
(21, 3, 'A', 'SA'),
(22, 3, 'A', 'EN'),
(23, 2, 'N', 'SA'),
(24, 3, 'C', 'EN'),
(25, 2, 'N', 'EN'),
(26, 4, 'B', 'I');

-- --------------------------------------------------------

--
-- Struttura della tabella `materia`
--

CREATE TABLE `materia` (
  `ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materia`
--

INSERT INTO `materia` (`ID`, `nome`) VALUES
(1, 'Italiano'),
(2, 'Informatica'),
(3, 'Storia'),
(4, 'Tepsit');

-- --------------------------------------------------------

--
-- Struttura della tabella `ripetizioni`
--

CREATE TABLE `ripetizioni` (
  `ID` int(6) NOT NULL,
  `orario` varchar(5) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_studente` int(11) NOT NULL,
  `id_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ripetizioni`
--

INSERT INTO `ripetizioni` (`ID`, `orario`, `id_materia`, `id_studente`, `id_tutor`) VALUES
(3, 'defin', 2, 26, 14),
(8, 'defin', 2, 27, 14),
(9, 'defin', 2, 26, 28),
(10, 'defin', 3, 27, 29),
(11, 'defin', 4, 27, 14);

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE `studenti` (
  `nome` varchar(60) NOT NULL,
  `cognome` varchar(60) NOT NULL,
  `tutor` tinyint(4) NOT NULL DEFAULT 0,
  `id_studente` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `CF` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`nome`, `cognome`, `tutor`, `id_studente`, `id_classe`, `id_materia`, `CF`) VALUES
('Gabriele', 'Parrini', 1, 14, 18, 4, 'PRRGRL06R22G843H'),
('Gianni', 'Caroti', 0, 26, 18, NULL, 'CRTGNN06L31G843V'),
('Daniele', 'Parrini', 0, 27, 23, NULL, 'PRRDNL01A22G843E'),
('Luca', 'Modric', 1, 28, 24, 2, 'MDRLCA01A22G843A'),
('Luca', 'Parrini', 1, 29, 26, 3, 'PRRLCL25R06B843H');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `ripetizioni`
--
ALTER TABLE `ripetizioni`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_materia` (`id_materia`,`id_studente`,`id_tutor`),
  ADD KEY `id_studente` (`id_studente`),
  ADD KEY `id_tutor` (`id_tutor`);

--
-- Indici per le tabelle `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id_studente`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_materia` (`id_materia`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `classe`
--
ALTER TABLE `classe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `materia`
--
ALTER TABLE `materia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ripetizioni`
--
ALTER TABLE `ripetizioni`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id_studente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ripetizioni`
--
ALTER TABLE `ripetizioni`
  ADD CONSTRAINT `ripetizioni_ibfk_1` FOREIGN KEY (`id_studente`) REFERENCES `studenti` (`id_studente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ripetizioni_ibfk_2` FOREIGN KEY (`id_tutor`) REFERENCES `studenti` (`id_studente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ripetizioni_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studenti_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
