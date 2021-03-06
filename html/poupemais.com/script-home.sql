  -- MySQL Script generated by MySQL Workbench
  -- Tue Dec 17 21:31:05 2019
  -- Model: New Model    Version: 1.0
  -- MySQL Workbench Forward Engineering

  SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
  SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
  SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

  -- -----------------------------------------------------
  -- Schema db_poupemais
  -- -----------------------------------------------------

  -- -----------------------------------------------------
  -- Schema db_poupemais
  -- -----------------------------------------------------
  CREATE SCHEMA IF NOT EXISTS `db_poupemais` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci ;
  USE `db_poupemais` ;

  -- -----------------------------------------------------
  -- Table `db_poupemais`.`usuarios`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`usuarios` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`usuarios` (
    `id` INT(6) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(255) NOT NULL,
    `data_cadastro` DATE NOT NULL,
    `status` VARCHAR(10) NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`clientes`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`clientes` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`clientes` (
    `id` INT(8) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `data_nascimento` DATE NOT NULL,
    `cpf` VARCHAR(15) NOT NULL,
    `rg` VARCHAR(15) NOT NULL,
    `estado_civil` VARCHAR(10) NOT NULL,
    `telefone` VARCHAR(15) NOT NULL,
    `endereco` VARCHAR(50) NOT NULL,
    `numero` INT NOT NULL,
    `complemento` VARCHAR(20) NULL,
    `bairro` VARCHAR(100) NOT NULL,
    `cep` VARCHAR(9) NOT NULL,
    `cidade` VARCHAR(25) NOT NULL,
    `uf` CHAR(2) NOT NULL,
    `id_usuario` INT NOT NULL,
    PRIMARY KEY (`id`, `id_usuario`),
    UNIQUE INDEX `rg_UNIQUE` (`rg` ASC),
    UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
    INDEX `fk_cliente_usuario_idx` (`id_usuario` ASC),
    CONSTRAINT `fk_cliente_usuario`
      FOREIGN KEY (`id_usuario`)
      REFERENCES `db_poupemais`.`usuarios` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`planos`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`planos` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`planos` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`aportes`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`aportes` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`aportes` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`id`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`investimentos`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`investimentos` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`investimentos` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `valor` DECIMAL(7,2) NOT NULL,
    `data_contratacao` DATE NOT NULL,
    `situacao` VARCHAR(10) NULL,
    `id_cliente` INT NOT NULL,
    `id_plano` INT NOT NULL,
    `id_aporte` INT NOT NULL,
    PRIMARY KEY (`id`, `id_cliente`, `id_plano`, `id_aporte`),
    INDEX `fk_investimento_cliente1_idx` (`id_cliente` ASC),
    INDEX `fk_investimento_planos1_idx` (`id_plano` ASC),
    INDEX `fk_investimentos_aportes1_idx` (`id_aporte` ASC),
    CONSTRAINT `fk_investimento_cliente1`
      FOREIGN KEY (`id_cliente`)
      REFERENCES `db_poupemais`.`clientes` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_investimento_planos1`
      FOREIGN KEY (`id_plano`)
      REFERENCES `db_poupemais`.`planos` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_investimentos_aportes1`
      FOREIGN KEY (`id_aporte`)
      REFERENCES `db_poupemais`.`aportes` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`vencimentos`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`vencimentos` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`vencimentos` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `parcela` CHAR(1) NOT NULL,
    `vencimento` DATE NOT NULL,
    `valor` DECIMAL(7,2) NOT NULL,
    `data_pagamento` DATE NULL,
    `situacao` VARCHAR(20) NOT NULL,
    `id_investimento` INT NOT NULL,
    PRIMARY KEY (`id`, `id_investimento`),
    INDEX `fk_vencimentos_investimentos1_idx` (`id_investimento` ASC),
    CONSTRAINT `fk_vencimentos_investimentos1`
      FOREIGN KEY (`id_investimento`)
      REFERENCES `db_poupemais`.`investimentos` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`confirmation`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`confirmation` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`confirmation` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NULL,
    `token` TEXT NULL,
    PRIMARY KEY (`id`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`tentativas`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`tentativas` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`tentativas` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `ip` VARCHAR(20) NULL,
    `date` DATETIME NULL,
    PRIMARY KEY (`id`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `db_poupemais`.`nivel_access`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`nivel_access` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`nivel_access` (
    `id` INT(2) NOT NULL AUTO_INCREMENT,
    `nivel` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`id`, `nivel`))
  ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `db_poupemais`.`access_admin`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`access_admin` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`access_admin` (
    `id` INT(3) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(40) NOT NULL,
    `login` VARCHAR(10) NOT NULL,
    `passwd` VARCHAR(255) NOT NULL,
    `nivel_access_id` INT NOT NULL,
    PRIMARY KEY (`id`, `nivel_access_id`),
    UNIQUE INDEX `login_UNIQUE` (`login` ASC),
    INDEX `fk_access_admin_nivel_access1_idx` (`nivel_access_id` ASC),
    CONSTRAINT `fk_access_admin_nivel_access1`
      FOREIGN KEY (`nivel_access_id`)
      REFERENCES `db_poupemais`.`nivel_access` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `db_poupemais`.`baixas`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`baixas` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`baixas` (
    `id` INT(8) NOT NULL AUTO_INCREMENT,
    `valor_pago` DECIMAL(7,2) NULL,
    `data_baixa` DATE NULL,
    `historico` TEXT NULL,
    `id_invest_bx` INT(10) NOT NULL,
    PRIMARY KEY (`id`, `id_invest_bx`),
    INDEX `fk_baixas_investimentos1_idx` (`id_invest_bx` ASC),
    CONSTRAINT `fk_baixas_investimentos1`
      FOREIGN KEY (`id_invest_bx`)
      REFERENCES `db_poupemais`.`investimentos` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;

  -- -----------------------------------------------------
  -- Table `db_poupemais`.`contratos`
  -- -----------------------------------------------------
  DROP TABLE IF EXISTS `db_poupemais`.`contratos` ;

  CREATE TABLE IF NOT EXISTS `db_poupemais`.`contratos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `folder` VARCHAR(150) NULL,
    `filename` VARCHAR(40) NULL,
    `id_invest_contrat` INT(10) NOT NULL,
    PRIMARY KEY (`id`, `id_invest_contrat`),
    INDEX `fk_contratos_investimentos1_idx` (`id_invest_contrat` ASC),
    CONSTRAINT `fk_contratos_investimentos1`
      FOREIGN KEY (`id_invest_contrat`)
      REFERENCES `db_poupemais`.`investimentos` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;

  SET SQL_MODE=@OLD_SQL_MODE;
  SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
  SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

  INSERT INTO `planos` (nome) VALUES ('6 meses'),('9 meses'),('12 meses');
  INSERT INTO `nivel_access` (nivel) VALUES ('maximo'),('medio'),('basico');
  INSERT INTO `aportes` (nome) VALUES ('mensal'),('unico');


  SHOW COLUMNS FROM `db_poupemais`.`usuarios`;
  SHOW COLUMNS FROM `db_poupemais`.`clientes`;
  SHOW COLUMNS FROM `db_poupemais`.`investimentos`;
  SHOW COLUMNS FROM `db_poupemais`.`vencimentos`;
  SHOW COLUMNS FROM `db_poupemais`.`access_admin`;
  SHOW COLUMNS FROM `db_poupemais`.`nivel_access`;
  SHOW COLUMNS FROM `db_poupemais`.`tentativas`;
  SHOW COLUMNS FROM `db_poupemais`.`confirmation`;

/* TABLE ACCESS_ADMIN */

/* TABLE PLANOS 
local
$2y$10$xTbIaUeUYuP1gk97weHMKuaxHbrvV1a2PiSr1.D38X7Szyy7wKwuy

servidor
$2y$10$nurF3SmhXdrw/nL3aCOSKeDDii90/Eqj.vZZckPzfZZ3q3ZzC.dAG
*/

UPDATE `db_poupemais`.`usuarios` SET senha = '$2y$10$xTbIaUeUYuP1gk97weHMKuaxHbrvV1a2PiSr1.D38X7Szyy7wKwuy' WHERE id = 1;

/* TABLE GRUPOS */
SELECT * FROM `db_poupemais`.`grupos`;

/*UPDATE grupos SET nome= 'Toronto' WHERE id = 3;*/

/* TABALE USERS */
SELECT * FROM `db_poupemais`.`usuarios`;
SELECT * FROM `db_poupemais`.`clientes`;
SELECT * FROM `db_poupemais`.`tentativas`;
SELECT * FROM `db_poupemais`.`confirmation`;
SELECT * FROM `db_poupemais`.`aportes`;
SELECT * FROM `db_poupemais`.`contratos`;
SELECT * FROM `db_poupemais`.`planos`;
SELECT * FROM `db_poupemais`.`investimentos`;
SELECT * FROM `db_poupemais`.`vencimentos`;
SELECT * FROM `db_poupemais`.`access_admin`;

 SELECT * FROM confirmation WHERE email = 'fernandoestevam23@gmail.com' AND token = '2ef5e05b62b3e089ca9c8a276921f322f6e96e16aa9fda6dce73682ea14e9a793070ee3486a545a2f3ed0fc15234d50ecd111bfacbe859f77eed977a123e561c';

SELECT id FROM grupos;

SHOW TABLE STATUS LIKE 'grupos';

SELECT * FROM `db_poupemais`.`investimentos`;

DELETE FROM usuarios WHERE id = 6;

UPDATE investimentos SET id_grupo = 2 WHERE id = 4;

SELECT * FROM `db_poupemais`.`usuarios` WHERE senha = '$2y$10$.FiIKyfpq0d03lkl2c5rWenea55wP0C5RuA7QxmwnZhKzowfm2j7m';

SELECT * FROM usuarios WHERE email = 'fernandoestevam23@outlook.com' AND senha = md5('fuba709244');
INSERT INTO usuarios (email,senha,data_cadastro,status) VALUES('fernandoestevam23@outlook.com',md5('fuba709244'),current_date(),'ativo');

/* TABLE CLIENTE */
SELECT * FROM `db_poupemais`.`clientes`;
SELECT * FROM confirmation;

SELECT * FROM `db_poupemais`.`clientes` JOIN `db_poupemais`.`usuarios` AS u ON clientes.id_usuario = u.id WHERE nome='Fernando Antonio Estevam' OR cpf = 32332280820 OR rg = 406337780 OR email='fernandoestevam23@gmail.com';

SELECT nome,cpf,rg,u.email FROM `db_poupemais`.`clientes` JOIN `db_poupemais`.`usuarios` AS u ON clientes.id_usuario = u.id
          WHERE nome='Fernando Antonio Estevam'
           OR cpf=32332280820 OR rg=406337780 OR email='fernandoestevam23@gmail.com';



INSERT INTO clientes (nome,data_nascimento, cpf,rg,estado_civil,telefone,endereco,numero,complemento,bairro,cep,cidade,estado,id_usuario)
	VALUES('João Fonseca','1985-07-23','123.456.789-01','12.345.678-9','solteiro','11-9.9999-9999','rua vinde e cinco, 10 apt 55-A','544','11-A', 'Bela Vista','12345-678','São Paulo','SP',1);

/* TABLE INVESTIMENTO */
SELECT * FROM `db_poupemais`.`investimentos`;

SELECT c.id, c.nome, i.id AS N_INVEST, i.valor, g.nome  FROM `db_poupemais`.`investimentos` AS i
	JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
    JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
    WHERE c.id = 1;

INSERT INTO `db_poupemais`.`investimentos` (valor,data_contratacao,id_cliente,id_plano,id_grupo) VALUES(50.00,'2019-08-22',1,1,1);

SELECT i.valor, i.data_contratacao, i.id_cliente, i.id_plano, i.id_grupo, p.nome FROM `db_poupemais`.`investimentos` AS i
  JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
  JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
  JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano
  WHERE c.id = 1;

SELECT * FROM `db_poupemais`.`investimentos`;
SELECT * FROM `db_poupemais`.`vencimentos`;

SELECT i.id AS n_invest, v.parcela, v.vencimento, v.valor, p.nome AS plano, g.nome AS grupo, v.situacao, v.data_pagamento FROM
				`db_poupemais`.`vencimentos` AS v
				JOIN `db_poupemais`.`investimentos` AS i ON i.id = v.investimentos_id
				JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
				JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano
				JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
				WHERE i.id = 1;

/* TABLES VENCIMENTOS */
SELECT * FROM `db_poupemais`.`investimentos`;
select * from investimentos AS i JOIN grupos AS g ON i.id_grupo = g.id WHERE g.id = 1;
UPDATE investimentos SET id_grupo = 1;

SELECT * FROM `db_poupemais`.`vencimentos`;
INSERT INTO vencimentos (parcela,vencimento, valor, situacao,investimentos_id) VALUES('1','2019-08-01',50.00,'em aberto',1);
INSERT INTO vencimentos (parcela,vencimento, valor, situacao,investimentos_id) VALUES('2','2019-08-10',50.00,'em aberto',1);
INSERT INTO vencimentos (parcela,vencimento, valor, situacao,investimentos_id) VALUES('3','2019-08-20',50.00,'em aberto',1);
INSERT INTO vencimentos (parcela,vencimento, valor, situacao,investimentos_id) VALUES('4','2019-08-30',50.00,'em aberto',1);

SELECT * FROM access_admin;
SELECT * FROM nivel_access;


DELETE FROM usuarios WHERE id = 2;

DROP DATABASE `db_poupemais`;

SELECT i.id AS NºInvest, i.valor AS Valor, g.nome AS Grupo, p.nome AS Plano, i.data_contratacao AS Data_Contratacao FROM `db_poupemais`.`investimentos` AS i
  JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
  JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
  JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano WHERE c.nome = 'Fernando';


SELECT i.id AS NºInvest, i.valor AS Valor, c.nome AS Cliente, g.nome AS Grupo, p.nome AS Plano FROM `db_poupemais`.`investimentos` AS i
  JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
  JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
  JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano;


SELECT i.id, c.nome AS Nº, v.parcela, v.vencimento, v.valor,  p.nome AS Plano, g.nome AS Grupo, v.situacao, v.data_pagamento FROM `db_poupemais`.`vencimentos` AS v
	  JOIN `db_poupemais`.`investimentos` AS i ON i.id = v.investimentos_id
    JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
    JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano
    JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
    WHERE c.nome = 'Fernando';

SELECT id,email,senha FROM `db_poupemais`.`usuarios` WHERE senha = '$2y$10$IgZ64Ej69PR
.CpiAMqeU4OVMePtJhKxk0t6iJ2ZqRI2rTO5bByJ5y';

SELECT c.id, c.nome, u.email FROM `db_poupemais`.`clientes` AS c
  JOIN `db_poupemais`.`usuarios` AS u ON u.id = c.id
  WHERE u.email = '';


SELECT * FROM `db_poupemais`.`access_admin`;

SELECT id FROM usuarios;

DROP DATABASE `db_poupemais`;

SELECT vencimento, situacao FROM vencimentos WHERE vencimento between '2019-01-01' and '2019-11-11' ORDER BY vencimento ASC;

SELECT * FROM investimentos;
SELECT * FROM grupos;

UPDATE vencimentos AS v
	JOIN investimentos AS i
    ON i.id = v.investimentos_id
    JOIN grupos AS g ON g.id = i.id_grupo
    SET v.data_pagamento = '2019-11-11', v.situacao = 'pago'
    WHERE v.id = 1;

UPDATE vencimentos AS v
	JOIN investimentos AS i
	ON i.id = v.investimentos_id
	JOIN grupos AS g ON g.id = i.id_grupo
	SET v.situacao = 'aberto', v.data_pagamento = null;

UPDATE vencimentos SET situacao = 'aberto' WHERE vencimento between '2019-01-01' and '2019-11-11';
UPDATE usuarios SET status = 'confirmar' WHERE email = 'fernandoestevam23@gmail.com';
UPDATE usuarios SET data_cadastro = '2019-11-05' WHERE email = 'fernandoestevam23@gmail.com';
select * from usuarios;
select * from confirmation;

SELECT v.id, i.id AS n_invest, v.parcela, v.vencimento, v.valor, p.nome AS plano, g.nome AS grupo, v.situacao, v.data_pagamento FROM
				`db_poupemais`.`vencimentos` AS v
				JOIN `db_poupemais`.`investimentos` AS i ON i.id = v.investimentos_id
				JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
				JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano
				JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
				WHERE v.vencimento between '2019-01-01' and '2019-11-11';

SELECT c.nome, i.id AS n_invest, v.parcela, v.vencimento, v.valor, p.nome AS plano, g.nome AS grupo, v.situacao, v.data_pagamento FROM
	`db_poupemais`.`vencimentos` AS v
	JOIN `db_poupemais`.`investimentos` AS i ON i.id = v.investimentos_id
	JOIN `db_poupemais`.`grupos` AS g ON g.id = i.id_grupo
	JOIN `db_poupemais`.`planos` AS p ON p.id = i.id_plano
	JOIN `db_poupemais`.`clientes` AS c ON c.id = i.id_cliente
	WHERE v.situacao = 'aberto' AND v.vencimento between '2019-01-01' and '2019-11-11';

ALTER TABLE vencimentos MODIFY COLUMN parcela char;

DELETE FROM tentativas WHERE ip = '127.0.0.1';

select c.id, c.nome, u.email, u.senha from clientes AS c JOIN usuarios AS u ON u.id = c.id WHERE u.email = 'fernandoestevam23@gmail.com';

 select id_grupo FROM investimentos AS i JOIN grupos AS g ON i.id_grupo = g.id WHERE g.id = 1;

SELECT * FROM vencimentos WHERE vencimento < '2019-11-24';

SELECT * FROM vencimentos;

UPDATE vencimentos SET vencimento = '2019-11-23' WHERE id = 1;


SELECT v.id AS ID_vcto, c.nome, i.id AS n_invest, v.parcela, v.vencimento, v.valor, p.nome AS plano, g.nome AS grupo, v.situacao
        FROM vencimentos AS v
        JOIN investimentos AS i ON i.id = v.investimentos_id
          JOIN grupos AS g ON g.id = i.id_grupo
          JOIN planos AS p ON p.id = i.id_plano
          JOIN clientes AS c ON c.id = i.id_cliente
          WHERE v.situacao = 'aberto' AND
          v.vencimento  = '2019-11-23' < '2021-11-24' ORDER BY vencimento ASC;

SELECT id FROM investimentos WHERE id = 4 ;
SELECT * FROM baixas;

INSERT INTO baixas_investimentos (valor_pago,data_baixa,historico,investimentos_id) VALUES (25.00,current_date(),'Titulo baixo com restrições',1);
DELETE FROM baixas_investimentos WHERE id = 2;
SELECT valor_pago, data_baixa,historico, i.data_contratacao, p.plano, i.situacao FROM baixas_investimentos AS bx JOIN investimentos AS i ON i.id = bx.investimentos_id WHERE bx.investimentos_id = 1;


SELECT i.id AS ID_Invest, i.valor, p.nome AS plano, i.data_contratacao AS contratação, i.situacao FROM baixas_investimentos AS bx
	JOIN investimentos AS i ON i.id = bx.id_investimento
    JOIN planos AS p ON p.id = i.id_plano
    WHERE i.id = 1;

SELECT i.valor, valor_pago, data_baixa,historico, i.data_contratacao, i.situacao FROM baixas    AS bx JOIN investimentos AS i ON i.id = bx.id_invest_bx WHERE i.id = 7;

SELECT folder, filename FROM contratos AS c  JOIN investimentos AS i ON i.id = c.id_invest_contrat WHERE i.id = 1;

SELECT c.id, c.nome, i.id AS idinvest, i.valor, p.nome AS nome_plano, i.data_contratacao, i.situacao FROM investimentos AS i JOIN clientes AS c ON c.id = i.id_cliente JOIN planos AS p ON p.id = i.id_plano WHERE i.id = 7;

SELECT c.id, c.nome, i.id AS idinvest, i.valor, p.nome AS nome_plano, i.data_contratacao, i.situacao FROM investimentos AS i JOIN clientes AS c ON c.id = i.id_cliente JOIN planos AS p ON p.id = i.id_plano WHERE i.id = 4;

SELECT c.nome,c.cpf,c.rg,u.email FROM clientes AS c JOIN usuarios AS u ON c.id_usuario = u.id WHERE u.email= 'fernandoestevam23@gmail.com';

SELECT c.nome, c.cpf, c.rg, u.email FROM clientes AS c JOIN usuarios AS u ON c.id_usuario = u.id WHERE c.nome='Fernando Antonio Estevam' OR c.cpf='32332280820' OR c.rg='406337780' OR u.email='fernandoestevam23@gmail.com';

SELECT c.nome, c.estado_civil, c.rg, c.cpf,c.data_nascimento,c.endereco,c.numero,c.complemento,c.bairro,c.cep,c.cidade,c.uf,c.telefone, u.email
	FROM investimentos AS i 
    JOIN clientes AS c ON c.id = i.id_cliente 
    JOIN usuarios AS u ON u.id = c.id_usuario
    WHERE c.nome = 'Fernando Antonio Estevam';

use db_poupemais;
    
UPDATE usuarios SET status = 'ativo' WHERE id = 18;    
    
UPDATE vencimentos AS v JOIN investimentos AS i ON i.id = v.id_investimento 
	SET v.data_pagamento = null, vencimento = '2020/12/10' ,v.situacao = 'aberto' WHERE  v.id = 1;
    
UPDATE vencimentos AS v JOIN investimentos AS i ON i.id = v.id_investimento 
	SET v.data_pagamento = null, v.situacao = 'aberto' WHERE v.id = 1;
    
SELECT vencimento FROM vencimentos WHERE id = 1;
    
    
SELECT v.id AS ID_Vcto, c.nome, i.id AS n_invest, v.parcela, v.vencimento, v.valor, p.nome AS plano, v.situacao
        FROM vencimentos AS v
			JOIN investimentos AS i ON i.id = v.id_investimento
			JOIN planos AS p ON p.id = i.id_plano
			JOIN clientes AS c ON c.id = i.id_cliente
            WHERE v.vencimento <= '2020-01-13';
            
SELECT * FROM clientes;
SET FOREIGN_KEY_CHECKS=0;DELETE FROM vencimentos where id_investimento = 26;
SET FOREIGN_KEY_CHECKS=0;DELETE FROM vencimentos where id = 26;
SET FOREIGN_KEY_CHECKS=0;DELETE FROM clientes where id = 25;
SET FOREIGN_KEY_CHECKS=0;DELETE FROM usuarios where id = 25;

ALTER TABLE vencimentos AUTO_INCREMENT=209;
ALTER TABLE investimentos AUTO_INCREMENT=25;
ALTER TABLE clientes AUTO_INCREMENT=25;
ALTER TABLE usuarios AUTO_INCREMENT=25;

select * from clientes;

SELECT c.cpf, u.email FROM clientes AS c JOIN usuarios AS u ON c.id_usuario = u.id WHERE c.cpf = '32332280820' AND u.email = 'fernandoestevam23@gmail.com';

SELECT c.cpf FROM clientes AS c WHERE c.cpf = '32332280820';

SELECT * FROM confirmation;
DELETE FROM confirmation WHERE email = 'fernandoestevam23@gmail.com'; 
ALTER TABLE confirmation AUTO_INCREMENT=19;
INSERT confirmation(email, token) VALUES ('fernandoestevam2@gmail.com','token64');

SELECT * FROM usuarios;
UPDATE usuarios SET senha = 704564 WHERE email = 'fernandoestevam23@gmail.com';   

UPDATE usuarios SET status = 'ativo' WHERE id = 18;    

DELETE FROM usuarios WHERE id = 17;

SELECT * FROM usuarios;
SELECT * FROM clientes;
SELECT * FROM investimentos;
SELECT * FROM vencimentos;
SELECT * FROM contratos;

ALTER TABLE contratos DROP FOREIGN KEY fk_contratos_investimentos1;

ALTER TABLE contratos 
  ADD CONSTRAINT fk_contratos_investimentos1
  FOREIGN KEY (id_invest_contrat) 
  REFERENCES investimentos (id) 
  ON DELETE CASCADE;

SHOW COLUMNS FROM `db_poupemais`.`investimentos`;

SET foreign_key_checks = 1;

