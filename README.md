# Teste desenvolvedor 3 ZUP
Autor Filipe A. Ribeiro

#Banco de dados

crie a seguinte tabela

DROP TABLE IF EXISTS `modelos`;
CREATE TABLE `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `price` double(8,2) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


Configuração do banco de dados

src/settings.php

Altere as informações de DB
"db" => [
            "host" => "localhost",
            "dbname" => "zup",
            "user" => "root",
            "pass" => ""
        ],