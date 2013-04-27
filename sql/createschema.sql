SET storage_engine=MYISAM;

create database viewmedb;

grant all on viewmedb.* to 'viewme'@'localhost';

use viewmedb;

drop table if EXISTS account;
drop table if EXISTS myprefs;
drop table if EXISTS mytheme;
drop table if EXISTS myskills;
drop table if EXISTS myexperience;
drop table if EXISTS myportfolio;
drop table if EXISTS myeducation;
drop table if EXISTS myreference;
drop table if EXISTS mysocialids;
drop table if EXISTS myskills;
drop table if EXISTS tags;
drop table if EXISTS skills;
drop table if EXISTS communities;

create table account(
    userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	username VARCHAR(25),
    fullname VARCHAR(50),
    firstname VARCHAR(25),
    lastname VARCHAR(25),
    password VARCHAR (25),
    email VARCHAR(50),
    phone VARCHAR(15),
    mobile VARCHAR(15),
    status INTEGER,
    started DATETIME,
    suspended DATETIME,
    usertype VARCHAR (20),
    company VARCHAR (50),
    streetaddress1 VARCHAR (80),
    streetaddress2 VARCHAR (80),
    city VARCHAR(50),
    state VARCHAR(50),
    postalcode VARCHAR(10),
    country VARCHAR(50),
    communityid VARCHAR(25),
    aboutme TEXT,
	headline VARCHAR(50),
    created DATETIME NULL,
    updated DATETIME NULL,
	PRIMARY KEY (userid, posnum)
);

DELIMITER |

CREATE TRIGGER account_INSERT BEFORE INSERT ON account
FOR EACH ROW BEGIN
    SET new.created = now();
    Set new.updated = now();
END|

CREATE TRIGGER account_UPDATE BEFORE UPDATE ON account
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;


create table myprefs (
    userid VARCHAR (25) NOT NULL,
    avatar BLOB,
    locale VARCHAR(25),
    timezone varchar(25),
	showAvatar BOOLEAN DEFAULT TRUE,
	showMyTweets BOOLEAN DEFAULT TRUE,
	showContactInfo BOOLEAN DEFAULT TRUE,
	showProfessions BOOLEAN DEFAULT TRUE,
	showHobbies BOOLEAN DEFAULT TRUE,
	showExperience BOOLEAN DEFAULT TRUE,
	showPortfolio BOOLEAN DEFAULT TRUE,
	showEducation BOOLEAN DEFAULT TRUE,
	showReferences BOOLEAN DEFAULT TRUE,
	showSocialIds BOOLEAN DEFAULT TRUE,
	showSkills BOOLEAN DEFAULT TRUE,
    updated DATETIME NULL,
    PRIMARY KEY (userid)
);

DELIMITER |

CREATE TRIGGER myprefs_INSERT BEFORE INSERT ON myprefs
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myprefs_UPDATE BEFORE UPDATE ON myprefs
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;

create table mytheme (
	userid VARCHAR (25) NOT NULL,
	fontfamily VARCHAR(50),
	h1color VARCHAR(6),
	h1size FLOAT,
	h2color VARCHAR(6),
	h2size FLOAT,
	h3color VARCHAR(6),
	h3size FLOAT,
	menucolor VARCHAR(6),
	menuhovercolor VARCHAR(6),
	linkcolor VARCHAR(6),
	linkhovercolor VARCHAR(6),
	contentcolor VARCHAR(6),
	contentbgcolor VARCHAR(6),
	themebgcolor VARCHAR(6),
    updated DATETIME NULL,
    PRIMARY KEY (userid)
);

DELIMITER |

CREATE TRIGGER mytheme_INSERT BEFORE INSERT ON mytheme
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER mytheme_UPDATE BEFORE UPDATE ON mytheme
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;


create table myskills (
	userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	skillname VARCHAR(25),
	selfrating INTEGER,
	communityrating INTEGER,
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER myskills_INSERT BEFORE INSERT ON myskills
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myskills_UPDATE BEFORE UPDATE ON myskills
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;


create table myexperience (
	userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	company VARCHAR(25),
	position VARCHAR (25),
	startdate DATETIME,
	enddate DATETIME,
	description VARCHAR(2000),
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER myexperience_INSERT BEFORE INSERT ON myexperience
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myexperience_UPDATE BEFORE UPDATE ON myexperience
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;


create table myportfolio (
    userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	projectname varchar(25),
	title VARCHAR(25),
	image BLOB,
	description VARCHAR(255),
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER myportfolio_INSERT BEFORE INSERT ON myportfolio
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myportfolio_UPDATE BEFORE UPDATE ON myportfolio
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;

create table myeducation (
	userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	startdate DATETIME,
	enddate DATETIME,
	institution VARCHAR(50),
    fieldofstudy VARCHAR(50),
	credential VARCHAR(50),
	activities TEXT,
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER myeducation_INSERT BEFORE INSERT ON myeducation
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myeducation_UPDATE BEFORE UPDATE ON myeducation
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;

create table myreference (
	userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	name VARCHAR (25),
	position VARCHAR(25),
	company VARCHAR (50),
	testimonial TEXT,
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER myreference_INSERT BEFORE INSERT ON myreference
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER myreference_UPDATE BEFORE UPDATE ON myreference
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;

create table mysocialids (
	userid VARCHAR (25),
	posnum INTEGER AUTO_INCREMENT,
	socnetwork varchar(50),
	socid  VARCHAR(50),
	password VARCHAR(50),
	weburl VARCHAR(255),
	apiurl VARCHAR(255),
	identity VARCHAR(255),
    updated DATETIME NULL,
    PRIMARY KEY (userid, posnum)	
);

DELIMITER |

CREATE TRIGGER mysocialids_INSERT BEFORE INSERT ON mysocialids
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

CREATE TRIGGER mysocialids_UPDATE BEFORE UPDATE ON mysocialids
FOR EACH ROW BEGIN
    Set new.updated = now();
END|

DELIMITER ;

create table skills (
    skillid VARCHAR(25) PRIMARY KEY NOT NULL,
    skilltype VARCHAR (25),
    description VARCHAR(255)
);

create table tags (
	tag VARCHAR(25),
	tagtype VARCHAR(25),
	taggeditemid VARCHAR(25),
	primary key (tag, tagtype, taggeditemid)
);

create table communities (
	id VARCHAR (25) PRIMARY KEY NOT NULL,
	name VARCHAR(25),
	description VARCHAR(255)
);

alter table account MODIFY COLUMN headline varchar(255);

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verifystring` varchar(15) NOT NULL,
  `lostkey` varchar(100) NOT NULL,
  `active` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `messages` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(11) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text,
  `message_date` datetime DEFAULT NULL,
  `sender_status` tinyint(2) DEFAULT NULL COMMENT '0=deleted, 1=new, 2=read',
  `label_id` tinyint(4) DEFAULT NULL COMMENT '1=message, 2=system alert, 3=recommendation',
  `thread_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`)
);

CREATE TABLE IF NOT EXISTS `connections` (
  `userid` varchar(50) NOT NULL,
  `frndid` bigint(20) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `picture_url` blob,
  `profile_url` blob
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
