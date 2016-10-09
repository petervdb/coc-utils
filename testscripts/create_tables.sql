CREATE TABLE TblClans(
  ClTag text PRIMARY KEY,
  ClName text NOT NULL,
  ClDescription text,
  ClType text,
  ClLocation text,
  ClBadgeURL text,
  ClWarFrequency text,
  ClClanLevel int,
  ClWarWins int,
  ClWarWinStreak int,
  ClClanPoints int,
  ClRequiredTrophies int,
  ClMembers int,
  ClCreated text,
  ClUpdated text,
  ClActive int,
  ClHiActive int,
  ClQueue int
);

CREATE TABLE TblClansHist(
  ClHiDate text NOT NULL,
  ClHiTag text NOT NULL,
  ClHiName text NOT NULL,
  ClHiType text,
  ClHiClanLevel int,
  ClHiWarWins int,
  ClHiWarWinStreak int,
  ClHiClanPoints int,
  ClHiMembers int,
  PRIMARY KEY (ClHiDate, ClHiTag)
);

CREATE TABLE TblMembers(
  MbTag text PRIMARY KEY,
  MbName text NOT NULL,
  MbClTag text,
  MbRole text,
  MbLevel int,
  MbLeagueId int,
  MbLeague text,
  MbTrophies int,
  MbClanRank int,
  MbDonations int,
  MbReceived int,
  MbCreated text,
  MbUpdated text,
  MbActive int,
  MbQueue int
);
