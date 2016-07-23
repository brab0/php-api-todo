


<html>
<head>
  <meta content="text/html; charset=windows-1252" http-equiv="content-type"><title></title>
  <meta name="generator">
</head>

<body style="direction: ltr;" lang="pt-BR" link="#0563c1">
<div class="col-md-offset-1 col-md-10">
<h1>PHP API-TODO - A REST API for PHP TODOs
</h1>
<br />
<h2>Install</h2>
<code># php composer install</code>
<br />
<code># php -S 0.0.0.0:8080 -t tasks tasks/index.php</code>
<br />
<p>Run on Browser http://0.0.0.0:8080/tasks</p>
<br />
<p>Edit Database setting in the Connection.php file</p>
<h3>Script MySQL</h3>
<pre>
<code>
CREATE DATABASE  IF NOT EXISTS `todo`
USE `todo`;

CREATE TABLE `tasks` (
  `uuid` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('shopping','work') DEFAULT NULL,
  `content` varchar(245) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT '0',
  `done` enum('true','false') DEFAULT 'false',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uuid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
</code>
</pre>

<br>
<h2>Object Model</h2>
<pre>
<code>
{
  "uuid": "",
  "type": "",
  "content": "",
  "sort_order" : 0,
  "done" : true|false,
  "date_created": ""
}
</code>
</pre>
<br />

<h3>Testing with PHPUnit</h3>
<p>On Terminal:</p>
<pre>
<code>
# php vendor/bin/phpunit --verbose tasks/ControllerTest
</code>
</pre>
<br />
<h2>URI's</h2>
<table class="table" style="page-break-before: auto; page-break-after: auto; page-break-inside: auto; width: 100%;">
<tbody>   
<tr>
  <th>URI</th>
  <th>Tipo</th>
  <th>Descrição</th>
</tr>
<tr>
  <td>/</td>
  <td>GET</td>
  <td>Retorna todas as tasks</td>  
</tr>
<tr>
  <td>/tasks/{id}</td>
  <td>GET</td>
  <td>Retorna os detalhes da task por id</td>  
</tr>
<tr>
  <td>/tasks/</td>
  <td>POST</td>
  <td>Insere no banco mediante ao modelo do objeto passado como parâmetro no formato json</td>  
</tr>
<tr>
  <td>/tasks/</td>
  <td>DELETE</td>
  <td>Deleta do banco mediante ao objeto: {"uuid": number}</td>  
</tr>
<tr>
  <td>/tasks/</td>
  <td>PUT</td>
  <td>Atualiza o registro no banco mediante ao modelo do objeto passado como parâmetro no formato json</td>  
</tr>
</tbody>
</table>
</div>
</html>
