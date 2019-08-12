/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

create database adscom;
use adscom;

CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `RA` varchar(13) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `ciclo` varchar(10) NOT NULL,
  `periodo` varchar(5) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `niveis_acesso_id` int(2) NOT NULL,
  `nivel_especial` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `alunos` (`nome`,`email`,`RA`,`celular`,`ciclo`,`periodo`,`senha`,`niveis_acesso_id`,`nivel_especial`) VALUES
( 'adm', 'adm@hotmail.com','1234567890123','123456789','ADS 2','Manha', '202cb962ac59075b964b07152d234b70',1,1),
( 'lucas', 'lucas@hotmail.com','1234567890123','987654321','ADS 2','Manha',  '202cb962ac59075b964b07152d234b70',2,0);

CREATE TABLE IF NOT EXISTS `recados` (
  `id_recado` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL ,
  `recado` text NOT NULL,
  `classificacao` int (2) NOT NULL,
  `urgente` int(2)  NOT NULL,
  `data_` date  NOT NULL,
  `analise_adm` int(2)  NOT NULL,
  PRIMARY KEY (`id_recado`),
  foreign key(id_aluno) references alunos(id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

ALTER TABLE `recados` ADD `titulo` varchar(70);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
