--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.12
-- Dumped by pg_dump version 9.6.12

-- Started on 2019-04-13 15:16:47 CEST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 6 (class 2615 OID 16649)
-- Name: business; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA business;


ALTER SCHEMA business OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12394)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 187 (class 1259 OID 16652)
-- Name: rental; Type: TABLE; Schema: business; Owner: postgres
--

CREATE TABLE business.rental (
    id integer NOT NULL,
    client_firstname character varying NOT NULL,
    client_lastname character varying NOT NULL,
    vehicle_id integer NOT NULL,
    rental_date date NOT NULL
);


ALTER TABLE business.rental OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16650)
-- Name: rental_id_seq; Type: SEQUENCE; Schema: business; Owner: postgres
--

CREATE SEQUENCE business.rental_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE business.rental_id_seq OWNER TO postgres;

--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 186
-- Name: rental_id_seq; Type: SEQUENCE OWNED BY; Schema: business; Owner: postgres
--

ALTER SEQUENCE business.rental_id_seq OWNED BY business.rental.id;


--
-- TOC entry 189 (class 1259 OID 16663)
-- Name: sale; Type: TABLE; Schema: business; Owner: postgres
--

CREATE TABLE business.sale (
    id integer NOT NULL,
    client_firstname character varying NOT NULL,
    client_lastname character varying NOT NULL,
    product_id character varying NOT NULL,
    sale_id character varying NOT NULL
);


ALTER TABLE business.sale OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 16661)
-- Name: sale_id_seq; Type: SEQUENCE; Schema: business; Owner: postgres
--

CREATE SEQUENCE business.sale_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE business.sale_id_seq OWNER TO postgres;

--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 188
-- Name: sale_id_seq; Type: SEQUENCE OWNED BY; Schema: business; Owner: postgres
--

ALTER SEQUENCE business.sale_id_seq OWNED BY business.sale.id;


--
-- TOC entry 2015 (class 2604 OID 16655)
-- Name: rental id; Type: DEFAULT; Schema: business; Owner: postgres
--

ALTER TABLE ONLY business.rental ALTER COLUMN id SET DEFAULT nextval('business.rental_id_seq'::regclass);


--
-- TOC entry 2016 (class 2604 OID 16666)
-- Name: sale id; Type: DEFAULT; Schema: business; Owner: postgres
--

ALTER TABLE ONLY business.sale ALTER COLUMN id SET DEFAULT nextval('business.sale_id_seq'::regclass);


--
-- TOC entry 2139 (class 0 OID 16652)
-- Dependencies: 187
-- Data for Name: rental; Type: TABLE DATA; Schema: business; Owner: postgres
--

COPY business.rental (id, client_firstname, client_lastname, vehicle_id, rental_date) FROM stdin;
\.


--
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 186
-- Name: rental_id_seq; Type: SEQUENCE SET; Schema: business; Owner: postgres
--

SELECT pg_catalog.setval('business.rental_id_seq', 1, false);


--
-- TOC entry 2141 (class 0 OID 16663)
-- Dependencies: 189
-- Data for Name: sale; Type: TABLE DATA; Schema: business; Owner: postgres
--

COPY business.sale (id, client_firstname, client_lastname, product_id, sale_id) FROM stdin;
\.


--
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 188
-- Name: sale_id_seq; Type: SEQUENCE SET; Schema: business; Owner: postgres
--

SELECT pg_catalog.setval('business.sale_id_seq', 1, false);


--
-- TOC entry 2018 (class 2606 OID 16657)
-- Name: rental rental_pkey; Type: CONSTRAINT; Schema: business; Owner: postgres
--

ALTER TABLE ONLY business.rental
    ADD CONSTRAINT rental_pkey PRIMARY KEY (id);


--
-- TOC entry 2020 (class 2606 OID 16668)
-- Name: sale sale_pkey; Type: CONSTRAINT; Schema: business; Owner: postgres
--

ALTER TABLE ONLY business.sale
    ADD CONSTRAINT sale_pkey PRIMARY KEY (id);


-- Completed on 2019-04-13 15:16:47 CEST

--
-- PostgreSQL database dump complete
--

