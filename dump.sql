DROP TABLE bread;
DROP TABLE history;
DROP TABLE item_cart;
DROP TABLE users;

DROP EXTENSION chkpass;
CREATE EXTENSION chkpass;

CREATE TABLE bread (
	breadid INTEGER NOT NULL,
	breadname VARCHAR(31) NOT NULL,
	price NUMERIC (15,2) NOT NULL,
	quantity INTEGER NOT NULL,
	PRIMARY KEY (breadid)
);

CREATE TABLE history (
  username VARCHAR(31) NOT NULL,
	breadid INTEGER NOT NULL,
  payid INTEGER NOT NULL,
	quantity INTEGER NOT NULL,
	cost NUMERIC (15,2) NOT NULL,
	date TIMESTAMP NOT NULL,
	PRIMARY KEY (username,breadid,payid)
);

CREATE TABLE item_cart (
  username VARCHAR(31) NOT NULL,
	breadid INTEGER NOT NULL,
  quantity INTEGER NOT NULL,
	PRIMARY KEY (username,breadid)
);

CREATE TABLE users (
  username VARCHAR(31) NOT NULL,
	name VARCHAR(63) NOT NULL,
  address VARCHAR(127) NOT NULL,
  email VARCHAR(63) NOT NULL,
	type INTEGER NOT NULL,
  password chkpass NOT NULL,
	PRIMARY KEY (username)
);

INSERT INTO bread values (1,'Japan No. 3',65.00,2);
INSERT INTO bread values (2,'Japan No. 16',50.00,6);

INSERT INTO history values ('joe',1,4,2,130.00,'2016-12-18 07:57:58');
INSERT INTO history values ('joe',1,5,2,130.00,'2016-12-18 15:49:16');
INSERT INTO history values ('joe',1,6,1,65.00,'2016-12-19 10:46:01');
INSERT INTO history values ('joe',2,7,1,50.00,'2016-12-19 10:58:12');

INSERT INTO item_cart values ('joe',1,1);
INSERT INTO item_cart values ('joe',2,3);

INSERT INTO users values ('admin','admin','Tokyo','admin@pantasia.jp',1,'poison');
INSERT INTO users values ('joe','johnny','Atlanta','joe@mlb.com',0,'password');
