CREATE DATABASE disquecomeu COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT ,
    nome VARCHAR(255) NOT NULL ,
    sobrenome VARCHAR(255) NOT NULL ,
    nome_usuario VARCHAR(255) NOT NULL ,
    email VARCHAR(255) NOT NULL ,
    senha CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE mensagens (
    id INT NOT NULL AUTO_INCREMENT ,
    usuario_id INT NOT NULL ,
    texto VARCHAR(255) NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)
ENGINE = InnoDB;
