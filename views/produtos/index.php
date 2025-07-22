<!-- views/produtos/index.php -->
<?php include 'layout/header.php'; ?>
<h1 class="mb-4">Produtos</h1>
<a href="/produto/editar" class="btn btn-primary mb-3">Novo Produto</a>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço Base</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['id'] ?></td>
                <td><?= $produto['nome'] ?></td>
                <td>R$ <?= number_format($produto['preco_base'], 2, ',', '.') ?></td>
                <td>
                    <a href="/produto/editar?id=<?= $produto['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/produto/comprar?id=<?= $produto['id'] ?>" class="btn btn-sm btn-success">Comprar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'layout/footer.php'; ?>