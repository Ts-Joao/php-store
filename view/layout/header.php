<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pageTitle = $pageTitle ?? 'Sistema de Produtos';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | Estoque PHP</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }
    </style>
</head>
<body>

<!-- Barra de Navegação -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php?action=home">
            <i class="bi bi-box-seam text-primary"></i>
            <span>Estoque PHP</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (!isset($_GET['action']) || $_GET['action'] === 'home') ? 'active fw-semibold' : '' ?>" href="index.php?action=home">
                        <i class="bi bi-house-door"></i> Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'list') ? 'active fw-semibold' : '' ?>" href="index.php?action=list">
                        <i class="bi bi-card-list"></i> Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'create') ? 'active fw-semibold' : '' ?>" href="index.php?action=create">
                        <i class="bi bi-plus-circle"></i> Novo Produto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['action']) && $_GET['action'] === 'history') ? 'active fw-semibold' : '' ?>" href="index.php?action=history">
                        <i class="bi bi-clock-history"></i> Histórico (Trigger)
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="index.php?action=create" class="btn btn-primary btn-sm d-flex align-items-center gap-1 shadow-sm">
                    <i class="bi bi-plus-lg"></i>
                    <span>Cadastrar</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Conteúdo Principal -->
<main class="container py-4">

    <!-- Mensagens de Feedback Flash -->
    <?php if (!empty($_SESSION['msg'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['msg_tipo'] ?? 'info') ?> alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <?= htmlspecialchars($_SESSION['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        <?php unset($_SESSION['msg'], $_SESSION['msg_tipo']); ?>
    <?php endif; ?>

