<?php
$pageTitle = 'Editar Produto';
require_once __DIR__ . '/layout/header.php';

$id         = $product['id'] ?? $_GET['id'] ?? '';
$nome       = $product['nome'] ?? $product['name'] ?? '';
$descricao  = $product['descricao'] ?? $product['description'] ?? '';
$preco      = $product['preco'] ?? $product['price'] ?? 0;
$quantidade = $product['quantidade'] ?? $product['amount'] ?? 0;
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        
        <!-- Alerta Informativo sobre a Trigger -->
        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-info-circle-fill fs-5 text-primary"></i>
            <div>
                <strong>Atenção:</strong> Qualquer alteração nos campos abaixo será detectada e gravada automaticamente na tabela de histórico pela trigger <code>trg_produto_update</code>.
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning-subtle text-warning-emphasis py-3 border-bottom border-warning-subtle">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square fs-5"></i>
                        <h5 class="card-title mb-0 fw-bold">Editar Produto #<?= htmlspecialchars((string)$id) ?></h5>
                    </div>
                    <span class="badge bg-warning text-dark">Modo Edição</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="index.php?action=edit&id=<?= urlencode((string)$id) ?>" method="POST" id="formEditProduct">
                    <!-- Campo oculto para o ID -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$id) ?>">

                    <!-- Nome do Produto -->
                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">
                            Nome do Produto <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">
                                <i class="bi bi-tag"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="nome" 
                                   name="nome" 
                                   value="<?= htmlspecialchars($nome) ?>" 
                                   required>
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-semibold">
                            Descrição Detalhada
                        </label>
                        <textarea class="form-control" 
                                  id="descricao" 
                                  name="descricao" 
                                  rows="3"><?= htmlspecialchars($descricao) ?></textarea>
                    </div>

                    <!-- Linha: Preço e Quantidade -->
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="preco" class="form-label fw-semibold">
                                Preço Unitário <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-muted">R$</span>
                                <input type="number" 
                                       step="0.01" 
                                       min="0" 
                                       class="form-control" 
                                       id="preco" 
                                       name="preco" 
                                       value="<?= htmlspecialchars((string)$preco) ?>" 
                                       required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="quantidade" class="form-label fw-semibold">
                                Quantidade em Estoque <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">
                                    <i class="bi bi-stack"></i>
                                </span>
                                <input type="number" 
                                       min="0" 
                                       class="form-control" 
                                       id="quantidade" 
                                       name="quantidade" 
                                       value="<?= htmlspecialchars((string)$quantidade) ?>" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Ações -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?action=list" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bi bi-arrow-left"></i>
                            <span>Cancelar</span>
                        </a>
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-save"></i>
                            <span>Salvar Alterações</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

