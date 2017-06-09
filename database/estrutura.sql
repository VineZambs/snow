CREATE TABLE usuarios(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    rg VARCHAR(255) NOT NULL,
    cpf VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE empresas(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    razao_social VARCHAR(255) NOT NULL,
    cnpj VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE enderecos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    empresa_id INT,
    usuario_id INT,
    logradouro VARCHAR(255) NOT NULL,
    bairro VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    numero VARCHAR(255) NOT NULL,
    estado VARCHAR(255) NOT NULL,
    cep VARCHAR(255) NOT NULL
);

CREATE TABLE cpds(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    empresa_id INT,
    numero_serial VARCHAR(255) NOT NULL,
    data_instalacao DATE NOT NULL
);

CREATE TABLE cpd_leitura(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cpd_id INT,
    temperatura FLOAT NOT NULL,
    humidade FLOAT NOT NULL,
    horario DATETIME NOT NULL
);

ALTER TABLE cpds ADD FOREIGN KEY (empresa_id) REFERENCES empresas(id);
ALTER TABLE enderecos ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
ALTER TABLE enderecos ADD FOREIGN KEY (empresa_id) REFERENCES empresas(id);
ALTER TABLE empresas ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
ALTER TABLE cpd_leitura ADD FOREIGN KEY (cpd_id) REFERENCES cpds(id);
