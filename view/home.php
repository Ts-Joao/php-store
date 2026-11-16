<?php
$pageTitle = 'Página Inicial';
require_once __DIR__ . '/layout/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Hero Section -->
        <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
            <div class="container-fluid py-2">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="badge bg-primary fs-6 px-3 py-2">
                        <i class="bi bi-shield-check me-1"></i> Trigger MySQL Ativa
                    </span>
                    <span class="badge bg-secondary fs-6 px-3 py-2">
                        <i class="bi bi-database me-1"></i> PHP + PDO
                    </span>
                </div>
                <h1 class="display-6 fw-bold text-dark">Gestão de Produtos & Auditoria</h1>
                <p class="col-md-10 fs-5 text-muted">
                    Sistema completo para cadastro, consulta, alteração e exclusão de produtos em banco de dados MySQL via PDO. 
                    Todas as alterações de dados disparam automaticamente uma <strong>Trigger</strong> para gravação de histórico.
                </p>
                <div class="d-flex flex-wrap gap-2 pt-2">
                    <a href="index.php?action=list" class="btn btn-primary btn-lg px-4 gap-3">
                        <i class="bi bi-box-seam me-2"></i>Ver Lista de Produtos
                    </a>
                    <a href="index.php?action=create" class="btn btn-outline-success btn-lg px-4">
                        <i class="bi bi-plus-circle me-2"></i>Cadastrar Novo
                    </a>
                    <a href="index.php?action=history" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-clock-history me-2"></i>Histórico da Trigger
                    </a>
                </div>
            </div>
        </div>

        <!-- Cards de Acesso Rápido -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10 rounded-3 p-3 mb-3">
                            <i class="bi bi-boxes fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Consulta & Estoque</h5>
                        <p class="card-text text-muted small">
                            Consulte a lista de produtos, visualize a descrição, o preço unitário e o status do estoque.
                        </p>
                        <a href="index.php?action=list" class="btn btn-sm btn-outline-primary">Acessar Produtos &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center text-success bg-success bg-opacity-10 rounded-3 p-3 mb-3">
                            <i class="bi bi-pencil-square fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Cadastro & Edição</h5>
                        <p class="card-text text-muted small">
                            Formulários com validação para inserir ou editar dados cadastrais de produtos com segurança.
                        </p>
                        <a href="index.php?action=create" class="btn btn-sm btn-outline-success">Novo Cadastro &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center text-secondary bg-secondary bg-opacity-10 rounded-3 p-3 mb-3">
                            <i class="bi bi-lightning-charge fs-3"></i>
                        </div>
                        <h5 class="card-title fw-bold">Trigger Automática</h5>
                        <p class="card-text text-muted small">
                            Acompanhe a tabela <code>historico_alteracoes</code> gerada automaticamente pelo MySQL a cada <code>UPDATE</code>.
                        </p>
                        <a href="index.php?action=history" class="btn btn-sm btn-outline-secondary">Ver Auditoria &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

