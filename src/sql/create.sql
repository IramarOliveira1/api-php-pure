
CREATE DATABASE IF NOT EXISTS blue_service;

--executar primeiro a linha de create DATA BASE

--Após criar as tabelas ir no arquivo insert.sql para criar os dados

CREATE TABLE `endereco` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`cep` VARCHAR(9) NOT NULL COLLATE 'utf8mb4_general_ci',
	`logradouro` VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	`bairro` VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	`uf` VARCHAR(2) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	`cidade` VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	`complemento` VARCHAR(100) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	`numero` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `usuario` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`cpf` VARCHAR(14) NOT NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`senha` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`perfil` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_endereco` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `email` (`email`) USING BTREE,
	UNIQUE INDEX `cpf` (`cpf`) USING BTREE,
	INDEX `FK_usuario_endereco` (`id_endereco`) USING BTREE,
	CONSTRAINT `FK_usuario_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `categoria` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `caracteristica` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`modelo` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`fabricante` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`cor` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`codigo` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `codigo` (`codigo`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `produto` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`descricao` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`url_imagem` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`preco` DECIMAL(10,2) NOT NULL,
	`id_caracteristica` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK_produto_caracteristica` (`id_caracteristica`) USING BTREE,
	CONSTRAINT `FK_produto_caracteristica` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristica` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `pedido` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`codigo` BIGINT(20) NOT NULL,
	`id_produto` INT(11) NOT NULL,
	`id_usuario` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `codigo` (`codigo`) USING BTREE,
	INDEX `FK_pedido_produto` (`id_produto`) USING BTREE,
	INDEX `FK_pedido_usuario` (`id_usuario`) USING BTREE,
	CONSTRAINT `FK_pedido_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `pivot_produto_categoria` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_produto` INT(11) NOT NULL,
	`id_categoria` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `FK__produto` (`id_produto`) USING BTREE,
	INDEX `FK__categoria` (`id_categoria`) USING BTREE,
	CONSTRAINT `FK__categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK__produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
