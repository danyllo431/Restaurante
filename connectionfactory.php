<?php 
	$db = @mysql_connect("localhost","root","") or die("Não foi possível connectar com o servidor de dados!");
	$dados = mysql_select_db("Temp", $db) or die ("Banco de dado não localizado!");
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
?>