--
-- PostgreSQL database dump
--

\restrict UJFXE5DFjaJ3DWAHfe6sgCYErus1MbS4wy6TZY39Mssvc9loeGV3Cd6zDbStJqA

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: alugar_personagem; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alugar_personagem (
    id integer NOT NULL,
    cliente_id integer NOT NULL,
    personagem_id integer NOT NULL,
    data_festa date NOT NULL,
    horario_inicio time without time zone NOT NULL,
    horario_termino time without time zone NOT NULL,
    status character varying(50) DEFAULT 'Ativo'::character varying,
    experiencia character varying(100) DEFAULT 'Conto de Fadas'::character varying,
    cidade character varying(255),
    bairro character varying(255),
    rua character varying(255),
    numero character varying(20)
);


ALTER TABLE public.alugar_personagem OWNER TO postgres;

--
-- Name: alugar_personagem_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.alugar_personagem_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.alugar_personagem_id_seq OWNER TO postgres;

--
-- Name: alugar_personagem_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.alugar_personagem_id_seq OWNED BY public.alugar_personagem.id;


--
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    senha character varying(255)
);


ALTER TABLE public.cliente OWNER TO postgres;

--
-- Name: cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cliente_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cliente_id_seq OWNER TO postgres;

--
-- Name: cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cliente_id_seq OWNED BY public.cliente.id;


--
-- Name: funcionario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionario (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    senha character varying(255)
);


ALTER TABLE public.funcionario OWNER TO postgres;

--
-- Name: funcionario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.funcionario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.funcionario_id_seq OWNER TO postgres;

--
-- Name: funcionario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.funcionario_id_seq OWNED BY public.funcionario.id;


--
-- Name: personagem; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personagem (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    categoria character varying(100) NOT NULL,
    descricao text,
    imagem_url character varying(500) DEFAULT 'assets/default-avatar.png'::character varying,
    cadastrado_por_id integer
);


ALTER TABLE public.personagem OWNER TO postgres;

--
-- Name: personagem_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personagem_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personagem_id_seq OWNER TO postgres;

--
-- Name: personagem_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personagem_id_seq OWNED BY public.personagem.id;


--
-- Name: alugar_personagem id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alugar_personagem ALTER COLUMN id SET DEFAULT nextval('public.alugar_personagem_id_seq'::regclass);


--
-- Name: cliente id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente ALTER COLUMN id SET DEFAULT nextval('public.cliente_id_seq'::regclass);


--
-- Name: funcionario id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario ALTER COLUMN id SET DEFAULT nextval('public.funcionario_id_seq'::regclass);


--
-- Name: personagem id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personagem ALTER COLUMN id SET DEFAULT nextval('public.personagem_id_seq'::regclass);


--
-- Data for Name: alugar_personagem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alugar_personagem (id, cliente_id, personagem_id, data_festa, horario_inicio, horario_termino, status, experiencia, cidade, bairro, rua, numero) FROM stdin;
16	1	6	2026-05-12	12:00:00	21:00:00	Ativo	Conto de Fadas	Campinas	jardim Rosa	kibano	3533
17	1	9	2026-12-12	12:00:00	16:00:00	Ativo	Conto de Fadas	Americana	jardim Rosa	monica	103
18	11	6	2026-06-11	11:30:00	15:00:00	Ativo	Conto de Fadas	lllllllllll	hggggggggg	hfgth	2443
19	12	8	5677-04-23	12:00:00	15:00:00	Ativo	Conto de Fadas	americana	lalalalal	sjkdhsd	2122
\.


--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (id, nome, email, senha) FROM stdin;
2	otavio	otta@gmail	\N
3	ttt	tt@rt	\N
5	João Silva	joao@teste.com	\N
7	Maria Silva	maria@teste.com	$2y$12$yYW/e9XEQ7W1p168x.Gy6es3cu2ZMUTFlGvZWMUQifQos3uG64s4S
1	otavio	otavio@gmail	$2y$12$DbNk0dzDrYazNcRtkmRp8.81EbmoHxR5U/vqTS5xriHJkQqrVDO9W
9	Bluey	kllo@gmail	$2y$12$h8TT35ZPhS0ClqGwVzv8j.fEnjj0.I1afWZyESK8xAmCg/3g3zVT.
10	lari lala	lari@gmail	$2y$12$4tMHHQOBEA4UFP.18K2R1.CrkGIlFnDYUp0jY7fB6EdVtftFx/w2y
11	kaillany	kaymaiap@gmail.com	$2y$12$q6OHur/1e1d2YLqj4PnxneiBGWzufjRCWplmrYuA1PJ4L6rL5gTOm
12	laura	laurananana0@gmail.com	$2y$12$TLliUgMKRvrt4WP.WB8L8eIiO5/HxQlELEXcYJvi0BliQj0hyLfe2
\.


--
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionario (id, nome, email, senha) FROM stdin;
3	otavio	tttt@q	\N
1	otavio	otavio@gmail	\N
7	lau	lau@gmail	$2y$12$67.z6D3Qw7BpCTEtzQdyuOqznc.HiWUd71SFhC8HI1j0tb/v8q9sK
8	otavio	bia@gmail	$2y$12$JXVTINmcpubwl4nrFvofqOh/ZvzGMRgqyCp49qBgBHUDnU59tvJjO
\.


--
-- Data for Name: personagem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personagem (id, nome, categoria, descricao, imagem_url, cadastrado_por_id) FROM stdin;
6	Bluey	Personagens de Desenho	Ela ira divertir suas crianças	uploads/magic_6a28259a99fae.jpeg	8
7	Bela e a Fera	Personagens de Desenho	Eles iram animar suas crianças cantando as musicas do filme	uploads/magic_6a2826cf6dd42.jpg	8
8	Homem-Aranha	Heróis	manobras legai	uploads/magic_6a282706bc00a.jpg	8
9	Coelho da Páscoa	Outros	Ira divertir suas crianças	uploads/magic_6a283ea642221.jpg	8
10	Cinderela	Personagens de Desenho	Ela irá alegrar suas crianças e iteração com os animais	uploads/magic_6a2b12cdcc399.jpg	8
\.


--
-- Name: alugar_personagem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.alugar_personagem_id_seq', 19, true);


--
-- Name: cliente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cliente_id_seq', 12, true);


--
-- Name: funcionario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.funcionario_id_seq', 8, true);


--
-- Name: personagem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personagem_id_seq', 10, true);


--
-- Name: alugar_personagem alugar_personagem_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alugar_personagem
    ADD CONSTRAINT alugar_personagem_pkey PRIMARY KEY (id);


--
-- Name: cliente cliente_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_email_key UNIQUE (email);


--
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id);


--
-- Name: funcionario funcionario_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_email_key UNIQUE (email);


--
-- Name: funcionario funcionario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_pkey PRIMARY KEY (id);


--
-- Name: personagem personagem_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personagem
    ADD CONSTRAINT personagem_pkey PRIMARY KEY (id);


--
-- Name: alugar_personagem alugar_personagem_cliente_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alugar_personagem
    ADD CONSTRAINT alugar_personagem_cliente_id_fkey FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: alugar_personagem alugar_personagem_personagem_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alugar_personagem
    ADD CONSTRAINT alugar_personagem_personagem_id_fkey FOREIGN KEY (personagem_id) REFERENCES public.personagem(id) ON DELETE CASCADE;


--
-- Name: personagem personagem_cadastrado_por_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personagem
    ADD CONSTRAINT personagem_cadastrado_por_id_fkey FOREIGN KEY (cadastrado_por_id) REFERENCES public.funcionario(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict UJFXE5DFjaJ3DWAHfe6sgCYErus1MbS4wy6TZY39Mssvc9loeGV3Cd6zDbStJqA

