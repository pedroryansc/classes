CREATE SCHEMA cidest;

CREATE TABLE estado(
    id INT AUTO_INCREMENT,
    est_nome varchar(45),
    sigla varchar(2),
    PRIMARY KEY (id));

CREATE TABLE cidade(
    id INT AUTO_INCREMENT,
    id_estado INT,
    cid_nome varchar(45),
    PRIMARY KEY (id),
    FOREIGN KEY (id_estado) references estado (id));

INSERT INTO estado VALUES(0, "Santa Catarina", "SC");
INSERT INTO estado VALUES(0, "Rio de Janeiro", "RJ");
INSERT INTO estado VALUES(0, "São Paulo", "SP");
INSERT INTO estado VALUES(0, "Paraná", "PR");
INSERT INTO estado VALUES(0, "Rio Grande do Sul", "RS");