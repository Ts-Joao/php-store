<?php
$pageTitle = 'Cadastrar Novo Produto';
require_once __DIR__ . '/layout/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill fs-5"></i>
                    <h5 class="card-title mb-0 fw-bold">Cadastrar Novo Produto</h5>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="index.php?action=create" method="POST" id="formAddProduct" novalidate>
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
                                   placeholder="Ex: Teclado Mecânico RGB" 
                                   required 
                                   autofocus>
                        </div>
                        <div class="form-text">Digite o título ou identificação comercial do produto.</div>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-semibold">
                            Descrição Detalhada
                        </label>
                        <textarea class="form-control" 
                                  id="descricao" 
                                  name="descricao" 
                                  rows="3" 
                                  placeholder="Informe características, especificações técnicas ou observações..."></textarea>
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
                                       placeholder="0,00" 
                                       required>
                            </div>
                            <div class="form-text">Use ponto ou vírgula para centavos.</div>
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
                                       placeholder="Ex: 50" 
                                       required>
                            </div>
                            <div class="form-text">Unidades disponíveis em estoque.</div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Ações -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?action=list" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                            <i class="bi bi-arrow-left"></i>
                            <span>Cancelar e Voltar</span>
                        </a>
                        <button type="submit" class="btn btn-success px-4 d-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-check-circle"></i>
                            <span>Salvar Produto</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

