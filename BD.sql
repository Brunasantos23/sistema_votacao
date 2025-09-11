-- criação do BD 
CREATE DATABASE IF NOT EXISTS `eleicao_turma` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `eleicao_turma`;

-- chapas
CREATE TABLE `chapas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo_chapa` VARCHAR(20) NOT NULL UNIQUE,
  `nome_chapa` VARCHAR(100) NOT NULL,
  `matricula_lider` VARCHAR(50) NOT NULL,
  `nome_lider` VARCHAR(100) NOT NULL,
  `matricula_vice` VARCHAR(50) NOT NULL,
  `nome_vice` VARCHAR(100) NOT NULL,
  `data_cadastro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- alunos que já votaram 
CREATE TABLE `alunos_votantes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `matricula_aluno` VARCHAR(50) NOT NULL UNIQUE,
  `data_voto` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- registro dos votos 
CREATE TABLE `votos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `chapa_id` INT NOT NULL,
  `aluno_votante_id` INT NOT NULL,
  `data_voto` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`chapa_id`) REFERENCES `chapas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`aluno_votante_id`) REFERENCES `alunos_votantes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;