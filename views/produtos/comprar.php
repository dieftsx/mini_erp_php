<!-- views/produtos/comprar.php -->
<?php include '../layout/header.php'; ?>
<h1 class="mb-4">Comprar: <?= $produto->nome ?></h1>

<form method="POST" action="/carrinho/adicionar">
    <input type="hidden" name="produto_id" value="<?= $produto->id ?>">
    
    <div class="mb-3">
        <label class="form-label">Variação</label>
        <select name="variacao_id" class="form-select" required>
            <?php foreach ($variacoes as $variacao): ?>
            <option value="<?= $variacao['id'] ?>">
                <?= $variacao['nome'] ?> - 
                R$ <?= number_format($produto->preco_base + $variacao['preco_adicional'], 2, ',', '.') ?> - 
                Estoque: <?= $variacao['estoque'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Quantidade</label>
        <input type="number" name="quantidade" class="form-control" min="1" value="1" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
</form>
<?php include '../layout/footer.php'; ?>