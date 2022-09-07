CREATE DATABASE db_filme;

USE db_filme;

CREATE TABLE genero(
	genero_id INTEGER AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(20)
);

CREATE TABLE filme(
	filme_id INTEGER AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(50),
	sinopse VARCHAR(500),
	fk_genero_id INTEGER, 
	FOREIGN KEY (fk_genero_id) REFERENCES genero(genero_id)
);