DROP DATABASE IF EXISTS Hamburgers;
CREATE DATABASE Hamburgers;
USE Hamburgers;
 

CREATE TABLE `Hamburger` (
  `ID` char(4) NOT NULL,
  `Nom` char(20) NOT NULL,
  `Calories` int(11) NOT NULL,
  `Genre` char(10) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE(`Nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Hamburger` (`ID`, `Nom`, `Calories`, `Genre`) VALUES
('H1', 'Bicky', 1000, 'Boeuf'),
('H2', 'Bicky Poulet', 800, 'Poulet'),
('H3', 'Bicky Kefta', 900, 'Boeuf'),
('H4', 'Bicky Poulet Cheese', 1100, 'Poulet'),
('H5', 'Mega Burger', 1500, 'Boeuf'),
('H6', 'Giga Burger', 2000, 'Boeuf');

CREATE TABLE `Personne` (
  `ID` char(4) NOT NULL,
  `Nom` char(20) NOT NULL,
  `Age` int(11) NOT NULL,
  `Poids` int(11) NOT NULL,
  `Sexe` char(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `Personne` (`ID`, `Nom`, `Age`, `Poids`, `Sexe`) VALUES
('P1', 'Claude', 30, 65, 'M'),
('P2', 'Michelle', 35, 60, 'F'),
('P3', 'Tony', 33, 120, 'M'),
('P4', 'Lisa', 25, 50, 'F'),
('P5', 'Marc', 60, 85, 'M');

CREATE TABLE `Mange` (
  `ID_P` char(4) NOT NULL,
  `ID_H` char(4) NOT NULL,
  `Date_Consommation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Note` int(11) NOT NULL,
  PRIMARY KEY (`ID_P`,`ID_H`,`Date_Consommation`),
  FOREIGN KEY (`ID_H`) REFERENCES `Hamburger` (`ID`),
  FOREIGN KEY (`ID_P`) REFERENCES `Personne` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `Mange` (`ID_P`, `ID_H`, `Date_Consommation`, `Note`) VALUES
('P1', 'H1', '2014-05-01', 7),
('P2', 'H1', '2014-05-14', 8),
('P3', 'H1', '2014-05-29', 6),
('P3', 'H4', '2014-05-21', 6),
('P4', 'H2', '2014-05-13', 4),
('P4', 'H4', '2014-05-21', 9),
('P4', 'H5', '2014-05-13', 9),
('P4', 'H5', '2014-05-15', 8),
('P4', 'H5', '2014-05-20', 8),
('P5', 'H1', '2014-05-29', 6),
('P5', 'H2', '2014-05-06', 8),
('P5', 'H4', '2014-05-06', 2);

