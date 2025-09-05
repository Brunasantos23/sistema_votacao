<?php

define('DB_HOST', 'localhost');   
define('DB_NAME', 'eleicao_turma'); 
define('DB_USER', 'root');         
define('DB_PASS', '');            

/**
 * Função para conectar ao banco de dados MySQL
 * @return mysqli|false
 */
function conectar_db() {
    $conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    
    if ($conexao->connect_error) {
        
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }
    
   
    $conexao->set_charset("utf8mb4");

    return $conexao;
}
?>