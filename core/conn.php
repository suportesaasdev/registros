<?php 
$usuario = 'resielg_gleiser'; // Usuario do MYSQL
$senha = 'Nicol@s123'; // Senha do MYSQL
$database = 'resielg_registros'; // Nome do database criado
$conn = @mysql_connect('127.0.0.1',$usuario,$senha); // Cria a variavel que vai fazer a conexão
if (!$conn) { // Tenta conectar, caso de algum erro executa a ação abaixo mostrando qual erro
    die('Não foi possível Conectar: ' . mysql_error());
}
mysql_select_db($database, $conn);
/* Esses arquivos agora definem que tudo a ser passado para o banco de dados é UTF8*/
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>