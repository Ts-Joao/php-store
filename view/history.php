<?php
$pageTitle = 'Histórico de Alterações (Trigger)';
require_once __DIR__ . '/layout/header.php';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="h3 fw-bold text-dark mb-1">
            <i class="bi bi-clock-history text-secondary me-2"></i>Histórico de Alterações
        </h2>
        <p class="text-muted small mb-0">
            Registros gerados automaticamente no banco de dados pela trigger <code>trg_produto_update</code>.
        </p>
    </div>
    <div>
        <a href="index.php?action=list" class="btn btn-outline-secondary d-flex align-items-center gap-1">
            <i class="bi bi-arrow-left"></i>
            <span>Voltar aos Produtos</span>
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col" style="width: 170px;">Data / Hora</th>
                        <th scope="col" style="width: 110px;" class="text-center">ID Produto</th>
                        <th scope="col">Produto</th>
                        <th scope="col" style="width: 160px;">Campo Alterado</th>
                        <th scope="col">Valor Anterior</th>
                        <th scope="col">Novo Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($history)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
                                    <p class="mb-1 fw-semibold">Nenhuma alteração registrada até o momento.</p>
                                    <small>Edite as informações de algum produto para que a trigger registre as mudanças aqui.</small>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($history as $h): ?>
                            <tr>
                                <td>
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <?= !empty($h['data_alteracao']) ? date('d/m/Y H:i:s', strtotime($h['data_alteracao'])) : '-' ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        #<?= htmlspecialchars((string)($h['id_produto'] ?? '')) ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($h['produto_nome'] ?? $h['nome'] ?? 'Produto #' . ($h['id_produto'] ?? '')) ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                        <code><?= htmlspecialchars($h['campo_alterado'] ?? '') ?></code>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-danger">
                                        <del><?= htmlspecialchars($h['valor_antigo'] ?? '(vazio)') ?></del>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">
                                        <?= htmlspecialchars($h['valor_novo'] ?? '(vazio)') ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (!empty($history)): ?>
        <div class="card-footer bg-white border-top text-muted small py-3">
            Total de alterações registradas: <strong><?= count($history) ?></strong>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

