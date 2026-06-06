--
-- PostgreSQL database dump
--

\restrict fxNQX6toGIV3uNZRxXQsxbtzw36q0qhRE6RE0Zj1logm92P6EV1ajwOfEfMxHMY

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4 (Ubuntu 18.4-1.pgdg24.04+1)

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
-- Name: cache; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration bigint NOT NULL
);


ALTER TABLE public.cache OWNER TO sail;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration bigint NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO sail;

--
-- Name: contacts; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.contacts (
    id bigint NOT NULL,
    "nameEn" character varying(255) NOT NULL,
    "nameAr" character varying(255) NOT NULL,
    email character varying(255),
    phone character varying(255),
    nationality character varying(255) DEFAULT 'Egyptian'::character varying NOT NULL,
    religion character varying(255),
    gender character varying(255),
    national_id character varying(14),
    passport_no character varying(255),
    birth_date date,
    status character varying(255) DEFAULT 'Active'::character varying NOT NULL,
    source character varying(255),
    notes text,
    parent_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    categories jsonb DEFAULT '[]'::jsonb NOT NULL,
    mother_id bigint
);


ALTER TABLE public.contacts OWNER TO sail;

--
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contacts_id_seq OWNER TO sail;

--
-- Name: contacts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.contacts_id_seq OWNED BY public.contacts.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection character varying(255) NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO sail;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO sail;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: grade_stage; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.grade_stage (
    id bigint NOT NULL,
    grade_id bigint NOT NULL,
    stage_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grade_stage OWNER TO sail;

--
-- Name: grade_stage_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.grade_stage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.grade_stage_id_seq OWNER TO sail;

--
-- Name: grade_stage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.grade_stage_id_seq OWNED BY public.grade_stage.id;


--
-- Name: grade_subject; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.grade_subject (
    id bigint NOT NULL,
    grade_id bigint NOT NULL,
    subject_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grade_subject OWNER TO sail;

--
-- Name: grade_subject_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.grade_subject_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.grade_subject_id_seq OWNER TO sail;

--
-- Name: grade_subject_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.grade_subject_id_seq OWNED BY public.grade_subject.id;


--
-- Name: grades; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.grades (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    name_ar character varying(255) NOT NULL,
    level_order integer DEFAULT 0 NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.grades OWNER TO sail;

--
-- Name: grades_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.grades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.grades_id_seq OWNER TO sail;

--
-- Name: grades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.grades_id_seq OWNED BY public.grades.id;


--
-- Name: interactions; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.interactions (
    id bigint NOT NULL,
    lead_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    date date NOT NULL,
    summary text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    contact_id bigint
);


ALTER TABLE public.interactions OWNER TO sail;

--
-- Name: interactions_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.interactions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.interactions_id_seq OWNER TO sail;

--
-- Name: interactions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.interactions_id_seq OWNED BY public.interactions.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO sail;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO sail;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO sail;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: leads; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.leads (
    id bigint NOT NULL,
    "nameEn" character varying(255) NOT NULL,
    "nameAr" character varying(255) NOT NULL,
    email character varying(255),
    phone character varying(255),
    nationality character varying(255) DEFAULT 'Egyptian'::character varying NOT NULL,
    national_id character varying(14),
    passport_no character varying(255),
    birth_date date,
    status character varying(255) DEFAULT 'New'::character varying NOT NULL,
    source character varying(255),
    notes text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    parent_id bigint,
    grade_id bigint,
    religion character varying(255),
    gender character varying(255),
    second_language_subject_id bigint,
    categories jsonb DEFAULT '[]'::jsonb NOT NULL,
    mother_id bigint
);


ALTER TABLE public.leads OWNER TO sail;

--
-- Name: leads_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.leads_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.leads_id_seq OWNER TO sail;

--
-- Name: leads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.leads_id_seq OWNED BY public.leads.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO sail;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO sail;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO sail;

--
-- Name: schools; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.schools (
    id bigint NOT NULL,
    "nameEn" character varying(255) NOT NULL,
    "nameAr" character varying(255) NOT NULL,
    address text,
    phone character varying(255),
    email character varying(255),
    website character varying(255),
    logo character varying(255),
    principal_name character varying(255),
    mission text,
    vision text,
    social_facebook character varying(255),
    social_twitter character varying(255),
    social_instagram character varying(255),
    social_linkedin character varying(255),
    established_year integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.schools OWNER TO sail;

--
-- Name: schools_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.schools_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.schools_id_seq OWNER TO sail;

--
-- Name: schools_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.schools_id_seq OWNED BY public.schools.id;


--
-- Name: sections; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.sections (
    id bigint NOT NULL,
    grade_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    name_ar character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.sections OWNER TO sail;

--
-- Name: sections_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.sections_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sections_id_seq OWNER TO sail;

--
-- Name: sections_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.sections_id_seq OWNED BY public.sections.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO sail;

--
-- Name: stages; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.stages (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    name_ar character varying(255) NOT NULL,
    level_order integer DEFAULT 0 NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.stages OWNER TO sail;

--
-- Name: stages_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.stages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.stages_id_seq OWNER TO sail;

--
-- Name: stages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.stages_id_seq OWNED BY public.stages.id;


--
-- Name: students; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.students (
    id bigint NOT NULL,
    contact_id bigint NOT NULL,
    grade_id bigint NOT NULL,
    section_id bigint,
    second_language_id bigint,
    government_code character varying(255),
    seat_no character varying(255),
    secret_code character varying(255),
    father_id bigint,
    mother_id bigint,
    guardian character varying(255) DEFAULT 'father'::character varying NOT NULL,
    photo character varying(255),
    age_at_october integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.students OWNER TO sail;

--
-- Name: students_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.students_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.students_id_seq OWNER TO sail;

--
-- Name: students_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.students_id_seq OWNED BY public.students.id;


--
-- Name: subjects; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.subjects (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    name_ar character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    parent_id bigint,
    is_main boolean DEFAULT true NOT NULL,
    is_religion_based boolean DEFAULT false NOT NULL,
    religion character varying(255)
);


ALTER TABLE public.subjects OWNER TO sail;

--
-- Name: subjects_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.subjects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.subjects_id_seq OWNER TO sail;

--
-- Name: subjects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.subjects_id_seq OWNED BY public.subjects.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255) DEFAULT 'admin'::character varying NOT NULL
);


ALTER TABLE public.users OWNER TO sail;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO sail;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: contacts id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts ALTER COLUMN id SET DEFAULT nextval('public.contacts_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: grade_stage id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_stage ALTER COLUMN id SET DEFAULT nextval('public.grade_stage_id_seq'::regclass);


--
-- Name: grade_subject id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_subject ALTER COLUMN id SET DEFAULT nextval('public.grade_subject_id_seq'::regclass);


--
-- Name: grades id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grades ALTER COLUMN id SET DEFAULT nextval('public.grades_id_seq'::regclass);


--
-- Name: interactions id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.interactions ALTER COLUMN id SET DEFAULT nextval('public.interactions_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: leads id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads ALTER COLUMN id SET DEFAULT nextval('public.leads_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: schools id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.schools ALTER COLUMN id SET DEFAULT nextval('public.schools_id_seq'::regclass);


--
-- Name: sections id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.sections ALTER COLUMN id SET DEFAULT nextval('public.sections_id_seq'::regclass);


--
-- Name: stages id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.stages ALTER COLUMN id SET DEFAULT nextval('public.stages_id_seq'::regclass);


--
-- Name: students id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students ALTER COLUMN id SET DEFAULT nextval('public.students_id_seq'::regclass);


--
-- Name: subjects id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.subjects ALTER COLUMN id SET DEFAULT nextval('public.subjects_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.cache (key, value, expiration) FROM stdin;
laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer	i:1780781632;	1780781632
laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab	i:1;	1780781632
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.contacts (id, "nameEn", "nameAr", email, phone, nationality, religion, gender, national_id, passport_no, birth_date, status, source, notes, parent_id, created_at, updated_at, categories, mother_id) FROM stdin;
6	Heba Mahmoud Seddik Awad	هبة محمود صديق عوض	Heba@kashmos.com	+2011183	Egyptian	Muslim	Female	28412240100000	\N	1984-12-24	Active	\N	\N	\N	2026-06-06 11:36:07	2026-06-06 11:36:07	["Parent"]	\N
7	Mahmoud Ayman Medhat Mohamed	محمود أيمن مدحت محمد	mamo@kashmos.com	+2015500000	Egyptian	Muslim	Male	31102210500753	\N	2011-02-21	Active	\N	\N	5	2026-06-06 11:36:07	2026-06-06 11:36:07	["Student"]	6
8	Fatemah ElZahraa Ayman Medhat Mohamed	فاطمة الزهراء أيمن مدحت محمد	tema@kashmos.com	+20111111	Egyptian	Muslim	Female	31403030107123	\N	2014-03-03	Active	\N	\N	5	2026-06-06 11:36:12	2026-06-06 11:36:12	["Student"]	6
5	Ayman Medhat Mohamed Omar	أيمن مدحت محمد عمر	kashmos@outlook.com	+201012872168	Egyptian	Muslim	Male	28205120103799	\N	1982-05-12	Active	\N	\N	\N	2026-06-06 11:36:07	2026-06-06 19:50:50	["Parent", "Employee"]	\N
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: grade_stage; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.grade_stage (id, grade_id, stage_id, created_at, updated_at) FROM stdin;
16	57	5	\N	\N
17	58	5	\N	\N
18	59	5	\N	\N
19	60	6	\N	\N
20	61	6	\N	\N
21	62	6	\N	\N
22	63	6	\N	\N
23	64	6	\N	\N
24	65	6	\N	\N
25	66	7	\N	\N
26	67	7	\N	\N
27	68	7	\N	\N
28	69	8	\N	\N
29	70	8	\N	\N
30	71	8	\N	\N
\.


--
-- Data for Name: grade_subject; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.grade_subject (id, grade_id, subject_id, created_at, updated_at) FROM stdin;
1	57	1	\N	\N
2	57	9	\N	\N
3	57	10	\N	\N
4	58	1	\N	\N
5	58	9	\N	\N
6	58	10	\N	\N
7	59	1	\N	\N
8	59	9	\N	\N
9	59	10	\N	\N
10	60	1	\N	\N
11	60	9	\N	\N
12	60	10	\N	\N
13	61	1	\N	\N
14	61	9	\N	\N
15	61	10	\N	\N
16	62	1	\N	\N
17	62	9	\N	\N
18	62	10	\N	\N
19	63	1	\N	\N
20	63	9	\N	\N
21	63	10	\N	\N
22	64	1	\N	\N
23	64	9	\N	\N
24	64	10	\N	\N
25	65	1	\N	\N
26	65	9	\N	\N
27	65	10	\N	\N
28	66	1	\N	\N
29	66	9	\N	\N
30	66	10	\N	\N
31	67	1	\N	\N
32	67	9	\N	\N
33	67	10	\N	\N
34	68	1	\N	\N
35	68	9	\N	\N
36	68	10	\N	\N
37	69	1	\N	\N
38	69	9	\N	\N
39	69	10	\N	\N
40	70	1	\N	\N
41	70	9	\N	\N
42	70	10	\N	\N
43	71	1	\N	\N
44	71	9	\N	\N
45	71	10	\N	\N
\.


--
-- Data for Name: grades; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.grades (id, name, name_ar, level_order, description, created_at, updated_at) FROM stdin;
57	Pre-KG	ما قبل الروضة	0	Pre-Kindergarten — early learning foundation	2026-06-06 07:56:12	2026-06-06 07:56:12
58	KG1	أولى رياض أطفال	0	Kindergarten 1 — ages 4–5	2026-06-06 07:56:12	2026-06-06 07:56:12
59	KG2	ثانية رياض أطفال	0	Kindergarten 2 — ages 5–6	2026-06-06 07:56:12	2026-06-06 07:56:12
60	Grade 1	أولى إبتدائى	1	First grade — basics of reading, writing, and arithmetic	2026-06-06 07:56:12	2026-06-06 07:56:12
61	Grade 2	ثانية إبتدائى	1	Second grade — building literacy and numeracy	2026-06-06 07:56:12	2026-06-06 07:56:12
62	Grade 3	ثالثة إبتدائى	1	Third grade — introduction to science and social studies	2026-06-06 07:56:12	2026-06-06 07:56:12
63	Grade 4	رابعة إبتدائى	1	Fourth grade — expanded subjects and critical thinking	2026-06-06 07:56:12	2026-06-06 07:56:12
64	Grade 5	خامسة إبتدائى	1	Fifth grade — preparing for middle school transition	2026-06-06 07:56:12	2026-06-06 07:56:12
65	Grade 6	سادسة إبتدائى	1	Sixth grade — final year of primary education	2026-06-06 07:56:12	2026-06-06 07:56:12
66	Grade 7	أولى إعدادى	2	Seventh grade — first year of preparatory/middle school	2026-06-06 07:56:12	2026-06-06 07:56:12
67	Grade 8	ثانية إعدادى	2	Eighth grade — deeper exploration of STEM and humanities	2026-06-06 07:56:12	2026-06-06 07:56:12
68	Grade 9	ثالثة إعدادى	2	Ninth grade — final preparatory year before high school	2026-06-06 07:56:12	2026-06-06 07:56:12
69	Grade 10	أولى ثانوى	3	Tenth grade — secondary school foundation year	2026-06-06 07:56:12	2026-06-06 07:56:12
70	Grade 11	ثانية ثانوى	3	Eleventh grade — academic specialization begins	2026-06-06 07:56:12	2026-06-06 07:56:12
71	Grade 12	ثالثة ثانوى	3	Twelfth grade — final year, graduation and university preparation	2026-06-06 07:56:12	2026-06-06 07:56:12
\.


--
-- Data for Name: interactions; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.interactions (id, lead_id, type, date, summary, created_at, updated_at, contact_id) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: leads; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.leads (id, "nameEn", "nameAr", email, phone, nationality, national_id, passport_no, birth_date, status, source, notes, created_at, updated_at, parent_id, grade_id, religion, gender, second_language_subject_id, categories, mother_id) FROM stdin;
1	Ayman Medhat Mohamed Omar	أيمن مدحت محمد عمر	kashmos@outlook.com	+201012872168	Egyptian	28205120103799	\N	1982-05-12	Accepted	\N	\N	2026-06-06 10:45:11	2026-06-06 11:36:07	\N	\N	Muslim	Male	\N	["Parent"]	\N
3	Heba Mahmoud Seddik Awad	هبة محمود صديق عوض	Heba@kashmos.com	+2011183	Egyptian	28412240100000	\N	1984-12-24	Accepted	\N	\N	2026-06-06 10:45:20	2026-06-06 11:36:07	\N	\N	Muslim	Female	\N	["Parent"]	\N
2	Mahmoud Ayman Medhat Mohamed	محمود أيمن مدحت محمد	mamo@kashmos.com	+2015500000	Egyptian	31102210500753	\N	2011-02-21	Accepted	\N	\N	2026-06-06 10:45:15	2026-06-06 11:36:07	1	67	Muslim	Male	14	["Student"]	3
4	Fatemah ElZahraa Ayman Medhat Mohamed	فاطمة الزهراء أيمن مدحت محمد	tema@kashmos.com	+20111111	Egyptian	31403030107123	\N	2014-03-03	Accepted	\N	\N	2026-06-06 11:35:56	2026-06-06 11:36:12	1	65	Muslim	Female	\N	["Student"]	3
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_06_04_174328_create_leads_table	1
5	2026_06_04_174329_create_interactions_table	1
6	2026_06_04_183913_add_category_to_leads_table	2
7	2026_06_04_184706_add_parent_id_to_leads_table	3
8	2026_06_04_191845_create_grades_table	4
9	2026_06_04_191850_add_grade_id_to_leads_table	4
10	2026_06_05_000001_create_subjects_table	5
11	2026_06_05_000002_create_sections_table	6
12	2026_06_05_120000_add_leads_indexes	7
13	2026_06_05_155647_add_religion_and_gender_to_leads_table	8
14	2026_06_05_155650_add_branch_fields_to_subjects_table	8
15	2026_06_05_155651_create_grade_subject_table	8
16	2026_06_05_162812_add_second_language_subject_id_to_leads_table	9
17	2026_06_05_193500_create_contacts_table	10
18	2026_06_05_193600_add_contact_id_to_interactions_table	10
19	2026_06_05_193700_add_contacts_indexes	10
20	2026_06_06_000001_add_categories_to_leads_and_contacts	11
21	2026_06_06_000002_add_mother_id_to_leads_and_contacts	12
22	2026_06_06_000003_create_stages_table	13
23	2026_06_06_000004_create_grade_stage_table	13
24	2026_06_06_000005_create_schools_table	14
27	2026_06_06_000006_add_role_to_users_table	15
28	2026_06_06_000007_create_students_table	15
29	2026_06_06_000008_remove_student_fields_from_contacts	15
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: schools; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.schools (id, "nameEn", "nameAr", address, phone, email, website, logo, principal_name, mission, vision, social_facebook, social_twitter, social_instagram, social_linkedin, established_year, created_at, updated_at) FROM stdin;
1	Kashmos International School	مدرسة كاشموس الدولية	390	+201012872168	info@kashmos.com	https://www.kashmos.com	/storage/school-logos/ljVnR3HdveN0PYcIWTDEK6Xf9ml9tGyQhiQtH3qF.jpg	Mrs. Heba Mahmoud	Kashmos International school is committed to providing an excellent, globally-minded education that nurtures every student’s unique potential. We inspire our diverse community of learners to become inquiring, knowledgeable, and caring global citizens who contribute to a better and more peaceful world through intercultural understanding and respect.\n\nThrough a student-centered, holistic approach, we:\n\n    Inspire students to take proactive roles as responsible global citizens\n\n    Support every learner to achieve their individual potential and become well-rounded, lifelong learners\n\n    Nourish minds and spirits in a safe, respectful, and caring environment\n\n    Empathize with diverse cultures and foster intercultural understanding\n\n    Prepare today’s learners to confidently embrace challenges as adaptable, empathetic leaders for a sustainable future\n\nOur innovative pedagogy encourages students to respect each other and the environment, communicate through active dialogue, and create the foundations of a collaborative society. We deliver world-class education with a global perspective, outstanding teaching methodology, and an ethos of integrity for students from diverse backgrounds.	Kashmos International school  visions to be a leading international school recognized globally for fostering academic excellence, intercultural understanding, and ethical leadership. We aspire to create a learning community where every student is empowered to thrive as a confident, compassionate, and innovative global citizen ready to shape a sustainable and peaceful future.\n\nWe envision:\n\n    A school where diversity is celebrated and every student feels valued, respected, and inspired to reach their full potential\n\n    World-class education that blends cutting-edge pedagogy with timeless values, preparing learners for the challenges of tomorrow\n\n    Lifelong learners who think critically, act creatively, and communicate with clarity and empathy across cultures\n\n    A collaborative community of students, families, teachers, and partners united by shared purpose and mutual respect\n\n    An innovative learning environment that integrates technology, sustainability, and global perspectives into every aspect of education\n\n    Ethical leaders who contribute positively to their communities and work toward a more just, equitable, and peaceful world\n\nOur vision is to set the standard for international education—where excellence meets character, and where every learner discovers their purpose and impact on the world.					2026	2026-06-06 08:42:51	2026-06-06 09:57:52
2	Kashmos International School	مدرسة كاشموس الدولية	390	+201012872168	info@kashmos.com	https://www.kashmos.com		Mrs. Heba Mahmoud	Kashmos International school is committed to providing an excellent, globally-minded education that nurtures every student’s unique potential. We inspire our diverse community of learners to become inquiring, knowledgeable, and caring global citizens who contribute to a better and more peaceful world through intercultural understanding and respect.\n\nThrough a student-centered, holistic approach, we:\n\n    Inspire students to take proactive roles as responsible global citizens\n\n    Support every learner to achieve their individual potential and become well-rounded, lifelong learners\n\n    Nourish minds and spirits in a safe, respectful, and caring environment\n\n    Empathize with diverse cultures and foster intercultural understanding\n\n    Prepare today’s learners to confidently embrace challenges as adaptable, empathetic leaders for a sustainable future\n\nOur innovative pedagogy encourages students to respect each other and the environment, communicate through active dialogue, and create the foundations of a collaborative society. We deliver world-class education with a global perspective, outstanding teaching methodology, and an ethos of integrity for students from diverse backgrounds.	Kashmos International school  visions to be a leading international school recognized globally for fostering academic excellence, intercultural understanding, and ethical leadership. We aspire to create a learning community where every student is empowered to thrive as a confident, compassionate, and innovative global citizen ready to shape a sustainable and peaceful future.\n\nWe envision:\n\n    A school where diversity is celebrated and every student feels valued, respected, and inspired to reach their full potential\n\n    World-class education that blends cutting-edge pedagogy with timeless values, preparing learners for the challenges of tomorrow\n\n    Lifelong learners who think critically, act creatively, and communicate with clarity and empathy across cultures\n\n    A collaborative community of students, families, teachers, and partners united by shared purpose and mutual respect\n\n    An innovative learning environment that integrates technology, sustainability, and global perspectives into every aspect of education\n\n    Ethical leaders who contribute positively to their communities and work toward a more just, equitable, and peaceful world\n\nOur vision is to set the standard for international education—where excellence meets character, and where every learner discovers their purpose and impact on the world.					2026	2026-06-06 08:43:00	2026-06-06 09:48:05
\.


--
-- Data for Name: sections; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.sections (id, grade_id, name, name_ar, created_at, updated_at) FROM stdin;
87	57	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
88	57	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
89	58	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
90	58	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
91	59	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
92	59	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
93	60	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
94	60	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
95	61	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
96	61	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
97	62	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
98	62	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
99	63	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
100	63	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
101	64	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
102	64	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
103	65	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
104	65	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
105	66	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
106	66	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
109	68	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
110	68	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
111	69	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
112	69	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
113	70	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
114	70	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
115	71	A	أ	2026-06-06 07:57:55	2026-06-06 07:57:55
116	71	B	ب	2026-06-06 07:57:55	2026-06-06 07:57:55
117	65	C	ت	2026-06-06 07:58:41	2026-06-06 07:58:41
127	67	A	أ	2026-06-06 08:05:34	2026-06-06 08:05:34
128	67	B	ب	2026-06-06 08:05:34	2026-06-06 08:05:34
129	67	C	ت	2026-06-06 08:05:34	2026-06-06 08:05:34
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
6DqMTkOCep5nWOT2UrhVeU0wW9PBa4UaQ7TflCSI	1	172.18.0.1	Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0	eyJfdG9rZW4iOiJJZHl6QWlIVkt2Z3c0MGw0NEpUMzJqdnV2Tmt2azl3N1kyWnZrWXM0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=	1780784437
\.


--
-- Data for Name: stages; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.stages (id, name, name_ar, level_order, description, created_at, updated_at) FROM stdin;
5	Pre-K & KG	مرحلة ما قبل الروضة ورياض الأطفال	0	Early years foundation — Pre-KG, KG1, KG2	2026-06-06 07:56:12	2026-06-06 07:56:12
6	Primary	المرحلة الإبتدائية	1	Primary education — Grades 1 through 6	2026-06-06 07:56:12	2026-06-06 07:56:12
7	Preparatory	المرحلة الإعدادية	2	Middle school — Grades 7 through 9	2026-06-06 07:56:12	2026-06-06 07:56:12
8	Secondary	المرحلة الثانوية	3	High school — Grades 10 through 12	2026-06-06 07:56:12	2026-06-06 07:56:12
\.


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.students (id, contact_id, grade_id, section_id, second_language_id, government_code, seat_no, secret_code, father_id, mother_id, guardian, photo, age_at_october, created_at, updated_at) FROM stdin;
1	7	67	128	14	487039457	\N	\N	5	6	father	students/5KpAmJGACR3ND9nuTfQ0IPikpqYrUDqQ4YRd3FAU.jpg	15	2026-06-06 21:03:06	2026-06-06 21:31:48
2	8	64	102	13	4848911674	\N	\N	5	6	father	students/0pcRZkMLCBiAPjvkHXcylcfrBCAjQDqi3a2qH2uC.jpg	12	2026-06-06 21:03:06	2026-06-06 22:18:41
\.


--
-- Data for Name: subjects; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.subjects (id, name, name_ar, description, created_at, updated_at, parent_id, is_main, is_religion_based, religion) FROM stdin;
1	Mathematics	الرياضيات	Core mathematics covering numbers, operations, and problem-solving	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
2	Algebra	الجبر	Algebraic expressions, equations, and functions	2026-06-06 07:56:12	2026-06-06 07:56:12	1	t	f	\N
3	Geometry	الهندسة	Shapes, angles, proofs, and spatial reasoning	2026-06-06 07:56:12	2026-06-06 07:56:12	1	t	f	\N
4	Trigonometry	علم المثلثات	Triangles, trigonometric functions, and identities	2026-06-06 07:56:12	2026-06-06 07:56:12	1	f	f	\N
5	Science	العلوم	General science foundation covering natural phenomena	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
6	Physics	الفيزياء	Matter, energy, motion, and fundamental forces	2026-06-06 07:56:12	2026-06-06 07:56:12	5	t	f	\N
7	Chemistry	الكيمياء	Elements, compounds, reactions, and chemical processes	2026-06-06 07:56:12	2026-06-06 07:56:12	5	t	f	\N
8	Biology	الأحياء	Living organisms, cells, genetics, and ecosystems	2026-06-06 07:56:12	2026-06-06 07:56:12	5	t	f	\N
9	Arabic Language	اللغة العربية	Arabic reading, writing, grammar, and literature	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
10	English OL	اللغة الإنجليزية	English reading, writing, grammar, and comprehension (Ordinary Level)	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
11	English AL	اللغة الإنجليزية (متقدم)	Advanced English literature, composition, and critical analysis (Advanced Level)	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
12	Second Language	اللغة الثانية	Students choose one foreign language from the available options	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
13	French	الفرنسية	French language — speaking, writing, and culture	2026-06-06 07:56:12	2026-06-06 07:56:12	12	f	f	\N
14	German	الألمانية	German language — speaking, writing, and culture	2026-06-06 07:56:12	2026-06-06 07:56:12	12	f	f	\N
15	Spanish	الإسبانية	Spanish language — speaking, writing, and culture	2026-06-06 07:56:12	2026-06-06 07:56:12	12	f	f	\N
16	Italian	الإيطالية	Italian language — speaking, writing, and culture	2026-06-06 07:56:12	2026-06-06 07:56:12	12	f	f	\N
17	Religious Education	التربية الدينية	Splits into Islamic and Christian tracks based on student religion	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	t	\N
18	Islamic Education	التربية الإسلامية	Quran, Hadith, Fiqh, and Islamic studies for Muslim students	2026-06-06 07:56:12	2026-06-06 07:56:12	17	t	f	Muslim
19	Christian Education	التربية المسيحية	Bible studies, Christian ethics, and religious teachings for Christian students	2026-06-06 07:56:12	2026-06-06 07:56:12	17	t	f	Christian
20	Social Studies	الدراسات الاجتماعية	Study of human society, history, and geography	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	t	f	\N
21	History	التاريخ	World and national history, civilizations, and historical analysis	2026-06-06 07:56:12	2026-06-06 07:56:12	20	t	f	\N
22	Geography	الجغرافيا	Physical and human geography, maps, and environmental studies	2026-06-06 07:56:12	2026-06-06 07:56:12	20	t	f	\N
23	Physical Education	التربية البدنية	Sports, fitness, motor skills, and healthy lifestyle	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	f	f	\N
24	Art	التربية الفنية	Visual arts, drawing, painting, and creative expression	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	f	f	\N
25	Computer Science	علوم الحاسب	Computers, programming, digital literacy, and technology skills	2026-06-06 07:56:12	2026-06-06 07:56:12	\N	f	f	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) FROM stdin;
1	Admin	admin@school.com	\N	$2y$12$gN5iRs90en1H3jEbmeVaYufW39.tjUnTnPhyxnaL8LIJ/sEuuYxYa	\N	2026-06-04 18:14:14	2026-06-04 18:14:14	admin
2	HR	hr@kashmos.com	2026-06-06 07:56:12	$2y$12$cwD5eaw3RrSERJV573D5SuAVpnMJLrxv0i6naIhY8nEpnQbCUY61G	az7m4L6kN843T4L3u3uWBZINt5dUrk8tVaMIvCJ31UzzG3giS0ftpruOyIb7	2026-06-06 07:56:12	2026-06-06 22:15:05	hr
3	StudAff	Student.affairs@kashmos.com	\N	$2y$12$6R0Eaw8k95GIGgHhXZDLDussomKPWc7kwL/u9l8VzhMvKXZUoGiHu	\N	2026-06-06 18:34:03	2026-06-06 22:15:15	student_affairs
4	Teacher	teacher@kashmos.com	\N	$2y$12$sjQdc2iacdhoxHToXfWhrejPwNEm6bSKRD8KrgjHWGNszCJmzIjN2	\N	2026-06-06 19:19:44	2026-06-06 22:15:27	academic
5	Control	control@kashmos.com	\N	$2y$12$gMtA0uvFRVOYJMaI6adBjeJbxqzkbAFi8A2rgu/iTvy/DAorzFtte	\N	2026-06-06 22:20:01	2026-06-06 22:20:01	control
\.


--
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.contacts_id_seq', 8, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: grade_stage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grade_stage_id_seq', 30, true);


--
-- Name: grade_subject_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grade_subject_id_seq', 45, true);


--
-- Name: grades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grades_id_seq', 71, true);


--
-- Name: interactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.interactions_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: leads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.leads_id_seq', 4, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.migrations_id_seq', 29, true);


--
-- Name: schools_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.schools_id_seq', 2, true);


--
-- Name: sections_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.sections_id_seq', 129, true);


--
-- Name: stages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.stages_id_seq', 8, true);


--
-- Name: students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.students_id_seq', 2, true);


--
-- Name: subjects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.subjects_id_seq', 25, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.users_id_seq', 5, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: contacts contacts_national_id_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_national_id_unique UNIQUE (national_id);


--
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: grade_stage grade_stage_grade_id_stage_id_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_stage
    ADD CONSTRAINT grade_stage_grade_id_stage_id_unique UNIQUE (grade_id, stage_id);


--
-- Name: grade_stage grade_stage_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_stage
    ADD CONSTRAINT grade_stage_pkey PRIMARY KEY (id);


--
-- Name: grade_subject grade_subject_grade_id_subject_id_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_subject
    ADD CONSTRAINT grade_subject_grade_id_subject_id_unique UNIQUE (grade_id, subject_id);


--
-- Name: grade_subject grade_subject_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_subject
    ADD CONSTRAINT grade_subject_pkey PRIMARY KEY (id);


--
-- Name: grades grades_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grades
    ADD CONSTRAINT grades_pkey PRIMARY KEY (id);


--
-- Name: interactions interactions_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.interactions
    ADD CONSTRAINT interactions_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: leads leads_national_id_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_national_id_unique UNIQUE (national_id);


--
-- Name: leads leads_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: schools schools_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.schools
    ADD CONSTRAINT schools_pkey PRIMARY KEY (id);


--
-- Name: sections sections_grade_id_name_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.sections
    ADD CONSTRAINT sections_grade_id_name_unique UNIQUE (grade_id, name);


--
-- Name: sections sections_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.sections
    ADD CONSTRAINT sections_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: stages stages_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.stages
    ADD CONSTRAINT stages_pkey PRIMARY KEY (id);


--
-- Name: students students_contact_id_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_contact_id_unique UNIQUE (contact_id);


--
-- Name: students students_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_pkey PRIMARY KEY (id);


--
-- Name: subjects subjects_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.subjects
    ADD CONSTRAINT subjects_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: contacts_parent_id_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX contacts_parent_id_index ON public.contacts USING btree (parent_id);


--
-- Name: failed_jobs_connection_queue_failed_at_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX failed_jobs_connection_queue_failed_at_index ON public.failed_jobs USING btree (connection, queue, failed_at);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: leads_parent_id_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX leads_parent_id_index ON public.leads USING btree (parent_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: contacts contacts_mother_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_mother_id_foreign FOREIGN KEY (mother_id) REFERENCES public.contacts(id) ON DELETE SET NULL;


--
-- Name: contacts contacts_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.contacts(id) ON DELETE SET NULL;


--
-- Name: grade_stage grade_stage_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_stage
    ADD CONSTRAINT grade_stage_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE CASCADE;


--
-- Name: grade_stage grade_stage_stage_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_stage
    ADD CONSTRAINT grade_stage_stage_id_foreign FOREIGN KEY (stage_id) REFERENCES public.stages(id) ON DELETE CASCADE;


--
-- Name: grade_subject grade_subject_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_subject
    ADD CONSTRAINT grade_subject_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE CASCADE;


--
-- Name: grade_subject grade_subject_subject_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.grade_subject
    ADD CONSTRAINT grade_subject_subject_id_foreign FOREIGN KEY (subject_id) REFERENCES public.subjects(id) ON DELETE CASCADE;


--
-- Name: interactions interactions_contact_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.interactions
    ADD CONSTRAINT interactions_contact_id_foreign FOREIGN KEY (contact_id) REFERENCES public.contacts(id) ON DELETE CASCADE;


--
-- Name: interactions interactions_lead_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.interactions
    ADD CONSTRAINT interactions_lead_id_foreign FOREIGN KEY (lead_id) REFERENCES public.leads(id) ON DELETE CASCADE;


--
-- Name: leads leads_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE SET NULL;


--
-- Name: leads leads_mother_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_mother_id_foreign FOREIGN KEY (mother_id) REFERENCES public.leads(id) ON DELETE SET NULL;


--
-- Name: leads leads_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.leads(id) ON DELETE SET NULL;


--
-- Name: leads leads_second_language_subject_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.leads
    ADD CONSTRAINT leads_second_language_subject_id_foreign FOREIGN KEY (second_language_subject_id) REFERENCES public.subjects(id) ON DELETE SET NULL;


--
-- Name: sections sections_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.sections
    ADD CONSTRAINT sections_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE CASCADE;


--
-- Name: students students_contact_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_contact_id_foreign FOREIGN KEY (contact_id) REFERENCES public.contacts(id) ON DELETE CASCADE;


--
-- Name: students students_father_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_father_id_foreign FOREIGN KEY (father_id) REFERENCES public.contacts(id) ON DELETE SET NULL;


--
-- Name: students students_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE CASCADE;


--
-- Name: students students_mother_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_mother_id_foreign FOREIGN KEY (mother_id) REFERENCES public.contacts(id) ON DELETE SET NULL;


--
-- Name: students students_second_language_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_second_language_id_foreign FOREIGN KEY (second_language_id) REFERENCES public.subjects(id) ON DELETE SET NULL;


--
-- Name: students students_section_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_section_id_foreign FOREIGN KEY (section_id) REFERENCES public.sections(id) ON DELETE SET NULL;


--
-- Name: subjects subjects_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.subjects
    ADD CONSTRAINT subjects_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.subjects(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict fxNQX6toGIV3uNZRxXQsxbtzw36q0qhRE6RE0Zj1logm92P6EV1ajwOfEfMxHMY

