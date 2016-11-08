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

CREATE TABLE TblClansHist(
  ClHiDate datetime NOT NULL,
  ClHiTag varchar(10) NOT NULL,
  ClHiName varchar(40) NOT NULL,
  ClHiType text,
  ClHiClanLevel int,
  ClHiWarWins int,
  ClHiWarWinStreak int,
  ClHiClanPoints int,
  ClHiMembers int,
  PRIMARY KEY (ClHiDate, ClHiTag)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE TblMembers(
  MbTag varchar(10) PRIMARY KEY,
  MbName text NOT NULL,
  MbClTag varchar(10),
  MbRole varchar(10),
  MbLevel int,
  MbLeagueId int,
  MbLeague text,
  MbTrophies int,
  MbClanRank int,
  MbDonations int,
  MbReceived int,
  MbCreated datetime,
  MbUpdated datetime,
  MbActive int,
  MbQueue int
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

