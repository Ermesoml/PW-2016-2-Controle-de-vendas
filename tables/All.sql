CREATE SCHEMA `kikmidia` ;

CREATE TABLE `kikmidia`.`clientes` (
  `cliente_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `telefone` VARCHAR(20) NULL,
  `email` VARCHAR(70) NULL,
  PRIMARY KEY (`cliente_id`));

CREATE TABLE `kikmidia`.`clientes_redes_sociais` (
  `cliente_id` INT NOT NULL,
  `rede_social` VARCHAR(40) NOT NULL,
  `login` VARCHAR(40) NOT NULL,
  `senha` VARCHAR(40) NULL,
  PRIMARY KEY (`cliente_id`, `login`, `rede_social`),
  CONSTRAINT `fk_red_soc_cliente_id`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `kikmidia`.`clientes` (`cliente_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);

ALTER TABLE `kikmidia`.`clientes_redes_sociais` 
ADD COLUMN `rede_social_id` INT NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`rede_social_id`, `cliente_id`, `rede_social`, `login`);


CREATE TABLE `kikmidia`.`clientes_acompanhamentos` (
  `acompanhamento_id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `cliente_rede_social_id` INT NOT NULL,
  `tipo_servico` VARCHAR(30) NULL,
  `representante` VARCHAR(60) NULL,
  `preco` DECIMAL(10,2) NULL,
  `comissao` DECIMAL(10,2) NULL,
  `data_cadastro` DATE NULL,
  `status` CHAR(1) NULL DEFAULT 'A',
  PRIMARY KEY (`acompanhamento_id`),
  INDEX `acompanhamento_cliente_id_idx` (`cliente_id` ASC),
  CONSTRAINT `acompanhamento_cliente_id`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `kikmidia`.`clientes` (`cliente_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);


ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ENGINE = InnoDB ;


ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD INDEX `acompanhamento_rede_social_id_idx` (`cliente_rede_social_id` ASC);
ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD CONSTRAINT `acompanhamento_rede_social_id`
  FOREIGN KEY (`cliente_rede_social_id`)
  REFERENCES `kikmidia`.`clientes_redes_sociais` (`rede_social_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


USE `kikmidia`;

DELIMITER $$

DROP TRIGGER IF EXISTS kikmidia.clientes_acompanhamentos_BEFORE_INSERT_1$$
USE `kikmidia`$$
CREATE DEFINER = CURRENT_USER TRIGGER `kikmidia`.`clientes_acompanhamentos_BEFORE_INSERT_1` BEFORE INSERT ON `clientes_acompanhamentos` FOR EACH ROW
BEGIN
	SET NEW.DATA_CADASTRO = NOW();
END$$
DELIMITER ;


INSERT INTO `kikmidia`.`clientes_acompanhamentos` (`cliente_id`, `cliente_rede_social_id`, `tipo_servico`, `representante`, `preco`, `comissao`, `status`) VALUES ('12', '8', 'Mensalista', 'Ermesom', '125', '12.50', 'A');


ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD COLUMN `descricao` VARCHAR(200) NULL AFTER `tipo_servico`;

CREATE TABLE `kikmidia`.`usuarios` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `telefone` VARCHAR(20),
  `email` VARCHAR(70),
  `login` VARCHAR(20) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`usuario_id`));

ALTER TABLE `kikmidia`.`usuarios` 
ADD UNIQUE INDEX `usuario_unico_idx` (`login` ASC);

ALTER TABLE `kikmidia`.`usuarios` 
ADD COLUMN `tipo` CHAR(1) NULL DEFAULT 'V' AFTER `senha`,
ADD COLUMN `banido` CHAR(1) NULL DEFAULT 'N' AFTER `tipo`;

ALTER TABLE `kikmidia`.`usuarios` 
CHANGE COLUMN `tipo` `tipo` CHAR(1) NOT NULL DEFAULT 'V' ,
CHANGE COLUMN `banido` `banido` CHAR(1) NOT NULL DEFAULT 'N' ,
ADD COLUMN `cargo` VARCHAR(40) NULL AFTER `banido`;

ALTER TABLE `kikmidia`.`usuarios` 
CHANGE COLUMN `senha` `senha` BLOB NOT NULL ;

ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD COLUMN `usuario_id` INT(11) NULL AFTER `status`,
ADD INDEX `fk_usuarios_idx` (`usuario_id` ASC);
ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD CONSTRAINT `fk_usuarios`
  FOREIGN KEY (`usuario_id`)
  REFERENCES `kikmidia`.`usuarios` (`usuario_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

CREATE or replace VIEW vw_acompanhamentos AS
select
  aco.acompanhamento_id,
    aco.cliente_id,
    cli.nome,
    cli.telefone,
    aco.representante,
    aco.cliente_rede_social_id,
    red.rede_social,
    red.login,
    aco.preco,
    aco.comissao,
    aco.descricao,
    aco.data_cadastro,
    aco.status,
    aco.usuario_id,
    aco.qtd_seg_inicial,
    aco.qtd_seg_atual
from
  clientes_acompanhamentos aco
    
inner join clientes cli
on cli.cliente_id = aco.cliente_id

inner join clientes_redes_sociais red
on red.rede_social_id = aco.cliente_rede_social_id

ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD COLUMN `qtd_seg_inicial` INT(11) NULL AFTER `status`,
ADD COLUMN `qtd_seg_atual` INT(11) NULL AFTER `qtd_seg_inicial`;
USE `kikmidia`;

DELIMITER $$

DROP TRIGGER IF EXISTS kikmidia.clientes_acompanhamentos_BEFORE_INSERT_1$$
USE `kikmidia`$$
CREATE DEFINER=`root`@`localhost` TRIGGER `kikmidia`.`clientes_acompanhamentos_BEFORE_INSERT_1` BEFORE INSERT ON `clientes_acompanhamentos` FOR EACH ROW
BEGIN
  SET NEW.data_cadastro = NOW();
    SET NEW.qtd_seg_atual = NEW.qtd_seg_inicial;
END$$
DELIMITER ;

update clientes_acompanhamentos set qtd_seg_inicial = 250, qtd_seg_atual = 250

ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
DROP INDEX `fk_acomp_rede_social_id_idx` ;

ALTER TABLE `kikmidia`.`clientes_redes_sociais` 
ENGINE = InnoDB ;

ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD INDEX `fk_acomp_red_id_idx` (`cliente_rede_social_id` ASC);
ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD CONSTRAINT `fk_acomp_red_id`
  FOREIGN KEY (`cliente_rede_social_id`)
  REFERENCES `kikmidia`.`clientes_redes_sociais` (`rede_social_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
DROP FOREIGN KEY `fk_acomp_red_id`;
ALTER TABLE `kikmidia`.`clientes_acompanhamentos` 
ADD CONSTRAINT `fk_acomp_red_id`
  FOREIGN KEY (`cliente_rede_social_id`)
  REFERENCES `kikmidia`.`clientes_redes_sociais` (`rede_social_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
