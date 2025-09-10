<?php

function exibir_votacao() {
    $db = conectar_db();
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula_aluno'])) {
        $matricula_aluno = $_POST['matricula_aluno'];

        
        if (empty($matricula_aluno)) {
            $mensagem = "Por favor, informe sua matrícula.";
            $status = 'erro';
            $erro_matricula = true; // Flag para mostrar o formulário de matrícula novamente
            require_once __DIR__ . '/../Views/votacao.php';
            return;
        }

        
        $stmt_check = $db->prepare("SELECT matricula_aluno FROM alunos_votantes WHERE matricula_aluno = ?");
        $stmt_check->bind_param("s", $matricula_aluno);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $mensagem = "A matrícula " . htmlspecialchars($matricula_aluno) . " já registrou um voto. Não é permitido votar mais de uma vez.";
            $status = 'erro';
            $erro_matricula = true;
        } else {
            
            $resultado = $db->query("SELECT id, codigo_chapa, nome_chapa, nome_lider, nome_vice FROM chapas ORDER BY codigo_chapa ASC");
            $chapas = $resultado->fetch_all(MYSQLI_ASSOC);

            if (empty($chapas)) {
                $mensagem = "Nenhuma chapa cadastrada para votação no momento.";
                $status = 'erro';
                $erro_matricula = true;
            }
        }
        $stmt_check->close();
    }
    
    $db->close();
    require_once __DIR__ . '/../Views/votacao.php';
}


function registrar_voto() {
    $db = conectar_db();

    $matricula_aluno = $_POST['matricula_aluno'] ?? null;
    $chapa_id = $_POST['chapa_id'] ?? null;

    // Validação
    if (!$matricula_aluno || !$chapa_id) {
        $mensagem = "Ocorreu um erro. Matrícula ou chapa não informada.";
        $status = 'erro';
        require_once __DIR__ . '/../Views/votacao.php';
        return;
    }

    // Transação para garantir consistência: ou salva nas duas tabelas ou em nenhuma
    $db->begin_transaction();

    try {
        // --- LÓGICA ATUALIZADA ---

        // 1. PRIMEIRO, insere o aluno na tabela de votantes para garantir que ele não vote de novo.
        $stmt_aluno = $db->prepare("INSERT INTO alunos_votantes (matricula_aluno) VALUES (?)");
        $stmt_aluno->bind_param("s", $matricula_aluno);
        $stmt_aluno->execute();
        
        // 2. PEGA O ID do aluno que acabou de ser inserido.
        $aluno_id = $db->insert_id;
        
        // 3. SEGUNDO, insere o voto na tabela de votos, usando o ID do aluno e o ID da chapa.
        $stmt_voto = $db->prepare("INSERT INTO votos (chapa_id, aluno_votante_id) VALUES (?, ?)");
        $stmt_voto->bind_param("ii", $chapa_id, $aluno_id);
        $stmt_voto->execute();

        // Se tudo deu certo, confirma a transação
        $db->commit();
        $mensagem = "Voto registrado com sucesso! Obrigado por participar.";
        $status = 'sucesso';

    } catch (mysqli_sql_exception $exception) {
        $db->rollback(); // Desfaz a transação em caso de erro

        // Verifica se o erro é de matrícula duplicada
        if ($db->errno == 1062) {
             $mensagem = "Erro: A matrícula '" . htmlspecialchars($matricula_aluno) . "' já registrou um voto.";
        } else {
             $mensagem = "Erro ao registrar o voto: " . $exception->getMessage();
        }
        $status = 'erro';
    }
    
    $db->close();
    require_once __DIR__ . '/../Views/votacao.php';
}


function exibir_relatorio() {
    $db = conectar_db();

    $sql = "SELECT 
                c.nome_chapa, 
                c.codigo_chapa, 
                COUNT(v.id) as qtd_votos
            FROM 
                chapas c
            LEFT JOIN 
                votos v ON c.id = v.chapa_id
            GROUP BY 
                c.id, c.nome_chapa, c.codigo_chapa
            ORDER BY 
                qtd_votos DESC";

    $resultado = $db->query($sql);
    $relatorio = $resultado->fetch_all(MYSQLI_ASSOC);
    

    $total_votos = 0;
    foreach ($relatorio as $item) {
        $total_votos += $item['qtd_votos'];
    }

    $db->close();
    require_once __DIR__ . '/../Views/relatorio_votacao.php';
}
?>