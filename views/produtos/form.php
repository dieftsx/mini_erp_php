<!-- views/produtos/form.php -->
<?php include '../layout/header.php'; ?>
<h1 class="mb-4"><?= $produto ? 'Editar' : 'Novo' ?> Produto</h1>

<form method="POST" action="/produto/salvar">
    <input type="hidden" name="id" value="<?= $produto->id ?? '' ?>">
    
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= $produto->nome ?? '' ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Preço Base (R$)</label>
        <input type="number" step="0.01" name="preco_base" class="form-control" 
               value="<?= $produto->preco_base ?? '' ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"><?= $produto->descricao ?? '' ?></textarea>
    </div>
    
    <h4 class="mt-4">Variações</h4>
    <div id="variacoes-container">
        <?php foreach ($variacoes as $index => $variacao): ?>
        <div class="variacao-item border p-3 mb-3">
            <input type="hidden" name="variacoes[<?= $index ?>][id]" value="<?= $variacao['id'] ?>">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nome</label>
                    <input type="text" name="variacoes[<?= $index ?>][nome]" class="form-control" 
                           value="<?= $variacao['nome'] ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preço Adicional</label>
                    <input type="number" step="0.01" name="variacoes[<?= $index ?>][preco_adicional]" 
                           class="form-control" value="<?= $variacao['preco_adicional'] ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estoque</label>
                    <input type="number" name="variacoes[<?= $index ?>][estoque]" class="form-control" 
                           value="<?= $variacao['estoque'] ?>" required>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <button type="button" id="add-variacao" class="btn btn-secondary mb-3">Adicionar Variação</button>
    <button type="submit" class="btn btn-primary d-block">Salvar</button>
</form>

<script>
    document.getElementById('add-variacao').addEventListener('click', function() {
        const container = document.getElementById('variacoes-container');
        const index = container.children.length;
        
        const div = document.createElement('div');
        div.className = 'variacao-item border p-3 mb-3';
        div.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nome</label>
                    <input type="text" name="variacoes[${index}][nome]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Preço Adicional</label>
                    <input type="number" step="0.01" name="variacoes[${index}][preco_adicional]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estoque</label>
                    <input type="number" name="variacoes[${index}][estoque]" class="form-control" required>
                </div>
            </div>
        `;
        
        container.appendChild(div);
    });
</script>
<?php include '../layout/footer.php'; ?>