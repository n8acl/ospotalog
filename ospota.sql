-- ------------------------------------------------
-- phpContestLogger - OSPOTA
-- Developed by: Jeff Lehman, N8ACL
-- This script creates the OSPOTA logging database

-- Questions? Comments? Suggestions? Contact me one of the following ways:
-- E-mail: n8acl@protonmail.com
-- Twitter: @n8acl
-- Telegram: @Ravendos
-- Website: https://n8acl.ddns.net
-- ------------------------------------------------

--drop database ospotalog;

drop database if exists ospotalog;

CREATE DATABASE ospotalog;

-- --------------------------------------------------------

-- use ospotalog;

--
-- Table structure for table ospotaclass
--

CREATE TABLE ospotalog.ospotaclass (
  ospotaclassid int(11) NOT NULL,
  classid varchar(4) DEFAULT NULL,
  classname varchar(250) DEFAULT NULL,
  classdescription varchar(500) DEFAULT NULL,
  power varchar(5) DEFAULT NULL
);

--
-- Dumping data for table ospotaclass
--

INSERT INTO ospotalog.ospotaclass (ospotaclassid, classid, classname, classdescription, power) VALUES
(1, 'MML', 'Multi-Op Multi-Transmitter Low Power', '(.1 to 100 watts) located at one Ohio State Park', 'LOW'),
(2, 'MMH', 'Multi-Op Multi-Transmitter High Power', '(>100 watts) located at one Ohio State Park', 'HIGH'),
(3, 'MSL', 'Multi-Op Single-Transmitter Low Power', '(.1 to 100 watts) located at one Ohio State Park', 'LOW'),
(4, 'MSH', 'Multi-Op Single-Transmitter High Power', '(>100 watts) located at one Ohio State Park', 'HIGH'),
(5, 'SL', 'Single Operator Low Power', '(.1 to 100 watts) located at one Ohio State Park', 'LOW'),
(6, 'SH', 'Single Operator High Power', '(>100 watts) located at one Ohio State Park', 'HIGH'),
(7, 'INOH', 'Operator (Single or Multi)', 'inside Ohio not at an Ohio State Park (low or high power)', 'HIGH'),
(8, 'OUT', 'Operator (Single or Multi)', 'outside of Ohio (low or high power)', 'HIGH');

-- --------------------------------------------------------

--
-- Table structure for table ospotalog
--

CREATE TABLE ospotalog.ospotalog (
  contactid int(11) NOT NULL,
  contactcallsign varchar(6) DEFAULT NULL,
  parkid int(11) DEFAULT NULL,
  stateid int(11) DEFAULT NULL,
  mode int(11) DEFAULT NULL,
  utc_datetime datetime DEFAULT NULL,
  bandid int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table ospotaparks
--

CREATE TABLE ospotalog.ospotaparks (
  ospotaparkid int(11) NOT NULL,
  parkid varchar(3) DEFAULT NULL,
  parkname varchar(500) DEFAULT NULL,
  wwffid varchar(8) DEFAULT NULL,
  potaid varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table ospotaparks
--

INSERT INTO ospotalog.ospotaparks (ospotaparkid, parkid, parkname, wwffid, potaid) VALUES
(1,'AWM','A.W.Marion','KFF-1931','K-1931'),
(2,'ADA','Adams Lake','KFF-1932','K-1932'),
(3,'ALU','Alum Creek','KFF-1933','K-1933'),
(4,'BAR','Barkcamp','KFF-1934','K-1934'),
(5,'BEA','Beaver Creek','KFF-1935','K-1935'),
(6,'BLU','Blue Rock','KFF-1936','K-1936'),
(7,'BCK','Buck Creek','KFF-1937','K-1937'),
(8,'BKL','Buckeye Lake','KFF-1938','K-1938'),
(9,'BUR','Burr Oak','KFF-1939','K-1939'),
(10,'CAE','Caesar Creek','KFF-1940','K-1940'),
(11,'CAT','Catawba Island','KFF-1941','K-1941'),
(12,'COW','Cowan Lake','KFF-1943','K-1943'),
(13,'DEE','Deer Creek','KFF-1945','K-1945'),
(14,'DEL','Delaware','KFF-1946','K-1946'),
(15,'DIL','Dillon','KFF-1947','K-1947'),
(16,'EFK','East Fork','KFF-1948','K-1948'),
(17,'EHB','East Harbor','KFF-1949','K-1949'),
(18,'FIN','Findley','KFF-1950','K-1950'),
(19,'FOR','Forked Run','KFF-1951','K-1951'),
(20,'GEN','Geneva','KFF-1952','K-1952'),
(21,'GLM','Grand Lake St. Marys','KFF-1953','K-1953'),
(22,'GSL','Great Seal','KFF-1954','K-1954'),
(23,'GLK','Guilford Lake','KFF-1955','K-1955'),
(24,'HLK','Harrison Lake','KFF-1956','K-1956'),
(25,'HEA','Headlands Beach','KFF-1957','K-1957'),
(26,'HOC','Hocking Hills','KFF-1958','K-1958'),
(27,'HUE','Hueston Woods','KFF-1959','K-1959'),
(28,'IDM','Independence Dam','KFF-1960','K-1960'),
(29,'ILK','Indian Lake','KFF-1961','K-1961'),
(30,'JAC','Jackson Lake','KFF-1962','K-1962'),
(31,'JEF','Jefferson Lake','KFF-1963','K-1963'),
(32,'JEO','Jesse Owens','KFF-4620','K-5641'),
(33,'JOB','John Bryan','KFF-1964','K-1964'),
(34,'KEL','Kelleys Island','KFF-1965','K-1965'),
(35,'KLK','Kiser Lake','KFF-1966','K-1966'),
(36,'LAL','Lake Alma','KFF-1967','K-1967'),
(37,'LHO','Lake Hope','KFF-1968','K-1968'),
(38,'LOG','Lake Logan','KFF-1969','K-1969'),
(39,'LOR','Lake Loramie','KFF-1970','K-1970'),
(40,'LML','Lake Milton','KFF-3515','K-3515'),
(41,'LWT','Lake White','KFF-1971','K-1971'),
(42,'LMI','Little Miami','KFF-1972','K-1972'),
(43,'MLK','Madison Lake','KFF-1973','K-1973'),
(44,'MAL','Malabar Farm','KFF-1974','K-1974'),
(45,'MHD','Marblehead Lighthouse','KFF-3519','K-3519'),
(46,'MJT','Mary Jane Thurston','KFF-1975','K-1975'),
(47,'MBY','Maumee Bay','KFF-1976','K-1976'),
(48,'MBI','Middle Bass Island','KFF-3518','K-3518'),
(49,'MOH','Mohican','KFF-1977','K-1977'),
(50,'MST','Mosquito Lake','KFF-1978','K-1978'),
(51,'MTG','Mt. Gilead','KFF-1979','K-1979'),
(52,'MUS','Muskingum River','KFF-3520','K-3520'),
(53,'NKL','Nelson Kennedy Ledges','KFF-1980','K-1980'),
(54,'NBI','North Bass Island','KFF-3517','K-3517'),
(55,'OPT','Oak Point','KFF-1981','K-1981'),
(56,'PTC','Paint Creek','KFF-1982','K-1982'),
(57,'PLK','Pike Lakes','KFF-1983','K-1983'),
(58,'POR','Portage Lakes','KFF-1984','K-1984'),
(59,'PUN','Punderson','KFF-1985','K-1985'),
(60,'PYM','Pymatuning','KFF-1986','K-1986'),
(61,'QHL','Quail Hollow','KFF-1987','K-1987'),
(62,'RFK','Rocky Fork','KFF-1988','K-1988'),
(63,'SFK','Salt Fork','KFF-1989','K-1989'),
(64,'STR','Scioto Trail','KFF-1990','K-1990'),
(65,'SHA','Shawnee','KFF-1991','K-1991'),
(66,'SBI','South Bass Island','KFF-1992','K-1992'),
(67,'STO','Stonelick','KFF-1993','K-1993'),
(68,'SRN','Strouds Run','KFF-1994','K-1994'),
(69,'SYC','Sycamore','KFF-1995','K-1995'),
(70,'TAR','Tar Hollow','KFF-1996','K-1996'),
(71,'TCK','Tinkers Creek','KFF-1997','K-1997'),
(72,'VAN','Van Buren','KFF-1998','K-1998'),
(73,'WBR','West Branch','KFF-1999','K-1999'),
(74,'WLK','Wingfoot Lake','KFF-3516','K-3516'),
(75,'WRN','Wolf Run','KFF-2000','K-2000'),
(76,'','','','');

-- --------------------------------------------------------

--
-- Table structure for table ospotasettings
--

CREATE TABLE ospotalog.ospotasettings (
  contestcallsign varchar(6) DEFAULT NULL,
  clubname varchar(500) DEFAULT NULL,
  parkid int(11) DEFAULT NULL,
  licenseclassid int(11) NOT NULL,
  classid int(11) DEFAULT NULL,
  contactname varchar(500) DEFAULT NULL,
  contactaddress varchar(500) DEFAULT NULL,
  contactcity varchar(500) DEFAULT NULL,
  contactstate varchar(500) DEFAULT NULL,
  contactzip varchar(500) DEFAULT NULL,
  contactcountry varchar(500) DEFAULT NULL,
  contactemail varchar(500) DEFAULT NULL,
  operators varchar(8000) DEFAULT NULL,
  cabrillo int(1) DEFAULT NULL,
  firstrun int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table ospotasettings
--

INSERT INTO ospotalog.ospotasettings (contestcallsign, clubname, parkid, licenseclassid, classid, contactname, contactaddress, contactcity, contactstate, contactzip, contactcountry, contactemail, operators, cabrillo, firstrun) VALUES
('WN8ABC', 'Group Name', 42, 2, 1, 'Jeff Lehman N8ACL', '1313 Mockingbird ln', 'Mockingbird Heights', 'WA', '12345', 'USA', 'na8cl@protonmail.com', '', 0,1);

-- --------------------------------------------------------

--
-- Table structure for table sysbands
--

CREATE TABLE ospotalog.sysbands (
  sysbandsid int(11) NOT NULL,
  band varchar(50) DEFAULT NULL,
  mode varchar(50) DEFAULT NULL,
  licenseclassid int(11) DEFAULT NULL,
  priv text,
  orderby int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table sysbands
--

INSERT INTO ospotalog.sysbands (sysbandsid, band, mode, licenseclassid, priv, orderby) VALUES
(1,'80 M',1,1,'None', 1),
(2,'80 M',2,1,'3.525 - 3.600 Mhz', 1),
(3,'80 M',3,1,'None', 1),
(4,'40 M',1,1,'None', 2),
(5,'40 M',2,1,'7.025 - 7.125 Mhz', 2),
(6,'40 M',3,1,'None', 2),
(7,'20 M',1,1,'None', 3),
(8,'20 M',2,1,'None', 3),
(9,'20 M',3,1,'None', 3),
(10,'15 M',1,1,'None', 4),
(11,'15 M',2,1,'21.025 - 21.200 Mhz', 4),
(12,'15 M',3,1,'None', 4),
(13,'10 M',1,1,'28.300 - 28.500 Mhz SSB', 5),
(14,'10 M',2,1,'28.000 - 28.500 Mhz', 5),
(15,'10 M',3,1,'28.000 - 28.300 Mhz', 5),
(16,'80 M',1,2,'3.800 - 4.000 Mhz', 1),
(17,'80 M',2,2,'3.525 - 4.000 Mhz', 1),
(18,'80 M',3,2,'3.525 - 3.600 Mhz', 1),
(19,'40 M',1,2,'7.175 - 7.300 Mhz', 2),
(20,'40 M',2,2,'7.025 - 7.300 Mhz', 2),
(21,'40 M',3,2,'7.025 - 7.125 Mhz', 2),
(22,'20 M',1,2,'14.255 - 14.350 Mhz', 3),
(23,'20 M',2,2,'14.025 -14.350 Mhz', 3),
(24,'20 M',3,2,'14.025 - 14.150 Mhz', 3),
(25,'15 M',1,2,'21.275 - 21.450 Mhz', 4),
(26,'15 M',2,2,'21.025 - 21.450 Mhz', 4),
(27,'15 M',3,2,'21.025 - 21.200 Mhz', 4),
(28,'10 M',1,2,'28.300 - 29.700 Mhz', 5),
(29,'10 M',2,2,'28.000 - 29.700 Mhz', 5),
(30,'10 M',3,2,'28.000 - 28.300 Mhz', 5),
(31,'80 M',1,3,'3.600 - 4.000 Mhz', 1),
(32,'80 M',2,3,'3.500 - 4.000 Mhz', 1),
(33,'80 M',3,3,'3.500 - 3.600 Mhz', 1),
(34,'40 M',1,3,'7.125 - 7.300 Mhz', 2),
(35,'40 M',2,3,'7.000 - 7.300 Mhz', 2),
(36,'40 M',3,3,'7.000 - 7.125 Mhz', 2),
(37,'20 M',1,3,'14.150 - 14.350 Mhz', 3),
(38,'20 M',2,3,'14.150 - 14.350 Mhz', 3),
(39,'20 M',3,3,'14.000 - 14.150 Mhz', 3),
(40,'15 M',1,3,'21.200 - 21.450 Mhz', 4),
(41,'15 M',2,3,'21.000 - 21.450 Mhz', 4),
(42,'15 M',3,3,'21.000 - 21.200 Mhz', 4),
(43,'10 M',1,3,'28.300 - 29.700 Mhz', 5),
(44,'10 M',2,3,'28.000 - 29.700 Mhz', 5),
(45,'10 M',3,3,'28.000 - 28.300 Mhz', 5);

-- --------------------------------------------------------

--
-- Table structure for table syslicenseclass
--

CREATE TABLE ospotalog.syslicenseclass (
  syslicenseclassid int(11) NOT NULL,
  licenseclass varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table syslicenseclass
--

INSERT INTO ospotalog.syslicenseclass (syslicenseclassid, licenseclass) VALUES
(1, 'Technician'),
(2, 'General'),
(3, 'Extra');

-- --------------------------------------------------------

--
-- Table structure for table sysmodes
--

CREATE TABLE ospotalog.sysmodes (
  sysmodesid int(11) NOT NULL,
  modes varchar(20) DEFAULT NULL,
  modeabrv varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table sysmodes
--

INSERT INTO ospotalog.sysmodes (sysmodesid, modes, modeabrv) VALUES
(1, 'Phone', 'PH'),
(2, 'CW', 'CW'),
(3, 'Digital', 'DIG'),
(4, 'Voice Over IP', 'VOIP'),
(5, 'Digital', 'DI');

-- --------------------------------------------------------

--
-- Table structure for table sysstates
--

CREATE TABLE ospotalog.sysstates (
  sysstatesid int(11) NOT NULL,
  stateabrv varchar(2) DEFAULT NULL,
  statename varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table sysstates
--

INSERT INTO ospotalog.sysstates (sysstatesid, stateabrv, statename) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AZ', 'Arizona'),
(4, 'AR', 'Arkansas'),
(5, 'CA', 'California'),
(6, 'CO', 'Colorado'),
(7, 'CT', 'Connecticut'),
(8, 'DE', 'Delaware'),
(9, 'FL', 'Florida'),
(10, 'GA', 'Georgia'),
(11, 'HI', 'Hawaii'),
(12, 'ID', 'Idaho'),
(13, 'IL', 'Illinois'),
(14, 'IN', 'Indiana'),
(15, 'IA', 'Iowa'),
(16, 'KS', 'Kansas'),
(17, 'KY', 'Kentucky'),
(18, 'LA', 'Louisiana'),
(19, 'ME', 'Maine'),
(20, 'MD', 'Maryland'),
(21, 'MA', 'Massachusetts'),
(22, 'MI', 'Michigan'),
(23, 'MN', 'Minnesota'),
(24, 'MS', 'Mississippi'),
(25, 'MO', 'Missouri'),
(26, 'MT', 'Montana'),
(27, 'NE', 'Nebraska'),
(28, 'NV', 'Nevada'),
(29, 'NH', 'New Hampshire'),
(30, 'NJ', 'New Jersey'),
(31, 'NM', 'New Mexico'),
(32, 'NY', 'New York'),
(33, 'NC', 'North Carolina'),
(34, 'ND', 'North Dakota'),
(35, 'OH', 'Ohio'),
(36, 'OK', 'Oklahoma'),
(37, 'OR', 'Oregon'),
(38, 'PA', 'Pennsylvania'),
(39, 'RI', 'Rhode Island'),
(40, 'SC', 'South Carolina'),
(41, 'SD', 'South Dakota'),
(42, 'TN', 'Tennessee'),
(43, 'TX', 'Texas'),
(44, 'UT', 'Utah'),
(45, 'VT', 'Vermont'),
(46, 'VA', 'Virginia'),
(47, 'WA', 'Washington'),
(48, 'WV', 'West Virginia'),
(49, 'WI', 'Wisconsin'),
(50, 'WY', 'Wyoming'),
(51, 'DX', 'DX'),
(52, '', '');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table ospotaclass
--
ALTER TABLE ospotalog.ospotaclass
  ADD PRIMARY KEY (ospotaclassid);

--
-- Indexes for table ospotalog
--
ALTER TABLE ospotalog.ospotalog
  ADD PRIMARY KEY (contactid);

--
-- Indexes for table ospotaparks
--
ALTER TABLE ospotalog.ospotaparks
  ADD PRIMARY KEY (ospotaparkid);

--
-- Indexes for table sysbands
--
ALTER TABLE ospotalog.sysbands
  ADD PRIMARY KEY (sysbandsid);

--
-- Indexes for table syslicenseclass
--
ALTER TABLE ospotalog.syslicenseclass
  ADD PRIMARY KEY (syslicenseclassid);

--
-- Indexes for table sysmodes
--
ALTER TABLE ospotalog.sysmodes
  ADD PRIMARY KEY (sysmodesid);

--
-- Indexes for table sysstates
--
ALTER TABLE ospotalog.sysstates
  ADD PRIMARY KEY (sysstatesid);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table ospotaclass
--
ALTER TABLE ospotalog.ospotaclass
  MODIFY ospotaclassid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table ospotalog
--
ALTER TABLE ospotalog.ospotalog
  MODIFY contactid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table ospotaparks
--
ALTER TABLE ospotalog.ospotaparks
  MODIFY ospotaparkid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table sysbands
--
ALTER TABLE ospotalog.sysbands
  MODIFY sysbandsid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table syslicenseclass
--
ALTER TABLE ospotalog.syslicenseclass
  MODIFY syslicenseclassid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table sysmodes
--
ALTER TABLE ospotalog.sysmodes
  MODIFY sysmodesid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table sysstates
--
--ALTER TABLE ospotalog.sysstates
 -- MODIFY sysstatesid int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

-- -----------------------------------------
--
-- Create new user
--

--DROP USER IF EXISTS 'contest'@'localhost';
--CREATE USER 'contest'@'localhost' IDENTIFIED BY 'contest336';
--GRANT ALL PRIVILEGES ON ospotalog.* TO 'contest'@'localhost';
--FLUSH PRIVILEGES;