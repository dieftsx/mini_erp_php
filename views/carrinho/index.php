<!-- views/carrinho/index.php -->
<?php include '../layout/header.php'; ?>
<h1 class="mb-4">Carrinho de Compras</h1>

<?php if (empty($carrinho)): ?>
    <div class="alert alert-info">Seu carrinho está vazio</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Variação</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrinho as $id => $item): ?>
                <tr>
                    <td><?= Produto::buscarPorId($item['produto_id'])->nome ?></td>
                    <td><?= $item['nome'] ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
                    <td>
                        <a href="/carrinho/remover?id=<?= $id ?>" class="btn btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo do Pedido</h5>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Frete:</span>
                        <span>R$ <?= number_format($frete, 2, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>R$ <?= number_format($subtotal + $frete, 2, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Finalizar Compra</h5>
                    <form method="POST" action="/carrinho/finalizar">
                        <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                        <input type="hidden" name="frete" value="<?= $frete ?>">
                        <input type="hidden" name="total" value="<?= $subtotal + $frete ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Cupom de Desconto</label>
                            <select name="cupom_id" class="form-select">
                                <option value="">Selecione um cupom</option>
                                <?php foreach ($cupons as $cupom): ?>
                                <option value="<?= $cupom['id'] ?>"><?= $cupom['codigo'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">CEP</label>
                            <div class="input-group">
                                <input type="text" id="cep" name="cep" class="form-control" required>
                                <button type="button" id="buscarCep" class="btn btn-outline-secondary">Buscar</button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <textarea id="endereco" name="endereco" class="form-control" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Finalizar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include '../layout/footer.php'; ?>