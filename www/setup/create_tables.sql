CREATE TABLE `TblClans` (
  `ClTag` varchar(10) NOT NULL,
  `ClName` varchar(40) NOT NULL,
  `ClDescription` varchar(80) NOT NULL,
  `ClType` varchar(12) NOT NULL,
  `ClLocation` varchar(20) NOT NULL,
  `ClBadgeURL` varchar(80) NOT NULL,
  `ClWarFrequency` varchar(10) NOT NULL,
  `ClClanLevel` int(11) NOT NULL,
  `ClWarWins` int(11) NOT NULL,
  `ClWarWinStreak` int(11) NOT NULL,
  `ClClanPoints` int(11) NOT NULL,
  `ClRequiredTrophies` int(11) NOT NULL,
  `ClMembers` int(11) NOT NULL,
  `ClCreated` datetime NOT NULL,
  `ClUpdated` datetime NOT NULL,
  `ClActive` int(11) NOT NULL,
  `ClHiActive` int(11) NOT NULL,
  `ClQueue` int(11) NOT NULL,
  PRIMARY KEY (`ClTag`),
  KEY `ClName` (`ClName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


