--
-- PostgreSQL database dump
--

-- Dumped from database version 14.10 (Ubuntu 14.10-1.pgdg22.04+1)
-- Dumped by pg_dump version 16.1 (Ubuntu 16.1-1.pgdg22.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: analyses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.analyses (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.analyses OWNER TO postgres;

--
-- Name: analyses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.analyses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.analyses_id_seq OWNER TO postgres;

--
-- Name: analyses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.analyses_id_seq OWNED BY public.analyses.id;


--
-- Name: analysis_parameters; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.analysis_parameters (
    id bigint NOT NULL,
    analysis_id bigint NOT NULL,
    analysis_type_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(255),
    price_per_hour bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.analysis_parameters OWNER TO postgres;

--
-- Name: analysis_parameters_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.analysis_parameters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.analysis_parameters_id_seq OWNER TO postgres;

--
-- Name: analysis_parameters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.analysis_parameters_id_seq OWNED BY public.analysis_parameters.id;


--
-- Name: analysis_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.analysis_types (
    id bigint NOT NULL,
    analysis_id bigint NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.analysis_types OWNER TO postgres;

--
-- Name: analysis_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.analysis_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.analysis_types_id_seq OWNER TO postgres;

--
-- Name: analysis_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.analysis_types_id_seq OWNED BY public.analysis_types.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: category_post; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category_post (
    id bigint NOT NULL,
    category_id bigint NOT NULL,
    post_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.category_post OWNER TO postgres;

--
-- Name: category_post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.category_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.category_post_id_seq OWNER TO postgres;

--
-- Name: category_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.category_post_id_seq OWNED BY public.category_post.id;


--
-- Name: category_product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.category_product (
    id bigint NOT NULL,
    category_id bigint NOT NULL,
    product_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.category_product OWNER TO postgres;

--
-- Name: category_product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.category_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.category_product_id_seq OWNER TO postgres;

--
-- Name: category_product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.category_product_id_seq OWNED BY public.category_product.id;


--
-- Name: conditions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conditions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    conditionable_id bigint,
    conditionable_type character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.conditions OWNER TO postgres;

--
-- Name: conditions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conditions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.conditions_id_seq OWNER TO postgres;

--
-- Name: conditions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.conditions_id_seq OWNED BY public.conditions.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: gender_post; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gender_post (
    id bigint NOT NULL,
    gender_id bigint NOT NULL,
    post_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.gender_post OWNER TO postgres;

--
-- Name: gender_post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.gender_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.gender_post_id_seq OWNER TO postgres;

--
-- Name: gender_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.gender_post_id_seq OWNED BY public.gender_post.id;


--
-- Name: gender_product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gender_product (
    id bigint NOT NULL,
    gender_id bigint NOT NULL,
    product_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.gender_product OWNER TO postgres;

--
-- Name: gender_product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.gender_product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.gender_product_id_seq OWNER TO postgres;

--
-- Name: gender_product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.gender_product_id_seq OWNED BY public.gender_product.id;


--
-- Name: genders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.genders (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.genders OWNER TO postgres;

--
-- Name: genders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.genders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.genders_id_seq OWNER TO postgres;

--
-- Name: genders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.genders_id_seq OWNED BY public.genders.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: pending_orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pending_orders (
    id bigint NOT NULL,
    owner_firstname character varying(30) NOT NULL,
    owner_lastname character varying(255) NOT NULL,
    owner_id character varying(20) NOT NULL,
    owner_email character varying(255) NOT NULL,
    owner_phone_number character varying(255) NOT NULL,
    owner_state character varying(255) NOT NULL,
    owner_city character varying(255) NOT NULL,
    owner_address character varying(255) NOT NULL,
    owner_request character varying(255) NOT NULL,
    status character varying(20) DEFAULT 'En espera'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pending_orders OWNER TO postgres;

--
-- Name: pending_orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pending_orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pending_orders_id_seq OWNER TO postgres;

--
-- Name: pending_orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pending_orders_id_seq OWNED BY public.pending_orders.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    thumbnail character varying(255),
    slug character varying(255) NOT NULL,
    body text NOT NULL,
    published boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.posts OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.posts_id_seq OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- Name: product_purchase_retail_order; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_purchase_retail_order (
    id bigint NOT NULL,
    product_id bigint NOT NULL,
    purchase_retail_order_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_purchase_retail_order OWNER TO postgres;

--
-- Name: product_purchase_retail_order_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_purchase_retail_order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.product_purchase_retail_order_id_seq OWNER TO postgres;

--
-- Name: product_purchase_retail_order_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_purchase_retail_order_id_seq OWNED BY public.product_purchase_retail_order.id;


--
-- Name: product_type_sale; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_type_sale (
    id bigint NOT NULL,
    product_id bigint NOT NULL,
    type_sale_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_type_sale OWNER TO postgres;

--
-- Name: product_type_sale_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_type_sale_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.product_type_sale_id_seq OWNER TO postgres;

--
-- Name: product_type_sale_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_type_sale_id_seq OWNED BY public.product_type_sale.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    price bigint NOT NULL,
    image_urls jsonb NOT NULL,
    stock bigint NOT NULL,
    slug character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.products_id_seq OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: purchase_retail_orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.purchase_retail_orders (
    id bigint NOT NULL,
    owner_firstname character varying(30) NOT NULL,
    owner_lastname character varying(30) NOT NULL,
    owner_id character varying(255) NOT NULL,
    owner_phone_number character varying(255) NOT NULL,
    owner_city character varying(255) NOT NULL,
    owner_state character varying(255) NOT NULL,
    owner_address character varying(255) NOT NULL,
    reference_number character varying(255) NOT NULL,
    image character varying(255),
    total_price bigint NOT NULL,
    status character varying(20) DEFAULT 'En espera'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.purchase_retail_orders OWNER TO postgres;

--
-- Name: purchase_retail_orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.purchase_retail_orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.purchase_retail_orders_id_seq OWNER TO postgres;

--
-- Name: purchase_retail_orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.purchase_retail_orders_id_seq OWNED BY public.purchase_retail_orders.id;


--
-- Name: purchase_wholesale_orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.purchase_wholesale_orders (
    id bigint NOT NULL,
    product_id bigint NOT NULL,
    owner_firstname character varying(30) NOT NULL,
    owner_lastname character varying(255) NOT NULL,
    owner_id character varying(255) NOT NULL,
    owner_phone_number character varying(255) NOT NULL,
    owner_city character varying(255) NOT NULL,
    owner_state character varying(255) NOT NULL,
    owner_address character varying(255) NOT NULL,
    reference_number character varying(255) NOT NULL,
    image character varying(255),
    total_price bigint NOT NULL,
    product_quantity integer NOT NULL,
    unit character varying(255) NOT NULL,
    status character varying(20) DEFAULT 'En espera'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.purchase_wholesale_orders OWNER TO postgres;

--
-- Name: purchase_wholesale_orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.purchase_wholesale_orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.purchase_wholesale_orders_id_seq OWNER TO postgres;

--
-- Name: purchase_wholesale_orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.purchase_wholesale_orders_id_seq OWNED BY public.purchase_wholesale_orders.id;


--
-- Name: services; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.services (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.services OWNER TO postgres;

--
-- Name: services_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.services_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.services_id_seq OWNER TO postgres;

--
-- Name: services_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.services_id_seq OWNED BY public.services.id;


--
-- Name: type_sales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type_sales (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    description character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.type_sales OWNER TO postgres;

--
-- Name: type_sales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_sales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.type_sales_id_seq OWNER TO postgres;

--
-- Name: type_sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_sales_id_seq OWNED BY public.type_sales.id;


--
-- Name: units; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.units (
    id bigint NOT NULL,
    name character varying(30) NOT NULL,
    abbreviation character varying(3) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.units OWNER TO postgres;

--
-- Name: units_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.units_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.units_id_seq OWNER TO postgres;

--
-- Name: units_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.units_id_seq OWNED BY public.units.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: analyses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analyses ALTER COLUMN id SET DEFAULT nextval('public.analyses_id_seq'::regclass);


--
-- Name: analysis_parameters id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_parameters ALTER COLUMN id SET DEFAULT nextval('public.analysis_parameters_id_seq'::regclass);


--
-- Name: analysis_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_types ALTER COLUMN id SET DEFAULT nextval('public.analysis_types_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: category_post id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_post ALTER COLUMN id SET DEFAULT nextval('public.category_post_id_seq'::regclass);


--
-- Name: category_product id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_product ALTER COLUMN id SET DEFAULT nextval('public.category_product_id_seq'::regclass);


--
-- Name: conditions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conditions ALTER COLUMN id SET DEFAULT nextval('public.conditions_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: gender_post id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_post ALTER COLUMN id SET DEFAULT nextval('public.gender_post_id_seq'::regclass);


--
-- Name: gender_product id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_product ALTER COLUMN id SET DEFAULT nextval('public.gender_product_id_seq'::regclass);


--
-- Name: genders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genders ALTER COLUMN id SET DEFAULT nextval('public.genders_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: pending_orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pending_orders ALTER COLUMN id SET DEFAULT nextval('public.pending_orders_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- Name: product_purchase_retail_order id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_purchase_retail_order ALTER COLUMN id SET DEFAULT nextval('public.product_purchase_retail_order_id_seq'::regclass);


--
-- Name: product_type_sale id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_type_sale ALTER COLUMN id SET DEFAULT nextval('public.product_type_sale_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: purchase_retail_orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_retail_orders ALTER COLUMN id SET DEFAULT nextval('public.purchase_retail_orders_id_seq'::regclass);


--
-- Name: purchase_wholesale_orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_wholesale_orders ALTER COLUMN id SET DEFAULT nextval('public.purchase_wholesale_orders_id_seq'::regclass);


--
-- Name: services id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.services ALTER COLUMN id SET DEFAULT nextval('public.services_id_seq'::regclass);


--
-- Name: type_sales id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_sales ALTER COLUMN id SET DEFAULT nextval('public.type_sales_id_seq'::regclass);


--
-- Name: units id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.units ALTER COLUMN id SET DEFAULT nextval('public.units_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: analyses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.analyses (id, name, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: analysis_parameters; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.analysis_parameters (id, analysis_id, analysis_type_id, name, description, price_per_hour, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: analysis_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.analysis_types (id, analysis_id, name, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, name, created_at, updated_at) FROM stdin;
1	Categoria 1	2024-02-05 18:47:44	2024-02-05 18:47:44
2	Categoria 2	2024-02-08 16:45:39	2024-02-08 16:45:39
3	Categoria 3	2024-02-08 16:45:48	2024-02-08 16:45:48
\.


--
-- Data for Name: category_post; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.category_post (id, category_id, post_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	1	2	\N	\N
\.


--
-- Data for Name: category_product; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.category_product (id, category_id, product_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	2	2	\N	\N
3	3	3	\N	\N
4	1	4	\N	\N
5	1	5	\N	\N
6	2	5	\N	\N
\.


--
-- Data for Name: conditions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.conditions (id, name, description, conditionable_id, conditionable_type, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: gender_post; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.gender_post (id, gender_id, post_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	1	2	\N	\N
\.


--
-- Data for Name: gender_product; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.gender_product (id, gender_id, product_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	2	2	\N	\N
3	3	3	\N	\N
4	1	4	\N	\N
5	1	5	\N	\N
6	2	5	\N	\N
\.


--
-- Data for Name: genders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.genders (id, name, created_at, updated_at) FROM stdin;
1	Genero 1	2024-02-05 18:47:35	2024-02-05 18:47:35
2	Genero 2	2024-02-08 17:06:03	2024-02-08 17:06:03
3	Genero 3	2024-02-08 17:06:11	2024-02-08 17:06:11
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_reset_tokens_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2023_12_27_161550_create_services_table	1
6	2023_12_27_180503_create_genders_table	1
7	2023_12_28_212157_create_categories_table	1
8	2023_12_28_213735_create_posts_table	1
9	2023_12_28_215131_create_products_table	1
10	2023_12_29_023324_create_purchase_retail_orders_table	1
11	2023_12_30_030150_create_product_purchase_retail_order_table	1
12	2024_01_04_024723_create_pending_orders_table	1
13	2024_01_06_024112_create_analyses_table	1
14	2024_01_06_024435_create_analysis_types_table	1
15	2024_01_06_024519_create_analysis_parameters_table	1
16	2024_01_07_195239_create_purchase_wholesale_orders_table	1
17	2024_01_10_234514_create_category_product_table	1
18	2024_01_10_234553_create_gender_product_table	1
19	2024_01_11_215725_create_category_post_table	1
20	2024_01_11_215740_create_gender_post_table	1
21	2024_01_16_041314_create_units_table	1
22	2024_01_17_213054_create_conditions_table	1
23	2024_02_03_010229_create_type_sales_table	1
24	2024_02_03_011139_create_product_type_sale_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: pending_orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pending_orders (id, owner_firstname, owner_lastname, owner_id, owner_email, owner_phone_number, owner_state, owner_city, owner_address, owner_request, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.posts (id, title, thumbnail, slug, body, published, created_at, updated_at) FROM stdin;
1	Publicacion 1	01HNXY106HG7F4GA12F00VVP90.png	publicacion-1	<h2>Soy un contenido</h2><p><br></p><p><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;crema facial.jpg&quot;,&quot;filesize&quot;:25630,&quot;height&quot;:288,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/posts/PUaN3icGne0QtDwwEMPIqccC40mb5Nqgyjw6jQpA.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/posts/PUaN3icGne0QtDwwEMPIqccC40mb5Nqgyjw6jQpA.jpg&quot;,&quot;width&quot;:512}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/storage/posts/PUaN3icGne0QtDwwEMPIqccC40mb5Nqgyjw6jQpA.jpg"><img src="http://127.0.0.1:8000/storage/posts/PUaN3icGne0QtDwwEMPIqccC40mb5Nqgyjw6jQpA.jpg" width="512" height="288"><figcaption class="attachment__caption"><span class="attachment__name">crema facial.jpg</span> <span class="attachment__size">25.03 KB</span></figcaption></a></figure></p>	t	2024-02-06 00:45:27	2024-02-06 00:45:27
2	Publicacion 2	01HNXZY7V55S2GGB6ND8KTKY49.jpg	publicacion-2	<p>Soy otra publicacion</p>	f	2024-02-06 01:18:53	2024-02-06 01:18:53
\.


--
-- Data for Name: product_purchase_retail_order; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_purchase_retail_order (id, product_id, purchase_retail_order_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: product_type_sale; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_type_sale (id, product_id, type_sale_id, created_at, updated_at) FROM stdin;
1	1	1	\N	\N
2	2	1	\N	\N
3	3	1	\N	\N
4	4	1	\N	\N
5	5	1	\N	\N
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, name, description, price, image_urls, stock, slug, created_at, updated_at) FROM stdin;
1	Producto 1	Description\n	400	["01HNX9K7MJNH4Z1WKJ7ASMMFDD.png"]	3	producto-1	2024-02-05 18:48:24	2024-02-05 18:48:24
2	Producto 2	Description	500	["01HP4XPWNFE6TJTC7H9JNC8AS8.png"]	3	producto-2	2024-02-08 17:54:36	2024-02-08 17:54:36
3	Producto 3	Description	500	["01HP4XRE3SJVWFQPNKCX9CDKQN.png"]	3	producto-3	2024-02-08 17:55:27	2024-02-08 17:55:27
4	Crema de dia	Description	500	["01HP5M5MHJ5XK6K04SZ4H0QAWC.png"]	3	crema-de-dia	2024-02-09 00:27:08	2024-02-09 00:27:08
5	Bloqueador solar	Description	500	["01HP5M7VCSXG51KXCGSZ6Q2WBP.png"]	4	bloqueador-solar	2024-02-09 00:28:21	2024-02-09 00:28:21
\.


--
-- Data for Name: purchase_retail_orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.purchase_retail_orders (id, owner_firstname, owner_lastname, owner_id, owner_phone_number, owner_city, owner_state, owner_address, reference_number, image, total_price, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: purchase_wholesale_orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.purchase_wholesale_orders (id, product_id, owner_firstname, owner_lastname, owner_id, owner_phone_number, owner_city, owner_state, owner_address, reference_number, image, total_price, product_quantity, unit, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: services; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.services (id, name, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: type_sales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type_sales (id, name, description, created_at, updated_at) FROM stdin;
1	Tipo de venta 1	\N	2024-02-05 18:47:17	2024-02-05 18:47:17
\.


--
-- Data for Name: units; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.units (id, name, abbreviation, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
1	nata	rojo@gmail.com	\N	$2y$12$fs/5EOA6Gkia9QgsUa600O30zEper4NtlAauWDzk4p5I7NW2VkVyG	8tzZqmjcF8MzNK5sDRj9O8zprwNqo9PwDt5c8M306NLqEO1mNBi8q1DaXrLf	2024-02-05 18:46:32	2024-02-05 18:46:32
\.


--
-- Name: analyses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.analyses_id_seq', 1, false);


--
-- Name: analysis_parameters_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.analysis_parameters_id_seq', 1, false);


--
-- Name: analysis_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.analysis_types_id_seq', 1, false);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 3, true);


--
-- Name: category_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.category_post_id_seq', 2, true);


--
-- Name: category_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.category_product_id_seq', 6, true);


--
-- Name: conditions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.conditions_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: gender_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.gender_post_id_seq', 2, true);


--
-- Name: gender_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.gender_product_id_seq', 6, true);


--
-- Name: genders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.genders_id_seq', 3, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 24, true);


--
-- Name: pending_orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pending_orders_id_seq', 1, false);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.posts_id_seq', 2, true);


--
-- Name: product_purchase_retail_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_purchase_retail_order_id_seq', 1, false);


--
-- Name: product_type_sale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_type_sale_id_seq', 5, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 5, true);


--
-- Name: purchase_retail_orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_retail_orders_id_seq', 1, false);


--
-- Name: purchase_wholesale_orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_wholesale_orders_id_seq', 1, false);


--
-- Name: services_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.services_id_seq', 1, false);


--
-- Name: type_sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_sales_id_seq', 1, true);


--
-- Name: units_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.units_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: analyses analyses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analyses
    ADD CONSTRAINT analyses_pkey PRIMARY KEY (id);


--
-- Name: analysis_parameters analysis_parameters_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_parameters
    ADD CONSTRAINT analysis_parameters_pkey PRIMARY KEY (id);


--
-- Name: analysis_types analysis_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_types
    ADD CONSTRAINT analysis_types_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: category_post category_post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_post
    ADD CONSTRAINT category_post_pkey PRIMARY KEY (id);


--
-- Name: category_product category_product_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_product
    ADD CONSTRAINT category_product_pkey PRIMARY KEY (id);


--
-- Name: conditions conditions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conditions
    ADD CONSTRAINT conditions_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: gender_post gender_post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_post
    ADD CONSTRAINT gender_post_pkey PRIMARY KEY (id);


--
-- Name: gender_product gender_product_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_product
    ADD CONSTRAINT gender_product_pkey PRIMARY KEY (id);


--
-- Name: genders genders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genders
    ADD CONSTRAINT genders_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: pending_orders pending_orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pending_orders
    ADD CONSTRAINT pending_orders_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: product_purchase_retail_order product_purchase_retail_order_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_purchase_retail_order
    ADD CONSTRAINT product_purchase_retail_order_pkey PRIMARY KEY (id);


--
-- Name: product_type_sale product_type_sale_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_type_sale
    ADD CONSTRAINT product_type_sale_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: products products_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_slug_unique UNIQUE (slug);


--
-- Name: purchase_retail_orders purchase_retail_orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_retail_orders
    ADD CONSTRAINT purchase_retail_orders_pkey PRIMARY KEY (id);


--
-- Name: purchase_wholesale_orders purchase_wholesale_orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_wholesale_orders
    ADD CONSTRAINT purchase_wholesale_orders_pkey PRIMARY KEY (id);


--
-- Name: services services_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.services
    ADD CONSTRAINT services_pkey PRIMARY KEY (id);


--
-- Name: type_sales type_sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type_sales
    ADD CONSTRAINT type_sales_pkey PRIMARY KEY (id);


--
-- Name: units units_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.units
    ADD CONSTRAINT units_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: analysis_parameters analysis_parameters_analysis_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_parameters
    ADD CONSTRAINT analysis_parameters_analysis_id_foreign FOREIGN KEY (analysis_id) REFERENCES public.analyses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: analysis_parameters analysis_parameters_analysis_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_parameters
    ADD CONSTRAINT analysis_parameters_analysis_type_id_foreign FOREIGN KEY (analysis_type_id) REFERENCES public.analysis_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: analysis_types analysis_types_analysis_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.analysis_types
    ADD CONSTRAINT analysis_types_analysis_id_foreign FOREIGN KEY (analysis_id) REFERENCES public.analyses(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: category_post category_post_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_post
    ADD CONSTRAINT category_post_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: category_post category_post_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_post
    ADD CONSTRAINT category_post_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: category_product category_product_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_product
    ADD CONSTRAINT category_product_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: category_product category_product_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.category_product
    ADD CONSTRAINT category_product_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: gender_post gender_post_gender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_post
    ADD CONSTRAINT gender_post_gender_id_foreign FOREIGN KEY (gender_id) REFERENCES public.genders(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: gender_post gender_post_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_post
    ADD CONSTRAINT gender_post_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: gender_product gender_product_gender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_product
    ADD CONSTRAINT gender_product_gender_id_foreign FOREIGN KEY (gender_id) REFERENCES public.genders(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: gender_product gender_product_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gender_product
    ADD CONSTRAINT gender_product_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: product_purchase_retail_order product_purchase_retail_order_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_purchase_retail_order
    ADD CONSTRAINT product_purchase_retail_order_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: product_purchase_retail_order product_purchase_retail_order_purchase_retail_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_purchase_retail_order
    ADD CONSTRAINT product_purchase_retail_order_purchase_retail_order_id_foreign FOREIGN KEY (purchase_retail_order_id) REFERENCES public.purchase_retail_orders(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: product_type_sale product_type_sale_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_type_sale
    ADD CONSTRAINT product_type_sale_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: product_type_sale product_type_sale_type_sale_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_type_sale
    ADD CONSTRAINT product_type_sale_type_sale_id_foreign FOREIGN KEY (type_sale_id) REFERENCES public.type_sales(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: purchase_wholesale_orders purchase_wholesale_orders_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_wholesale_orders
    ADD CONSTRAINT purchase_wholesale_orders_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

