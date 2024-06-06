-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/06/2024 às 23:26
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iteflix`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `esportes`
--

CREATE TABLE `esportes` (
  `id_esportes` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text NOT NULL,
  `data_transmissao` date DEFAULT NULL,
  `horario` varchar(8) DEFAULT NULL,
  `modalidade_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `esportes`
--

INSERT INTO `esportes` (`id_esportes`, `nome`, `descricao`, `data_transmissao`, `horario`, `modalidade_id`) VALUES
(1, NULL, 'Palmeiras X Corinthians', '2024-06-29', '20:00', 1),
(2, NULL, 'São Paulo x Internacional', '2024-06-13', '20:00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id_filmes` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `diretor` varchar(255) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL,
  `classificacao` varchar(50) DEFAULT NULL,
  `sinopse` text DEFAULT NULL,
  `genero_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id_filmes`, `titulo`, `diretor`, `ano`, `duracao`, `classificacao`, `sinopse`, `genero_id`) VALUES
(10, 'Velozes e Furiosos', ' Rob Cohen', 200, 106, '+13', '\"Velozes e Furiosos\" segue o policial disfarçado Brian O\'Conner, que se infiltra no mundo das corridas de rua ilegais em Los Angeles. Ele se aproxima de Dominic Toretto, um carismático líder de gangue e talentoso piloto, e sua equipe. Enquanto investiga roubos de caminhões, Brian luta com sua lealdade entre a lei e a nova família que encontra nas ruas.', 1),
(11, 'Up - Altas Aventuras', 'Pete Docter', 2009, 96, 'Público geral', '\"Up - Altas Aventuras\" conta a história de Carl Fredricksen, um viúvo de 78 anos que decide realizar o sonho de sua falecida esposa de explorar a América do Sul. Ele amarra milhares de balões à sua casa e voa para a selva, acidentalmente levando consigo Russell, um jovem escoteiro. Juntos, eles embarcam em uma aventura emocionante, encontrando amigos inusitados e enfrentando desafios inesperados.', 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `nome`) VALUES
(1, 'Ação'),
(2, 'Comédia'),
(3, 'Drama'),
(4, 'Fantasia'),
(5, 'Terror'),
(22, 'Animação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero_serie`
--

CREATE TABLE `genero_serie` (
  `id_genero_serie` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero_serie`
--

INSERT INTO `genero_serie` (`id_genero_serie`, `nome`) VALUES
(57, 'Ação'),
(58, 'Comédia'),
(60, 'Fantasia'),
(61, 'Terror'),
(62, 'Ficção Científica'),
(63, 'Drama');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modalidade`
--

CREATE TABLE `modalidade` (
  `id_modalidade` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modalidade`
--

INSERT INTO `modalidade` (`id_modalidade`, `nome`) VALUES
(1, 'futebol'),
(2, 'basquete'),
(3, 'vôlei'),
(4, 'tênis'),
(5, 'natação'),
(6, 'tênis de mesa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `diretor` varchar(255) DEFAULT NULL,
  `genero` varchar(100) NOT NULL,
  `ano_inicio` int(11) DEFAULT NULL,
  `ano_fim` int(11) DEFAULT NULL,
  `temporadas` int(11) DEFAULT NULL,
  `episodios` int(11) DEFAULT NULL,
  `duracao` varchar(20) NOT NULL,
  `classificacao` varchar(20) NOT NULL,
  `sinopse` text NOT NULL,
  `id_genero_serie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `series`
--

INSERT INTO `series` (`id`, `titulo`, `diretor`, `genero`, `ano_inicio`, `ano_fim`, `temporadas`, `episodios`, `duracao`, `classificacao`, `sinopse`, `id_genero_serie`) VALUES
(45, 'Friends', 'Kevin S. Bright, Michael Lembeck e James Burrows', 'Comédia', 1994, 2004, 10, 234, '', 'Público geral', '\"Friends\" segue as vidas e as peripécias de seis amigos – Rachel, Ross, Monica, Chandler, Joey e Phoebe – que vivem em Nova York. Entre romances, carreiras e momentos hilários, eles navegam pelas complexidades da vida adulta, sempre com muito humor e amizade.', NULL),
(46, 'The Walking Dead', 'Frank Darabont', 'Terror', 2010, 2022, 11, 177, '', '+17', '\"The Walking Dead\" segue um grupo de sobreviventes em um mundo pós-apocalíptico dominado por zumbis, conhecidos como \"walkers\". Liderado inicialmente pelo ex-xerife Rick Grimes, o grupo enfrenta constantes ameaças tanto dos mortos-vivos quanto de outros sobreviventes humanos, lutando para manter a humanidade e a esperança em meio ao caos.', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `email`, `senha`) VALUES
(1, 'admin@gmail.com', '1234567');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `esportes`
--
ALTER TABLE `esportes`
  ADD PRIMARY KEY (`id_esportes`),
  ADD KEY `fk_modalidade` (`modalidade_id`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id_filmes`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Índices de tabela `genero_serie`
--
ALTER TABLE `genero_serie`
  ADD PRIMARY KEY (`id_genero_serie`);

--
-- Índices de tabela `modalidade`
--
ALTER TABLE `modalidade`
  ADD PRIMARY KEY (`id_modalidade`);

--
-- Índices de tabela `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_genero_serie` (`id_genero_serie`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `esportes`
--
ALTER TABLE `esportes`
  MODIFY `id_esportes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id_filmes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `genero_serie`
--
ALTER TABLE `genero_serie`
  MODIFY `id_genero_serie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `modalidade`
--
ALTER TABLE `modalidade`
  MODIFY `id_modalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `esportes`
--
ALTER TABLE `esportes`
  ADD CONSTRAINT `fk_modalidade` FOREIGN KEY (`modalidade_id`) REFERENCES `modalidade` (`id_modalidade`);

--
-- Restrições para tabelas `filmes`
--
ALTER TABLE `filmes`
  ADD CONSTRAINT `filmes_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id_genero`);

--
-- Restrições para tabelas `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_genero_serie` FOREIGN KEY (`id_genero_serie`) REFERENCES `genero_serie` (`id_genero_serie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
