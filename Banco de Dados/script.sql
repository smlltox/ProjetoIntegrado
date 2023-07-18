CREATE TABLE tatuador(
	id SERIAL PRIMARY KEY,
	email VARCHAR(100) NOT NULL UNIQUE,
	nome VARCHAR(100) NOT NULL,
	senha VARCHAR(100) NOT NULL,
	descr VARCHAR(300) NOT NULL,
	telf VARCHAR(15) NOT NULL,
	ftPerfil VARCHAR(100)
);

CREATE TABLE usuarios(
	id SERIAL PRIMARY KEY,
	email VARCHAR(100) NOT NULL UNIQUE,
	nome VARCHAR(100) NOT NULL,
	senha VARCHAR(100) NOT NULL,
	telf VARCHAR(15) NOT NULL
);

CREATE TABLE portfolio(
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
	tatuador INTEGER NOT NULL,
	FOREIGN KEY (tatuador) REFERENCES tatuador (id)
);

CREATE TABLE imgportf(
    id SERIAL PRIMARY KEY,
    link_ VARCHAR(100) NOT NULL,
    data_upload DATE DEFAULT CURRENT_DATE,
    destaque BOOLEAN NOT NULL,
    descricao VARCHAR(300),
    port INTEGER NOT NULL,
	FOREIGN KEY (port) REFERENCES portfolio (id)
);

CREATE TABLE avaliacao(
    ida SERIAL PRIMARY KEY,
    estrelas INTEGER NOT NULL,
    dta DATE DEFAULT CURRENT_DATE,
    descr VARCHAR(300) NOT NULL,
    cliente INTEGER NOT NULL,
	FOREIGN KEY (cliente) REFERENCES usuarios (id)
);

CREATE TABLE orcamentos(
    id SERIAL PRIMARY KEY,
    tamanho VARCHAR(100) NOT NULL,
    data_solc DATE DEFAULT CURRENT_DATE,
    aprovado BOOLEAN NOT NULL,
    local_corpo VARCHAR(300) NOT NULL,
    tamanho INTEGER NOT NULL,
	descr VARCHAR(300),
	preco INTEGER,
	referencia1 VARCHAR(100) NOT NULL,
	referencia2 VARCHAR(100),
	referencia3 VARCHAR(100),
	referencia4 VARCHAR(100),
	referencia5 VARCHAR(100),
	cliente INTEGER NOT NULL,
	tt_desejado INTEGER NOT NULL,
	FOREIGN KEY (cliente) REFERENCES usuarios (id),
	FOREIGN KEY (tt_desejado) REFERENCES tatuador (id)
);
