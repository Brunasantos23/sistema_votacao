<?php
// Ponto de Entrada (Front Controller)

// 1. Inclui os arquivos necessários
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Controllers/ChapaController.php';
require_once __DIR__ . '/../src/Controllers/VotacaoController.php';

// 2. Define a página e a ação a serem executadas
$page = $_GET['page'] ?? 'home';     // Página a ser exibida
$action = $_GET['action'] ?? null; // Ação a ser executada (ex: um POST de formulário)

// 3. Roteamento de ações (normalmente de formulários POST)
if ($action) {
    switch ($action) {
        case 'cadastrar_chapa':
            cadastrar_chapa();
            break;
        case 'votar':
            registrar_voto();
            break;
        // Adicionar outras ações aqui se necessário
    }
} else {
    // 4. Roteamento de páginas (visualização)
    switch ($page) {
        case 'cadastro_chapa':
            exibir_formulario_chapa();
            break;
        case 'consulta_chapa':
            consultar_chapas();
            break;
        case 'votacao':
            exibir_votacao();
            break;
        case 'relatorio_votacao':
            exibir_relatorio();
            break;
        case 'home':
        default:
            include __DIR__ . '/../src/Views/home.php';
            break;
    }
}
?>