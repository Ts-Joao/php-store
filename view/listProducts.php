<?php
$pageTitle = 'Listagem de Produtos';
require_once __DIR__ . '/layout/header.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="h3 fw-bold text-dark mb-1">
            <i class="bi bi-boxes text-primary me-2"></i>Produtos Cadastrados
        </h2>
        <p class="text-muted small mb-0">Gerencie os produtos do estoque e acompanhe o inventário.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="index.php?action=create" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Cadastrar Produto</span>
        </a>
    </div>
</div>

<!-- Filtro de Busca -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="index.php" method="GET" class="row g-2 align-items-center">
            <input type="hidden" name="action" value="list">
            <div class="col-md-9 col-sm-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0" 
                           id="name" 
                           name="name" 
                           value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" 
                           placeholder="Buscar produto por nome...">
                </div>
            </div>
            <div class="col-md-3 col-sm-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    Buscar
                </button>
                <?php if (!empty($_GET['name'])): ?>
                    <a href="index.php?action=list" class="btn btn-outline-secondary" title="Limpar busca">
                        <i class="bi bi-x-lg"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Tabela de Produtos -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 80px;" class="text-center">#ID</th>
                        <th scope="col">Nome do Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col" style="width: 140px;">Preço</th>
                        <th scope="col" style="width: 120px;" class="text-center">Estoque</th>
                        <th scope="col" style="width: 180px;" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-2 fw-semibold">Nenhum produto encontrado.</p>
                                    <small class="d-block mb-3">Cadastre novos itens para alimentar o catálogo do estoque.</small>
                                    <a href="index.php?action=create" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i>Cadastrar Primeiro Produto
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $p): ?>
                            <?php
                                $id    = $p['id'] ?? null;
                                $nome  = $p['nome'] ?? $p['name'] ?? '';
                                $desc  = $p['descricao'] ?? $p['description'] ?? '';
                                $preco = (float) ($p['preco'] ?? $p['price'] ?? 0);
                                $qtd   = (int) ($p['quantidade'] ?? $p['amount'] ?? 0);
                            ?>
                            <tr>
                                <td class="text-center fw-bold text-secondary">
                                    #<?= htmlspecialchars((string)$id) ?>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= htmlspecialchars($nome) ?></span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        <?= !empty($desc) ? nl2br(htmlspecialchars($desc)) : '<em class="text-black-50">Sem descrição</em>' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">
                                        R$ <?= number_format($preco, 2, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($qtd > 5): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="bi bi-check-circle me-1"></i><?= $qtd ?> un
                                        </span>
                                    <?php elseif ($qtd > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                                            <i class="bi bi-exclamation-triangle me-1"></i><?= $qtd ?> un
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                            <i class="bi bi-x-circle me-1"></i>Esgotado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="index.php?action=edit&id=<?= urlencode((string)$id) ?>" 
                                           class="btn btn-outline-primary" 
                                           title="Editar Produto">
                                            <i class="bi bi-pencil-square me-1"></i>Editar
                                        </a>
                                        <a href="index.php?action=delete&id=<?= urlencode((string)$id) ?>" 
                                           class="btn btn-outline-danger" 
                                           title="Excluir Produto"
                                           onclick="return confirm('Deseja realmente excluir o produto &quot;<?= htmlspecialchars(addslashes($nome)) ?>&quot; (ID #<?= $id ?>)? Esta ação não pode ser desfeita.');">
                                            <i class="bi bi-trash me-1"></i>Excluir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (!empty($products)): ?>
        <div class="card-footer bg-white border-top text-muted small py-3 d-flex justify-content-between align-items-center">
            <span>Total de registros: <strong><?= count($products) ?></strong> produto(s)</span>
            <a href="index.php?action=history" class="text-decoration-none">
                <i class="bi bi-clock-history me-1"></i>Ver histórico de alterações da Trigger &rarr;
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

