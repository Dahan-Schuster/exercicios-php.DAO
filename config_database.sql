CREATE DATABASE `dbphp7`;

CREATE TABLE IF NOT EXISTS `tb_usuarios`
(
    id    INT AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    primary key (id)
);

INSERT INTO `tb_usuarios` VALUES
('Dahan-Schuster', 'Saudosa Maloca'),
('Fanisz', 'y2y2y2y2'),
('Lee', 'Rita');

USE `dbphp7`;
DROP procedure IF EXISTS `sp_usuarios_insert`;

DELIMITER $$
USE `dbphp7`$$
CREATE PROCEDURE `sp_usuarios_insert` (
plogin VARCHAR(50),
psenha VARCHAR(50)
)
BEGIN
	INSERT INTO tb_usuarios(login, senha) values (plogin, psenha);

    SELECT * FROM tb_usuarios WHERE id = LAST_INSERT_ID();

END$$

DELIMITER ;