CREATE DATABASE IF NOT EXISTS ludwickvonmises;

USE ludwickvonmises;

CREATE TABLE IF NOT EXISTS User(
    id INT AUTO_INCREMENT NOT NULL,
    avatar VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255),
    is_staff BOOLEAN,
    password VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS Conteudo (
    id INT AUTO_INCREMENT NOT NULL,
    imagem VARCHAR(255),
    titulo VARCHAR(100),
    descricao TEXT,
    body TEXT,
    user_id INT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    CONSTRAINT Fk_conteudo_user
        FOREIGN KEY (user_id)
        REFERENCES User(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);