CREATE DATABASE disquecomeu COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    sobrenome VARCHAR(255) NOT NULL ,
    nome_usuario VARCHAR(255) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    administrador BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE categorias (
    id INT NOT NULL AUTO_INCREMENT ,
    categoria VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id)
);

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT ,
    id_categoria INT NOT NULL ,
    nome VARCHAR(255) NOT NULL ,
    descricao VARCHAR(255) NOT NULL ,
    valor DOUBLE NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (id_categoria) REFERENCES categorias (id)
);

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario_id INT NOT NULL ,
    texto VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);

INSERT INTO `categorias` (`id`, `categoria`) VALUES (NULL, 'Pizza'), (NULL, 'Lanche'), (NULL, 'Massa'), (NULL, 'Porção');

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `nome_usuario`, `email`, `senha`, `administrador`) VALUES (NULL, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$/6aH1pW4RKYRFcvKC83JJ.AMSerCItzea57qRHTTLACwRZpkGfs4q', '1');