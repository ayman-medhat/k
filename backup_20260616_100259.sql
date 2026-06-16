--
-- PostgreSQL database dump
--

\restrict 0e8cCc5oqsGHkR1DXReI5whhnWEMg1qZgNguSidjKSoHIwUG9XIk75G5POSHY84

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
-- Name: academic_years; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.academic_years (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    is_current boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.academic_years OWNER TO sail;

--
-- Name: academic_years_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.academic_years_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.academic_years_id_seq OWNER TO sail;

--
-- Name: academic_years_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.academic_years_id_seq OWNED BY public.academic_years.id;


--
-- Name: attendance; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.attendance (
    id bigint NOT NULL,
    student_id bigint NOT NULL,
    section_id bigint NOT NULL,
    date date NOT NULL,
    status character varying(255) NOT NULL,
    notes text,
    created_by bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT attendance_status_check CHECK (((status)::text = ANY ((ARRAY['present'::character varying, 'absent'::character varying, 'late'::character varying, 'excused'::character varying])::text[])))
);


ALTER TABLE public.attendance OWNER TO sail;

--
-- Name: attendance_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.attendance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.attendance_id_seq OWNER TO sail;

--
-- Name: attendance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.attendance_id_seq OWNED BY public.attendance.id;


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
-- Name: contact_documents; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.contact_documents (
    id bigint NOT NULL,
    contact_id bigint NOT NULL,
    file_path character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    file_type character varying(255) NOT NULL,
    notes character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.contact_documents OWNER TO sail;

--
-- Name: contact_documents_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.contact_documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contact_documents_id_seq OWNER TO sail;

--
-- Name: contact_documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.contact_documents_id_seq OWNED BY public.contact_documents.id;


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
    mother_id bigint,
    nationality_ar character varying(255),
    religion_ar character varying(255),
    gender_ar character varying(255),
    notes_ar text,
    source_ar character varying(255),
    status_ar character varying(255),
    photo character varying(255)
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
-- Name: enrollments; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.enrollments (
    id bigint NOT NULL,
    student_id bigint NOT NULL,
    academic_year_id bigint NOT NULL,
    grade_id bigint NOT NULL,
    section_id bigint,
    enrolled_at date NOT NULL,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT enrollments_status_check CHECK (((status)::text = ANY ((ARRAY['active'::character varying, 'transferred'::character varying, 'graduated'::character varying, 'dropped'::character varying])::text[])))
);


ALTER TABLE public.enrollments OWNER TO sail;

--
-- Name: enrollments_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.enrollments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.enrollments_id_seq OWNER TO sail;

--
-- Name: enrollments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.enrollments_id_seq OWNED BY public.enrollments.id;


--
-- Name: exam_records; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.exam_records (
    id bigint NOT NULL,
    exam_id bigint NOT NULL,
    student_id bigint NOT NULL,
    subject_id bigint NOT NULL,
    marks_obtained numeric(8,2),
    notes text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.exam_records OWNER TO sail;

--
-- Name: exam_records_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.exam_records_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.exam_records_id_seq OWNER TO sail;

--
-- Name: exam_records_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.exam_records_id_seq OWNED BY public.exam_records.id;


--
-- Name: exam_subject; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.exam_subject (
    exam_id bigint NOT NULL,
    subject_id bigint NOT NULL,
    max_marks numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.exam_subject OWNER TO sail;

--
-- Name: exams; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.exams (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    grade_id bigint NOT NULL,
    term_id bigint NOT NULL,
    date date NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.exams OWNER TO sail;

--
-- Name: exams_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.exams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.exams_id_seq OWNER TO sail;

--
-- Name: exams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.exams_id_seq OWNED BY public.exams.id;


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
    mother_id bigint,
    nationality_ar character varying(255),
    national_id_ar character varying(14),
    passport_no_ar character varying(255),
    status_ar character varying(255),
    source_ar character varying(255),
    notes_ar text,
    religion_ar character varying(255),
    gender_ar character varying(255),
    photo character varying(255)
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
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name text NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO sail;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO sail;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


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
-- Name: terms; Type: TABLE; Schema: public; Owner: sail
--

CREATE TABLE public.terms (
    id bigint NOT NULL,
    academic_year_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    is_current boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.terms OWNER TO sail;

--
-- Name: terms_id_seq; Type: SEQUENCE; Schema: public; Owner: sail
--

CREATE SEQUENCE public.terms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.terms_id_seq OWNER TO sail;

--
-- Name: terms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sail
--

ALTER SEQUENCE public.terms_id_seq OWNED BY public.terms.id;


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
    role character varying(255) DEFAULT 'admin'::character varying NOT NULL,
    lead_id bigint,
    locale character varying(5) DEFAULT 'en'::character varying NOT NULL
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
-- Name: academic_years id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.academic_years ALTER COLUMN id SET DEFAULT nextval('public.academic_years_id_seq'::regclass);


--
-- Name: attendance id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance ALTER COLUMN id SET DEFAULT nextval('public.attendance_id_seq'::regclass);


--
-- Name: contact_documents id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contact_documents ALTER COLUMN id SET DEFAULT nextval('public.contact_documents_id_seq'::regclass);


--
-- Name: contacts id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contacts ALTER COLUMN id SET DEFAULT nextval('public.contacts_id_seq'::regclass);


--
-- Name: enrollments id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments ALTER COLUMN id SET DEFAULT nextval('public.enrollments_id_seq'::regclass);


--
-- Name: exam_records id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records ALTER COLUMN id SET DEFAULT nextval('public.exam_records_id_seq'::regclass);


--
-- Name: exams id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exams ALTER COLUMN id SET DEFAULT nextval('public.exams_id_seq'::regclass);


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
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


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
-- Name: terms id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.terms ALTER COLUMN id SET DEFAULT nextval('public.terms_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: academic_years; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.academic_years (id, name, start_date, end_date, is_current, created_at, updated_at) FROM stdin;
12	2024/2025	2024-09-01	2025-06-30	f	2026-06-14 02:55:33	2026-06-14 02:55:33
13	2025/2026	2025-09-01	2026-06-30	f	2026-06-14 02:55:33	2026-06-14 02:55:33
14	2026/2027	2026-09-01	2027-06-30	t	2026-06-14 02:55:33	2026-06-14 02:55:33
\.


--
-- Data for Name: attendance; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.attendance (id, student_id, section_id, date, status, notes, created_by, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.cache (key, value, expiration) FROM stdin;
laravel-cache-heba.mahmoud@kashmos.com|172.18.0.1:timer	i:1781256795;	1781256795
laravel-cache-heba.mahmoud@kashmos.com|172.18.0.1	i:1;	1781256795
laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer	i:1781373421;	1781373421
laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab	i:1;	1781373421
laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer	i:1781406501;	1781406501
laravel-cache-5c785c036466adea360111aa28563bfd556b5fba	i:1;	1781406501
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: contact_documents; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.contact_documents (id, contact_id, file_path, file_name, file_type, notes, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.contacts (id, "nameEn", "nameAr", email, phone, nationality, religion, gender, national_id, passport_no, birth_date, status, source, notes, parent_id, created_at, updated_at, categories, mother_id, nationality_ar, religion_ar, gender_ar, notes_ar, source_ar, status_ar, photo) FROM stdin;
1480	Hanaa Abrahaym	هناء إبراهيم	amany.maged524@example.com	01035014706	Egyptian	Christian	Female	\N	\N	1971-07-01	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:08:01	["Parent"]	\N	سوداني	مسيحي	أنثى	\N	توصية	نشط	\N
1481	Layla Ibrahaim	ليلى إبراهيم	Layla.Ibrahaim809@example.com	01008722699	Egyptian	Muslim	Female	\N	\N	1973-07-08	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:17:45	["Parent", "Guardian"]	\N	مصري	مسلم	أنثى	\N	توصية	نشط	\N
1497	Bashra Sayed Abedalmoula	بشرى سيد عبدالمولى	Bashra.Sayed528@example.com	01007990787	Syrian	Muslim	Female	\N	\N	1973-01-14	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 17:07:20	["Parent"]	\N	سوري	مسلم	أنثى	\N	توصية	نشط	\N
1482	Aly Nagy	علي ناجي	salma.bishara461@example.com	01059161795	Lebanese	Christian	Male	\N	\N	1982-02-06	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	لبناني	مسيحي	ذكر	\N	توصية	نشط	\N
1483	Hany Hasn	هاني حسن	samuel.saleh882@example.com	01053768407	Algerian	Muslim	Male	\N	\N	1990-06-17	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	جزائري	مسلم	ذكر	\N	توصية	نشط	\N
1484	Haba Zaky	هبة زكي	rania.hussein382@example.com	01081951719	Moroccan	Muslim	Female	\N	\N	1990-06-19	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	مغربي	مسلم	أنثى	\N	توصية	نشط	\N
1485	Ahmed Gamayl	أحمد جميل	richard.bishara575@example.com	01020310674	Yemeni	Muslim	Male	\N	\N	2000-09-14	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	يمني	مسلم	ذكر	\N	توصية	نشط	\N
1486	Maraym Garags	مريم جرجس	yasmin.hassan755@example.com	01027020583	Syrian	Muslim	Female	\N	\N	1992-07-13	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	سوري	مسلم	أنثى	\N	توصية	نشط	\N
1487	Sara Zaky	سارة زكي	nour.ali7@example.com	01075561994	Algerian	Christian	Female	\N	\N	1989-11-09	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	جزائري	مسيحي	أنثى	\N	توصية	نشط	\N
1488	Tamr Gamayl	تامر جميل	amany.bishara659@example.com	01064120321	Algerian	Muslim	Male	\N	\N	1983-11-10	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	جزائري	مسلم	ذكر	\N	توصية	نشط	\N
1489	Karaym Nagy	كريم ناجي	karim.shaker185@example.com	01059739779	Moroccan	Christian	Male	\N	\N	1995-05-17	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	مغربي	مسيحي	ذكر	\N	توصية	نشط	\N
1490	Mana Garags	منى جرجس	nadia.bishara277@example.com	01042637386	Tunisian	Muslim	Female	\N	\N	1971-11-03	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	تونسي	مسلم	أنثى	\N	توصية	نشط	\N
1491	Fatma Fahamy	فاطمة فهمي	malak.ali746@example.com	01019081157	Omani	Muslim	Female	\N	\N	1989-09-20	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	عماني	مسلم	أنثى	\N	توصية	نشط	\N
1492	Ahmed Razq	أحمد رزق	ali.ibrahim639@example.com	01029465901	Libyan	Christian	Male	\N	\N	1975-11-18	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	ليبي	مسيحي	ذكر	\N	توصية	نشط	\N
1493	Mohamed Aly	محمد علي	samuel.bishara707@example.com	01034001060	Omani	Muslim	Male	\N	\N	1971-04-05	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	عماني	مسلم	ذكر	\N	توصية	نشط	\N
1494	Ahmed Nagy	أحمد ناجي	shahd.hassan517@example.com	01037706118	Bahraini	Muslim	Male	\N	\N	1986-10-29	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	بحريني	مسلم	ذكر	\N	توصية	نشط	\N
1495	Abed Alalh Fahamy	عبد الله فهمي	sara.khaled497@example.com	01012111926	Yemeni	Muslim	Male	\N	\N	1970-09-18	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	يمني	مسلم	ذكر	\N	توصية	نشط	\N
1496	Ranya Aly	رانيا علي	laila.mansour534@example.com	01079750878	Jordanian	Christian	Female	\N	\N	1975-01-31	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	أردني	مسيحي	أنثى	\N	توصية	نشط	\N
1498	Maraym Bashra	مريم بشرى	hana.bishara48@example.com	01073331009	Egyptian	Christian	Female	\N	\N	2001-02-08	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	مصري	مسيحي	أنثى	\N	توصية	نشط	\N
1499	Nour Bashra	نور بشرى	dina.william119@example.com	01068454337	Moroccan	Christian	Female	\N	\N	1986-08-28	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	مغربي	مسيحي	أنثى	\N	توصية	نشط	\N
1500	Maraym Fahamy	مريم فهمي	mariam.mikhail197@example.com	01053080816	Saudi	Christian	Female	\N	\N	1998-10-14	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	سعودي	مسيحي	أنثى	\N	توصية	نشط	\N
1501	Dayna Fahamy	دينا فهمي	nour.ibrahim785@example.com	01039481288	Libyan	Christian	Female	\N	\N	1980-05-11	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	ليبي	مسيحي	أنثى	\N	توصية	نشط	\N
1502	Ranya Hana	رانيا حنا	yasmin.saleh334@example.com	01083135912	Qatari	Christian	Female	\N	\N	1972-05-04	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	قطري	مسيحي	أنثى	\N	توصية	نشط	\N
1503	Nadya Mansour	نادية منصور	mariam.nagy760@example.com	01050287712	Egyptian	Muslim	Female	\N	\N	1983-12-02	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	مصري	مسلم	أنثى	\N	توصية	نشط	\N
1504	Abrahaym Gamayl	إبراهيم جميل	samuel.ahmed755@example.com	01086750408	Tunisian	Christian	Male	\N	\N	1995-06-20	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	تونسي	مسيحي	ذكر	\N	توصية	نشط	\N
1505	Hasayn Maged	حسين ماجد	mark.maged708@example.com	01073321789	Omani	Muslim	Male	\N	\N	1990-06-09	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	عماني	مسلم	ذكر	\N	توصية	نشط	\N
1506	Haba Gamayl	هبة جميل	yasmin.girgis312@example.com	01010963043	Libyan	Christian	Female	\N	\N	1998-05-29	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	ليبي	مسيحي	أنثى	\N	توصية	نشط	\N
1507	Dayna Khaled	دينا خالد	fatma.girgis847@example.com	01082290969	Sudanese	Muslim	Female	\N	\N	2001-04-12	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	سوداني	مسلم	أنثى	\N	توصية	نشط	\N
1508	Amany Aly	أماني علي	rania.abdullah894@example.com	01070886099	Yemeni	Christian	Female	\N	\N	1976-08-05	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	يمني	مسيحي	أنثى	\N	توصية	نشط	\N
1509	Amany Oulyam	أماني وليام	james.ibrahim607@example.com	01017246324	Yemeni	Christian	Male	\N	\N	1983-07-17	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	يمني	مسيحي	ذكر	\N	توصية	نشط	\N
1478	Fatma Bashra	فاطمة بشرى	mona.fahmy933@example.com	01099303189	Saudi	Muslim	Female	\N	\N	1985-09-10	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:17:02	["Parent", "Guardian"]	\N	سعودي	مسيحي	أنثى	\N	توصية	نشط	\N
1511	Maykhaayl Ahmed	ميخائيل أحمد	malak.girgis771@example.com	01054766454	Palestinian	Christian	Male	\N	\N	1994-09-07	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	فلسطيني	مسيحي	ذكر	\N	توصية	نشط	\N
1512	Sara Hasayn	سارة حسين	laila.fahmy225@example.com	01002501338	Saudi	Muslim	Male	\N	\N	1999-08-29	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	سعودي	مسلم	ذكر	\N	توصية	نشط	\N
1513	Youhna Aly	يوحنا علي	mina.rizk232@example.com	01083572193	Iraqi	Christian	Male	\N	\N	1979-10-28	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	عراقي	مسيحي	ذكر	\N	توصية	نشط	\N
1514	Dayna Nagy	دينا ناجي	salma.mohamed149@example.com	01028471856	Algerian	Christian	Female	\N	\N	1993-01-20	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	جزائري	مسيحي	أنثى	\N	توصية	نشط	\N
1515	Malk Garags	ملك جرجس	heba.bishara898@example.com	01046871370	Syrian	Muslim	Male	\N	\N	1994-07-09	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	سوري	مسلم	ذكر	\N	توصية	نشط	\N
1516	Bayatr Abrahaym	بيتر إبراهيم	amr.ibrahim222@example.com	01071278376	Sudanese	Christian	Male	\N	\N	1977-01-03	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	سوداني	مسيحي	ذكر	\N	توصية	نشط	\N
1517	Layla Gamayl	ليلى جميل	mariam.bishara61@example.com	01010238096	Palestinian	Christian	Female	\N	\N	1996-01-22	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	فلسطيني	مسيحي	أنثى	\N	توصية	نشط	\N
1518	Nour Bashra	نور بشرى	amany.khaled925@student.example.com	01010603752	Saudi	Christian	Female	\N	\N	2016-01-12	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سعودي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1519	Malk Shakr	ملك شاكر	fatma.saleh597@student.example.com	01078643828	Egyptian	Muslim	Male	\N	\N	2015-03-07	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	مصري	مسلم	ذكر	\N	تسجيل	نشط	\N
1520	Layla Ahmed	ليلى أحمد	george.abdullah266@student.example.com	01077684747	Omani	Christian	Male	\N	\N	2014-03-29	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عماني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1521	Mana Fars	منى فارس	nour.ali957@student.example.com	01073150120	Saudi	Muslim	Female	\N	\N	2010-12-21	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سعودي	مسلم	أنثى	\N	تسجيل	نشط	\N
1522	Layla Hasayn	ليلى حسين	mona.maged818@student.example.com	01016822901	Libyan	Christian	Female	\N	\N	2017-12-07	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	ليبي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1523	Shahed Shakr	شهد شاكر	nader.rizk437@student.example.com	01069505195	Yemeni	Christian	Male	\N	\N	2013-01-12	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	يمني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1525	Amany Hasayn	أماني حسين	mark.abdullah354@student.example.com	01035086757	Emirati	Christian	Male	\N	\N	2016-03-22	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	إماراتي	مسيحي	ذكر	\N	تسجيل	نشط	\N
1526	Salma Abed Alalh	سلمى عبد الله	omar.william278@student.example.com	01099066386	Yemeni	Christian	Male	\N	\N	2021-04-26	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	يمني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1527	Haba Garags	هبة جرجس	mona.fahmy963@student.example.com	01095593318	Libyan	Christian	Female	\N	\N	2015-04-10	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	ليبي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1528	Bayatr Nagy	بيتر ناجي	john.gamil243@student.example.com	01093955052	Saudi	Muslim	Male	\N	\N	2021-08-13	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سعودي	مسلم	ذكر	\N	تسجيل	نشط	\N
1529	Dayna Abed Alalh	دينا عبد الله	robert.khaled932@student.example.com	01045600150	Egyptian	Muslim	Male	\N	\N	2008-07-03	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	مصري	مسلم	ذكر	\N	تسجيل	نشط	\N
1530	Amr Hana	عمر حنا	david.hanna188@student.example.com	01079991497	Omani	Muslim	Male	\N	\N	2008-10-10	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عماني	مسلم	ذكر	\N	تسجيل	نشط	\N
1531	Abed Alalh Amr	عبد الله عمر	mark.mansour907@student.example.com	01048919736	Omani	Muslim	Male	\N	\N	2012-10-22	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عماني	مسلم	ذكر	\N	تسجيل	نشط	\N
1532	Layla Zaky	ليلى زكي	nadia.ahmed295@student.example.com	01006836803	Omani	Muslim	Female	\N	\N	2018-06-10	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عماني	مسلم	أنثى	\N	تسجيل	نشط	\N
1533	Bayatr Abed Alalh	بيتر عبد الله	george.mikhail686@student.example.com	01065371640	Syrian	Muslim	Male	\N	\N	2013-08-05	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سوري	مسلم	ذكر	\N	تسجيل	نشط	\N
1534	Mark Maykhaayl	مارك ميخائيل	nadia.abdullah349@student.example.com	01077484592	Egyptian	Christian	Male	\N	\N	2009-08-02	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	مصري	مسيحي	ذكر	\N	تسجيل	نشط	\N
1535	Ranya Ahmed	رانيا أحمد	amr.mansour659@student.example.com	01098099363	Tunisian	Christian	Male	\N	\N	2016-11-12	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	تونسي	مسيحي	ذكر	\N	تسجيل	نشط	\N
1536	Mayna Gamayl	مينا جميل	daniel.omar450@student.example.com	01083844369	Bahraini	Christian	Male	\N	\N	2021-07-11	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	بحريني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1537	Dayafayed Nagy	ديفيد ناجي	mina.fares709@student.example.com	01081127753	Kuwaiti	Christian	Male	\N	\N	2016-03-06	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسيحي	ذكر	\N	تسجيل	نشط	\N
1538	Salma Shakr	سلمى شاكر	rania.mansour807@student.example.com	01029820580	Palestinian	Muslim	Female	\N	\N	2013-08-24	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	فلسطيني	مسلم	أنثى	\N	تسجيل	نشط	\N
1539	Ranya Fars	رانيا فارس	karim.saleh759@student.example.com	01044675067	Libyan	Muslim	Male	\N	\N	2011-11-12	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	ليبي	مسلم	ذكر	\N	تسجيل	نشط	\N
1540	Haba Abed Alalh	هبة عبد الله	mariam.ibrahim877@student.example.com	01052767967	Bahraini	Muslim	Female	\N	\N	2011-08-09	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	بحريني	مسلم	أنثى	\N	تسجيل	نشط	\N
1541	Aly Razq	علي رزق	joseph.mikhail186@student.example.com	01001444967	Tunisian	Muslim	Male	\N	\N	2010-12-26	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	تونسي	مسلم	ذكر	\N	تسجيل	نشط	\N
1543	Ranya Fahamy	رانيا فهمي	robert.shaker419@student.example.com	01047833526	Iraqi	Muslim	Male	\N	\N	2011-05-26	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عراقي	مسلم	ذكر	\N	تسجيل	نشط	\N
1544	Sara Fars	سارة فارس	salma.bishara886@student.example.com	01008148851	Egyptian	Christian	Female	\N	\N	2019-08-23	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	مصري	مسيحي	أنثى	\N	تسجيل	نشط	\N
1545	Fatma Bashra	فاطمة بشرى	laila.william725@student.example.com	01000122267	Yemeni	Muslim	Female	\N	\N	2016-06-16	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	يمني	مسلم	أنثى	\N	تسجيل	نشط	\N
1546	Ranya Hasayn	رانيا حسين	rania.bishara834@student.example.com	01021475660	Kuwaiti	Christian	Female	\N	\N	2020-10-06	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1547	Gourg Khaled	جورج خالد	mohamed.saleh682@student.example.com	01001836827	Syrian	Christian	Male	\N	\N	2015-06-06	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سوري	مسيحي	ذكر	\N	تسجيل	نشط	\N
1548	Nadya Bashra	نادية بشرى	mariam.fares897@student.example.com	01041796170	Tunisian	Muslim	Female	\N	\N	2010-10-14	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	تونسي	مسلم	أنثى	\N	تسجيل	نشط	\N
1549	Salma Oulyam	سلمى وليام	nadia.zaky892@student.example.com	01006804001	Sudanese	Christian	Female	\N	\N	2021-09-04	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سوداني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1550	Hanaa Oulyam	هناء وليام	rania.mansour682@student.example.com	01004506322	Palestinian	Christian	Female	\N	\N	2013-01-22	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	فلسطيني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1551	Roubart Hana	روبرت حنا	hassan.ahmed725@student.example.com	01018048034	Saudi	Muslim	Male	\N	\N	2020-11-17	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سعودي	مسلم	ذكر	\N	تسجيل	نشط	\N
1552	Nadya Maykhaayl	نادية ميخائيل	john.maged805@student.example.com	01055257027	Sudanese	Christian	Male	\N	\N	2014-06-06	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سوداني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1553	Amrou Nagy	عمرو ناجي	nour.fares296@student.example.com	01002591415	Emirati	Muslim	Male	\N	\N	2017-06-24	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	إماراتي	مسلم	ذكر	\N	تسجيل	نشط	\N
1554	Dayafayed Fars	ديفيد فارس	amr.nagy860@student.example.com	01039920565	Sudanese	Muslim	Male	\N	\N	2011-01-20	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سوداني	مسلم	ذكر	\N	تسجيل	نشط	\N
1555	Gouzayf Abed Alalh	جوزيف عبد الله	karim.fahmy210@student.example.com	01090362731	Algerian	Muslim	Male	\N	\N	2009-03-28	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	جزائري	مسلم	ذكر	\N	تسجيل	نشط	\N
1556	Mana Aly	منى علي	nader.omar664@student.example.com	01024246256	Palestinian	Christian	Male	\N	\N	2009-10-11	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	فلسطيني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1557	Hasayn Abed Alalh	حسين عبد الله	peter.ahmed874@student.example.com	01076820444	Kuwaiti	Christian	Male	\N	\N	2018-12-31	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسيحي	ذكر	\N	تسجيل	نشط	\N
1558	Haba Mansour	هبة منصور	salma.khaled405@student.example.com	01073757384	Kuwaiti	Muslim	Female	\N	\N	2012-03-30	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسلم	أنثى	\N	تسجيل	نشط	\N
1559	Sara Hasn	سارة حسن	fatma.fares991@student.example.com	01022965639	Egyptian	Christian	Female	\N	\N	2007-10-29	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	مصري	مسيحي	أنثى	\N	تسجيل	نشط	\N
1560	Fatma Amr	فاطمة عمر	hana.mansour968@student.example.com	01095992835	Lebanese	Christian	Female	\N	\N	2012-04-05	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	لبناني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1561	Samouayl Hasayn	صموئيل حسين	ibrahim.omar471@student.example.com	01088603044	Lebanese	Christian	Male	\N	\N	2007-09-03	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	لبناني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1562	Yousf Hasayn	يوسف حسين	hana.william32@student.example.com	01097773313	Yemeni	Muslim	Male	\N	\N	2019-04-30	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	يمني	مسلم	ذكر	\N	تسجيل	نشط	\N
1563	Nour Aly	نور علي	nadia.saleh475@student.example.com	01067787989	Lebanese	Christian	Male	\N	\N	2020-10-10	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	لبناني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1564	Amany Gamayl	أماني جميل	shahd.bishara264@student.example.com	01077410984	Lebanese	Muslim	Female	\N	\N	2018-08-14	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	لبناني	مسلم	أنثى	\N	تسجيل	نشط	\N
1565	Fatma Hasn	فاطمة حسن	dina.rizk257@student.example.com	01064907560	Emirati	Christian	Female	\N	\N	2012-12-13	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	إماراتي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1566	Hanaa Maykhaayl	هناء ميخائيل	rania.girgis145@student.example.com	01094921828	Tunisian	Muslim	Female	\N	\N	2022-03-20	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	تونسي	مسلم	أنثى	\N	تسجيل	نشط	\N
1567	Salma Abrahaym	سلمى إبراهيم	shahd.william346@student.example.com	01053704313	Qatari	Muslim	Female	\N	\N	2021-02-18	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	قطري	مسلم	أنثى	\N	تسجيل	نشط	\N
1568	Nour Mohamed	نور محمد	amany.mansour555@student.example.com	01091760467	Lebanese	Christian	Female	\N	\N	2008-02-14	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	لبناني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1569	Ahmed Oulyam	أحمد وليام	nader.khaled176@student.example.com	01029055140	Kuwaiti	Muslim	Male	\N	\N	2016-12-13	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسلم	ذكر	\N	تسجيل	نشط	\N
1570	Mana Maged	منى ماجد	dina.hassan18@student.example.com	01019566476	Jordanian	Christian	Female	\N	\N	2019-02-24	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	أردني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1571	Nour Shakr	نور شاكر	malak.rizk63@student.example.com	01079083785	Kuwaiti	Christian	Female	\N	\N	2018-06-09	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	كويتي	مسيحي	أنثى	\N	تسجيل	نشط	\N
1572	Mahmoud Ahmed	محمود أحمد	rania.hussein942@student.example.com	01041260255	Omani	Muslim	Male	\N	\N	2011-05-17	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عماني	مسلم	ذكر	\N	تسجيل	نشط	\N
1479	Hasn Mansour	حسن منصور	amany.gamil921@example.com	01089083688	Egyptian	Muslim	Male	28205120100000	\N	1982-05-12	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent", "Guardian"]	\N	عراقي	مسلم	ذكر	\N	توصية	نشط	\N
1510	Mark Fahamy	مارك فهمي	peter.bishara496@example.com	01017600461	Palestinian	Christian	Male	\N	\N	1976-10-27	Active	Referral	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Parent"]	\N	فلسطيني	مسيحي	ذكر	\N	توصية	نشط	\N
1524	Gouzayf Hasn	جوزيف حسن	james.mikhail206@student.example.com	01077305272	Emirati	Muslim	Male	\N	\N	2007-08-13	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	إماراتي	مسلم	ذكر	\N	تسجيل	نشط	\N
1542	Layla Khaled	ليلى خالد	george.shaker197@student.example.com	01085583545	Algerian	Christian	Male	\N	\N	2010-09-16	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	جزائري	مسيحي	ذكر	\N	تسجيل	نشط	\N
1573	Ranya Maykhaayl	رانيا ميخائيل	mona.zaky297@student.example.com	01053263457	Saudi	Muslim	Female	\N	\N	2012-01-08	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	سعودي	مسلم	أنثى	\N	تسجيل	نشط	\N
1574	Mana Shakr	منى شاكر	sara.hussein933@student.example.com	01033301605	Jordanian	Christian	Female	\N	\N	2020-06-26	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	أردني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1575	Mana Zaky	منى زكي	karim.fahmy653@student.example.com	01082368903	Palestinian	Christian	Male	\N	\N	2012-03-11	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	فلسطيني	مسيحي	ذكر	\N	تسجيل	نشط	\N
1576	Salma Khaled	سلمى خالد	yasmin.girgis610@student.example.com	01053113229	Yemeni	Christian	Female	\N	\N	2010-08-12	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	يمني	مسيحي	أنثى	\N	تسجيل	نشط	\N
1577	Hanaa Hana	هناء حنا	david.khaled595@student.example.com	01009104773	Iraqi	Muslim	Male	\N	\N	2021-01-02	Active	Enrollment	\N	\N	2026-06-14 02:55:33	2026-06-14 13:15:42	["Student"]	\N	عراقي	مسلم	ذكر	\N	تسجيل	نشط	\N
1578	Amany Bashra	أماني بشرى	salma.hussein664@example.com	01063227883	Saudi	Muslim	Female	\N	\N	2014-11-11	Active	Referral	\N	1497	2026-06-14 17:07:29	2026-06-14 17:29:06	["Student"]	1508	سعودي	مسيحي	أنثى	\N	يوم مفتوح	جديد	\N
\.


--
-- Data for Name: enrollments; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.enrollments (id, student_id, academic_year_id, grade_id, section_id, enrolled_at, status, created_at, updated_at) FROM stdin;
141	5	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
142	15	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
143	45	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
144	47	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
145	49	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
146	57	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
147	61	14	4	409	2026-06-15	active	2026-06-15 18:39:43	2026-06-15 18:39:43
34	34	14	1	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
42	42	14	1	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
88	42	12	1	\N	2024-09-12	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
128	42	13	1	\N	2025-09-12	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
18	18	14	2	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
20	20	14	2	\N	2026-09-14	active	2026-06-14 02:55:34	2026-06-14 02:55:34
23	23	14	2	\N	2026-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
72	18	12	2	\N	2024-09-09	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
73	20	12	2	\N	2024-09-04	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
75	23	12	2	\N	2024-09-13	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
112	18	13	2	\N	2025-09-02	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
113	20	13	2	\N	2025-09-08	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
115	23	13	2	\N	2025-09-14	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
1	1	14	2	\N	2026-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
38	38	14	2	\N	2026-09-03	active	2026-06-14 02:55:34	2026-06-14 02:55:34
85	38	12	2	\N	2024-09-12	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
125	38	13	2	\N	2025-09-07	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
21	21	14	2	\N	2026-09-08	active	2026-06-14 02:55:34	2026-06-14 02:55:34
36	36	14	2	\N	2026-09-09	active	2026-06-14 02:55:34	2026-06-14 02:55:34
74	21	12	2	\N	2024-09-12	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
84	36	12	2	\N	2024-09-07	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
114	21	13	2	\N	2025-09-04	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
124	36	13	2	\N	2025-09-01	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
40	40	14	3	\N	2026-09-11	active	2026-06-14 02:55:34	2026-06-14 02:55:34
12	12	14	3	\N	2026-09-10	active	2026-06-14 02:55:34	2026-06-14 02:55:34
41	41	14	3	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
60	60	14	3	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
68	12	12	3	\N	2024-09-06	active	2026-06-14 02:55:34	2026-06-14 02:55:34
87	41	12	3	\N	2024-09-12	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
100	60	12	3	\N	2024-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
108	12	13	3	\N	2025-09-12	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
127	41	13	3	\N	2025-09-07	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
140	60	13	3	\N	2025-09-09	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
9	9	14	3	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
66	9	12	3	\N	2024-09-09	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
106	9	13	3	\N	2025-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
31	31	14	4	\N	2026-09-10	active	2026-06-14 02:55:34	2026-06-14 02:55:34
47	47	14	4	\N	2026-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
49	49	14	4	\N	2026-09-09	active	2026-06-14 02:55:34	2026-06-14 02:55:34
91	47	12	4	\N	2024-09-14	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
131	47	13	4	\N	2025-09-13	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
5	5	14	4	\N	2026-09-13	active	2026-06-14 02:55:34	2026-06-14 02:55:34
27	27	14	4	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
45	45	14	4	\N	2026-09-06	active	2026-06-14 02:55:34	2026-06-14 02:55:34
63	5	12	4	\N	2024-09-03	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
78	27	12	4	\N	2024-09-08	active	2026-06-14 02:55:34	2026-06-14 02:55:34
90	45	12	4	\N	2024-09-14	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
103	5	13	4	\N	2025-09-05	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
118	27	13	4	\N	2025-09-15	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
130	45	13	4	\N	2025-09-06	active	2026-06-14 02:55:34	2026-06-14 02:55:34
15	15	14	4	\N	2026-09-02	active	2026-06-14 02:55:34	2026-06-14 02:55:34
48	48	14	4	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
57	57	14	4	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
70	15	12	4	\N	2024-09-12	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
92	48	12	4	\N	2024-09-06	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
98	57	12	4	\N	2024-09-04	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
110	15	13	4	\N	2025-09-01	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
132	48	13	4	\N	2025-09-11	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
138	57	13	4	\N	2025-09-15	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
8	8	14	5	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
46	46	14	5	\N	2026-09-14	active	2026-06-14 02:55:34	2026-06-14 02:55:34
65	8	12	5	\N	2024-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
105	8	13	5	\N	2025-09-11	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
51	51	14	5	\N	2026-09-11	active	2026-06-14 02:55:34	2026-06-14 02:55:34
52	52	14	5	\N	2026-09-04	active	2026-06-14 02:55:34	2026-06-14 02:55:34
94	51	12	5	\N	2024-09-01	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
134	51	13	5	\N	2025-09-04	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
10	10	14	6	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
22	22	14	6	\N	2026-09-13	active	2026-06-14 02:55:34	2026-06-14 02:55:34
56	56	14	6	\N	2026-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
97	56	12	6	\N	2024-09-14	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
137	56	13	6	\N	2025-09-02	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
39	39	14	6	\N	2026-09-11	active	2026-06-14 02:55:34	2026-06-14 02:55:34
86	39	12	6	\N	2024-09-02	active	2026-06-14 02:55:34	2026-06-14 02:55:34
126	39	13	6	\N	2025-09-08	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
11	11	14	6	\N	2026-09-13	active	2026-06-14 02:55:34	2026-06-14 02:55:34
67	11	12	6	\N	2024-09-06	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
107	11	13	6	\N	2025-09-15	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
14	14	14	8	\N	2026-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
50	50	14	8	\N	2026-09-03	active	2026-06-14 02:55:34	2026-06-14 02:55:34
69	14	12	8	\N	2024-09-03	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
93	50	12	8	\N	2024-09-06	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
109	14	13	8	\N	2025-09-08	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
133	50	13	8	\N	2025-09-02	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
33	33	14	8	\N	2026-09-08	active	2026-06-14 02:55:34	2026-06-14 02:55:34
82	33	12	8	\N	2024-09-06	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
122	33	13	8	\N	2025-09-03	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
55	55	14	9	\N	2026-09-04	active	2026-06-14 02:55:34	2026-06-14 02:55:34
3	3	14	9	\N	2026-09-14	active	2026-06-14 02:55:34	2026-06-14 02:55:34
62	3	12	9	\N	2024-09-12	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
102	3	13	9	\N	2025-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
6	6	14	10	\N	2026-09-03	active	2026-06-14 02:55:34	2026-06-14 02:55:34
17	17	14	10	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
64	6	12	10	\N	2024-09-14	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
71	17	12	10	\N	2024-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
104	6	13	10	\N	2025-09-15	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
111	17	13	10	\N	2025-09-03	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
19	19	14	10	\N	2026-09-02	active	2026-06-14 02:55:34	2026-06-14 02:55:34
24	24	14	11	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
54	54	14	11	\N	2026-09-13	active	2026-06-14 02:55:34	2026-06-14 02:55:34
76	24	12	11	\N	2024-09-09	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
96	54	12	11	\N	2024-09-15	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
116	24	13	11	\N	2025-09-11	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
136	54	13	11	\N	2025-09-13	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
28	28	14	11	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
59	59	14	11	\N	2026-09-11	active	2026-06-14 02:55:34	2026-06-14 02:55:34
99	59	12	11	\N	2024-09-07	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
139	59	13	11	\N	2025-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
2	2	14	12	\N	2026-09-08	active	2026-06-14 02:55:34	2026-06-14 02:55:34
61	2	12	12	\N	2024-09-09	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
101	2	13	12	\N	2025-09-07	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
44	44	14	12	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
89	44	12	12	\N	2024-09-09	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
129	44	13	12	\N	2025-09-03	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
25	25	14	13	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
58	58	14	13	\N	2026-09-13	active	2026-06-14 02:55:34	2026-06-14 02:55:34
26	26	14	13	\N	2026-09-15	active	2026-06-14 02:55:34	2026-06-14 02:55:34
37	37	14	13	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
53	53	14	13	\N	2026-09-04	active	2026-06-14 02:55:34	2026-06-14 02:55:34
77	26	12	13	\N	2024-09-04	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
95	53	12	13	\N	2024-09-07	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
117	26	13	13	\N	2025-09-15	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
135	53	13	13	\N	2025-09-13	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
16	16	14	14	\N	2026-09-07	active	2026-06-14 02:55:34	2026-06-14 02:55:34
29	29	14	14	\N	2026-09-03	active	2026-06-14 02:55:34	2026-06-14 02:55:34
32	32	14	14	\N	2026-09-08	active	2026-06-14 02:55:34	2026-06-14 02:55:34
79	29	12	14	\N	2024-09-05	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
81	32	12	14	\N	2024-09-07	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
119	29	13	14	\N	2025-09-12	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
121	32	13	14	\N	2025-09-14	active	2026-06-14 02:55:34	2026-06-14 02:55:34
30	30	14	14	\N	2026-09-06	active	2026-06-14 02:55:34	2026-06-14 02:55:34
80	30	12	14	\N	2024-09-05	graduated	2026-06-14 02:55:34	2026-06-14 02:55:34
120	30	13	14	\N	2025-09-04	active	2026-06-14 02:55:34	2026-06-14 02:55:34
4	4	14	14	\N	2026-09-01	active	2026-06-14 02:55:34	2026-06-14 02:55:34
7	7	14	14	\N	2026-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
35	35	14	14	\N	2026-09-05	active	2026-06-14 02:55:34	2026-06-14 02:55:34
83	35	12	14	\N	2024-09-06	dropped	2026-06-14 02:55:34	2026-06-14 02:55:34
123	35	13	14	\N	2025-09-15	transferred	2026-06-14 02:55:34	2026-06-14 02:55:34
43	43	14	15	\N	2026-09-12	active	2026-06-14 02:55:34	2026-06-14 02:55:34
13	13	14	15	\N	2026-09-03	active	2026-06-14 02:55:34	2026-06-14 02:55:34
\.


--
-- Data for Name: exam_records; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.exam_records (id, exam_id, student_id, subject_id, marks_obtained, notes, created_at, updated_at) FROM stdin;
1	5	34	1	78.36	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
2	5	34	9	43.76	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
3	5	34	10	91.62	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
4	5	42	1	81.12	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
5	5	42	9	74.32	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
6	5	42	10	73.13	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
7	6	1	1	29.13	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
8	6	1	9	47.95	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
9	6	1	10	71.90	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
10	6	18	1	44.06	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
11	6	18	9	90.55	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
12	6	18	10	68.28	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
13	6	20	1	88.06	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
14	6	20	9	29.97	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
15	6	20	10	83.27	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
16	6	21	1	99.34	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
17	6	21	9	92.53	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
18	6	21	10	29.53	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
19	6	23	1	52.32	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
20	6	23	9	48.72	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
21	6	23	10	76.54	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
22	6	36	1	24.40	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
23	6	36	9	98.14	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
24	6	36	10	78.72	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
25	6	38	1	89.37	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
26	6	38	9	68.62	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
27	6	38	10	52.36	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
28	7	8	1	75.70	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
29	7	8	9	36.65	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
30	7	8	10	78.59	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
31	7	46	1	59.12	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
32	7	46	9	60.31	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
33	7	46	10	79.95	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
34	7	51	1	35.76	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
35	7	51	9	31.36	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
36	7	51	10	69.43	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
37	7	52	1	80.25	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
38	7	52	9	57.44	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
39	7	52	10	80.63	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
40	8	10	1	91.63	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
41	8	10	9	88.12	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
42	8	10	10	43.48	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
43	8	11	1	92.80	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
44	8	11	9	34.33	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
45	8	11	10	49.31	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
46	8	22	1	91.34	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
47	8	22	9	96.08	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
48	8	22	10	90.89	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
49	8	39	1	49.28	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
50	8	39	9	89.45	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
51	8	39	10	40.74	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
52	8	56	1	90.35	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
53	8	56	9	33.67	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
54	8	56	10	82.29	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
55	10	14	1	47.54	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
56	10	14	9	46.90	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
57	10	14	10	100.00	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
58	10	33	1	37.97	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
59	10	33	9	95.71	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
60	10	33	10	63.04	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
61	10	50	1	35.90	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
62	10	50	9	72.15	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
63	10	50	10	82.83	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
64	11	6	1	80.16	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
65	11	6	9	84.22	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
66	11	6	10	68.26	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
67	11	17	1	71.59	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
68	11	17	9	63.48	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
69	11	17	10	98.29	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
70	11	19	1	34.58	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
71	11	19	9	36.77	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
72	11	19	10	64.84	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
73	12	24	1	85.77	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
74	12	24	9	36.27	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
75	12	24	10	70.37	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
76	12	28	1	24.74	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
77	12	28	9	97.90	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
78	12	28	10	94.08	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
79	12	54	1	38.52	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
80	12	54	9	85.54	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
81	12	54	10	29.23	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
82	12	59	1	42.63	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
83	12	59	9	75.68	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
84	12	59	10	82.62	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
85	13	2	1	96.70	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
86	13	2	9	61.97	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
87	13	2	10	21.74	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
88	13	44	1	93.49	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
89	13	44	9	29.33	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
90	13	44	10	86.04	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
91	14	25	1	45.25	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
92	14	25	9	84.25	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
93	14	25	10	32.23	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
94	14	26	1	36.24	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
95	14	26	9	29.18	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
96	14	26	10	59.11	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
97	14	37	1	25.21	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
98	14	37	9	48.55	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
99	14	37	10	62.35	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
100	14	53	1	91.69	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
101	14	53	9	50.93	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
102	14	53	10	23.09	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
103	14	58	1	56.43	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
104	14	58	9	33.18	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
105	14	58	10	99.34	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
106	15	4	1	87.93	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
107	15	4	9	82.75	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
108	15	4	10	65.59	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
109	15	7	1	88.33	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
110	15	7	9	32.49	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
111	15	7	10	22.46	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
112	15	16	1	51.88	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
113	15	16	9	66.13	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
114	15	16	10	48.66	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
115	15	29	1	76.44	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
116	15	29	9	20.18	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
117	15	29	10	81.60	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
118	15	30	1	68.55	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
119	15	30	9	42.90	Needs improvement	2026-06-14 02:55:34	2026-06-14 02:55:34
120	15	30	10	63.63	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
121	15	32	1	50.38	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
122	15	32	9	50.81	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
123	15	32	10	87.24	\N	2026-06-14 02:55:34	2026-06-14 02:55:34
124	15	35	1	66.01	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
125	15	35	9	84.09	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
126	15	35	10	98.72	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
127	16	13	1	44.95	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
128	16	13	9	35.17	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
129	16	13	10	65.27	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
130	16	43	1	100.00	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
131	16	43	9	59.79	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
132	16	43	10	73.94	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
133	17	34	1	92.04	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
134	17	34	9	56.85	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
135	17	34	10	56.32	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
136	17	42	1	83.35	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
137	17	42	9	33.80	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
138	17	42	10	37.25	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
139	18	1	1	94.54	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
140	18	1	9	72.38	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
141	18	1	10	64.34	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
142	18	18	1	49.84	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
143	18	18	9	53.50	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
144	18	18	10	77.70	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
145	18	20	1	37.29	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
146	18	20	9	21.05	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
147	18	20	10	89.38	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
148	18	21	1	35.86	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
149	18	21	9	86.20	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
150	18	21	10	94.12	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
151	18	23	1	98.92	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
152	18	23	9	70.86	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
153	18	23	10	45.89	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
154	18	36	1	43.80	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
155	18	36	9	37.72	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
156	18	36	10	79.78	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
157	18	38	1	33.95	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
158	18	38	9	22.11	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
159	18	38	10	53.20	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
160	19	9	1	41.94	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
161	19	9	9	56.26	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
162	19	9	10	86.20	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
163	19	12	1	87.52	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
164	19	12	9	100.00	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
165	19	12	10	78.09	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
166	19	40	1	46.04	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
167	19	40	9	91.98	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
168	19	40	10	30.60	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
169	19	41	1	91.25	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
170	19	41	9	83.40	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
171	19	41	10	36.24	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
172	19	60	1	43.37	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
173	19	60	9	89.28	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
174	19	60	10	45.07	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
175	20	5	1	34.58	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
176	20	5	9	21.41	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
177	20	5	10	55.78	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
178	20	15	1	30.35	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
179	20	15	9	61.49	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
180	20	15	10	59.48	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
181	20	27	1	40.27	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
182	20	27	9	37.26	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
183	20	27	10	39.38	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
184	20	31	1	65.57	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
185	20	31	9	67.33	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
186	20	31	10	76.36	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
187	20	45	1	79.51	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
188	20	45	9	44.04	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
189	20	45	10	48.41	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
190	20	47	1	29.68	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
191	20	47	9	80.28	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
192	20	47	10	71.04	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
193	20	48	1	72.01	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
194	20	48	9	70.91	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
195	20	48	10	20.78	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
196	20	49	1	52.73	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
197	20	49	9	43.11	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
198	20	49	10	42.28	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
199	20	57	1	34.67	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
200	20	57	9	61.58	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
201	20	57	10	67.12	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
202	22	3	1	67.98	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
203	22	3	9	87.43	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
204	22	3	10	80.86	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
205	22	55	1	75.43	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
206	22	55	9	100.00	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
207	22	55	10	36.00	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
208	23	6	1	32.68	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
209	23	6	9	62.51	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
210	23	6	10	46.06	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
211	23	17	1	62.38	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
212	23	17	9	42.62	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
213	23	17	10	67.35	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
214	23	19	1	34.97	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
215	23	19	9	99.73	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
216	23	19	10	53.66	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
217	24	24	1	74.64	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
218	24	24	9	38.31	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
219	24	24	10	53.13	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
220	24	28	1	69.41	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
221	24	28	9	85.12	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
222	24	28	10	92.35	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
223	24	54	1	58.91	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
224	24	54	9	86.30	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
225	24	54	10	64.56	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
226	24	59	1	50.80	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
227	24	59	9	24.33	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
228	24	59	10	94.65	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
229	25	2	1	63.08	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
230	25	2	9	21.18	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
231	25	2	10	96.39	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
232	25	44	1	92.06	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
233	25	44	9	82.43	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
234	25	44	10	64.68	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
235	26	25	1	51.42	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
236	26	25	9	77.44	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
237	26	25	10	32.40	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
238	26	26	1	52.29	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
239	26	26	9	46.46	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
240	26	26	10	71.95	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
241	26	37	1	68.61	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
242	26	37	9	56.41	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
243	26	37	10	38.86	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
244	26	53	1	90.21	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
245	26	53	9	99.00	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
246	26	53	10	27.30	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
247	26	58	1	42.55	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
248	26	58	9	50.26	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
249	26	58	10	86.83	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
250	27	13	1	65.76	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
251	27	13	9	55.64	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
252	27	13	10	31.23	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
253	27	43	1	88.73	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
254	27	43	9	56.59	\N	2026-06-14 02:55:35	2026-06-14 02:55:35
255	27	43	10	38.85	Needs improvement	2026-06-14 02:55:35	2026-06-14 02:55:35
\.


--
-- Data for Name: exam_subject; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.exam_subject (exam_id, subject_id, max_marks, created_at, updated_at) FROM stdin;
5	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
5	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
5	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
6	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
6	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
6	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
7	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
7	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
7	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
8	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
8	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
8	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
9	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
9	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
9	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
10	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
10	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
10	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
11	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
11	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
11	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
12	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
12	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
12	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
13	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
13	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
13	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
14	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
14	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
14	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
15	1	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
15	9	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
15	10	100.00	2026-06-14 02:55:34	2026-06-14 02:55:34
16	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
16	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
16	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
17	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
17	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
17	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
18	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
18	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
18	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
19	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
19	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
19	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
20	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
20	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
20	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
21	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
21	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
21	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
22	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
22	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
22	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
23	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
23	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
23	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
24	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
24	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
24	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
25	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
25	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
25	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
26	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
26	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
26	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
27	1	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
27	9	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
27	10	100.00	2026-06-14 02:55:35	2026-06-14 02:55:35
\.


--
-- Data for Name: exams; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.exams (id, name, grade_id, term_id, date, description, created_at, updated_at) FROM stdin;
5	Midterm Exam	1	27	2026-12-23	Midterm examination for Pre-KG	2026-06-14 02:55:34	2026-06-14 02:55:34
6	Midterm Exam	2	27	2026-12-18	Midterm examination for KG1	2026-06-14 02:55:34	2026-06-14 02:55:34
7	Midterm Exam	5	27	2026-12-16	Midterm examination for Grade 2	2026-06-14 02:55:34	2026-06-14 02:55:34
8	Midterm Exam	6	27	2026-12-20	Midterm examination for Grade 3	2026-06-14 02:55:34	2026-06-14 02:55:34
9	Midterm Exam	7	27	2026-12-12	Midterm examination for Grade 4	2026-06-14 02:55:34	2026-06-14 02:55:34
10	Midterm Exam	8	27	2026-12-24	Midterm examination for Grade 5	2026-06-14 02:55:34	2026-06-14 02:55:34
11	Midterm Exam	10	27	2026-12-16	Midterm examination for Grade 7	2026-06-14 02:55:34	2026-06-14 02:55:34
12	Midterm Exam	11	27	2026-12-22	Midterm examination for Grade 8	2026-06-14 02:55:34	2026-06-14 02:55:34
13	Midterm Exam	12	27	2026-12-25	Midterm examination for Grade 9	2026-06-14 02:55:34	2026-06-14 02:55:34
14	Midterm Exam	13	27	2026-12-18	Midterm examination for Grade 10	2026-06-14 02:55:34	2026-06-14 02:55:34
15	Midterm Exam	14	27	2026-12-23	Midterm examination for Grade 11	2026-06-14 02:55:34	2026-06-14 02:55:34
16	Midterm Exam	15	27	2026-12-14	Midterm examination for Grade 12	2026-06-14 02:55:35	2026-06-14 02:55:35
17	Final Exam	1	28	2027-06-14	Final examination for Pre-KG	2026-06-14 02:55:35	2026-06-14 02:55:35
18	Final Exam	2	28	2027-06-15	Final examination for KG1	2026-06-14 02:55:35	2026-06-14 02:55:35
19	Final Exam	3	28	2027-06-12	Final examination for KG2	2026-06-14 02:55:35	2026-06-14 02:55:35
20	Final Exam	4	28	2027-06-19	Final examination for Grade 1	2026-06-14 02:55:35	2026-06-14 02:55:35
21	Final Exam	7	28	2027-06-24	Final examination for Grade 4	2026-06-14 02:55:35	2026-06-14 02:55:35
22	Final Exam	9	28	2027-06-18	Final examination for Grade 6	2026-06-14 02:55:35	2026-06-14 02:55:35
23	Final Exam	10	28	2027-06-12	Final examination for Grade 7	2026-06-14 02:55:35	2026-06-14 02:55:35
24	Final Exam	11	28	2027-06-16	Final examination for Grade 8	2026-06-14 02:55:35	2026-06-14 02:55:35
25	Final Exam	12	28	2027-06-19	Final examination for Grade 9	2026-06-14 02:55:35	2026-06-14 02:55:35
26	Final Exam	13	28	2027-06-17	Final examination for Grade 10	2026-06-14 02:55:35	2026-06-14 02:55:35
27	Final Exam	15	28	2027-06-12	Final examination for Grade 12	2026-06-14 02:55:35	2026-06-14 02:55:35
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
106	1	21	\N	\N
107	2	21	\N	\N
108	3	21	\N	\N
109	4	22	\N	\N
110	5	22	\N	\N
111	6	22	\N	\N
112	7	22	\N	\N
113	8	22	\N	\N
114	9	22	\N	\N
115	10	23	\N	\N
116	11	23	\N	\N
117	12	23	\N	\N
118	13	24	\N	\N
119	14	24	\N	\N
120	15	24	\N	\N
\.


--
-- Data for Name: grade_subject; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.grade_subject (id, grade_id, subject_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	1	9	\N	\N
3	1	10	\N	\N
4	2	1	\N	\N
5	2	9	\N	\N
6	2	10	\N	\N
7	3	1	\N	\N
8	3	9	\N	\N
9	3	10	\N	\N
10	4	1	\N	\N
11	4	9	\N	\N
12	4	10	\N	\N
13	5	1	\N	\N
14	5	9	\N	\N
15	5	10	\N	\N
16	6	1	\N	\N
17	6	9	\N	\N
18	6	10	\N	\N
19	7	1	\N	\N
20	7	9	\N	\N
21	7	10	\N	\N
22	8	1	\N	\N
23	8	9	\N	\N
24	8	10	\N	\N
25	9	1	\N	\N
26	9	9	\N	\N
27	9	10	\N	\N
28	10	1	\N	\N
29	10	9	\N	\N
30	10	10	\N	\N
31	11	1	\N	\N
32	11	9	\N	\N
33	11	10	\N	\N
34	12	1	\N	\N
35	12	9	\N	\N
36	12	10	\N	\N
37	13	1	\N	\N
38	13	9	\N	\N
39	13	10	\N	\N
40	14	1	\N	\N
41	14	9	\N	\N
42	14	10	\N	\N
43	15	1	\N	\N
44	15	9	\N	\N
45	15	10	\N	\N
\.


--
-- Data for Name: grades; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.grades (id, name, name_ar, level_order, description, created_at, updated_at) FROM stdin;
1	Pre-KG	ما قبل الروضة	0	Pre-Kindergarten — early learning foundation	2026-06-14 02:55:32	2026-06-14 02:55:32
2	KG1	أولى رياض أطفال	0	Kindergarten 1 — ages 4–5	2026-06-14 02:55:32	2026-06-14 02:55:32
3	KG2	ثانية رياض أطفال	0	Kindergarten 2 — ages 5–6	2026-06-14 02:55:32	2026-06-14 02:55:32
4	Grade 1	أولى إبتدائى	1	First grade — basics of reading, writing, and arithmetic	2026-06-14 02:55:32	2026-06-14 02:55:32
5	Grade 2	ثانية إبتدائى	1	Second grade — building literacy and numeracy	2026-06-14 02:55:32	2026-06-14 02:55:32
6	Grade 3	ثالثة إبتدائى	1	Third grade — introduction to science and social studies	2026-06-14 02:55:32	2026-06-14 02:55:32
7	Grade 4	رابعة إبتدائى	1	Fourth grade — expanded subjects and critical thinking	2026-06-14 02:55:32	2026-06-14 02:55:32
8	Grade 5	خامسة إبتدائى	1	Fifth grade — preparing for middle school transition	2026-06-14 02:55:32	2026-06-14 02:55:32
9	Grade 6	سادسة إبتدائى	1	Sixth grade — final year of primary education	2026-06-14 02:55:32	2026-06-14 02:55:32
10	Grade 7	أولى إعدادى	2	Seventh grade — first year of preparatory/middle school	2026-06-14 02:55:32	2026-06-14 02:55:32
11	Grade 8	ثانية إعدادى	2	Eighth grade — deeper exploration of STEM and humanities	2026-06-14 02:55:32	2026-06-14 02:55:32
12	Grade 9	ثالثة إعدادى	2	Ninth grade — final preparatory year before high school	2026-06-14 02:55:32	2026-06-14 02:55:32
13	Grade 10	أولى ثانوى	3	Tenth grade — secondary school foundation year	2026-06-14 02:55:32	2026-06-14 02:55:32
14	Grade 11	ثانية ثانوى	3	Eleventh grade — academic specialization begins	2026-06-14 02:55:32	2026-06-14 02:55:32
15	Grade 12	ثالثة ثانوى	3	Twelfth grade — final year, graduation and university preparation	2026-06-14 02:55:32	2026-06-14 02:55:32
\.


--
-- Data for Name: interactions; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.interactions (id, lead_id, type, date, summary, created_at, updated_at, contact_id) FROM stdin;
1	1	Email	2026-05-17	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
2	11	Meeting	2026-06-14	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
3	15	Email	2026-06-06	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
4	17	Email	2026-05-28	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
5	19	WhatsApp	2026-06-03	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
6	22	Visit	2026-05-27	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
7	26	Visit	2026-06-04	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
8	29	Other	2026-05-28	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
9	30	WhatsApp	2026-05-16	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
10	33	WhatsApp	2026-05-15	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
11	37	Email	2026-05-19	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
12	38	Other	2026-06-05	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
13	40	WhatsApp	2026-05-25	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
14	46	Visit	2026-05-30	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
15	48	WhatsApp	2026-05-20	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
16	49	Meeting	2026-05-17	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
17	50	Meeting	2026-05-27	Initial contact with lead. Follow-up scheduled.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
18	42	Visit	2026-05-13	Discussed payment plan options.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
19	38	Other	2026-04-26	Scheduled a school tour for the family.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
20	25	Call	2026-05-13	Scheduled entrance assessment test.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
21	49	WhatsApp	2026-04-26	Discussed extracurricular activity options.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
22	41	WhatsApp	2026-04-24	Provided feedback from teachers.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
23	24	Email	2026-06-13	Follow-up call regarding application status.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
24	46	WhatsApp	2026-05-07	Scheduled entrance assessment test.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
25	24	WhatsApp	2026-05-28	Discussed student progress and performance.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
26	18	WhatsApp	2026-05-19	Followed up on missing documents.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
27	48	Meeting	2026-06-05	Discussed enrollment options and school fees.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
28	1	Email	2026-05-28	Followed up on missing documents.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
29	25	Other	2026-05-03	Discussed enrollment options and school fees.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
30	49	Other	2026-04-28	Discussed extracurricular activity options.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
31	34	Visit	2026-05-30	Followed up on missing documents.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
32	23	Other	2026-04-22	Scheduled entrance assessment test.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
33	30	Other	2026-04-15	Provided feedback from teachers.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
34	24	Other	2026-06-10	Parent called to confirm registration.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
35	48	Visit	2026-05-13	Discussed student progress and performance.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
36	26	Other	2026-05-10	Discussed enrollment options and school fees.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
37	47	Visit	2026-05-16	Confirmed attendance for open day event.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
38	26	Visit	2026-04-22	Discussed enrollment options and school fees.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
39	44	Call	2026-04-15	Provided feedback from teachers.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
40	8	Email	2026-06-14	Discussed extracurricular activity options.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
41	17	Email	2026-06-12	Discussed extracurricular activity options.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
42	9	Meeting	2026-05-03	Parent called to confirm registration.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
43	45	Meeting	2026-06-13	Provided information about transportation services.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
44	13	Call	2026-04-16	Provided feedback from teachers.	2026-06-14 02:55:33	2026-06-14 02:55:33	\N
45	45	Meeting	2026-05-16	Provided feedback from teachers.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
46	16	Email	2026-05-23	Provided feedback from teachers.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
47	21	Visit	2026-05-14	Discussed enrollment options and school fees.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
48	42	Visit	2026-05-03	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
49	24	Visit	2026-05-19	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
50	41	WhatsApp	2026-06-11	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
51	16	Email	2026-06-06	Follow-up call regarding application status.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
52	26	Call	2026-04-19	Provided feedback from teachers.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
53	9	Meeting	2026-05-15	Follow-up call regarding application status.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
54	47	Email	2026-04-24	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
55	9	Other	2026-05-26	Discussed enrollment options and school fees.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
56	33	Other	2026-05-31	Sent required documents via email.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
57	6	Email	2026-06-10	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
58	25	Other	2026-05-08	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
59	15	Other	2026-05-24	Confirmed attendance for open day event.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
60	48	Visit	2026-06-10	Provided feedback from teachers.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
61	11	Meeting	2026-05-16	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
62	27	Visit	2026-06-03	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
63	14	Other	2026-04-17	Discussed enrollment options and school fees.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
64	5	Other	2026-06-01	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
65	38	Email	2026-06-02	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
66	31	Meeting	2026-04-30	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
67	4	WhatsApp	2026-05-01	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
68	6	Email	2026-05-25	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
69	29	Visit	2026-04-30	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
70	50	Meeting	2026-04-19	Provided feedback from teachers.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
71	19	WhatsApp	2026-05-11	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
72	36	Visit	2026-05-30	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
73	22	Other	2026-05-25	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
74	28	Call	2026-05-21	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
75	18	Call	2026-05-28	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
76	29	Email	2026-05-25	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
77	15	Meeting	2026-04-30	Confirmed attendance for open day event.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
78	16	Other	2026-06-02	Followed up on missing documents.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
79	5	WhatsApp	2026-04-19	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
80	12	Visit	2026-06-04	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
81	34	Call	2026-06-07	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
82	18	Email	2026-05-11	Follow-up call regarding application status.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
83	7	Meeting	2026-04-24	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
84	17	WhatsApp	2026-04-19	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
85	8	Visit	2026-04-16	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
86	39	Visit	2026-05-26	Followed up on missing documents.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
87	12	Call	2026-05-03	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
88	9	Visit	2026-06-02	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
89	12	Visit	2026-05-12	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
90	42	Other	2026-05-03	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
91	17	Visit	2026-05-01	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
92	1	WhatsApp	2026-05-05	Confirmed attendance for open day event.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
93	16	Email	2026-06-13	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
94	15	WhatsApp	2026-04-24	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
95	1	Other	2026-05-13	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
96	39	Call	2026-06-03	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
97	28	Visit	2026-05-28	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
98	13	Call	2026-05-26	Answered questions about curriculum and activities.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
99	6	Meeting	2026-04-15	Discussed extracurricular activity options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
100	46	Email	2026-05-19	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
101	1	Call	2026-05-28	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
102	10	WhatsApp	2026-05-18	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
103	38	WhatsApp	2026-06-14	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
104	21	Email	2026-06-02	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
105	11	Call	2026-05-14	Scheduled entrance assessment test.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
106	42	Email	2026-05-20	Discussed payment plan options.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
107	4	WhatsApp	2026-06-13	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
108	44	Other	2026-04-18	Sent required documents via email.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
109	50	Visit	2026-04-27	Scheduled a school tour for the family.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
110	4	Other	2026-05-18	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
111	11	Other	2026-05-03	Sent required documents via email.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
112	2	Meeting	2026-05-26	Discussed student progress and performance.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
113	49	WhatsApp	2026-05-01	Follow-up call regarding application status.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
114	6	WhatsApp	2026-06-12	Confirmed attendance for open day event.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
115	6	Call	2026-05-18	Follow-up call regarding application status.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
116	33	Meeting	2026-06-06	Discussed enrollment options and school fees.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
117	5	Other	2026-06-14	Parent called to confirm registration.	2026-06-14 02:55:34	2026-06-14 02:55:34	\N
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

COPY public.leads (id, "nameEn", "nameAr", email, phone, nationality, national_id, passport_no, birth_date, status, source, notes, created_at, updated_at, parent_id, grade_id, religion, gender, second_language_subject_id, categories, mother_id, nationality_ar, national_id_ar, passport_no_ar, status_ar, source_ar, notes_ar, religion_ar, gender_ar, photo) FROM stdin;
2	Hanaa Fars	هناء فارس	rania.ibrahim3@example.com	01025918661	Syrian	\N	\N	2012-05-18	Contacted	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Christian	Female	13	["Student"]	\N	سوري	\N	\N	تم التواصل	إعلان	\N	مسيحي	أنثى	\N
3	Amany Bashra	أماني بشرى	salma.hussein664@example.com	01063227883	Saudi	\N	\N	2014-11-11	Accepted	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:07:29	\N	4	Christian	Female	13	["Student"]	\N	سعودي	\N	\N	جديد	يوم مفتوح	\N	مسيحي	أنثى	\N
5	Maraym Razq	مريم رزق	hussein.nagy339@example.com	01038970189	Tunisian	\N	\N	2020-07-05	New	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	1	Muslim	Male	13	["Student"]	\N	تونسي	\N	\N	جديد	يوم مفتوح	\N	مسلم	ذكر	\N
4	Anadrou Maykhaayl	أندرو ميخائيل	mona.saleh634@example.com	01084583477	Egyptian	32111030100000	\N	2021-11-03	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:05:26	\N	2	Christian	Male	13	["Student"]	\N	عماني	\N	\N	جديد	وسائل التواصل	\N	مسيحي	ذكر	\N
7	Maraym Fahamy	مريم فهمي	dina.bishara597@example.com	01066969440	Yemeni	\N	\N	2009-09-12	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	6	Muslim	Female	13	["Student"]	\N	يمني	\N	\N	جديد	يوم مفتوح	\N	مسلم	أنثى	\N
8	Aly Fars	علي فارس	john.hussein808@example.com	01035279073	Egyptian	\N	\N	2019-09-29	New	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Muslim	Male	13	["Student"]	\N	مصري	\N	\N	جديد	توصية	\N	مسلم	ذكر	\N
9	Mana Mansour	منى منصور	hana.omar821@example.com	01044875657	Kuwaiti	\N	\N	2018-01-28	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	10	Christian	Male	13	["Student"]	\N	كويتي	\N	\N	جديد	وسائل التواصل	\N	مسيحي	ذكر	\N
10	Mohamed Nagy	محمد ناجي	hany.shaker476@example.com	01081915276	Emirati	\N	\N	2018-02-28	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Muslim	Male	13	["Student"]	\N	إماراتي	\N	\N	جديد	يوم مفتوح	\N	مسلم	ذكر	\N
11	Layla Gamayl	ليلى جميل	shahd.hassan106@example.com	01000903560	Bahraini	\N	\N	2011-10-19	Contacted	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	5	Muslim	Female	13	["Student"]	\N	بحريني	\N	\N	تم التواصل	وسائل التواصل	\N	مسلم	أنثى	\N
12	Mana Hasn	منى حسن	nadia.hussein567@example.com	01043719446	Yemeni	\N	\N	2016-01-03	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Christian	Female	13	["Student"]	\N	يمني	\N	\N	جديد	زيارة	\N	مسيحي	أنثى	\N
13	Salma Amr	سلمى عمر	amany.ahmed832@example.com	01080510158	Syrian	\N	\N	2019-12-29	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	8	Muslim	Female	13	["Student"]	\N	سوري	\N	\N	جديد	زيارة	\N	مسلم	أنثى	\N
14	Sara Bashra	سارة بشرى	hana.khaled165@example.com	01028695541	Egyptian	\N	\N	2010-11-12	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	7	Muslim	Female	13	["Student"]	\N	مصري	\N	\N	جديد	أخرى	\N	مسلم	أنثى	\N
15	Dayna Bashra	دينا بشرى	amany.william319@example.com	01019595590	Libyan	\N	\N	2014-08-10	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	1	Christian	Female	13	["Student"]	\N	ليبي	\N	\N	جديد	الموقع الإلكتروني	\N	مسيحي	أنثى	\N
16	Shahed Mansour	شهد منصور	fatma.william22@example.com	01049449292	Syrian	\N	\N	2008-06-25	New	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	13	Christian	Female	13	["Student"]	\N	سوري	\N	\N	جديد	زيارة	\N	مسيحي	أنثى	\N
17	Roubart Gamayl	روبرت جميل	salma.abdullah417@example.com	01002210321	Syrian	\N	\N	2014-12-03	New	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	10	Christian	Male	13	["Student"]	\N	سوري	\N	\N	جديد	الموقع الإلكتروني	\N	مسيحي	ذكر	\N
18	Yasamayn Mohamed	ياسمين محمد	john.ibrahim726@example.com	01086221851	Kuwaiti	\N	\N	2017-05-31	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	12	Christian	Male	13	["Student"]	\N	كويتي	\N	\N	جديد	الموقع الإلكتروني	\N	مسيحي	ذكر	\N
19	Ahmed Ahmed	أحمد أحمد	hassan.hassan616@example.com	01058780793	Libyan	\N	\N	2017-04-07	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	8	Christian	Male	13	["Student"]	\N	ليبي	\N	\N	جديد	أخرى	\N	مسيحي	ذكر	\N
20	Bayatr Mohamed	بيتر محمد	william.nagy483@example.com	01055907604	Sudanese	\N	\N	2015-10-11	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Muslim	Male	13	["Student"]	\N	سوداني	\N	\N	جديد	توصية	\N	مسلم	ذكر	\N
21	Dayna Ahmed	دينا أحمد	mona.william259@example.com	01009097580	Tunisian	\N	\N	2009-06-17	Contacted	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	5	Muslim	Female	13	["Student"]	\N	تونسي	\N	\N	تم التواصل	يوم مفتوح	\N	مسلم	أنثى	\N
22	Nour Salh	نور صالح	sara.william67@example.com	01017886490	Egyptian	\N	\N	2016-03-09	New	Social Media	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Christian	Female	13	["Student"]	\N	مصري	\N	\N	جديد	استفسار هاتفي	\N	مسيحي	أنثى	\N
23	Layla Amr	ليلى عمر	shahd.girgis273@example.com	01067157496	Saudi	\N	\N	2022-04-11	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	10	Muslim	Female	13	["Student"]	\N	سعودي	\N	\N	جديد	الموقع الإلكتروني	\N	مسلم	أنثى	\N
24	Sara Ahmed	سارة أحمد	dina.fahmy834@example.com	01028101601	Emirati	\N	\N	2021-02-23	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	3	Muslim	Female	13	["Student"]	\N	إماراتي	\N	\N	جديد	يوم مفتوح	\N	مسلم	أنثى	\N
25	Samr Aly	سامر علي	george.khaled237@example.com	01020212078	Tunisian	\N	\N	2020-11-25	Contacted	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	12	Muslim	Male	13	["Student"]	\N	تونسي	\N	\N	تم التواصل	يوم مفتوح	\N	مسلم	ذكر	\N
26	Yasamayn Salh	ياسمين صالح	hassan.saleh309@example.com	01080146181	Sudanese	\N	\N	2012-06-12	Contacted	Phone Inquiry	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	5	Muslim	Male	13	["Student"]	\N	سوداني	\N	\N	تم التواصل	يوم مفتوح	\N	مسلم	ذكر	\N
27	Malk Amr	ملك عمر	nour.saleh775@example.com	01037576914	Kuwaiti	\N	\N	2020-06-02	Contacted	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	12	Muslim	Female	13	["Student"]	\N	كويتي	\N	\N	تم التواصل	استفسار هاتفي	\N	مسلم	أنثى	\N
28	Haba Zaky	هبة زكي	shahd.bishara931@example.com	01079845189	Qatari	\N	\N	2009-02-13	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Muslim	Female	13	["Student"]	\N	قطري	\N	\N	جديد	وسائل التواصل	\N	مسلم	أنثى	\N
29	Shahed Bashra	شهد بشرى	rania.hussein415@example.com	01051629735	Qatari	\N	\N	2019-04-03	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	10	Christian	Female	13	["Student"]	\N	قطري	\N	\N	جديد	توصية	\N	مسيحي	أنثى	\N
6	Nadya Androu	نادية أندرو	Nadya.Aly325@example.com	01055423199	Egyptian	31101010100000	\N	2011-01-01	New	Social Media	\N	2026-06-14 02:55:33	2026-06-14 17:04:07	\N	2	Christian	Female	13	["Student"]	\N	تونسي	\N	\N	جديد	استفسار هاتفي	\N	مسيحي	ذكر	\N
1	Fatma Oulyam	فاطمة وليام	mariam.ali427@example.com	01060064161	Sudanese	\N	\N	2015-08-02	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	8	Christian	Female	13	["Student"]	\N	سوداني	\N	\N	جديد	إعلان	\N	مسيحي	أنثى	\N
30	Yasamayn Bashra	ياسمين بشرى	sara.mikhail457@example.com	01035359697	Omani	\N	\N	2010-01-02	New	Other	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Muslim	Female	13	["Student"]	\N	عماني	\N	\N	جديد	توصية	\N	مسلم	أنثى	\N
31	Mana Maykhaayl	منى ميخائيل	nour.abdullah827@example.com	01035167665	Algerian	\N	\N	2008-12-27	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	8	Christian	Female	13	["Student"]	\N	جزائري	\N	\N	جديد	توصية	\N	مسيحي	أنثى	\N
32	Layla Oulyam	ليلى وليام	malak.shaker801@example.com	01006572704	Lebanese	\N	\N	2017-05-05	New	Other	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	6	Christian	Female	13	["Student"]	\N	لبناني	\N	\N	جديد	يوم مفتوح	\N	مسيحي	أنثى	\N
33	Amany Oulyam	أماني وليام	sara.omar723@example.com	01049141769	Palestinian	\N	\N	2017-08-13	Contacted	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	13	Muslim	Female	13	["Student"]	\N	فلسطيني	\N	\N	تم التواصل	يوم مفتوح	\N	مسلم	أنثى	\N
34	Nadr Aly	نادر علي	david.rizk597@example.com	01052797666	Omani	\N	\N	2019-03-17	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	4	Muslim	Male	13	["Student"]	\N	عماني	\N	\N	جديد	استفسار هاتفي	\N	مسلم	ذكر	\N
35	Mana Shakr	منى شاكر	yasmin.rizk130@example.com	01002986486	Palestinian	\N	\N	2012-08-12	Contacted	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	4	Christian	Female	13	["Student"]	\N	فلسطيني	\N	\N	تم التواصل	إعلان	\N	مسيحي	أنثى	\N
36	Salma Maykhaayl	سلمى ميخائيل	amany.fahmy775@example.com	01008839311	Yemeni	\N	\N	2017-09-05	Contacted	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	3	Muslim	Female	13	["Student"]	\N	يمني	\N	\N	تم التواصل	الموقع الإلكتروني	\N	مسلم	أنثى	\N
37	Layla Razq	ليلى رزق	samuel.mansour193@example.com	01061272367	Libyan	\N	\N	2007-09-26	New	Phone Inquiry	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	3	Christian	Male	13	["Student"]	\N	ليبي	\N	\N	جديد	وسائل التواصل	\N	مسيحي	ذكر	\N
38	Amany Zaky	أماني زكي	amany.bishara348@example.com	01096397343	Yemeni	\N	\N	2021-01-21	New	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Muslim	Female	13	["Student"]	\N	يمني	\N	\N	جديد	استفسار هاتفي	\N	مسلم	أنثى	\N
39	Layla Zaky	ليلى زكي	nour.bishara54@example.com	01001331273	Syrian	\N	\N	2013-11-13	Contacted	Open Day	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	8	Muslim	Female	13	["Student"]	\N	سوري	\N	\N	تم التواصل	زيارة	\N	مسلم	أنثى	\N
40	Malk Razq	ملك رزق	hana.hanna787@example.com	01071647430	Tunisian	\N	\N	2015-01-13	New	Referral	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	6	Christian	Female	13	["Student"]	\N	تونسي	\N	\N	جديد	أخرى	\N	مسيحي	أنثى	\N
41	Shahed Zaky	شهد زكي	laila.mikhail747@example.com	01068458148	Tunisian	\N	\N	2021-01-22	New	Other	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	12	Christian	Female	13	["Student"]	\N	تونسي	\N	\N	جديد	زيارة	\N	مسيحي	أنثى	\N
42	Fatma Maykhaayl	فاطمة ميخائيل	fatma.ibrahim729@example.com	01049613754	Palestinian	\N	\N	2021-04-16	Contacted	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	4	Christian	Female	13	["Student"]	\N	فلسطيني	\N	\N	تم التواصل	زيارة	\N	مسيحي	أنثى	\N
43	Hanaa Ahmed	هناء أحمد	shahd.maged830@example.com	01079832419	Qatari	\N	\N	2021-10-31	New	Social Media	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	12	Muslim	Female	13	["Student"]	\N	قطري	\N	\N	جديد	الموقع الإلكتروني	\N	مسلم	أنثى	\N
44	Dayna Zaky	دينا زكي	mina.hassan650@example.com	01005833639	Omani	\N	\N	2013-04-11	Contacted	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	10	Christian	Male	13	["Student"]	\N	عماني	\N	\N	تم التواصل	أخرى	\N	مسيحي	ذكر	\N
45	Haba Aly	هبة علي	rania.mohamed309@example.com	01004807719	Emirati	\N	\N	2013-11-03	New	Social Media	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	4	Muslim	Female	13	["Student"]	\N	إماراتي	\N	\N	جديد	وسائل التواصل	\N	مسلم	أنثى	\N
46	Hanaa Oulyam	هناء وليام	amany.fahmy412@example.com	01063925362	Algerian	\N	\N	2014-06-28	New	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	2	Muslim	Female	13	["Student"]	\N	جزائري	\N	\N	جديد	وسائل التواصل	\N	مسلم	أنثى	\N
47	Ahmed Maykhaayl	أحمد ميخائيل	ali.ahmed45@example.com	01060583406	Palestinian	\N	\N	2016-12-29	New	Website	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	11	Muslim	Male	13	["Student"]	\N	فلسطيني	\N	\N	جديد	استفسار هاتفي	\N	مسلم	ذكر	\N
48	Salma Khaled	سلمى خالد	mona.khaled175@example.com	01086565809	Qatari	\N	\N	2016-09-17	Contacted	Other	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Christian	Male	13	["Student"]	\N	قطري	\N	\N	تم التواصل	إعلان	\N	مسيحي	ذكر	\N
49	Maraym Oulyam	مريم وليام	samuel.omar843@example.com	01051309588	Moroccan	\N	\N	2017-10-04	Contacted	Walk-in	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	1	Christian	Male	13	["Student"]	\N	مغربي	\N	\N	تم التواصل	يوم مفتوح	\N	مسيحي	ذكر	\N
50	Amany Oulyam	أماني وليام	dina.bishara744@example.com	01078388963	Emirati	\N	\N	2019-05-18	New	Advertisement	\N	2026-06-14 02:55:33	2026-06-14 17:02:08	\N	15	Muslim	Female	13	["Student"]	\N	إماراتي	\N	\N	جديد	زيارة	\N	مسلم	أنثى	\N
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
30	2026_06_07_000001_create_academic_years_table	16
31	2026_06_07_000002_create_terms_table	16
32	2026_06_07_000003_create_enrollments_table	16
33	2026_06_07_000004_create_attendance_table	17
34	2026_06_07_000005_create_exams_table	18
35	2026_06_07_000006_create_exam_subject_table	19
36	2026_06_07_000007_create_exam_records_table	20
37	2026_06_07_205605_create_personal_access_tokens_table	21
38	2026_06_12_000001_add_lead_id_to_users_table	22
39	2026_06_13_000001_add_locale_to_users_table	23
40	2026_06_13_130800_add_arabic_fields_to_contacts_and_leads_tables	24
41	2026_06_13_143942_add_photo_to_contacts_and_leads_tables	25
42	2026_06_13_150000_create_contact_documents_table	26
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
1	App\\Models\\User	1	api-token	6a14c88f40ac0cad9e2345caa7f4e7004c4e1f0d5a17697d3e9aa2863f513a00	["admin"]	\N	\N	2026-06-07 21:09:52	2026-06-07 21:09:52
34	App\\Models\\User	1	api-token	da540c805f7b4e0fa80c0a246b44a907030d5ba849f9507f23bbbd5d843e94c9	["admin"]	2026-06-07 21:31:18	\N	2026-06-07 21:31:18	2026-06-07 21:31:18
35	App\\Models\\User	1	api-token	3eab0275024d9abb4e7501ae3a8c5eae94a689edbde5ec6b6fa5ac02456b1007	["admin"]	2026-06-07 21:31:46	\N	2026-06-07 21:31:40	2026-06-07 21:31:46
36	App\\Models\\User	2	api-token	cc6c28be41f34ac837301a8c400ca3c82697acea64484ee2095ad3e0c9919438	["hr"]	2026-06-07 21:32:32	\N	2026-06-07 21:32:32	2026-06-07 21:32:32
37	App\\Models\\User	1	api-token	7be2181a669eaf7fcbef6340069a54e1e2f64627e274579ef30422de2799d7a3	["admin"]	2026-06-08 05:52:44	\N	2026-06-08 05:52:44	2026-06-08 05:52:44
38	App\\Models\\User	1	api-token	96d4f40120ad2a74321ba60644cba4b87b1d2b346b6e235ecfc1ed34523a3b53	["admin"]	2026-06-08 05:59:31	\N	2026-06-08 05:59:31	2026-06-08 05:59:31
39	App\\Models\\User	1	api-token	b747a2119f75821691aa1c5d7eb445f0edb8b1663e3e98dbba800ceb2f4b0c3f	["admin"]	2026-06-08 06:00:16	\N	2026-06-08 06:00:15	2026-06-08 06:00:16
40	App\\Models\\User	1	api-token	c1682b523d83cb650d44223fd789ef9065fd8c79edee36dfd97ccc551e35ae19	["admin"]	2026-06-08 06:09:21	\N	2026-06-08 06:09:21	2026-06-08 06:09:21
41	App\\Models\\User	1	api-token	2443aa1db4994f99d6070daef746d8ab91105f45a1336cb5744e12f9df6f07e2	["admin"]	2026-06-08 08:53:48	\N	2026-06-08 08:53:48	2026-06-08 08:53:48
42	App\\Models\\User	1	api-token	1282f0d9f4e79b9f3e2501dee006005dcc958b4d21b23e2bceca498e4409f2b1	["admin"]	2026-06-08 09:28:30	\N	2026-06-08 09:28:20	2026-06-08 09:28:30
43	App\\Models\\User	1	api-token	ccc8182d8e723da8b5060fa828296b4502bc680c9b82391836a7cdc9d8ab0ba1	["admin"]	2026-06-08 09:31:41	\N	2026-06-08 09:31:41	2026-06-08 09:31:41
44	App\\Models\\User	1	api-token	1b0eff1357a6026f55b69b10f6127b78336bb095e5ebd7f79717838996cdfe62	["admin"]	2026-06-08 09:49:59	\N	2026-06-08 09:49:59	2026-06-08 09:49:59
45	App\\Models\\User	1	api-token	bc5817086b3660bf0e1657cfd9d0007a4939001c846c16b5182cbf91566989f3	["admin"]	2026-06-08 09:51:35	\N	2026-06-08 09:51:35	2026-06-08 09:51:35
46	App\\Models\\User	1	api-token	9778b4e61381b6aacfb79e155c2f90cf5cf35c4400dd09ac4653097933dc014e	["admin"]	2026-06-08 12:58:41	\N	2026-06-08 12:58:41	2026-06-08 12:58:41
47	App\\Models\\User	1	api-token	bcdecd511572916ce80f17b30e0e098d04557a69aba7344693d495c8703c570a	["admin"]	2026-06-08 13:05:36	\N	2026-06-08 13:05:36	2026-06-08 13:05:36
48	App\\Models\\User	1	api-token	7e05d7af370d90d1c2ab429d83d88a2a807b0725afa02361919e323fc6ae28f6	["admin"]	2026-06-08 19:13:09	\N	2026-06-08 19:13:09	2026-06-08 19:13:09
49	App\\Models\\User	1	api-token	54b65221feb5974f55f454620cc671b962700f328943ee6713802a4835d32bc7	["admin"]	2026-06-08 20:22:39	\N	2026-06-08 20:22:39	2026-06-08 20:22:39
50	App\\Models\\User	1	api-token	710d12278524e767e91de4de2eb868605dd34302740bf66e3dabefa04989cbb4	["admin"]	2026-06-08 20:52:57	\N	2026-06-08 20:52:57	2026-06-08 20:52:57
51	App\\Models\\User	1	api-token	9a21e81084fa2b40dbad88bf609713bd2e8b1546b122337cb6cfff15ff78c3a2	["admin"]	\N	\N	2026-06-08 21:01:40	2026-06-08 21:01:40
\.


--
-- Data for Name: schools; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.schools (id, "nameEn", "nameAr", address, phone, email, website, logo, principal_name, mission, vision, social_facebook, social_twitter, social_instagram, social_linkedin, established_year, created_at, updated_at) FROM stdin;
1	Kashmos International School	مدرسة كاشموس الدولية	390	+201012872168	info@kashmos.com	https://www.kashmos.com	/storage/school-logos/ljVnR3HdveN0PYcIWTDEK6Xf9ml9tGyQhiQtH3qF.jpg	Mrs. Heba Mahmoud	Kashmos International school is committed to providing an excellent, globally-minded education that nurtures every student’s unique potential. We inspire our diverse community of learners to become inquiring, knowledgeable, and caring global citizens who contribute to a better and more peaceful world through intercultural understanding and respect.\n\nThrough a student-centered, holistic approach, we:\n\n    Inspire students to take proactive roles as responsible global citizens\n\n    Support every learner to achieve their individual potential and become well-rounded, lifelong learners\n\n    Nourish minds and spirits in a safe, respectful, and caring environment\n\n    Empathize with diverse cultures and foster intercultural understanding\n\n    Prepare today’s learners to confidently embrace challenges as adaptable, empathetic leaders for a sustainable future\n\nOur innovative pedagogy encourages students to respect each other and the environment, communicate through active dialogue, and create the foundations of a collaborative society. We deliver world-class education with a global perspective, outstanding teaching methodology, and an ethos of integrity for students from diverse backgrounds.	Kashmos International school  visions to be a leading international school recognized globally for fostering academic excellence, intercultural understanding, and ethical leadership. We aspire to create a learning community where every student is empowered to thrive as a confident, compassionate, and innovative global citizen ready to shape a sustainable and peaceful future.\n\nWe envision:\n\n    A school where diversity is celebrated and every student feels valued, respected, and inspired to reach their full potential\n\n    World-class education that blends cutting-edge pedagogy with timeless values, preparing learners for the challenges of tomorrow\n\n    Lifelong learners who think critically, act creatively, and communicate with clarity and empathy across cultures\n\n    A collaborative community of students, families, teachers, and partners united by shared purpose and mutual respect\n\n    An innovative learning environment that integrates technology, sustainability, and global perspectives into every aspect of education\n\n    Ethical leaders who contribute positively to their communities and work toward a more just, equitable, and peaceful world\n\nOur vision is to set the standard for international education—where excellence meets character, and where every learner discovers their purpose and impact on the world.					2026	2026-06-06 08:42:51	2026-06-06 09:57:52
\.


--
-- Data for Name: sections; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.sections (id, grade_id, name, name_ar, created_at, updated_at) FROM stdin;
403	1	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
404	1	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
405	2	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
406	2	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
407	3	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
408	3	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
409	4	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
410	4	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
411	5	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
412	5	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
413	6	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
414	6	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
415	7	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
416	7	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
417	8	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
418	8	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
419	9	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
420	9	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
421	10	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
422	10	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
423	11	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
424	11	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
425	12	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
426	12	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
427	13	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
428	13	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
429	14	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
430	14	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
431	15	A	أ	2026-06-15 18:23:59	2026-06-15 18:23:59
432	15	B	ب	2026-06-15 18:23:59	2026-06-15 18:23:59
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
vlgdVqwqvYmKc5RGc7yPZmCMSrvZTw8aWhio3a7L	1	172.18.0.1	Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0	eyJfdG9rZW4iOiJvckE4VDBSaDFKN0hVNHhYbDh6eGw4akVtWmN5SmYzOVV0U3pEanl5IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9lbnJvbGxtZW50cyIsInJvdXRlIjoiZW5yb2xsbWVudHMifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsImxvY2FsZSI6ImVuIn0=	1781548783
\.


--
-- Data for Name: stages; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.stages (id, name, name_ar, level_order, description, created_at, updated_at) FROM stdin;
21	Pre-K & KG	مرحلة ما قبل الروضة ورياض الأطفال	0	Early years foundation — Pre-KG, KG1, KG2	2026-06-14 02:55:32	2026-06-14 02:55:32
22	Primary	المرحلة الإبتدائية	1	Primary education — Grades 1 through 6	2026-06-14 02:55:32	2026-06-14 02:55:32
23	Preparatory	المرحلة الإعدادية	2	Middle school — Grades 7 through 9	2026-06-14 02:55:32	2026-06-14 02:55:32
24	Secondary	المرحلة الثانوية	3	High school — Grades 10 through 12	2026-06-14 02:55:32	2026-06-14 02:55:32
\.


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.students (id, contact_id, grade_id, section_id, second_language_id, government_code, seat_no, secret_code, father_id, mother_id, guardian, photo, age_at_october, created_at, updated_at) FROM stdin;
34	1551	1	\N	15	022647464502	4	0355	1493	1508	father	\N	5	2026-06-14 02:55:33	2026-06-14 02:55:33
23	1540	2	\N	13	657014549886	18	5609	1505	1486	father	\N	15	2026-06-14 02:55:33	2026-06-14 02:55:33
1	1518	2	\N	15	942259994674	8	7130	1489	1484	father	\N	10	2026-06-14 02:55:33	2026-06-14 02:55:33
38	1555	2	\N	16	116879526888	27	6966	1479	1484	father	\N	17	2026-06-14 02:55:33	2026-06-14 02:55:33
21	1538	2	\N	15	321960743525	24	3523	1504	1490	father	\N	13	2026-06-14 02:55:33	2026-06-14 02:55:33
36	1553	2	\N	16	932948770333	35	5283	1489	1490	father	\N	9	2026-06-14 02:55:33	2026-06-14 02:55:33
40	1557	3	\N	15	081321594298	6	7423	1494	1478	father	\N	7	2026-06-14 02:55:33	2026-06-14 02:55:33
41	1558	3	\N	16	754610419519	19	5996	1493	1491	father	\N	14	2026-06-14 02:55:33	2026-06-14 02:55:33
59	1576	11	423	14	293369126702	33	5125	1489	1484	father	\N	16	2026-06-14 02:55:33	2026-06-15 18:35:35
31	1548	4	\N	14	917634572196	22	8622	1483	1490	father	\N	15	2026-06-14 02:55:33	2026-06-14 02:55:33
27	1544	4	\N	16	570377898607	29	3575	1488	1487	father	\N	7	2026-06-14 02:55:33	2026-06-14 02:55:33
56	1573	6	414	13	328774608869	14	7447	1509	1481	father	\N	14	2026-06-14 02:55:33	2026-06-15 18:35:41
22	1539	6	\N	13	524414676381	19	7231	1516	1490	father	\N	14	2026-06-14 02:55:33	2026-06-14 02:55:33
55	1572	9	419	13	574017997233	29	3957	1488	1478	father	\N	15	2026-06-14 02:55:33	2026-06-15 18:35:42
39	1556	6	\N	15	286083116359	37	6892	1511	1506	father	\N	16	2026-06-14 02:55:33	2026-06-14 02:55:33
33	1550	8	\N	15	336186122434	38	0312	1485	1507	father	\N	13	2026-06-14 02:55:33	2026-06-14 02:55:33
24	1541	11	\N	14	593738586887	11	3652	1485	1478	father	\N	15	2026-06-14 02:55:33	2026-06-14 02:55:33
28	1545	11	\N	16	310770533711	4	7088	1505	1506	father	\N	10	2026-06-14 02:55:33	2026-06-14 02:55:33
58	1575	13	428	15	914712218448	33	5957	1513	1508	father	\N	14	2026-06-14 02:55:33	2026-06-15 18:35:37
25	1542	13	\N	15	131901737808	25	1815	1516	1517	father	\N	16	2026-06-14 02:55:33	2026-06-14 02:55:33
57	1574	4	409	13	279702819250	37	1673	1482	1514	father	\N	6	2026-06-14 02:55:33	2026-06-15 18:35:39
26	1543	13	\N	15	358271817535	37	1518	1485	1487	father	\N	15	2026-06-14 02:55:33	2026-06-14 02:55:33
37	1554	13	\N	16	927697064561	18	5676	1515	1484	father	\N	15	2026-06-14 02:55:33	2026-06-14 02:55:33
61	1578	4	409	13	\N	\N	\N	\N	\N	father	\N	11	2026-06-14 17:07:29	2026-06-15 18:35:27
60	1577	3	408	16	795950901246	30	4568	1483	1502	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:35:33
54	1571	11	424	13	292477924129	15	8148	1479	1478	father	\N	8	2026-06-14 02:55:33	2026-06-15 18:35:44
53	1570	13	427	15	634917476084	38	8645	1479	1508	father	\N	7	2026-06-14 02:55:33	2026-06-15 18:35:48
52	1569	5	412	13	381023043812	36	6531	1504	1496	father	\N	9	2026-06-14 02:55:33	2026-06-15 18:35:49
51	1568	5	411	16	082441775641	39	5963	1511	1480	father	\N	18	2026-06-14 02:55:33	2026-06-15 18:35:51
50	1567	8	418	14	276111289433	30	8184	1515	1506	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:35:52
49	1566	4	409	15	428097977553	15	9307	1495	1502	father	\N	4	2026-06-14 02:55:33	2026-06-15 18:35:53
48	1565	4	410	16	350252604943	5	8602	1510	1481	father	\N	13	2026-06-14 02:55:33	2026-06-15 18:35:55
47	1564	4	409	14	320659521395	3	5993	1482	1498	father	\N	8	2026-06-14 02:55:33	2026-06-15 18:35:57
46	1563	5	412	13	424825483051	35	2617	1509	1486	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:36:01
45	1562	4	409	15	517130382443	14	4790	1516	1484	father	\N	7	2026-06-14 02:55:33	2026-06-15 18:36:02
44	1561	12	426	13	174346414627	31	3407	1479	1514	father	\N	19	2026-06-14 02:55:33	2026-06-15 18:36:05
42	1559	1	404	13	008610777569	33	1594	1493	1507	father	\N	18	2026-06-14 02:55:33	2026-06-15 18:36:08
20	1537	2	406	13	562639638359	10	6113	1504	1480	father	\N	10	2026-06-14 02:55:33	2026-06-15 18:36:38
19	1536	10	421	13	655198963939	22	9645	1513	1480	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:36:39
18	1535	2	406	15	613694001385	22	8868	1509	1501	father	\N	9	2026-06-14 02:55:33	2026-06-15 18:36:41
17	1534	10	421	15	923936657672	24	4284	1511	1498	father	\N	17	2026-06-14 02:55:33	2026-06-15 18:36:42
16	1533	14	430	13	838178755786	24	3070	1488	1487	father	\N	13	2026-06-14 02:55:33	2026-06-15 18:36:43
15	1532	4	409	16	512775261413	9	6975	1493	1517	father	\N	8	2026-06-14 02:55:33	2026-06-15 18:36:45
14	1531	8	418	13	894703859992	22	6510	1494	1496	father	\N	13	2026-06-14 02:55:33	2026-06-15 18:36:48
12	1529	3	408	16	267802246365	3	5366	1489	1500	father	\N	18	2026-06-14 02:55:33	2026-06-15 18:36:51
11	1528	6	413	15	987062952702	39	9973	1483	1478	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:36:52
10	1527	6	414	13	693585548562	25	5310	1489	1491	father	\N	11	2026-06-14 02:55:33	2026-06-15 18:36:54
9	1526	3	407	15	925519949699	20	3103	1493	1481	father	\N	5	2026-06-14 02:55:33	2026-06-15 18:36:56
8	1525	5	412	14	480529568530	23	0600	1513	1498	father	\N	10	2026-06-14 02:55:33	2026-06-15 18:36:59
6	1523	10	422	13	656874633677	22	5462	1493	1484	father	\N	13	2026-06-14 02:55:33	2026-06-15 18:37:02
5	1522	4	409	13	098986979877	27	0499	1509	1507	father	\N	8	2026-06-14 02:55:33	2026-06-15 18:37:04
3	1520	9	419	14	343739599023	29	6014	1504	1503	father	\N	12	2026-06-14 02:55:33	2026-06-15 18:37:07
2	1519	12	426	13	933721189744	9	8387	1479	1506	father	\N	11	2026-06-14 02:55:33	2026-06-15 18:37:09
29	1546	14	\N	16	410404213214	7	1466	1483	1498	father	\N	5	2026-06-14 02:55:33	2026-06-14 02:55:33
32	1549	14	\N	14	060336750345	20	2440	1492	1508	father	\N	5	2026-06-14 02:55:33	2026-06-14 02:55:33
30	1547	14	\N	15	474433836253	31	7169	1489	1480	father	\N	11	2026-06-14 02:55:33	2026-06-14 02:55:33
35	1552	14	\N	14	872076009179	3	8174	1483	1501	father	\N	12	2026-06-14 02:55:33	2026-06-14 02:55:33
43	1560	15	431	16	610844823715	8	0664	1479	1517	father	\N	14	2026-06-14 02:55:33	2026-06-15 18:36:06
13	1530	15	431	13	345058336506	13	9973	1516	1514	father	\N	17	2026-06-14 02:55:33	2026-06-15 18:36:49
7	1524	14	429	13	539614678496	12	1330	1485	1496	father	\N	19	2026-06-14 02:55:33	2026-06-15 18:37:01
4	1521	14	430	14	542952676202	32	7475	1492	1502	father	\N	15	2026-06-14 02:55:33	2026-06-15 18:37:05
\.


--
-- Data for Name: subjects; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.subjects (id, name, name_ar, description, created_at, updated_at, parent_id, is_main, is_religion_based, religion) FROM stdin;
1	Mathematics	الرياضيات	Core mathematics covering numbers, operations, and problem-solving	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
2	Algebra	الجبر	Algebraic expressions, equations, and functions	2026-06-14 02:55:32	2026-06-14 02:55:32	1	t	f	\N
3	Geometry	الهندسة	Shapes, angles, proofs, and spatial reasoning	2026-06-14 02:55:32	2026-06-14 02:55:32	1	t	f	\N
4	Trigonometry	علم المثلثات	Triangles, trigonometric functions, and identities	2026-06-14 02:55:32	2026-06-14 02:55:32	1	f	f	\N
5	Science	العلوم	General science foundation covering natural phenomena	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
6	Physics	الفيزياء	Matter, energy, motion, and fundamental forces	2026-06-14 02:55:32	2026-06-14 02:55:32	5	t	f	\N
7	Chemistry	الكيمياء	Elements, compounds, reactions, and chemical processes	2026-06-14 02:55:32	2026-06-14 02:55:32	5	t	f	\N
8	Biology	الأحياء	Living organisms, cells, genetics, and ecosystems	2026-06-14 02:55:32	2026-06-14 02:55:32	5	t	f	\N
9	Arabic Language	اللغة العربية	Arabic reading, writing, grammar, and literature	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
10	English OL	اللغة الإنجليزية	English reading, writing, grammar, and comprehension (Ordinary Level)	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
11	English AL	اللغة الإنجليزية (متقدم)	Advanced English literature, composition, and critical analysis (Advanced Level)	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
12	Second Language	اللغة الثانية	Students choose one foreign language from the available options	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
13	French	الفرنسية	French language — speaking, writing, and culture	2026-06-14 02:55:32	2026-06-14 02:55:32	12	f	f	\N
14	German	الألمانية	German language — speaking, writing, and culture	2026-06-14 02:55:32	2026-06-14 02:55:32	12	f	f	\N
15	Spanish	الإسبانية	Spanish language — speaking, writing, and culture	2026-06-14 02:55:32	2026-06-14 02:55:32	12	f	f	\N
16	Italian	الإيطالية	Italian language — speaking, writing, and culture	2026-06-14 02:55:32	2026-06-14 02:55:32	12	f	f	\N
17	Religious Education	التربية الدينية	Splits into Islamic and Christian tracks based on student religion	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	t	\N
18	Islamic Education	التربية الإسلامية	Quran, Hadith, Fiqh, and Islamic studies for Muslim students	2026-06-14 02:55:32	2026-06-14 02:55:32	17	t	f	Muslim
19	Christian Education	التربية المسيحية	Bible studies, Christian ethics, and religious teachings for Christian students	2026-06-14 02:55:32	2026-06-14 02:55:32	17	t	f	Christian
20	Social Studies	الدراسات الاجتماعية	Study of human society, history, and geography	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	t	f	\N
21	History	التاريخ	World and national history, civilizations, and historical analysis	2026-06-14 02:55:32	2026-06-14 02:55:32	20	t	f	\N
22	Geography	الجغرافيا	Physical and human geography, maps, and environmental studies	2026-06-14 02:55:32	2026-06-14 02:55:32	20	t	f	\N
23	Physical Education	التربية البدنية	Sports, fitness, motor skills, and healthy lifestyle	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	f	f	\N
24	Art	التربية الفنية	Visual arts, drawing, painting, and creative expression	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	f	f	\N
25	Computer Science	علوم الحاسب	Computers, programming, digital literacy, and technology skills	2026-06-14 02:55:32	2026-06-14 02:55:32	\N	f	f	\N
\.


--
-- Data for Name: terms; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.terms (id, academic_year_id, name, start_date, end_date, is_current, created_at, updated_at) FROM stdin;
23	12	Semester 1	2024-09-01	2024-12-31	f	2026-06-14 02:55:33	2026-06-14 02:55:33
24	12	Semester 2	2025-01-01	2025-06-30	f	2026-06-14 02:55:33	2026-06-14 02:55:33
25	13	Semester 1	2025-09-01	2025-12-31	f	2026-06-14 02:55:33	2026-06-14 02:55:33
26	13	Semester 2	2026-01-01	2026-06-30	f	2026-06-14 02:55:33	2026-06-14 02:55:33
27	14	Semester 1	2026-09-01	2026-12-31	t	2026-06-14 02:55:33	2026-06-14 02:55:33
28	14	Semester 2	2027-01-01	2027-06-30	f	2026-06-14 02:55:33	2026-06-14 02:55:33
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sail
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, lead_id, locale) FROM stdin;
3	Amany Bashra	salma.hussein664@example.com	\N	$2y$12$EqrmQaOE0oLj5x8T7y4t.OiB/3qGqE11Z9iZd2MLZKZbHHwmx7TWK	\N	2026-06-14 17:07:29	2026-06-14 17:07:29	student	3	en
4	Guest User	guest@example.com	2026-06-15 06:36:15	$2y$12$1UwXmtwf.tNiXJcAsEedP.Nj41nz42S/woERtmH6LG2koakvMTCEe	7t7eQfmHOy0bZHto7Av8TLEAymGDw0OLpT66D76EkhOSu7aTYMVn7a7sGXdy	2026-06-15 06:36:15	2026-06-15 06:36:15	guest	\N	en
1	Admin User	admin@school.com	2026-06-14 02:55:33	$2y$12$kl3SRnBRR1GNQIh8XIl2v.S.cZBOX3Z2OCULakPjonLO6SEEIYyIW	\N	2026-06-14 02:55:33	2026-06-15 18:33:19	admin	\N	en
\.


--
-- Name: academic_years_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.academic_years_id_seq', 14, true);


--
-- Name: attendance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.attendance_id_seq', 1193, true);


--
-- Name: contact_documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.contact_documents_id_seq', 3, true);


--
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.contacts_id_seq', 1578, true);


--
-- Name: enrollments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.enrollments_id_seq', 147, true);


--
-- Name: exam_records_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.exam_records_id_seq', 255, true);


--
-- Name: exams_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.exams_id_seq', 27, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: grade_stage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grade_stage_id_seq', 120, true);


--
-- Name: grade_subject_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grade_subject_id_seq', 45, true);


--
-- Name: grades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.grades_id_seq', 15, true);


--
-- Name: interactions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.interactions_id_seq', 117, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: leads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.leads_id_seq', 50, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.migrations_id_seq', 42, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 51, true);


--
-- Name: schools_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.schools_id_seq', 2, true);


--
-- Name: sections_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.sections_id_seq', 432, true);


--
-- Name: stages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.stages_id_seq', 24, true);


--
-- Name: students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.students_id_seq', 61, true);


--
-- Name: subjects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.subjects_id_seq', 25, true);


--
-- Name: terms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.terms_id_seq', 28, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sail
--

SELECT pg_catalog.setval('public.users_id_seq', 4, true);


--
-- Name: academic_years academic_years_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.academic_years
    ADD CONSTRAINT academic_years_pkey PRIMARY KEY (id);


--
-- Name: attendance attendance_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance
    ADD CONSTRAINT attendance_pkey PRIMARY KEY (id);


--
-- Name: attendance attendance_student_id_date_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance
    ADD CONSTRAINT attendance_student_id_date_unique UNIQUE (student_id, date);


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
-- Name: contact_documents contact_documents_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contact_documents
    ADD CONSTRAINT contact_documents_pkey PRIMARY KEY (id);


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
-- Name: enrollments enrollments_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments
    ADD CONSTRAINT enrollments_pkey PRIMARY KEY (id);


--
-- Name: exam_records exam_record_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records
    ADD CONSTRAINT exam_record_unique UNIQUE (exam_id, student_id, subject_id);


--
-- Name: exam_records exam_records_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records
    ADD CONSTRAINT exam_records_pkey PRIMARY KEY (id);


--
-- Name: exam_subject exam_subject_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_subject
    ADD CONSTRAINT exam_subject_pkey PRIMARY KEY (exam_id, subject_id);


--
-- Name: exams exams_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exams
    ADD CONSTRAINT exams_pkey PRIMARY KEY (id);


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
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


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
-- Name: terms terms_pkey; Type: CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.terms
    ADD CONSTRAINT terms_pkey PRIMARY KEY (id);


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
-- Name: personal_access_tokens_expires_at_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX personal_access_tokens_expires_at_index ON public.personal_access_tokens USING btree (expires_at);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: sail
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: attendance attendance_created_by_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance
    ADD CONSTRAINT attendance_created_by_foreign FOREIGN KEY (created_by) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: attendance attendance_section_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance
    ADD CONSTRAINT attendance_section_id_foreign FOREIGN KEY (section_id) REFERENCES public.sections(id) ON DELETE CASCADE;


--
-- Name: attendance attendance_student_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.attendance
    ADD CONSTRAINT attendance_student_id_foreign FOREIGN KEY (student_id) REFERENCES public.students(id) ON DELETE CASCADE;


--
-- Name: contact_documents contact_documents_contact_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.contact_documents
    ADD CONSTRAINT contact_documents_contact_id_foreign FOREIGN KEY (contact_id) REFERENCES public.contacts(id) ON DELETE CASCADE;


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
-- Name: enrollments enrollments_academic_year_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments
    ADD CONSTRAINT enrollments_academic_year_id_foreign FOREIGN KEY (academic_year_id) REFERENCES public.academic_years(id) ON DELETE CASCADE;


--
-- Name: enrollments enrollments_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments
    ADD CONSTRAINT enrollments_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id);


--
-- Name: enrollments enrollments_section_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments
    ADD CONSTRAINT enrollments_section_id_foreign FOREIGN KEY (section_id) REFERENCES public.sections(id) ON DELETE SET NULL;


--
-- Name: enrollments enrollments_student_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.enrollments
    ADD CONSTRAINT enrollments_student_id_foreign FOREIGN KEY (student_id) REFERENCES public.students(id) ON DELETE CASCADE;


--
-- Name: exam_records exam_records_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records
    ADD CONSTRAINT exam_records_exam_id_foreign FOREIGN KEY (exam_id) REFERENCES public.exams(id) ON DELETE CASCADE;


--
-- Name: exam_records exam_records_student_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records
    ADD CONSTRAINT exam_records_student_id_foreign FOREIGN KEY (student_id) REFERENCES public.students(id) ON DELETE CASCADE;


--
-- Name: exam_records exam_records_subject_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_records
    ADD CONSTRAINT exam_records_subject_id_foreign FOREIGN KEY (subject_id) REFERENCES public.subjects(id) ON DELETE CASCADE;


--
-- Name: exam_subject exam_subject_exam_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_subject
    ADD CONSTRAINT exam_subject_exam_id_foreign FOREIGN KEY (exam_id) REFERENCES public.exams(id) ON DELETE CASCADE;


--
-- Name: exam_subject exam_subject_subject_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exam_subject
    ADD CONSTRAINT exam_subject_subject_id_foreign FOREIGN KEY (subject_id) REFERENCES public.subjects(id) ON DELETE CASCADE;


--
-- Name: exams exams_grade_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exams
    ADD CONSTRAINT exams_grade_id_foreign FOREIGN KEY (grade_id) REFERENCES public.grades(id) ON DELETE CASCADE;


--
-- Name: exams exams_term_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.exams
    ADD CONSTRAINT exams_term_id_foreign FOREIGN KEY (term_id) REFERENCES public.terms(id) ON DELETE CASCADE;


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
-- Name: terms terms_academic_year_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.terms
    ADD CONSTRAINT terms_academic_year_id_foreign FOREIGN KEY (academic_year_id) REFERENCES public.academic_years(id) ON DELETE CASCADE;


--
-- Name: users users_lead_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sail
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_lead_id_foreign FOREIGN KEY (lead_id) REFERENCES public.leads(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict 0e8cCc5oqsGHkR1DXReI5whhnWEMg1qZgNguSidjKSoHIwUG9XIk75G5POSHY84

