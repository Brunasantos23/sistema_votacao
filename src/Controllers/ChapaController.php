<?php
// Lógica para cadastro e consulta de chapas

/**
 * Função para exibir o formulário de cadastro
 */
function exibir_formulario_chapa() {
    require_once __DIR__ . '/../Views/cadastro_chapa.php';
}

/**
 * Função para processar o cadastro de uma nova chapa
 */
function cadastrar_chapa() {
    $db = conectar_db();
    
    // Pega os dados do formulário
    $nome_chapa = $_POST['nome_chapa'] ?? null;
    $codigo_chapa = $_POST['codigo_chapa'] ?? null;
    $nome_lider = $_POST['nome_lider'] ?? null;
    $matricula_lider = $_POST['matricula_lider'] ?? null;
    $nome_vice = $_POST['nome_vice'] ?? null;
    $matricula_vice = $_POST['matricula_vice'] ?? null;

    // Validação simples
    if (!$nome_chapa || !$codigo_chapa || !$nome_lider || !$matricula_lider || !$nome_vice || !$matricula_vice) {
        $mensagem = "Todos os campos são obrigatórios!";
        $status = 'erro';
        require_once __DIR__ . '/../Views/cadastro_chapa.php';
        return;
    }
    
    // Prepara a query para evitar SQL Injection
    $stmt = $db->prepare("INSERT INTO chapas (nome_chapa, codigo_chapa, nome_lider, matricula_lider, nome_vice, matricula_vice) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome_chapa, $codigo_chapa, $nome_lider, $matricula_lider, $nome_vice, $matricula_vice);

    if ($stmt->execute()) {
        $mensagem = "Chapa cadastrada com sucesso!";
    } else {
        // Verifica se o erro é de código de chapa duplicado
        if ($db->errno == 1062) {
             $mensagem = "Erro: O código da chapa '" . $codigo_chapa . "' já existe.";
        } else {
             $mensagem = "Erro ao cadastrar a chapa: " . $stmt->error;
        }
        $status = 'erro';
    }
    
    $stmt->close();
    $db->close();
    
    // Recarrega a página de cadastro para mostrar a mensagem
    require_once __DIR__ . '/../Views/cadastro_chapa.php';
}

/**
 * Função para consultar e exibir todas as chapas
 */
function consultar_chapas() {
    $db = conectar_db();
    
    $sql = "SELECT * FROM chapas ORDER BY codigo_chapa ASC";
    $resultado = $db->query($sql);
    
    $chapas = [];
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $chapas[] = $linha;
        }
    }
    
    $db->close();
    
    // Chama a view para exibir os dados
    require_once __DIR__ . '/../Views/consulta_chapa.php';
}
?>