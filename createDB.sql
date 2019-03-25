/*Run this script to create Database and insert tables in*/
/*Replace "yourDatabase" with your database name*/

/*Create Users*/

/*Admin User*/
CREATE ROLE postgres LOGIN
  ENCRYPTED PASSWORD 'P@ssw0rd'
  SUPERUSER INHERIT CREATEDB CREATEROLE REPLICATION;

/*Read-Only User*/
CREATE ROLE userRO LOGIN
  ENCRYPTED PASSWORD 'password'
  NOSUPERUSER INHERIT NOCREATEDB NOCREATEROLE NOREPLICATION;

/*Insert-Only User*/
CREATE ROLE userIO LOGIN
  ENCRYPTED PASSWORD 'password'
  NOSUPERUSER INHERIT NOCREATEDB NOCREATEROLE NOREPLICATION;

/*SuperUser User*/
CREATE ROLE userALL LOGIN
  ENCRYPTED PASSWORD 'password'
  NOSUPERUSER INHERIT NOCREATEDB NOCREATEROLE NOREPLICATION;


/*Create Database*/
CREATE DATABASE yourDatabase
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'C'
       LC_CTYPE = 'C'
       CONNECTION LIMIT = -1;
GRANT CONNECT, TEMPORARY ON DATABASE yourDatabase TO public;
GRANT ALL ON DATABASE yourDatabase TO postgres;
GRANT CONNECT ON DATABASE yourDatabase TO userRO;
GRANT CONNECT ON DATABASE yourDatabase TO userIO;
GRANT CONNECT ON DATABASE yourDatabase TO userALL;



/*Create schema*/
CREATE SCHEMA exo
  AUTHORIZATION postgres;

GRANT ALL ON SCHEMA exo TO postgres;
GRANT USAGE ON SCHEMA exo TO userRO;
GRANT USAGE ON SCHEMA exo TO userIO;
GRANT USAGE ON SCHEMA exo TO userALL;

/*Insert Tables*/

/*Members*/
CREATE TABLE exo.members
(
  memid integer NOT NULL,
  surname character varying(200) NOT NULL,
  firstname character varying(200) NOT NULL,
  address character varying(300) NOT NULL,
  zipcode integer NOT NULL,
  telephone character varying(20) NOT NULL,
  recommendedby integer,
  joindate timestamp without time zone NOT NULL,
  CONSTRAINT members_pk PRIMARY KEY (memid),
  CONSTRAINT fk_members_recommendedby FOREIGN KEY (recommendedby)
      REFERENCES exo.members (memid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE SET NULL
)
WITH (
  OIDS=FALSE
);
ALTER TABLE exo.members
  OWNER TO postgres;
GRANT ALL ON TABLE exo.members TO postgres;
GRANT SELECT ON TABLE exo.members TO userRO;
GRANT INSERT ON TABLE exo.members TO userIO;
GRANT ALL ON TABLE exo.members TO userALL;


/*Facilities*/
CREATE TABLE exo.facilities
(
  facid integer NOT NULL,
  name character varying(100) NOT NULL,
  membercost numeric NOT NULL,
  guestcost numeric NOT NULL,
  initialoutlay numeric NOT NULL,
  monthlymaintenance numeric NOT NULL,
  CONSTRAINT facilities_pk PRIMARY KEY (facid)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE exo.facilities
  OWNER TO postgres;
GRANT ALL ON TABLE exo.facilities TO postgres;
GRANT SELECT ON TABLE exo.facilities TO userRO;
GRANT INSERT ON TABLE exo.facilities TO userIO;
GRANT ALL ON TABLE exo.facilities TO userALL;


/*Bookings*/
CREATE TABLE exo.bookings
(
  bookid integer NOT NULL,
  facid integer NOT NULL,
  memid integer NOT NULL,
  starttime timestamp without time zone NOT NULL,
  slots integer NOT NULL,
  CONSTRAINT bookings_pk PRIMARY KEY (bookid),
  CONSTRAINT fk_bookings_facid FOREIGN KEY (facid)
      REFERENCES exo.facilities (facid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_bookings_memid FOREIGN KEY (memid)
      REFERENCES exo.members (memid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE exo.bookings
  OWNER TO postgres;
GRANT ALL ON TABLE exo.bookings TO postgres;
GRANT SELECT ON TABLE exo.bookings TO userRO;
GRANT INSERT ON TABLE exo.bookings TO userIO;
GRANT ALL ON TABLE exo.bookings TO userALL;