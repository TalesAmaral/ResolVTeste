-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 16-Jan-2022 às 17:14
-- Versão do servidor: 5.6.51
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `baseresolv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `ID_Alternativa` int(11) NOT NULL,
  `Valor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alternativa`
--

INSERT INTO `alternativa` (`ID_Alternativa`, `Valor`) VALUES
(1, '100'),
(2, '120'),
(3, '50'),
(4, '25'),
(5, '240');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `ID_Disciplina` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`ID_Disciplina`, `Nome`) VALUES
(1, 'Matemática'),
(2, 'Física'),
(3, 'Português'),
(4, 'Química'),
(5, 'Biologia'),
(6, 'Filosofia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `edita`
--

CREATE TABLE `edita` (
  `fk_Usuario_ID_Usuario` int(11) DEFAULT NULL,
  `fk_Questao_ID_Questao` int(11) DEFAULT NULL,
  `dataEditada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `possui`
--

CREATE TABLE `possui` (
  `fk_Alternativa_ID_Alternativa` int(11) DEFAULT NULL,
  `fk_Questao_ID_Questao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `possui`
--

INSERT INTO `possui` (`fk_Alternativa_ID_Alternativa`, `fk_Questao_ID_Questao`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `ID_Questao` int(11) NOT NULL,
  `Enunciado` varchar(2000) DEFAULT NULL,
  `Solucao` varchar(2000) DEFAULT NULL,
  `Ano` int(11) DEFAULT NULL,
  `Aprovada` tinyint(4) DEFAULT NULL,
  `fk_Disciplina_ID_Disciplina` int(11) DEFAULT NULL,
  `fk_Usuario_ID_Usuario` int(11) DEFAULT NULL,
  `dataCriada` date DEFAULT NULL,
  `fk_Alternativa_ID_Alternativa` int(11) DEFAULT NULL,
  `fk_Vestibular_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`ID_Questao`, `Enunciado`, `Solucao`, `Ano`, `Aprovada`, `fk_Disciplina_ID_Disciplina`, `fk_Usuario_ID_Usuario`, `dataCriada`, `fk_Alternativa_ID_Alternativa`, `fk_Vestibular_ID`) VALUES
(1, 'Duas caixas A e B, contêm exatamente 5 bolas cada uma. Retiram-se duas bolas de cada caixa, aleatoriamente. O número de elementos do espaço amostral relativo a esse experimento é exatamente:', 'O número de formas de escolher as 2 bolas em uma caixa será C 5,2. \n\nComo temos duas caixas, o total de possibilidades de escolha será:\n\nC 5,2 . C 5,2 = 10 . 10 = 100', 1994, 1, 1, NULL, '2021-12-22', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `realiza`
--

CREATE TABLE `realiza` (
  `fk_Usuario_ID_Usuario` int(11) DEFAULT NULL,
  `fk_Questao_ID_Questao` int(11) DEFAULT NULL,
  `Acertou` tinyint(4) DEFAULT NULL,
  `dataRealizada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `Nome` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Apelido` varchar(45) DEFAULT NULL,
  `Senha` varchar(200) DEFAULT NULL,
  `ID_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Nome`, `Email`, `Apelido`, `Senha`, `ID_Usuario`) VALUES
('Tales', 'talesamaral@gmail.com', 'totody', '$2y$10$yYTxf7/vzKnPunLMMUT9BugUzAGGnBlTmdOsjuQd30e2VhfiIpfOm', 1),
('Lucas D&#39;Amato Nitz', 'lucas.nitz@hotmail.com', 'lucdnitz', '$2y$10$IVS0P6anWmnxQ8l85Do/vObu84V8BKn3BmGgDg7oS0qmVIupksMde', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vestibular`
--

CREATE TABLE `vestibular` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vestibular`
--

INSERT INTO `vestibular` (`ID`, `Nome`) VALUES
(1, 'AFA');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`ID_Alternativa`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`ID_Disciplina`);

--
-- Índices para tabela `edita`
--
ALTER TABLE `edita`
  ADD KEY `FK_Edita_1` (`fk_Usuario_ID_Usuario`),
  ADD KEY `FK_Edita_2` (`fk_Questao_ID_Questao`);

--
-- Índices para tabela `possui`
--
ALTER TABLE `possui`
  ADD KEY `FK_Possui_1` (`fk_Alternativa_ID_Alternativa`),
  ADD KEY `FK_Possui_2` (`fk_Questao_ID_Questao`);

--
-- Índices para tabela `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`ID_Questao`),
  ADD KEY `FK_Questao_2` (`fk_Disciplina_ID_Disciplina`),
  ADD KEY `FK_Questao_3` (`fk_Usuario_ID_Usuario`),
  ADD KEY `FK_Questao_4` (`fk_Alternativa_ID_Alternativa`),
  ADD KEY `FK_Questao_5` (`fk_Vestibular_ID`);

--
-- Índices para tabela `realiza`
--
ALTER TABLE `realiza`
  ADD KEY `FK_Realiza_1` (`fk_Usuario_ID_Usuario`),
  ADD KEY `FK_Realiza_2` (`fk_Questao_ID_Questao`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Índices para tabela `vestibular`
--
ALTER TABLE `vestibular`
  ADD PRIMARY KEY (`ID`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `edita`
--
ALTER TABLE `edita`
  ADD CONSTRAINT `FK_Edita_1` FOREIGN KEY (`fk_Usuario_ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Edita_2` FOREIGN KEY (`fk_Questao_ID_Questao`) REFERENCES `questao` (`ID_Questao`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `possui`
--
ALTER TABLE `possui`
  ADD CONSTRAINT `FK_Possui_1` FOREIGN KEY (`fk_Alternativa_ID_Alternativa`) REFERENCES `alternativa` (`ID_Alternativa`),
  ADD CONSTRAINT `FK_Possui_2` FOREIGN KEY (`fk_Questao_ID_Questao`) REFERENCES `questao` (`ID_Questao`);

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `FK_Questao_2` FOREIGN KEY (`fk_Disciplina_ID_Disciplina`) REFERENCES `disciplina` (`ID_Disciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Questao_3` FOREIGN KEY (`fk_Usuario_ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Questao_4` FOREIGN KEY (`fk_Alternativa_ID_Alternativa`) REFERENCES `alternativa` (`ID_Alternativa`),
  ADD CONSTRAINT `FK_Questao_5` FOREIGN KEY (`fk_Vestibular_ID`) REFERENCES `vestibular` (`ID`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `FK_Realiza_1` FOREIGN KEY (`fk_Usuario_ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `FK_Realiza_2` FOREIGN KEY (`fk_Questao_ID_Questao`) REFERENCES `questao` (`ID_Questao`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
