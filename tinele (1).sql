-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 27-Jul-2018 às 12:08
-- Versão do servidor: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.2.3-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tinele`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regras` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativas`
--

CREATE TABLE `alternativas` (
  `id` int(10) UNSIGNED NOT NULL,
  `questao_id` int(11) NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resposta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `alternativas`
--

INSERT INTO `alternativas` (`id`, `questao_id`, `descricao`, `resposta`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tarauacá', 0, '2018-07-23 16:03:55', '2018-07-23 16:03:55'),
(2, 1, 'Cruzeiro do Sul?', 0, '2018-07-23 16:03:55', '2018-07-23 16:03:55'),
(3, 1, 'Rio Branco', 3, '2018-07-23 16:03:55', '2018-07-23 16:03:55'),
(4, 2, '1', 0, '2018-07-25 18:58:02', '2018-07-25 18:58:02'),
(5, 2, '2', 0, '2018-07-25 18:58:02', '2018-07-25 18:58:02'),
(6, 2, '3', 0, '2018-07-25 18:58:02', '2018-07-25 18:58:02'),
(7, 2, '4', 0, '2018-07-25 18:58:02', '2018-07-25 18:58:02'),
(8, 2, '5', 5, '2018-07-25 18:58:02', '2018-07-25 18:58:02'),
(9, 3, '2', 0, '2018-07-25 19:01:05', '2018-07-25 19:01:05'),
(10, 3, '3', 0, '2018-07-25 19:01:05', '2018-07-25 19:01:05'),
(11, 3, '4', 0, '2018-07-25 19:01:05', '2018-07-25 19:01:05'),
(12, 3, '5', 4, '2018-07-25 19:01:05', '2018-07-25 19:01:05'),
(13, 3, '1', 0, '2018-07-25 19:01:05', '2018-07-25 19:01:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anotacoes`
--

CREATE TABLE `anotacoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `aula_id` int(11) NOT NULL,
  `texto` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `anotacoes`
--

INSERT INTO `anotacoes` (`id`, `user_id`, `aula_id`, `texto`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'tteste', '2018-07-23 16:59:32', '2018-07-23 16:59:32'),
(2, 10, 5, 'oi', '2018-07-25 03:40:18', '2018-07-25 03:40:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordem` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `gratis` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id`, `nome`, `descricao`, `video`, `ordem`, `modulo_id`, `gratis`, `created_at`, `updated_at`) VALUES
(1, 'dsa', 'sda', '280992127', 1, 1, NULL, '2018-07-20 19:41:26', '2018-07-20 19:41:26'),
(2, 'Mapa Do Sucesso Online', 'Oi', '281007573', 2, 1, 1, '2018-07-20 21:43:50', '2018-07-20 21:43:58'),
(3, 'MindSet', NULL, '281009574', 1, 2, 1, '2018-07-20 22:02:30', '2018-07-20 22:02:39'),
(4, 'MindSet Vencedor', 'Configurando sua mente para o sucesso online.', '281288105', 1, 3, 1, '2018-07-23 16:03:15', '2018-07-23 16:04:47'),
(5, '1ª aula - Autoconsciência', NULL, '281357703', 1, 4, 1, '2018-07-23 23:15:34', '2018-07-25 22:26:03'),
(6, '2ª Aula - Como lidar com as suas emoções', NULL, '281513500', 2, 4, NULL, '2018-07-24 20:19:51', '2018-07-24 20:19:51'),
(7, '3ª Aula - Os valores', NULL, '281525370', 3, 4, NULL, '2018-07-24 21:37:35', '2018-07-24 21:37:35'),
(8, '4ª Aula - Quem é o líder da sua vida', NULL, '281527919', 4, 4, NULL, '2018-07-24 21:57:05', '2018-07-24 21:57:05'),
(9, '5ª Aula - Qual o propósito da sua vida', NULL, '281532835', 5, 4, NULL, '2018-07-25 00:16:24', '2018-07-25 00:16:24'),
(10, '6ª Aula- Responsabilidade pessoal', NULL, '281544528', 6, 4, NULL, '2018-07-25 00:46:06', '2018-07-25 00:46:06'),
(11, '7ª Aula - Automotivação', NULL, '281550902', 7, 4, NULL, '2018-07-25 02:00:12', '2018-07-25 02:00:12'),
(12, '8ª Aula - Não deixe se levar pelo melodrama da crise', NULL, '281552735', 8, 4, NULL, '2018-07-25 02:42:21', '2018-07-25 02:42:21'),
(13, '9ª Aula - Como viver de acordo com seus valores e propósitos', NULL, '281556249', 9, 4, NULL, '2018-07-25 03:13:17', '2018-07-25 03:13:17'),
(14, '10ª Aula - Como ter uma ação com o foco na solução', NULL, '281558997', 10, 4, NULL, '2018-07-25 03:38:55', '2018-07-25 03:38:55'),
(15, 'teste', '8787', '281676034', 1, 5, NULL, '2018-07-25 18:42:36', '2018-07-25 18:42:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `cod` int(11) NOT NULL,
  `banco` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bancos`
--

INSERT INTO `bancos` (`cod`, `banco`) VALUES
(1, '001 - BANCO DO BRASIL S/A'),
(2, '002 - BANCO CENTRAL DO BRASIL'),
(3, '003 - BANCO DA AMAZONIA S.A'),
(4, '004 - BANCO DO NORDESTE DO BRASIL S.A'),
(7, '007 - BANCO NAC DESENV. ECO. SOCIAL S.A'),
(8, '008 - BANCO MERIDIONAL DO BRASIL'),
(20, '020 - BANCO DO ESTADO DE ALAGOAS S.A'),
(21, '021 - BANCO DO ESTADO DO ESPIRITO SANTO S.A'),
(22, '022 - BANCO DE CREDITO REAL DE MINAS GERAIS SA'),
(24, '024 - BANCO DO ESTADO DE PERNAMBUCO'),
(25, '025 - BANCO ALFA S/A'),
(26, '026 - BANCO DO ESTADO DO ACRE S.A'),
(27, '027 - BANCO DO ESTADO DE SANTA CATARINA S.A'),
(28, '028 - BANCO DO ESTADO DA BAHIA S.A'),
(29, '029 - BANCO DO ESTADO DO RIO DE JANEIRO S.A'),
(30, '030 - BANCO DO ESTADO DA PARAIBA S.A'),
(31, '031 - BANCO DO ESTADO DE GOIAS S.A'),
(32, '032 - BANCO DO ESTADO DO MATO GROSSO S.A.'),
(33, '033 - BANCO DO ESTADO DE SAO PAULO S.A'),
(34, '034 - BANCO DO ESADO DO AMAZONAS S.A'),
(35, '035 - BANCO DO ESTADO DO CEARA S.A'),
(36, '036 - BANCO DO ESTADO DO MARANHAO S.A'),
(37, '037 - BANCO DO ESTADO DO PARA S.A'),
(38, '038 - BANCO DO ESTADO DO PARANA S.A'),
(39, '039 - BANCO DO ESTADO DO PIAUI S.A'),
(41, '041 - BANCO DO ESTADO DO RIO GRANDE DO SUL S.A'),
(47, '047 - BANCO DO ESTADO DE SERGIPE S.A'),
(48, '048 - BANCO DO ESTADO DE MINAS GERAIS S.A'),
(59, '059 - BANCO DO ESTADO DE RONDONIA S.A'),
(70, '070 - BANCO DE BRASILIA S.A'),
(104, '104 - CAIXA ECONOMICA FEDERAL'),
(106, '106 - BANCO ITABANCO S.A.'),
(107, '107 - BANCO BBM S.A'),
(109, '109 - BANCO CREDIBANCO S.A'),
(116, '116 - BANCO B.N.L DO BRASIL S.A'),
(148, '148 - MULTI BANCO S.A'),
(151, '151 - CAIXA ECONOMICA DO ESTADO DE SAO PAULO'),
(153, '153 - CAIXA ECONOMICA DO ESTADO DO R.G.SUL'),
(165, '165 - BANCO NORCHEM S.A'),
(166, '166 - BANCO INTER-ATLANTICO S.A'),
(168, '168 - BANCO C.C.F. BRASIL S.A'),
(175, '175 - CONTINENTAL BANCO S.A'),
(184, '184 - BBA - CREDITANSTALT S.A'),
(199, '199 - BANCO FINANCIAL PORTUGUES'),
(200, '200 - BANCO FRICRISA AXELRUD S.A'),
(201, '201 - BANCO AUGUSTA INDUSTRIA E COMERCIAL S.A'),
(204, '204 - BANCO S.R.L S.A'),
(205, '205 - BANCO SUL AMERICA S.A'),
(206, '206 - BANCO MARTINELLI S.A'),
(208, '208 - BANCO PACTUAL S.A'),
(210, '210 - DEUTSCH SUDAMERIKANICHE BANK AG'),
(211, '211 - BANCO SISTEMA S.A'),
(212, '212 - BANCO MATONE S.A'),
(213, '213 - BANCO ARBI S.A'),
(214, '214 - BANCO DIBENS S.A'),
(215, '215 - BANCO AMERICA DO SUL S.A'),
(216, '216 - BANCO REGIONAL MALCON S.A'),
(217, '217 - BANCO AGROINVEST S.A'),
(218, '218 - BBS - BANCO BONSUCESSO S.A.'),
(219, '219 - BANCO DE CREDITO DE SAO PAULO S.A'),
(220, '220 - BANCO CREFISUL'),
(221, '221 - BANCO GRAPHUS S.A'),
(222, '222 - BANCO AGF BRASIL S. A.'),
(223, '223 - BANCO INTERUNION S.A'),
(224, '224 - BANCO FIBRA S.A'),
(225, '225 - BANCO BRASCAN S.A'),
(228, '228 - BANCO ICATU S.A'),
(229, '229 - BANCO CRUZEIRO S.A'),
(230, '230 - BANCO BANDEIRANTES S.A'),
(231, '231 - BANCO BOAVISTA S.A'),
(232, '232 - BANCO INTERPART S.A'),
(233, '233 - BANCO MAPPIN S.A'),
(234, '234 - BANCO LAVRA S.A.'),
(235, '235 - BANCO LIBERAL S.A'),
(236, '236 - BANCO CAMBIAL S.A'),
(237, '237 - BANCO BRADESCO S.A'),
(239, '239 - BANCO BANCRED S.A'),
(240, '240 - BANCO DE CREDITO REAL DE MINAS GERAIS S.'),
(241, '241 - BANCO CLASSICO S.A'),
(242, '242 - BANCO EUROINVEST S.A'),
(243, '243 - BANCO STOCK S.A'),
(244, '244 - BANCO CIDADE S.A'),
(245, '245 - BANCO EMPRESARIAL S.A'),
(246, '246 - BANCO ABC ROMA S.A'),
(247, '247 - BANCO OMEGA S.A'),
(249, '249 - BANCO INVESTCRED S.A'),
(250, '250 - BANCO SCHAHIN CURY S.A'),
(251, '251 - BANCO SAO JORGE S.A.'),
(252, '252 - BANCO FININVEST S.A'),
(254, '254 - BANCO PARANA BANCO S.A'),
(255, '255 - MILBANCO S.A.'),
(256, '256 - BANCO GULVINVEST S.A'),
(258, '258 - BANCO INDUSCRED S.A'),
(261, '261 - BANCO VARIG S.A'),
(262, '262 - BANCO BOREAL S.A'),
(263, '263 - BANCO CACIQUE'),
(264, '264 - BANCO PERFORMANCE S.A'),
(265, '265 - BANCO FATOR S.A'),
(266, '266 - BANCO CEDULA S.A'),
(267, '267 - BANCO BBM-COM.C.IMOB.CFI S.A.'),
(275, '275 - BANCO REAL S.A'),
(277, '277 - BANCO PLANIBANC S.A'),
(282, '282 - BANCO BRASILEIRO COMERCIAL'),
(291, '291 - BANCO DE CREDITO NACIONAL S.A'),
(294, '294 - BCR - BANCO DE CREDITO REAL S.A'),
(295, '295 - BANCO CREDIPLAN S.A'),
(300, '300 - BANCO DE LA NACION ARGENTINA S.A'),
(302, '302 - BANCO DO PROGRESSO S.A'),
(303, '303 - BANCO HNF S.A.'),
(304, '304 - BANCO PONTUAL S.A'),
(308, '308 - BANCO COMERCIAL BANCESA S.A.'),
(318, '318 - BANCO B.M.G. S.A'),
(320, '320 - BANCO INDUSTRIAL E COMERCIAL'),
(341, '341 - BANCO ITAU S.A'),
(346, '346 - BANCO FRANCES E BRASILEIRO S.A'),
(347, '347 - BANCO SUDAMERIS BRASIL S.A'),
(351, '351 - BANCO BOZANO SIMONSEN S.A'),
(353, '353 - BANCO GERAL DO COMERCIO S.A'),
(356, '356 - ABN AMRO S.A'),
(366, '366 - BANCO SOGERAL S.A'),
(369, '369 - PONTUAL'),
(370, '370 - BEAL - BANCO EUROPEU PARA AMERICA LATINA'),
(372, '372 - BANCO ITAMARATI S.A'),
(375, '375 - BANCO FENICIA S.A'),
(376, '376 - CHASE MANHATTAN BANK S.A'),
(388, '388 - BANCO MERCANTIL DE DESCONTOS S/A'),
(389, '389 - BANCO MERCANTIL DO BRASIL S.A'),
(392, '392 - BANCO MERCANTIL DE SAO PAULO S.A'),
(394, '394 - BANCO B.M.C. S.A'),
(399, '399 - BANCO BAMERINDUS DO BRASIL S.A'),
(409, '409 - UNIBANCO - UNIAO DOS BANCOS BRASILEIROS'),
(412, '412 - BANCO NACIONAL DA BAHIA S.A'),
(415, '415 - BANCO NACIONAL S.A'),
(420, '420 - BANCO NACIONAL DO NORTE S.A'),
(422, '422 - BANCO SAFRA S.A'),
(424, '424 - BANCO NOROESTE S.A'),
(434, '434 - BANCO FORTALEZA S.A'),
(453, '453 - BANCO RURAL S.A'),
(456, '456 - BANCO TOKIO S.A'),
(464, '464 - BANCO SUMITOMO BRASILEIRO S.A'),
(466, '466 - BANCO MITSUBISHI BRASILEIRO S.A'),
(472, '472 - LLOYDS BANK PLC'),
(473, '473 - BANCO FINANCIAL PORTUGUES S.A'),
(477, '477 - CITIBANK N.A'),
(479, '479 - BANCO DE BOSTON S.A'),
(480, '480 - BANCO PORTUGUES DO ATLANTICO-BRASIL S.A'),
(483, '483 - BANCO AGRIMISA S.A.'),
(487, '487 - DEUTSCHE BANK S.A - BANCO ALEMAO'),
(488, '488 - BANCO J. P. MORGAN S.A'),
(489, '489 - BANESTO BANCO URUGAUAY S.A'),
(492, '492 - INTERNATIONALE NEDERLANDEN BANK N.V.'),
(493, '493 - BANCO UNION S.A.C.A'),
(494, '494 - BANCO LA REP. ORIENTAL DEL URUGUAY'),
(495, '495 - BANCO LA PROVINCIA DE BUENOS AIRES'),
(496, '496 - BANCO EXTERIOR DE ESPANA S.A'),
(498, '498 - CENTRO HISPANO BANCO'),
(499, '499 - BANCO IOCHPE S.A'),
(501, '501 - BANCO BRASILEIRO IRAQUIANO S.A.'),
(502, '502 - BANCO SANTANDER S.A'),
(504, '504 - BANCO MULTIPLIC S.A'),
(505, '505 - BANCO GARANTIA S.A'),
(600, '600 - BANCO LUSO BRASILEIRO S.A'),
(601, '601 - BFC BANCO S.A.'),
(602, '602 - BANCO PATENTE S.A'),
(604, '604 - BANCO INDUSTRIAL DO BRASIL S.A'),
(607, '607 - BANCO SANTOS NEVES S.A'),
(608, '608 - BANCO OPEN S.A'),
(610, '610 - BANCO V.R. S.A'),
(611, '611 - BANCO PAULISTA S.A'),
(612, '612 - BANCO GUANABARA S.A'),
(613, '613 - BANCO PECUNIA S.A'),
(616, '616 - BANCO INTERPACIFICO S.A'),
(617, '617 - BANCO INVESTOR S.A.'),
(618, '618 - BANCO TENDENCIA S.A'),
(621, '621 - BANCO APLICAP S.A.'),
(622, '622 - BANCO DRACMA S.A'),
(623, '623 - BANCO PANAMERICANO S.A'),
(624, '624 - BANCO GENERAL MOTORS S.A'),
(625, '625 - BANCO ARAUCARIA S.A'),
(626, '626 - BANCO FICSA S.A'),
(627, '627 - BANCO DESTAK S.A'),
(628, '628 - BANCO CRITERIUM S.A'),
(629, '629 - BANCORP BANCO COML. E. DE INVESTMENTO'),
(630, '630 - BANCO INTERCAP S.A'),
(633, '633 - BANCO REDIMENTO S.A'),
(634, '634 - BANCO TRIANGULO S.A'),
(635, '635 - BANCO DO ESTADO DO AMAPA S.A'),
(637, '637 - BANCO SOFISA S.A'),
(638, '638 - BANCO PROSPER S.A'),
(639, '639 - BIG S.A. - BANCO IRMAOS GUIMARAES'),
(640, '640 - BANCO DE CREDITO METROPOLITANO S.A'),
(641, '641 - BANCO EXCEL ECONOMICO S/A'),
(643, '643 - BANCO SEGMENTO S.A'),
(645, '645 - BANCO DO ESTADO DE RORAIMA S.A'),
(647, '647 - BANCO MARKA S.A'),
(648, '648 - BANCO ATLANTIS S.A'),
(649, '649 - BANCO DIMENSAO S.A'),
(650, '650 - BANCO PEBB S.A'),
(652, '652 - BANCO FRANCES E BRASILEIRO SA'),
(653, '653 - BANCO INDUSVAL S.A'),
(654, '654 - BANCO A. J. RENNER S.A'),
(655, '655 - BANCO VOTORANTIM S.A.'),
(656, '656 - BANCO MATRIX S.A'),
(657, '657 - BANCO TECNICORP S.A'),
(658, '658 - BANCO PORTO REAL S.A'),
(702, '702 - BANCO SANTOS S.A'),
(705, '705 - BANCO INVESTCORP S.A.'),
(707, '707 - BANCO DAYCOVAL S.A'),
(711, '711 - BANCO VETOR S.A.'),
(713, '713 - BANCO CINDAM S.A'),
(715, '715 - BANCO VEGA S.A'),
(718, '718 - BANCO OPERADOR S.A'),
(719, '719 - BANCO PRIMUS S.A'),
(720, '720 - BANCO MAXINVEST S.A'),
(721, '721 - BANCO CREDIBEL S.A'),
(722, '722 - BANCO INTERIOR DE SAO PAULO S.A'),
(724, '724 - BANCO PORTO SEGURO S.A'),
(725, '725 - BANCO FINABANCO S.A'),
(726, '726 - BANCO UNIVERSAL S.A'),
(728, '728 - BANCO FITAL S.A'),
(729, '729 - BANCO FONTE S.A'),
(730, '730 - BANCO COMERCIAL PARAGUAYO S.A'),
(731, '731 - BANCO GNPP S.A.'),
(732, '732 - BANCO PREMIER S.A.'),
(733, '733 - BANCO NACOES S.A.'),
(734, '734 - BANCO GERDAU S.A'),
(735, '735 - BACO POTENCIAL'),
(736, '736 - BANCO UNITED S.A'),
(737, '737 - THECA'),
(738, '738 - MARADA'),
(739, '739 - BGN'),
(740, '740 - BCN BARCLAYS'),
(741, '741 - BRP'),
(742, '742 - EQUATORIAL'),
(743, '743 - BANCO EMBLEMA S.A'),
(744, '744 - THE FIRST NATIONAL BANK OF BOSTON'),
(745, '745 - CITIBAN N.A.'),
(746, '746 - MODAL SA'),
(747, '747 - RAIBOBANK DO BRASIL'),
(748, '748 - SICREDI'),
(749, '749 - BRMSANTIL SA'),
(750, '750 - BANCO REPUBLIC NATIONAL OF NEW YORK (BRA'),
(751, '751 - DRESDNER BANK LATEINAMERIKA-BRASIL S/A'),
(752, '752 - BANCO BANQUE NATIONALE DE PARIS BRASIL S'),
(753, '753 - BANCO COMERCIAL URUGUAI S.A.'),
(755, '755 - BANCO MERRILL LYNCH S.A'),
(756, '756 - BANCO COOPERATIVO DO BRASIL S.A.'),
(757, '757 - BANCO KEB DO BRASIL S.A.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria_id`, `nome`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Teste', NULL, NULL),
(2, NULL, 'Desenvolvimento Pessoal', '2018-07-23 22:30:49', '2018-07-23 22:30:49'),
(3, 2, 'Liderança', '2018-07-23 22:31:30', '2018-07-23 22:31:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `aluno_id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `aluno_id`, `curso_id`, `data`, `comentario`, `rating`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2018-07-20', 'oi', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comissoes`
--

CREATE TABLE `comissoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `valor` decimal(11,2) NOT NULL,
  `data` date NOT NULL,
  `rand_log` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instrutor_id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `duracao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(11,2) DEFAULT NULL,
  `nivel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `aprovado` int(11) DEFAULT NULL,
  `comissao` decimal(11,2) DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_vimeo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `descricao`, `imagem`, `instrutor_id`, `categoria_id`, `duracao`, `valor`, `nivel`, `stars`, `aprovado`, `comissao`, `video`, `album_vimeo`, `created_at`, `updated_at`) VALUES
(1, 'curso teste', 'O QUE É MAPA DO SUCESSO ONLINE?\r\n\r\nO Mapa do Sucesso Online é um treinamento em vídeos 100% online, você estuda de onde e quando quiser, vídeos em alta qualidade, aulas curtas e práticas, além das aulas você recebe uma ferramenta prática de construção de negócios.\r\n\r\nDurante o treinamento você vai encontrar sua arte, definir sua missão de vida e transformar isso em um negócio sólido e escalável, em um produto ou serviço que venha transformar a vida das pessoas, você vai aprender como transformar seus conhecimentos ou de outra pessoa em dinheiro.', NULL, 3, 1, NULL, '0.00', 'Iniciante', 3, NULL, '0.00', '280993840', '5305778', '2018-07-20 19:36:48', '2018-07-25 21:34:29'),
(2, 'Mapa Do Sucesso Online', 'Teste', '955ea1def790a85ad72b25c081f17709.jpg', 7, 1, NULL, '0.00', 'Iniciante', NULL, NULL, '0.00', '281011776', '5306010', '2018-07-20 21:50:25', '2018-07-25 21:34:35'),
(3, 'curso teste 2', 'gsdadsa', 'c82e6f217e3d915c09882bf680680e4f.jpg', 3, 1, NULL, '2.00', 'Iniciante', NULL, NULL, '0.00', '281008420', '5306014', '2018-07-20 21:51:21', '2018-07-20 21:53:03'),
(4, 'curso 231', 'dsa', '2e4702d14b5cdd282609fd5b7a2492ba.png', 3, 1, NULL, '21.00', 'Iniciante', NULL, 1, '0.00', '281258280', '5306026', '2018-07-20 21:57:56', '2018-07-24 17:04:46'),
(5, 'Novo Curso', 'oi', '3461fc8ab48ceef47fdea6acd9e5560d.jpg', 8, 1, NULL, '0.00', 'Iniciante', NULL, NULL, '0.00', '281283885', '5309307', '2018-07-23 15:14:28', '2018-07-25 21:34:39'),
(6, 'Altoliderança Positiva', 'O programa de Autoliderança Positiva é composto por 10 aulas, um passo a passo para você construir a sua altoliderança positiva e ser protagonista da sua história. O programa é 100% online e ministrado por Caterine Castro que é Master Coach Senior, a maior titulação internacional em coaching. O programa faz parte dos cursos da Tinele, uma plataforma de ensino aprendizagem e ganhos compartilhados.', '4318ef188e268822b32baf37dc43e32f.jpg', 11, 3, NULL, '0.00', 'Médio', 5, 1, '0.00', '281352474', '5310160', '2018-07-23 22:26:35', '2018-07-24 17:04:05'),
(7, 'blabla', 'dsa', NULL, 3, 1, NULL, '100.00', 'Iniciante', NULL, NULL, '1.00', NULL, '5311889', '2018-07-24 16:53:15', '2018-07-24 16:53:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email_marketing`
--

CREATE TABLE `email_marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `aula_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `email_marketing`
--

INSERT INTO `email_marketing` (`id`, `aula_id`, `data`, `email`, `created_at`, `updated_at`) VALUES
(1, 2, '2018-07-20', 'alcionildofontinele@gmail.com', NULL, NULL),
(2, 3, '2018-07-20', 'alcionildofontinele@gmail.com', NULL, NULL),
(3, 3, '2018-07-20', 'alcionildofontinele@gmail.com', NULL, NULL),
(4, 4, '2018-07-23', 'alcionildofontinele@gmail.com', NULL, NULL),
(5, 0, '2018-07-26', 'freire.joe@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(10) UNSIGNED NOT NULL,
  `aula_id` int(11) NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `aula_id`, `descricao`, `nome`, `created_at`, `updated_at`) VALUES
(1, 4, '01', '57ee8456d1ffe3315103128063fe4c58.pdf', '2018-07-23 16:05:14', '2018-07-23 16:05:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(10) UNSIGNED NOT NULL,
  `de` int(10) UNSIGNED NOT NULL,
  `para` int(10) UNSIGNED NOT NULL,
  `texto` longtext COLLATE utf8mb4_unicode_ci,
  `visualizado` tinyint(4) DEFAULT NULL,
  `data` datetime NOT NULL,
  `rand_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `de`, `para`, `texto`, `visualizado`, `data`, `rand_log`, `created_at`, `updated_at`) VALUES
(1, 16, 3, 'ola teste', 0, '2018-07-25 19:32:25', '20180725073225310142ae8c103aba8d24a0b366451222', '2018-07-25 19:32:25', '2018-07-25 19:32:25'),
(2, 3, 16, 'testando resposta', 0, '2018-07-26 00:38:34', '20180725073225310142ae8c103aba8d24a0b366451222', '2018-07-26 00:38:34', '2018-07-26 00:38:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_07_18_000000_create_categorias_table', 1),
(3, '2018_07_18_000002_create_password_resets_table', 2),
(4, '2018_07_18_000003_create_aulas_table', 2),
(5, '2018_07_18_000004_create_cursos_table', 2),
(7, '2018_07_18_000008_create_acessos_table', 2),
(8, '2018_07_18_000009_create_mensagens_table', 2),
(9, '2018_07_18_000010_create_materiais_table', 2),
(10, '2018_07_18_000011_create_vendas_table', 2),
(11, '2018_07_18_000012_create_users_cursos_table', 2),
(12, '2018_07_18_000013_create_notificacoes_table', 2),
(13, '2018_07_18_000014_create_comissoes_table', 2),
(16, '2018_07_18_000017_create_email_marketing_table', 3),
(17, '2018_07_18_000018_create_users_aulas_table', 3),
(18, '2018_07_18_000019_create_questoes_table', 3),
(19, '2018_07_18_000020_create_comentarios_table', 3),
(20, '2018_07_18_000021_create_alternativas_table', 3),
(21, '2018_07_18_000022_create_vendas_produtos_table', 3),
(22, '2018_07_19_121400_create_shoppingcart_table', 3),
(24, '2018_07_18_000001_create_users_table', 4),
(25, '2018_07_18_000005_create_modulos_table', 5),
(26, '2018_07_18_000016_create_modulos_cursos_table', 6),
(27, '2018_07_18_000015_create_anotacoes_table', 7),
(28, '2018_07_25_121455_create_jobs_table', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos_cursos`
--

CREATE TABLE `modulos_cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `modulos_cursos`
--

INSERT INTO `modulos_cursos` (`id`, `curso_id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 3, 're', 'x', '2018-07-20 21:56:31', '2018-07-20 21:56:31'),
(2, 2, 'MindSet', NULL, '2018-07-20 22:00:10', '2018-07-20 22:00:10'),
(3, 5, 'MindSet Vencedor', 'Configurando sua mente para o sucesso online.', '2018-07-23 15:18:26', '2018-07-23 15:18:26'),
(4, 6, 'Altoliderança Positiva', NULL, '2018-07-23 22:33:32', '2018-07-23 22:33:32'),
(5, 4, 'teste', '333333333333333333333333333', '2018-07-25 18:41:24', '2018-07-25 18:41:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `para` int(10) UNSIGNED NOT NULL,
  `evento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visualizado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(11) NOT NULL,
  `enunciado` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id`, `curso_id`, `enunciado`, `ordem`, `created_at`, `updated_at`) VALUES
(1, 5, 'Qual a capital do Acre?', 1, '2018-07-23 15:20:17', '2018-07-23 15:20:17'),
(2, 4, 'Teste', 1, '2018-07-25 18:56:55', '2018-07-25 18:56:55'),
(3, 4, 'dsadsa', 2, '2018-07-25 19:00:43', '2018-07-25 19:00:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_nascimento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `acesso_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `capa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankNumber` int(11) DEFAULT NULL,
  `agencyNumber` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agencyCheckNumber` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountNumber` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountCheckNumber` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `cpf`, `dt_nascimento`, `telefone`, `endereco`, `latitude`, `longitude`, `foto`, `observacoes`, `acesso_id`, `token`, `tipo`, `capa`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado`, `bankNumber`, `agencyNumber`, `agencyCheckNumber`, `accountNumber`, `accountCheckNumber`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$.c8WwXCutYQrGgnkC/Adw.KcsopaKJJSJBoqKVu6r7lzdA8q7ZiIq', 'G6h8LOv1fcVYpkaNLRKfkw3xw3prvpxBKUoYggyT6pX2hq1TIC3vZu2XbsQe', '075.112.396-09', '15/08/1989', '(31) 99621-4702', 'Rua Igino Bonfioli', NULL, NULL, '6f8b455a13a6bec515d8427e7d1bf008.jpg', 'teste\r\nde\r\nquebra', 1, '68b3bd14-9276-481a-92d8-3716d711df6b', 0, NULL, '175', NULL, 'Jaraguá', '31270-460', 'Belo Horizonte', 'MG', 0, '', '', '', '', NULL, '2018-07-23 17:30:36'),
(2, 'aluno', 'aluno@aluno.com', '$2y$10$yCxa78YndgQpsKSkU5IC5OXQg5JEdjpqa8RQa9oA5KKYEXgphrnoy', 'nFQI39wrnKOpE5Z1hcbqpYeae2RjnMiDi6koSoFeZUlMaEnp3LspmXApCRw4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-20 19:34:00', '2018-07-20 19:34:00'),
(3, 'Guilherme Augusto de Oliveira Freire', 'freire.joe@gmail.com', '$2y$10$EFL8LCn2FNmkpwTkqtjxleuQ28PODaGk3vO2NCq4fIZufCY0gDfwK', 'ETgKHlj9PXUDD1Hkn13SwjpbTFU3G7w1QMLyDfMmWaHwS0rTlmdQnMLeTBDj', '07511239609', NULL, '31996214702', NULL, NULL, NULL, NULL, 'testando', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, '15505', '3', '', '1', '2018-07-20 19:36:20', '2018-07-26 17:32:07'),
(4, 'Guilherme Augusto de Oliveira Freire', 'aluno@teste.com', '$2y$10$6iszTdBRKSt3KGYx9gne1uaaXxumm7oZWYamc6e/DhZgUKorbU4SW', 'klApxiKewbaqXpDXK3EuObwTkM6sctrdzTKYopV62vqajcNmN4y8dHSK8Xj5', '075.112.396-09', '15/08/1989', '(31) 99621-4702', 'Rua Igino Bonfioli, 175, Jaragua', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Jaraguá', '31270-460', 'Belo Horizonte', 'MG', 0, '', '', '', '', '2018-07-20 20:48:11', '2018-07-24 13:01:26'),
(5, 'aluno2', 'aluno2@te.com', '$2y$10$/e9uCubiA3hkGaprrkgLe.zECOLqzfJPUDgPWALjL9A8BQ5JVJu8K', '8p9xe1PRwdlwZig08p5Y6F9mmojTecDDJ7AaQRMYrv5dQwWKqTKx2ugolBMP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-20 20:50:09', '2018-07-20 20:50:09'),
(6, 'Guilherme Freire', 'gfreire@ufmg.br', '$2y$10$rl7geIpKr1wRruZs0W9kOO4z/XTrQb7SHh.K3JZitinWaX0iC53yu', 'c0FaGHv6uvjSnxYfO1YDMQoQTSKNNxzNyZ4wNddieqx0u1dN89GdH0d2EzWU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-20 20:51:08', '2018-07-20 20:51:08'),
(7, 'Alcionildo Fontinele', 'atendimento@alcionildofontinele.com', '$2y$10$MyQ0bcAIwG8hi6QercWGP.YRP4qtSPv1W.sIfDB/7Ut0YvW2LU8TK', 'pbAlcTeTPmenwhvWvsiVpPBRevbwmnJbaqtW3rFrXH0S8cZm24poD8qxe2Iw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-20 21:21:30', '2018-07-20 21:21:30'),
(8, 'Alcionildo', 'alcionildofontinele@gmail.com', '$2y$10$pYzmAUJcYonncbY.dEjhJeiIalbyOdufTgTBPRK9jzq6MFRXso14O', 'bxZ8iU3MN2OvncXhHj3EMKHbo5os4u5KL8Y38gEA2pF6AtwxidXG8XjLm5Y8', '006.480.562-01', '12/07/1989', '(68) 99977-1474', 'Travessa Roraima', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '164', 'Galeria', 'Capoeira', '69910-060', 'Rio Branco', 'AC', 0, '', '', '', '', '2018-07-22 18:20:24', '2018-07-23 20:39:08'),
(9, 'Aluno2', 'aluno2@teste.com', '$2y$10$MiKVrEkwPO4H8beAssg1L.oHgb2KHkMREq7MoJy2nwAlEvESXrkxW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-23 19:38:35', '2018-07-23 19:38:35'),
(10, 'Alcionildo', 'redes@alcionildofontinele.com', '$2y$10$/iQb6QpgCqVu0M1.WFEhYuWq8VSwH7bTIWRIK4T1xbAOQLK/jEdJ2', 'bVpP1r0XrqzoSSukNrXlKXHKWVSPmDGPNp8LxbAQhYgceVAw0wxR9hjm2YDr', '006.480.562-01', '12/07/1989', '(68) 99977-1474', 'Travessa Roraima', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '164', NULL, 'Capoeira', '69910-060', 'Rio Branco', 'AC', 0, '', '', '', '', '2018-07-23 20:40:08', '2018-07-24 15:44:35'),
(11, 'Caterine Castro', 'caterinecastro.coach@gmail.com', '$2y$10$8t5FIyt7gEHfXfrcPQC1Au1zje5j22v10M4kZtkvM/3.4/BxgKFaK', 'bDWNiqtrDtT1MaWCHXZ0STfHRQ0Ib681NN5YsAqIhO7mjItHKikqif0HjWrb', NULL, NULL, NULL, NULL, NULL, NULL, 'e15215cc6b219e7c8291a5275935f15f.jpg', 'Master Coach Senior & Trainer do Instituto Brasileiro de Coaching - IBC e representante do IBC no Acre. Mestre em Direito, pós-graduada em gestão de pessoas com coaching e também em psicologia positiva e coaching. Tem, ainda, certificação internacional como terapeuta renascedora, técnica de respiração consciente (rebirthing) com Bob Mandel. Oferece treinamentos em coaching e palestras para o desenvolvimento humano e de liderança.', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '2018-07-23 21:36:05', '2018-07-25 21:28:31'),
(16, 'Guilherme Augusto de Oliveira Freire', 'freire.joe@gmail.com', '$2y$10$KHdxF2aiaRJXiiXesyTsJOF6GIZlmIqB5csZmIjd/4NFc.JBzI2Fq', '3e3a6ad79fa58b97500a75514492b80f', '075.112.396-09', '15/08/1989', '(31) 99621-4702', 'Rua Igino Bonfioli', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Jaraguá', '31270-460', 'Belo Horizonte', 'MG', 0, '', '', '', '', '2018-07-25 13:29:22', '2018-07-26 16:26:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_aulas`
--

CREATE TABLE `users_aulas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `aula_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_cursos`
--

CREATE TABLE `users_cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(11) NOT NULL,
  `andamento` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `data_nota` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - aberto, 1 - fechado, 2 - cancelado',
  `total` decimal(11,2) NOT NULL,
  `afiliado` int(11) DEFAULT NULL,
  `comissao` decimal(11,0) DEFAULT NULL,
  `meio_pagamento` text COLLATE utf8mb4_unicode_ci,
  `transacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_produtos`
--

CREATE TABLE `vendas_produtos` (
  `id` int(10) UNSIGNED NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rte` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alternativas`
--
ALTER TABLE `alternativas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comissoes`
--
ALTER TABLE `comissoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comissoes_users1_idx` (`users_id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_marketing`
--
ALTER TABLE `email_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos_cursos`
--
ALTER TABLE `modulos_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notificacoes_users1_idx` (`para`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `users_aulas`
--
ALTER TABLE `users_aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_cursos`
--
ALTER TABLE `users_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alternativas`
--
ALTER TABLE `alternativas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anotacoes`
--
ALTER TABLE `anotacoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comissoes`
--
ALTER TABLE `comissoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_marketing`
--
ALTER TABLE `email_marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modulos_cursos`
--
ALTER TABLE `modulos_cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_aulas`
--
ALTER TABLE `users_aulas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_cursos`
--
ALTER TABLE `users_cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendas_produtos`
--
ALTER TABLE `vendas_produtos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comissoes`
--
ALTER TABLE `comissoes`
  ADD CONSTRAINT `fk_comissoes_users1_idx` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `fk_notificacoes_users1_idx` FOREIGN KEY (`para`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
