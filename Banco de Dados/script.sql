-- Table: public.avaliacao

-- DROP TABLE IF EXISTS public.avaliacao;

CREATE TABLE IF NOT EXISTS public.avaliacao
(
    ida integer NOT NULL DEFAULT nextval('avaliacao_id_seq'::regclass),
    estrelas integer NOT NULL,
    descr character varying(200) COLLATE pg_catalog."default",
    dta date DEFAULT CURRENT_DATE,
    cliente integer,
    CONSTRAINT avaliacao_pkey PRIMARY KEY (ida),
    CONSTRAINT avaliacao_cliente_fkey FOREIGN KEY (cliente)
        REFERENCES public.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.avaliacao
    OWNER to postgres;

-- Table: public.imgportf

-- DROP TABLE IF EXISTS public.imgportf;

CREATE TABLE IF NOT EXISTS public.imgportf
(
    id integer NOT NULL DEFAULT nextval('imgportf_id_seq'::regclass),
    link_ character varying(100) COLLATE pg_catalog."default" NOT NULL,
    data_upload date DEFAULT CURRENT_DATE,
    destaque boolean,
    descricao character varying(300) COLLATE pg_catalog."default",
    port integer,
    CONSTRAINT imgportf_pkey PRIMARY KEY (id),
    CONSTRAINT imgportf_port_fkey FOREIGN KEY (port)
        REFERENCES public.portfolio (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.imgportf
    OWNER to postgres;

-- Table: public.orcamentos

-- DROP TABLE IF EXISTS public.orcamentos;

CREATE TABLE IF NOT EXISTS public.orcamentos
(
    id integer NOT NULL DEFAULT nextval('orcamentos_id_seq'::regclass),
    data_solc date DEFAULT CURRENT_DATE,
    tamanho integer NOT NULL,
    local_corpo character varying(100) COLLATE pg_catalog."default" NOT NULL,
    preco real,
    aprovado boolean,
    referencia1 character varying(100) COLLATE pg_catalog."default",
    referencia2 character varying(100) COLLATE pg_catalog."default",
    referencia3 character varying(100) COLLATE pg_catalog."default",
    referencia4 character varying(100) COLLATE pg_catalog."default",
    referencia5 character varying(100) COLLATE pg_catalog."default",
    cliente integer,
    tt_desejado integer NOT NULL,
    descr text COLLATE pg_catalog."default",
    CONSTRAINT orcamentos_pkey PRIMARY KEY (id),
    CONSTRAINT orcamentos_cliente_fkey FOREIGN KEY (cliente)
        REFERENCES public.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT orcamentos_tt_desejado_fkey FOREIGN KEY (tt_desejado)
        REFERENCES public.tatuador (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.orcamentos
    OWNER to postgres;

-- Table: public.portfolio

-- DROP TABLE IF EXISTS public.portfolio;

CREATE TABLE IF NOT EXISTS public.portfolio
(
    id integer NOT NULL DEFAULT nextval('portfolio_id_seq'::regclass),
    nome character varying(100) COLLATE pg_catalog."default",
    tatuador integer,
    CONSTRAINT portfolio_pkey PRIMARY KEY (id),
    CONSTRAINT portfolio_tatuador_fkey FOREIGN KEY (tatuador)
        REFERENCES public.tatuador (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.portfolio
    OWNER to postgres;

-- Table: public.tatuador

-- DROP TABLE IF EXISTS public.tatuador;

CREATE TABLE IF NOT EXISTS public.tatuador
(
    id integer NOT NULL DEFAULT nextval('tatuador_id_seq'::regclass),
    nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    email character varying(100) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(100) COLLATE pg_catalog."default" NOT NULL,
    descr character varying(300) COLLATE pg_catalog."default" NOT NULL,
    telf character varying(15) COLLATE pg_catalog."default" NOT NULL,
    ftperfil character varying(100) COLLATE pg_catalog."default",
    CONSTRAINT tatuador_pkey PRIMARY KEY (id),
    CONSTRAINT tatuador_email_key UNIQUE (email)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tatuador
    OWNER to postgres;

-- Table: public.usuarios

-- DROP TABLE IF EXISTS public.usuarios;

CREATE TABLE IF NOT EXISTS public.usuarios
(
    id integer NOT NULL DEFAULT nextval('usuarios_id_seq'::regclass),
    nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    email character varying(100) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(100) COLLATE pg_catalog."default" NOT NULL,
    telf character varying(15) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT usuarios_pkey PRIMARY KEY (id),
    CONSTRAINT usuarios_email_key UNIQUE (email)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.usuarios
    OWNER to postgres;
