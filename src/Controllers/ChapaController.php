<?php

function exibir_formulario_chapa() {
    require_once __DIR__ . '/../Views/cadastro_chapa.php';
}


function cadastrar_chapa() {
    $db = conectar_db();
    
    
    $nome_chapa = $_POST['nome_chapa'] ?? null;
    $codigo_chapa = $_POST['codigo_chapa'] ?? null;
    $nome_lider = $_POST['nome_lider'] ?? null;
    $matricula_lider = $_POST['matricula_lider'] ?? null;
    $nome_vice = $_POST['nome_vice'] ?? null;
    $matricula_vice = $_POST['matricula_vice'] ?? null;

   
    if (!$nome_chapa || !$codigo_chapa || !$nome_lider || !$matricula_lider || !$nome_vice || !$matricula_vice) {
        $mensagem = "Todos os campos são obrigatórios!";
        $status = 'erro';
        require_once __DIR__ . '/../Views/cadastro_chapa.php';
        return;
    }
    
    
    $stmt = $db->prepare("INSERT INTO chapas (nome_chapa, codigo_chapa, nome_lider, matricula_lider, nome_vice, matricula_vice) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome_chapa, $codigo_chapa, $nome_lider, $matricula_lider, $nome_vice, $matricula_vice);

    if ($stmt->execute()) {
        $mensagem = "Chapa cadastrada com sucesso!";
    } else {
       
        if ($db->errno == 1062) {
             $mensagem = "Erro: O código da chapa '" . $codigo_chapa . "' já existe.";
        } else {
             $mensagem = "Erro ao cadastrar a chapa: " . $stmt->error;
        }
        $status = 'erro';
    }
    
    $stmt->close();
    $db->close();
    
   
    require_once __DIR__ . '/../Views/cadastro_chapa.php';
}


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
    
   
    require_once __DIR__ . '/../Views/consulta_chapa.php';
}



function exibir_formulario_edicao() {
    $db = conectar_db();
    
   
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
       
        header("Location: index.php?page=consulta_chapa");
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM chapas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    
    $chapa = $resultado->fetch_assoc();

    $stmt->close();
    $db->close();

    
    require_once __DIR__ . '/../Views/editar_chapa.php';
}

/**
 * Função para processar a atualização de uma chapa no banco de dados
 */
function atualizar_chapa() {
    $db = conectar_db();

    
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome_chapa = $_POST['nome_chapa'] ?? null;
    $codigo_chapa = $_POST['codigo_chapa'] ?? null;
    $nome_lider = $_POST['nome_lider'] ?? null;
    $matricula_lider = $_POST['matricula_lider'] ?? null;
    $nome_vice = $_POST['nome_vice'] ?? null;
    $matricula_vice = $_POST['matricula_vice'] ?? null;
    
    
    if (!$id || !$nome_chapa || !$codigo_chapa || !$nome_lider || !$matricula_lider || !$nome_vice || !$matricula_vice) {
       
        $mensagem = "Todos os campos são obrigatórios!";
       
        $stmt = $db->prepare("SELECT * FROM chapas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $chapa = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        require_once __DIR__ . '/../Views/editar_chapa.php';
        return;
    }

    
    $stmt = $db->prepare("UPDATE chapas SET nome_chapa = ?, codigo_chapa = ?, nome_lider = ?, matricula_lider = ?, nome_vice = ?, matricula_vice = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $nome_chapa, $codigo_chapa, $nome_lider, $matricula_lider, $nome_vice, $matricula_vice, $id);

    if ($stmt->execute()) {
        
        $_SESSION['mensagem'] = "Chapa atualizada com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar a chapa: " . $stmt->error;
    }
    
    $stmt->close();
    $db->close();

    
    header("Location: index.php?page=consulta_chapa");
    exit();
}

?>
