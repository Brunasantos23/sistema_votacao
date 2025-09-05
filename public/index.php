<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Controllers/ChapaController.php';
require_once __DIR__ . '/../src/Controllers/VotacaoController.php';


$page = $_GET['page'] ?? 'home';    
$action = $_GET['action'] ?? null; 


if ($action) {
    switch ($action) {
        case 'cadastrar_chapa':
            cadastrar_chapa();
            break;
        case 'votar':
            registrar_voto();
            break;
       
    }
} else {
   
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