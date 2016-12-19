CREATE DATABASE buslig;
\c buslig;

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
