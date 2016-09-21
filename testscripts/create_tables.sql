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
  ClQueue int

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
