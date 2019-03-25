--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.15
-- Dumped by pg_dump version 9.5.15

-- Started on 2019-03-09 16:49:18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 8 (class 2615 OID 16574)
-- Name: exo; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA exo;


ALTER SCHEMA exo OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 184 (class 1259 OID 16604)
-- Name: bookings; Type: TABLE; Schema: exo; Owner: postgres
--

CREATE TABLE exo.bookings (
    bookid integer NOT NULL,
    facid integer NOT NULL,
    memid integer NOT NULL,
    starttime timestamp without time zone NOT NULL,
    slots integer NOT NULL
);


ALTER TABLE exo.bookings OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16596)
-- Name: facilities; Type: TABLE; Schema: exo; Owner: postgres
--

CREATE TABLE exo.facilities (
    facid integer NOT NULL,
    name character varying(100) NOT NULL,
    membercost numeric NOT NULL,
    guestcost numeric NOT NULL,
    initialoutlay numeric NOT NULL,
    monthlymaintenance numeric NOT NULL
);


ALTER TABLE exo.facilities OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16583)
-- Name: members; Type: TABLE; Schema: exo; Owner: postgres
--

CREATE TABLE exo.members (
    memid integer NOT NULL,
    surname character varying(200) NOT NULL,
    firstname character varying(200) NOT NULL,
    address character varying(300) NOT NULL,
    zipcode integer NOT NULL,
    telephone character varying(20) NOT NULL,
    recommendedby integer,
    joindate timestamp without time zone NOT NULL
);


ALTER TABLE exo.members OWNER TO postgres;

--
-- TOC entry 2117 (class 0 OID 16604)
-- Dependencies: 184
-- Data for Name: bookings; Type: TABLE DATA; Schema: exo; Owner: postgres
--

COPY exo.bookings (bookid, facid, memid, starttime, slots) FROM stdin;
1	1	1	2018-11-28 08:41:30.783157	3
2	2	2	2018-11-28 09:01:22.950578	4
3	3	3	2018-11-28 09:01:22.950578	5
4	4	4	2018-11-28 09:01:22.950578	50
5	5	5	2018-11-28 09:01:22.950578	20
6	6	6	2018-11-28 09:01:22.950578	200
7	7	7	2018-11-28 09:01:22.950578	10
8	8	8	2018-11-28 09:01:22.950578	200
9	9	9	2018-11-28 09:01:22.950578	2000
10	10	10	2018-11-28 09:01:22.950578	3000
11	11	11	2018-11-28 11:27:57.801246	50
12	12	19	1970-01-01 00:00:00	3
13	11	10	1970-01-01 00:00:00	5
15	11	12	2018-12-01 00:00:00	50
22	8	14	2019-03-22 00:00:00	4
21	1	1	2019-02-27 00:00:00	22
\.


--
-- TOC entry 2116 (class 0 OID 16596)
-- Dependencies: 183
-- Data for Name: facilities; Type: TABLE DATA; Schema: exo; Owner: postgres
--

COPY exo.facilities (facid, name, membercost, guestcost, initialoutlay, monthlymaintenance) FROM stdin;
1	facility1	15	10	1	5
2	salle de tennis	10	15	1	5
3	Tatami	15	20	1	10
4	Salle des fêtes de Putanges	30	50	1	20
5	Vignoble Lecuit	40	60	1	0
6	Discothèque Tongué	20	30	1	15
7	Caravane	1	10	1	1
8	Ile Delfino	100	200	1	50
9	Cowork Ynov Nantes	500	1000	1	2
10	Théatre Graslin	1000	2000	1	300
11	Zénith de Nantes	50	100	1	20
12	Garage Abandonné	15	25	10	5
13	Yourt de Djilani	20	50	15	20
\.


--
-- TOC entry 2115 (class 0 OID 16583)
-- Dependencies: 182
-- Data for Name: members; Type: TABLE DATA; Schema: exo; Owner: postgres
--

COPY exo.members (memid, surname, firstname, address, zipcode, telephone, recommendedby, joindate) FROM stdin;
1	Potier	Tanguy	Malakoff	44000	612131415	\N	2018-11-28 08:37:24.522195
2	Lecuit	Mattéo	Malakoff	44000	611111111	\N	2018-11-28 08:49:37.426328
3	Maisonneuve	Henry	Malakoff	44000	622222222	\N	2018-11-28 08:49:37.426328
4	Suchot	Alexandre	Malakoff	44000	633333333	\N	2018-11-28 08:49:37.426328
5	Pand	Antonin	Malakoff	44000	644444444	\N	2018-11-28 08:49:37.426328
6	Vera	Samy	Malakoff	44000	655555555	\N	2018-11-28 08:49:37.426328
7	Leroy-Nivot	Mathis	Malakoff	44000	666666666	\N	2018-11-28 08:49:37.426328
8	Cambert	Killian	Malakoff	44000	677777777	\N	2018-11-28 08:49:37.426328
9	Rigolo	Léo	Malakoff	44000	688888888	\N	2018-11-28 08:49:37.426328
10	Vaucard	Adrien	Malakoff	44000	699999999	\N	2018-11-28 08:49:37.426328
11	Kwoak	Henry	Malakoff	44000	610101010	\N	2018-11-28 11:27:57.801246
12	Lopez	Djo	4 rue de la caravane	44310	0612327623	4	2018-11-28 17:01:52
13	Bigeard	Jimmy	Sous un pont	44000	0867655443	1	2018-11-28 17:06:02
14	Bigeard	Bigeard	Egouts	44000	0611111111	2	2018-11-28 17:08:18
16	Lasalle	Jean	Campagne	0	0612723495	1	2018-11-28 19:25:18
17	Mélenchon	Jean-Luc	Goulag	11111	0645873323	2	2018-11-28 19:26:30
18	Obama	Barack	EU	34543	0635482365	4	2018-11-29 06:57:40
19	Alluin	Allan	Jura	43213	0645673456	3	2018-11-29 07:11:27
\.


--
-- TOC entry 1997 (class 2606 OID 16608)
-- Name: bookings_pk; Type: CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.bookings
    ADD CONSTRAINT bookings_pk PRIMARY KEY (bookid);


--
-- TOC entry 1994 (class 2606 OID 16603)
-- Name: facilities_pk; Type: CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.facilities
    ADD CONSTRAINT facilities_pk PRIMARY KEY (facid);


--
-- TOC entry 1992 (class 2606 OID 16590)
-- Name: members_pk; Type: CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.members
    ADD CONSTRAINT members_pk PRIMARY KEY (memid);


--
-- TOC entry 1995 (class 1259 OID 33183)
-- Name: bookings_index; Type: INDEX; Schema: exo; Owner: postgres
--

CREATE INDEX bookings_index ON exo.bookings USING btree (memid);


--
-- TOC entry 1990 (class 1259 OID 33184)
-- Name: members_index; Type: INDEX; Schema: exo; Owner: postgres
--

CREATE INDEX members_index ON exo.members USING btree (surname, memid);


--
-- TOC entry 1999 (class 2606 OID 16609)
-- Name: fk_bookings_facid; Type: FK CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.bookings
    ADD CONSTRAINT fk_bookings_facid FOREIGN KEY (facid) REFERENCES exo.facilities(facid);


--
-- TOC entry 2000 (class 2606 OID 16614)
-- Name: fk_bookings_memid; Type: FK CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.bookings
    ADD CONSTRAINT fk_bookings_memid FOREIGN KEY (memid) REFERENCES exo.members(memid);


--
-- TOC entry 1998 (class 2606 OID 16591)
-- Name: fk_members_recommendedby; Type: FK CONSTRAINT; Schema: exo; Owner: postgres
--

ALTER TABLE ONLY exo.members
    ADD CONSTRAINT fk_members_recommendedby FOREIGN KEY (recommendedby) REFERENCES exo.members(memid) ON DELETE SET NULL;


--
-- TOC entry 2124 (class 0 OID 0)
-- Dependencies: 8
-- Name: SCHEMA exo; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA exo FROM PUBLIC;
REVOKE ALL ON SCHEMA exo FROM postgres;
GRANT ALL ON SCHEMA exo TO postgres;
GRANT USAGE ON SCHEMA exo TO "UserRO";
GRANT USAGE ON SCHEMA exo TO "userRO";
GRANT USAGE ON SCHEMA exo TO "userIO";


--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 6
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 184
-- Name: TABLE bookings; Type: ACL; Schema: exo; Owner: postgres
--

REVOKE ALL ON TABLE exo.bookings FROM PUBLIC;
REVOKE ALL ON TABLE exo.bookings FROM postgres;
GRANT ALL ON TABLE exo.bookings TO postgres;
GRANT SELECT ON TABLE exo.bookings TO "UserRO";
GRANT SELECT ON TABLE exo.bookings TO testuser;
GRANT SELECT ON TABLE exo.bookings TO "userRO";
GRANT INSERT ON TABLE exo.bookings TO "userIO";
GRANT ALL ON TABLE exo.bookings TO "UserALL" WITH GRANT OPTION;
GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE exo.bookings TO "userALL";


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 183
-- Name: TABLE facilities; Type: ACL; Schema: exo; Owner: postgres
--

REVOKE ALL ON TABLE exo.facilities FROM PUBLIC;
REVOKE ALL ON TABLE exo.facilities FROM postgres;
GRANT ALL ON TABLE exo.facilities TO postgres;
GRANT SELECT ON TABLE exo.facilities TO "UserRO";
GRANT SELECT ON TABLE exo.facilities TO testuser;
GRANT SELECT ON TABLE exo.facilities TO "userRO";
GRANT INSERT ON TABLE exo.facilities TO "userIO";
GRANT ALL ON TABLE exo.facilities TO "UserALL" WITH GRANT OPTION;
GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE exo.facilities TO "userALL";


--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 182
-- Name: TABLE members; Type: ACL; Schema: exo; Owner: postgres
--

REVOKE ALL ON TABLE exo.members FROM PUBLIC;
REVOKE ALL ON TABLE exo.members FROM postgres;
GRANT ALL ON TABLE exo.members TO postgres;
GRANT SELECT ON TABLE exo.members TO "UserRO";
GRANT SELECT ON TABLE exo.members TO testuser;
GRANT SELECT ON TABLE exo.members TO "userRO";
GRANT INSERT ON TABLE exo.members TO "userIO";
GRANT ALL ON TABLE exo.members TO "UserALL" WITH GRANT OPTION;
GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE exo.members TO "userALL";


-- Completed on 2019-03-09 16:49:18

--
-- PostgreSQL database dump complete
--

