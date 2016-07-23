


<html>
<head>
  <meta content="text/html; charset=windows-1252" http-equiv="content-type"><title></title>
  <meta name="generator">
</head>

<body style="direction: ltr;" lang="pt-BR" link="#0563c1">
<div class="col-md-offset-1 col-md-10">
<h1>PHP API-TODO - A REST API for PHP TODOs
</h1>

<br>

<h2>Script do Banco - MySQL</h2>
<code><pre>
CREATE DATABASE  IF NOT EXISTS `todo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `todo`;
</pre>
</code>
<code>
<pre>
CREATE TABLE `tasks` (
  `uuid` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('shopping','work') DEFAULT NULL,
  `content` varchar(245) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT '0',
  `done` enum('true','false') DEFAULT 'false',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uuid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
</pre>
</code>

<h2>URI's</h2>
<table class="table" style="page-break-before: auto; page-break-after: auto; page-break-inside: auto; width: 100%;">

<tbody>   
<tr>
  <th>URI</th>
  <th>Tipo</th>
  <th>Descrição</th>
</tr>

<tr>
  <td>
    /
  </td>
  <td>
    GET
  </td>
  <td>
    Retorna todas as tasks
  </td>  
</tr>

<tr>
  <td>
    /tasks/{id}
  </td>
  <td>
    GET
  </td>
  <td>
    Retorna os detalhes da task por id
  </td>  
</tr>
</tbody>
</table>
</div>
</html>
