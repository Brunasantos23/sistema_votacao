<?php
// Arquivo de configuração do banco de dados

define('DB_HOST', 'localhost');    // Endereço do servidor MySQL
define('DB_NAME', 'eleicao_turma'); // Nome do banco de dados que você criou
define('DB_USER', 'root');         // Usuário do MySQL (padrão do XAMPP é 'root')
define('DB_PASS', '');             // Senha do MySQL (padrão do XAMPP é em branco)

/**
 * Função para conectar ao banco de dados MySQL
 * @return mysqli|false
 */
function conectar_db() {
    $conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Checa a conexão
    if ($conexao->connect_error) {
        // Em um sistema real, logaríamos o erro em vez de exibi-lo.
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }
    
    // Garante que os dados sejam transacionados em UTF-8
    $conexao->set_charset("utf8mb4");

    return $conexao;
}
?>